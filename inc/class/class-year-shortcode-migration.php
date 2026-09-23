<?php

defined( 'ABSPATH' ) || exit;

/**
 * Upgrade the former generic year shortcode without losing saved content.
 */
final class Travelfic_Toolkit_Year_Shortcode_Migration {
	private const STATE_OPTION = 'travelfic_toolkit_year_shortcode_migration_v1';
	private const POST_BACKUP = '_travelfic_toolkit_year_shortcode_backup_v1';
	private const ELEMENTOR_BACKUP = '_travelfic_toolkit_year_elementor_backup_v1';

	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'migrate_batch' ) );
		add_action( 'admin_notices', array( __CLASS__, 'show_migration_error' ) );
		add_filter( 'the_content', array( __CLASS__, 'replace_legacy_tag' ), 9 );
		add_filter( 'widget_text_content', array( __CLASS__, 'replace_legacy_tag' ), 9 );
		add_filter( 'widget_block_content', array( __CLASS__, 'replace_legacy_tag' ), 9 );
		add_action( 'after_switch_theme', array( __CLASS__, 'migrate_footer_setting' ) );
	}

	public static function replace_legacy_tag( $content ) {
		if ( ! is_string( $content ) || false === stripos( $content, '[year]' ) ) {
			return $content;
		}

		return preg_replace( '/(?<!\[)\[year\](?!\])/i', '[travelfic_toolkit_year]', $content );
	}

	public static function migrate_batch() {
		if ( ! current_user_can( 'manage_options' ) || wp_doing_ajax() ) {
			return;
		}

		self::migrate_footer_setting();
		$state = get_option( self::STATE_OPTION, array( 'last_id' => 0 ) );
		if ( ! is_array( $state ) || ! empty( $state['complete'] ) || ! empty( $state['error'] ) ) {
			return;
		}

		global $wpdb;
		$last_id = isset( $state['last_id'] ) ? absint( $state['last_id'] ) : 0;
		$ids = $wpdb->get_col( $wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE ID > %d AND post_type NOT IN ('revision', 'attachment') ORDER BY ID ASC LIMIT 50",
			$last_id
		) );

		foreach ( $ids as $id ) {
			$id = absint( $id );
			$post = get_post( $id );
			if ( $post && is_string( $post->post_content ) ) {
				$replacement = self::replace_legacy_tag( $post->post_content );
				if ( $replacement !== $post->post_content ) {
					if ( ! self::backup_meta( $id, self::POST_BACKUP, $post->post_content ) ) {
						self::record_error( $last_id );
						return;
					}
					$updated = wp_update_post( array( 'ID' => $id, 'post_content' => wp_slash( $replacement ) ), true );
					if ( is_wp_error( $updated ) || ! $updated ) {
						self::record_error( $last_id );
						return;
					}
				}
			}

			$elementor = get_post_meta( $id, '_elementor_data', true );
			if ( is_string( $elementor ) && false !== stripos( $elementor, '[year]' ) ) {
				$replacement = self::replace_legacy_tag( $elementor );
				if ( $replacement !== $elementor && null !== json_decode( $replacement, true ) ) {
					if ( ! self::backup_meta( $id, self::ELEMENTOR_BACKUP, $elementor ) ) {
						self::record_error( $last_id );
						return;
					}
					if ( ! update_post_meta( $id, '_elementor_data', wp_slash( $replacement ) ) ) {
						self::record_error( $last_id );
						return;
					}
				}
			}
			$last_id = $id;
		}

		update_option( self::STATE_OPTION, array( 'last_id' => $last_id, 'complete' => count( $ids ) < 50 ), false );
	}

	public static function migrate_footer_setting() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$key = 'travelfic_customizer_settings_copyright_text';
		$mods = get_theme_mods();
		if ( ! is_array( $mods ) || ! isset( $mods[ $key ] ) || ! is_string( $mods[ $key ] ) ) {
			return;
		}

		$replacement = self::replace_legacy_tag( $mods[ $key ] );
		if ( $replacement === $mods[ $key ] ) {
			return;
		}

		$backup_key = 'travelfic_toolkit_year_footer_backup_v1_' . sanitize_key( get_stylesheet() );
		if ( ! add_option( $backup_key, $mods[ $key ], '', false ) && false === get_option( $backup_key, false ) ) {
			return;
		}
		set_theme_mod( $key, $replacement );
	}

	public static function show_migration_error() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$state = get_option( self::STATE_OPTION );
		if ( ! is_array( $state ) || empty( $state['error'] ) ) {
			return;
		}

		echo '<div class="notice notice-error"><p>' . esc_html__( 'Tourfic Toolkit paused the year-shortcode upgrade because a saved item could not be backed up or updated. Existing content was retained. Please contact support before retrying the upgrade.', 'travelfic-toolkit' ) . '</p></div>';
	}

	private static function backup_meta( $id, $key, $value ) {
		return metadata_exists( 'post', $id, $key ) || add_post_meta( $id, $key, wp_slash( $value ), true );
	}

	private static function record_error( $last_id ) {
		update_option( self::STATE_OPTION, array( 'last_id' => $last_id, 'error' => true ), false );
	}
}

Travelfic_Toolkit_Year_Shortcode_Migration::init();
