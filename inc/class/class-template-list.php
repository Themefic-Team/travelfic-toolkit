<?php
defined( 'ABSPATH' ) || exit;
/**
 * Travelfic Template List Class
 * @since 1.0.0
 * @author Jahid
 */
if ( ! class_exists( 'Travelfic_Template_List' ) ) {
	class Travelfic_Template_List {

		private static $instance = null;
		private static $current_step = null;

		/**
		 * Singleton instance
		 * @since 1.0.0
		 */
		public static function instance() {
			if ( self::$instance == null ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'admin_menu', [ $this, 'travelfic_template_list_menu' ], 100 );
			add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
			add_action( 'admin_init', [ $this, 'tf_activation_redirect' ] );
			add_action( 'wp_ajax_tf_setup_wizard_submit', [ $this, 'tf_setup_wizard_submit_ajax' ] );
			add_action( 'in_admin_header', [ $this, 'remove_notice' ], 1000 );

			self::$current_step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : 'welcome';
		}

		/**
		 * Add wizard submenu
		 */
		public function travelfic_template_list_menu() {

			if ( current_user_can( 'manage_options' ) ) {
				add_submenu_page(
					'',
					esc_html__( 'Travelfic Template List', 'travelfic-toolkit' ),
					esc_html__( 'Travelfic Template List', 'travelfic-toolkit' ),
					'manage_options',
					'travelfic-template-list',
					[ $this, 'travelfic_template_list_page' ],
					99
				);
			}
		}

		/**
		 * Remove all notice in setup wizard page
		 */
		public function remove_notice() {
			if ( isset( $_GET['page'] ) && $_GET['page'] == 'travelfic-template-list' ) {
				remove_all_actions( 'admin_notices' );
				remove_all_actions( 'all_admin_notices' );
			}
		}

		/**
		 * Setup wizard page
		 */
		public function travelfic_template_list_page() {
            $this->travelfic_template_list_step();
            $this->tf_setup_step_one();
		}

		/**
		 * Welcome step
		 */
		private function travelfic_template_list_step() {
			?>
            <div class="travelfic-template-list-wrapper" id="travelfic-template-list-wrapper">
                <div class="travelfic-template-list-container">
                    <div class="travelfic-template-list-heading">
                        <h2><?php _e("What type of website are you building?", "travelfic-toolkit"); ?></h2>
                    </div>
                    <div class="travelfic-template-filter">
                        
                    </div>
                </div>
            </div>
			<?php
		}

		/**
		 * Setup step one
		 */
		private function tf_setup_step_one() {
			$tf_disable_services = ! empty( tfopt( 'disable-services' ) ) ? tfopt( 'disable-services' ) : '';
			?>
            <div class="tf-setup-step-container tf-setup-step-1 <?php echo self::$current_step == 'step_1' ? 'active' : ''; ?>" data-step="1">
                <section class="tf-setup-step-layout">
					<?php $this->tf_setup_wizard_steps_header() ?>
                    <h1 class="tf-setup-step-title"><?php _e( 'Select your service type', 'tourfic' ) ?></h1>
                    <p class="tf-setup-step-desc"><?php _e( '(You can choose any one or both)', 'tourfic' ) ?></p>
                    <ul class="tf-select-service">
                        <li>
                            <input type="checkbox" id="tf-hotel" name="tf-services[]"
                                   value="hotel" <?php echo empty( $tf_disable_services ) || ! in_array( 'hotel', $tf_disable_services ) ? esc_attr( 'checked' ) : ''; ?>/>
                            <label for="tf-hotel">
                                <img src="<?php echo TF_ASSETS_ADMIN_URL . 'images/hotel.png' ?>" alt="<?php esc_attr_e( 'Hotel', 'tourfic' ) ?>">
                                <span><?php _e( 'Hotel', 'tourfic' ) ?></span>
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="tf-tour" name="tf-services[]" value="tour" <?php echo empty( $tf_disable_services ) || ! in_array( 'tour', $tf_disable_services ) ? esc_attr( 'checked' ) : ''; ?>/>
                            <label for="tf-tour">
                                <img src="<?php echo TF_ASSETS_ADMIN_URL . 'images/tour.png' ?>" alt="<?php esc_attr_e( 'Tour', 'tourfic' ) ?>">
                                <span><?php _e( 'Tour', 'tourfic' ) ?></span>
                            </label>
                        </li>
                        <li>
                            <input type="checkbox" id="tf-apartment" name="tf-services[]"
                                   value="apartment" <?php echo empty( $tf_disable_services ) || ! in_array( 'apartment', $tf_disable_services ) ? esc_attr( 'checked' ) : ''; ?>/>
                            <label for="tf-apartment">
                                <img src="<?php echo TF_ASSETS_ADMIN_URL . 'images/apartment.png' ?>" alt="<?php esc_attr_e( 'Apartment', 'tourfic' ) ?>">
                                <span><?php _e( 'Apartment', 'tourfic' ) ?></span>
                            </label>
                        </li>
                    </ul>
                </section>
                <div class="tf-setup-action-btn-wrapper">
                    <div></div>
                    <div class="tf-setup-action-btn-next">
                        <button type="button" class="tf-setup-skip-btn tf-link-btn"><?php _e( 'Skip this step', 'tourfic' ) ?></button>
                        <button type="button" class="tf-setup-next-btn tf-admin-btn tf-btn-secondary"><?php _e( 'Next', 'tourfic' ) ?></button>
                    </div>
                </div>
            </div>
			<?php
		}

		/**
		 * redirect to set up wizard when active plugin
		 */
		public function tf_activation_redirect() {
			if ( ! get_option( 'tf_setup_wizard' ) && ! get_option( 'tf_settings' ) ) {
				update_option( 'tf_setup_wizard', 'active' );
				wp_redirect( admin_url( 'admin.php?page=tf-setup-wizard' ) );
				exit;
			}
		}
	}
}

new Travelfic_Template_List();