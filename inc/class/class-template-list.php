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
            $this->travelfic_setup_theme();
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

                        <span class="settings-import-btn" style="display: none;"><?php _e("Settings Import", "travelfic-toolkit"); ?></span>
                        <span class="customizer-import-btn" style="display: none;"><?php _e("Customizer Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-hotel-import-btn" style="display: none;"><?php _e("Hotel Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-tour-import-btn" style="display: none;"><?php _e("Tour Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-page-import-btn" style="display: none;"><?php _e("Pages Import", "travelfic-toolkit"); ?></span>
                        <span class="plug-tourfic-btn" style="display: none;"><?php _e("Tourfic Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-woocommerce-btn" style="display: none;"><?php _e("Woocommerce Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-elementor-btn" style="display: none;"><?php _e("Elementor Install", "travelfic-toolkit"); ?></span>
                    </div>
                    <!-- <div class="travelfic-template-filter">
                        <div class="travelfic-search-form">
                            <input type="text" placeholder="<?php _e("Search for templates", "travelfic-toolkit"); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z" fill="#666D74"/>
                            </svg>
                        </div>
                        <div class="travelfic-filter-selection">
                            <select name="" id="">
                                <option value=""><?php _e("Tour", "travelfic-toolkit"); ?></option>
                            </select>
                            <select name="" id="">
                                <option value=""><?php _e("Hotel", "travelfic-toolkit"); ?></option>
                            </select>
                            <select name="" id="">
                                <option value=""><?php _e("Apartment", "travelfic-toolkit"); ?></option>
                            </select>
                        </div>
                    </div> -->

                    <div class="travelfic-templates-list">

                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="travelfic-single-template">
                            <div class="template-img">
                                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/templates/home-1.png' ?>" alt="">
                                <div class="template-preview">
                                    <a href="#" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="template-import-btn">
                                <?php _e("Import demo 1", "travelfic-toolkit"); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}

		/**
		 * Setup step one
		 */
		private function travelfic_setup_theme() {
		?>
        <div class="travelfic-template-list-wrapper" id="travelfic-template-importing-wrapper">
            <div class="travelfic-template-import-container">
                <div class="travelfic-template-list-heading">
                    <h2><?php _e("Hey, we are building your website...", "travelfic-toolkit"); ?></h2>
                </div>
                <div class="travelfic-template-demo-importing">
                    <div class="demo-importing-loader">
                        <div class="loader-heading">
                            <div class="loader-label">
                            <?php _e("Installing required plugins...", "travelfic-toolkit"); ?>
                            </div>
                            <div class="loader-precent">
                                0%
                            </div>
                        </div>
                        <div class="loader-bars">
                            <div class="loader-precent-bar">

                            </div>
                        </div>
                    </div>
                    <div class="importing-img">
                        <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/demo-importing.png' ?>" alt="">
                    </div>
                    <div class="importing-success">
                        <h4><?php _e("This theme was built by @themefic. It's a really impressive feat!", "travelfic-toolkit"); ?></h4>
                        <a href="<?php echo site_url(); ?>" target="_blank"><?php _e("Visit you website", "travelfic-toolkit"); ?></a>
                    </div>
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