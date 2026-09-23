<?php
/**
 * Regression checks for idempotent contact-form imports and structured Car data.
 *
 * Run: php tests/security/demo-import-structured-data.php
 */

define( 'ABSPATH', __DIR__ . '/' );
define( 'OBJECT', 'OBJECT' );

$contact_forms = array(
	'Existing form' => array(
		'mail' => array( 'recipient' => 'owner@example.com' ),
	),
);
$contact_form_saves = 0;

function add_action() {
	return true;
}

function sanitize_text_field( $value ) {
	return is_scalar( $value ) ? trim( strip_tags( (string) $value ) ) : '';
}

function wp_json_encode( $value ) {
	return json_encode( $value );
}

function get_posts( $args ) {
	global $contact_forms;

	if ( 'wpcf7_contact_form' !== $args['post_type'] || ! isset( $contact_forms[ $args['title'] ] ) ) {
		return array();
	}

	return array( (object) array( 'post_title' => $args['title'] ) );
}

class WPCF7_ContactForm {
	private $title;
	private $properties = array();

	public static function get_template( $args ) {
		$form        = new self();
		$form->title = $args['title'];

		return $form;
	}

	public function set_properties( $properties ) {
		$this->properties = $properties;
	}

	public function save() {
		global $contact_forms, $contact_form_saves;

		$contact_forms[ $this->title ] = $this->properties;
		++$contact_form_saves;
	}
}

function assert_demo_import( $condition, $message ) {
	if ( ! $condition ) {
		fwrite( STDERR, "FAIL: {$message}\n" );
		exit( 1 );
	}
}

require dirname( __DIR__, 2 ) . '/inc/class/class-importer.php';

$importer            = new Travelfic_Template_Importer();
$import_forms_method = new ReflectionMethod( $importer, 'import_contact_forms' );
$decode_array_method = new ReflectionMethod( $importer, 'decode_import_array' );
$import_forms_method->setAccessible( true );
$decode_array_method->setAccessible( true );
$forms               = array(
	array(
		'title'      => 'Existing form',
		'properties' => wp_json_encode( array( 'mail' => array( 'recipient' => 'demo@example.com' ) ) ),
	),
	array(
		'title'      => 'Demo enquiry',
		'properties' => wp_json_encode( array( 'mail' => array( 'recipient' => 'demo@example.com' ) ) ),
	),
);

$import_forms_method->invoke( $importer, $forms );
$after_first_import = $contact_forms;
$import_forms_method->invoke( $importer, $forms );

assert_demo_import( 1 === $contact_form_saves, 'Repeated imports must not create duplicate Contact Form 7 forms.' );
assert_demo_import(
	'owner@example.com' === $contact_forms['Existing form']['mail']['recipient'],
	'An existing form with the same title must not be overwritten.'
);
assert_demo_import( $after_first_import === $contact_forms, 'The second form import must be idempotent.' );

$policy_json = '[{"cancellation-times":"day","cancellation_type":"free","before_cancel_time":"2"}]';
$policies    = $decode_array_method->invoke( $importer, $policy_json );
assert_demo_import( is_array( $policies ) && 1 === count( $policies ), 'Valid policy JSON must decode to an array.' );
assert_demo_import( array() === $decode_array_method->invoke( $importer, '[]' ), 'An empty policy list must remain an array.' );
assert_demo_import( array() === $decode_array_method->invoke( $importer, 'invalid' ), 'Invalid policy JSON must fail closed.' );

$source = file_get_contents( dirname( __DIR__, 2 ) . '/inc/class/class-importer.php' );
assert_demo_import(
	false !== strpos( $source, "'calcellation_policy' === \$field" ),
	'The Car importer must decode the actual cancellation-policy field.'
);
assert_demo_import(
	false === strpos( $source, "\$field == 'cancellation_type'" ),
	'The Car importer must not target the nonexistent cancellation_type CSV field.'
);

echo "Demo structured-data import checks passed.\n";
