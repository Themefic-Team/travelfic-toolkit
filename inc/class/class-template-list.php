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
			add_action( 'admin_init', [ $this, 'travelfic_toolkit_activation_redirect' ] );
//			add_action( 'wp_ajax_tf_setup_wizard_submit', [ $this, 'tf_setup_wizard_submit_ajax' ] );
			add_action( 'in_admin_header', [ $this, 'remove_notice' ], 1000 );

			self::$current_step = isset( $_GET['step'] ) ? sanitize_key( $_GET['step'] ) : 'welcome';
		}

		/**
		 * Add wizard submenu
		 */
		public function travelfic_template_list_menu() {

			if ( current_user_can( 'manage_options' ) ) {
				add_submenu_page(
					'travelfic-template-list',
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
        * Template List
        */
        public function template_list_header_footer(){
        ?>
        <div class="travelfic-template-top-header">
            <div class="header-logo">
                <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/travelfic-toolkit-icon.png') ?>" class="stc-logo-image" alt="Starter Templates">
            </div>
            <div class="top-header-right-navigation">
                <div class="travelfic-templte-sync-btn" title="<?php esc_html_e("Sync Library", "travelfic-toolkit"); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Refresh">
                    <path id="Vector" d="M5 7.99999L8.99999 12H5.99999C5.99999 15.31 8.69 18 12 18C13.01 18 13.97 17.75 14.8 17.3L16.26 18.76C15.03 19.54 13.57 20 12 20C7.58 20 4 16.42 4 12H1L5 7.99999ZM18 12C18 8.68999 15.31 6 12 6C10.99 6 10.03 6.25 9.2 6.7L7.73999 5.23999C8.96999 4.45999 10.43 4 12 4C16.42 4 20 7.57999 20 12H23L19 16L15 12H18Z" fill="#3D4C5C"/>
                    </g>
                    </svg>
                </div>
                <div class="header-exit-btn">
                    <a href="<?php echo esc_url(admin_url()); ?>" title="<?php esc_html_e("Exit to Dashboard", "travelfic-toolkit"); ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.7731 9.22687L9 15M14.7731 9.22687C14.2678 8.72156 11.8846 9.21665 11.1649 9.22687M14.7731 9.22687C15.2784 9.73219 14.7834 12.1154 14.7731 12.8351" stroke="#3D4C5C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="#3D4C5C" stroke-width="1.5"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <?php
        }

		private function travelfic_template_list_step() {
            $this->template_list_header_footer();
			?>
            <div class="travelfic-import-confirmaiton-msg">
                <div class="travelfic-card-flex">
                    <div class="import-confirmation-card">
                        <div class="import-confirmation-bg" style="background-image: url(<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/importing-bg.png'); ?>)">
                        </div>
                        <div class="import-confirmation-close">
                            <div class="default">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <rect width="32" height="32" rx="8" fill="#EBF5FF"/>
                                <path d="M15.9994 14.8149L20.1475 10.6667L21.3327 11.8519L17.1846 16.0001L21.3327 20.1482L20.1475 21.3334L15.9994 17.1853L11.8512 21.3334L10.666 20.1482L14.8142 16.0001L10.666 11.8519L11.8512 10.6667L15.9994 14.8149Z" fill="#27333F"/>
                                </svg>
                            </div>
                            <div class="hover">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <rect x="0.5" y="0.5" width="31" height="31" rx="7.5" fill="#EBF5FF"/>
                                    <rect x="0.5" y="0.5" width="31" height="31" rx="7.5" stroke="#CFE5FC"/>
                                    <path d="M15.9994 14.8149L20.1475 10.6667L21.3327 11.8519L17.1846 16.0001L21.3327 20.1482L20.1475 21.3334L15.9994 17.1853L11.8512 21.3334L10.666 20.1482L14.8142 16.0001L10.666 11.8519L11.8512 10.6667L15.9994 14.8149Z" fill="#27333F"/>
                                </svg>
                            </div>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="63" viewBox="0 0 72 63" fill="none">
                        <path d="M20.5351 20.4642L18.7949 25.1878C23.9376 32.8025 32.8734 39.8392 39.7987 42.1121C57.165 47.8115 72.3631 33.3106 71.9927 33.5456C62.9002 39.3244 54.5128 39.9427 51.8494 40.0239C42.6484 40.3036 36.4175 35.1173 33.7362 32.0734C32.0906 30.2046 30.652 28.2339 29.1334 26.3041C27.7156 24.5018 25.45 21.4848 24.256 19.6792L20.5351 20.4642Z" fill="#FFC100"/>
                        <path d="M36.1429 17.0678C35.27 22.4986 39.1481 30.8368 44.058 32.9927C48.9679 35.1481 42.5467 32.4987 39.7379 25.3612C38.6591 22.6195 38.3027 19.8123 37.3805 17.0544C37.1646 16.4076 36.2352 16.4932 36.1429 17.0678Z" fill="#FFC100"/>
                        <path d="M46.5802 48.064C46.6703 46.6635 44.6867 51.4951 39.4624 52.9991C37.4206 53.5866 35.2412 53.7287 33.3741 54.6878C32.9175 54.9222 32.9427 55.6239 33.3741 55.865C35.4147 57.0065 38.4272 56.2573 40.4315 55.2977C43.2364 53.9553 46.4912 49.4651 46.5802 48.064Z" fill="#FFC100"/>
                        <path d="M14.814 39.0376C13.6849 40.6049 16.5424 42.1973 18.1304 43.2946C20.0832 44.643 23.6709 46.2539 25.8838 47.1072C33.2361 49.9429 39.7939 45.4264 39.0698 45.6474C35.4508 46.7519 30.4077 46.0223 26.313 44.1954C24.5203 43.3953 22.8461 42.3025 21.2229 41.2064C19.7855 40.2361 15.9426 37.4709 14.814 39.0376Z" fill="#FFC100"/>
                        <path d="M3.62801 1.95278L13.0176 5.6429L21.3798 9.34541e-07L20.7722 10.0699L28.7231 16.2797L18.9581 18.8132L15.5097 28.294L10.0822 19.7896L-8.49721e-07 19.4393L6.41058 11.6501L3.62801 1.95278Z" fill="#FFC100"/>
                        <path d="M2.70703 32.6383L7.12119 32.8196L9.77283 29.2861L10.9641 33.5397L15.1438 34.9699L11.4665 37.4178L11.3977 41.8348L7.93364 39.0937L3.71195 40.3934L5.24787 36.2518L2.70703 32.6383Z" fill="#FFC100"/>
                        <path d="M18.8984 58.4185L21.3873 56.4831L21.2032 53.3357L23.8134 55.1044L26.7498 53.9568L25.8742 56.9855L27.8728 59.424L24.7221 59.5269L23.0205 62.1814L21.9485 59.2164L18.8984 58.4185Z" fill="#FFC100"/>
                        <path d="M33.8622 15.4106L34.0396 12.2632L31.5469 10.3329L34.5952 9.52823L35.6606 6.56104L37.3677 9.2121L40.519 9.30834L38.5254 11.7513L39.4072 14.7778L36.4686 13.6369L33.8622 15.4106Z" fill="#FFC100"/>
                        </svg>
                        <h3><?php esc_html_e("Before we procced...", "travelfic-toolkit"); ?></h3>
                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                        <div class="demo-importing-data-list">
                            <label class="form-control">
                                <input type="checkbox" value="customizer" name="imports[]" checked />
                                <?php esc_html_e("Import Customizer Settings", "travelfic-toolkit"); ?>
                                <span class="checkmark"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <input type="checkbox" value="tourfic" name="imports[]" checked />
                                <?php esc_html_e("Import Tourfic Settings", "travelfic-toolkit"); ?>
                                <span class="checkmark"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <input type="checkbox" name="checkbox" checked disabled/>
                                <?php esc_html_e("Install Required Plugins", "travelfic-toolkit"); ?>
                                <span class="checkmark disabled"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <input type="checkbox" value="widgets" name="imports[]" checked />
                                <?php esc_html_e("Import Widgets", "travelfic-toolkit"); ?>
                                <span class="checkmark"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <input type="checkbox" value="menu" name="imports[]" checked />
                                <?php esc_html_e("Import Menu", "travelfic-toolkit"); ?>
                                <span class="checkmark"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                            <label class="form-control">
                                <input type="checkbox" value="demo" name="imports[]" checked />
                                <?php esc_html_e("Import Content", "travelfic-toolkit"); ?>
                                <span class="checkmark"></span>
                                <div class="label-tooltip">
                                    <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.66602 8.18148C1.66602 5.19592 1.66602 3.70313 2.59351 2.77564C3.52101 1.84814 5.01379 1.84814 7.99935 1.84814C10.9849 1.84814 12.4777 1.84814 13.4052 2.77564C14.3327 3.70313 14.3327 5.19592 14.3327 8.18148C14.3327 11.167 14.3327 12.6598 13.4052 13.5873C12.4777 14.5148 10.9849 14.5148 7.99935 14.5148C5.01379 14.5148 3.52101 14.5148 2.59351 13.5873C1.66602 12.6598 1.66602 11.167 1.66602 8.18148Z" stroke="#27333F"/>
                                    <path d="M8.16081 11.5149V8.18156C8.16081 7.86729 8.16081 7.71015 8.06318 7.61252C7.96555 7.51489 7.80841 7.51489 7.49414 7.51489" stroke="#27333F" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.99401 5.51489H8" stroke="#27333F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="label-tooltip-content">
                                        <p><?php esc_html_e("To ensure a perfect demo installation, please confirm the followings", "travelfic-toolkit"); ?></p>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <button id="submit_confirm">
                            <?php esc_html_e("Submit & Build My Website", "travelfic-toolkit"); ?>
                            <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 12.1812L4 12.1812" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15 7.18115L19.2929 11.474C19.6262 11.8074 19.7929 11.974 19.7929 12.1812C19.7929 12.3883 19.6262 12.5549 19.2929 12.8883L15 17.1812" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="travelfic-template-list-wrapper" id="travelfic-template-list-wrapper" style="background: url(<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png'); ?>), #F8FAFC 50% / cover no-repeat;">
                <div class="travelfic-template-list-container">
                    <div class="travelfic-template-list-heading">
                        <h2><?php esc_html_e("What kind of travel site do you envision creating?", "travelfic-toolkit"); ?></h2>

                        <span class="settings-import-btn" style="display: none;"><?php esc_html_e("Settings Import", "travelfic-toolkit"); ?></span>
                        <span class="customizer-import-btn" style="display: none;"><?php esc_html_e("Customizer Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-hotel-import-btn" style="display: none;"><?php esc_html_e("Hotel Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-tour-import-btn" style="display: none;"><?php esc_html_e("Tour Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-car-import-btn" style="display: none;"><?php esc_html_e("Car Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-tragaway-import-btn" style="display: none;"><?php esc_html_e("Tragaway Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-page-import-btn" style="display: none;"><?php esc_html_e("Pages Import", "travelfic-toolkit"); ?></span>
                        <span class="plug-tourfic-btn" style="display: none;"><?php esc_html_e("Tourfic Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-cf7-btn" style="display: none;"><?php esc_html_e("CF7 Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-woocommerce-btn" style="display: none;"><?php esc_html_e("Woocommerce Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-elementor-btn" style="display: none;"><?php esc_html_e("Elementor Install", "travelfic-toolkit"); ?></span>
                        <span class="widget-import-btn" style="display: none;"><?php esc_html_e("Widget Import", "travelfic-toolkit"); ?></span>
                        <span class="menu-import-btn" style="display: none;"><?php esc_html_e("Menu Import", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-tourfic-btn" style="display: none;"><?php esc_html_e("Tourfic Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-cf7-btn" style="display: none;"><?php esc_html_e("CF7 Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-woocommerce-btn" style="display: none;"><?php esc_html_e("Woocommerce Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-elementor-btn" style="display: none;"><?php esc_html_e("Elementor Active", "travelfic-toolkit"); ?></span>
                    </div>
                    <div class="travelfic-template-filter">
                        <div class="travelfic-search-form">
                            <input type="text" id="travelfic_template_search" placeholder="<?php esc_html_e("Search for templates", "travelfic-toolkit"); ?>">
                            <input type="hidden" value="all" id="travelfic_filter_value">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z" fill="#666D74"/>
                            </svg>
                        </div>
                        <div class="travelfic-filter-selection">
                            <ul>
                                <li class="active" data-value="all"><?php esc_html_e("All", "travelfic-toolkit"); ?></li>
                                <li data-value="tour"><?php esc_html_e("Tour", "travelfic-toolkit"); ?></li>
                                <li data-value="hotel"><?php esc_html_e("Hotel", "travelfic-toolkit"); ?></li>
                                <li data-value="car"><?php esc_html_e("Car", "travelfic-toolkit"); ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="travelfic-templates-list">
                        <?php 
                        $travelfic_sync_templates_list =  !empty(get_option('travelfic_template_sync__schudle_data')) ? get_option('travelfic_template_sync__schudle_data') : '';
                        if(!empty($travelfic_sync_templates_list)){
                        foreach($travelfic_sync_templates_list as $single_temp){
                            if(empty($single_temp['coming_soon'])){
                        ?>
                            <div class="travelfic-single-template" data-template_type="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-template_name="<?php echo !empty($single_temp['title']) ? esc_html($single_temp['title']) : '' ?>">
                                <div class="template-img">
                                    <?php if(!empty($single_temp['template_image_url'])){ ?>
                                    <img src="<?php echo esc_url($single_temp['template_image_url']) ?>" alt="">
                                    <?php } ?>
                                    <?php if(!empty($single_temp['featured_title'])){ ?>
                                    <span class="new-template-tag">
                                        <?php echo esc_html($single_temp['featured_title']); ?>
                                        <span class="pulse"></span>
                                    </span>
                                    <?php } ?>
                                    <div class="template-preview">
                                        <div class="import-button-group">
                                            <a href="<?php echo !empty($single_temp['demo_url']) ? esc_url($single_temp['demo_url']) : '' ?>" target="_blank">
                                                <?php esc_html_e("Preview", "travelfic-toolkit"); ?>
                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="content">
                                                <path id="Vector 4130" d="M12.5 2.00012L1.5 13.0001" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round"/>
                                                <path id="Vector" d="M6.5 1.13151C6.5 1.13151 12.1335 0.65662 12.9885 1.51153C13.8434 2.36645 13.3684 8 13.3684 8" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                </svg>
                                            </a>
                                            <div class="template-import-btn" data-template="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-design="<?php echo !empty($single_temp['demo']) ? esc_html($single_temp['demo']) : '' ?>">
                                                <?php esc_html_e("Import Demo", "travelfic-toolkit"); ?>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 14.5L12 4.5M12 14.5C11.2998 14.5 9.99153 12.5057 9.5 12M12 14.5C12.7002 14.5 14.0085 12.5057 14.5 12" stroke="#211D12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M20 16.5C20 18.982 19.482 19.5 17 19.5H7C4.518 19.5 4 18.982 4 16.5" stroke="#211D12" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if(!empty($single_temp['title'])){ ?>
                                <h2>
                                    <?php echo esc_html($single_temp['title']); ?>
                                </h2>
                                <?php } ?>
                            </div>
                            <?php }
                            if(!empty($single_temp['coming_soon'])){ ?>
                                <div class="travelfic-single-template" data-template_type="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-template_name="<?php echo !empty($single_temp['title']) ? esc_html($single_temp['title']) : '' ?>">
                                    <div class="template-img">
                                        <?php if(!empty($single_temp['template_image_url'])){ ?>
                                        <img src="<?php echo esc_url($single_temp['template_image_url']) ?>" alt="">
                                        <?php } ?>
                                    </div>
                                    <?php if(!empty($single_temp['title'])){ ?>
                                    <h2>
                                        <?php echo esc_html($single_temp['title']); ?>
                                    </h2>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } } ?>
                    </div>
                </div>
            </div>
			<?php
		}

		/**
		 * Setup step one
		 */
		private function travelfic_setup_theme() {
            $this->template_list_header_footer();
		?>
        <div class="travelfic-template-list-wrapper" id="travelfic-template-importing-wrapper" style="background: url(<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png'); ?>), #F8FAFC 50% / cover no-repeat;">
            <div class="travelfic-template-import-container">
                <div class="travelfic-importing-bg" style="background-image: url(<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/importing-bg.png'); ?>)"></div>
                <div class="travelfic-template-list-heading">
                    <h2><?php esc_html_e("Demo Import in progress...", "travelfic-toolkit"); ?></h2>
                    <div class="travelfic-exits-highlights-finished">
                        <div class="travelfic-installing-highlights-content">
                        </div>
                    </div>
                </div>
                <div class="travelfic-template-demo-importing">
                    <div class="demo-importing-loader">
                        <div class="loader-heading">
                            <div class="loader-label">
                            <?php esc_html_e("Installing required plugins...", "travelfic-toolkit"); ?>
                            </div>
                            <div class="loader-precent">
                                0%
                            </div>
                        </div>
                        <div class="loader-bars">
                            <div class="loader-precent-bar">

                            </div>
                        </div>

                        <div class="tf-import-log-boxss">
                            <ul class="tf-import-log-contentss"></ul>
                        </div>
                    </div>
                    <div class="importing-img">
                        <img src="<?php echo esc_url(TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/demo-importing.gif'); ?>" alt="">
                    </div>
                    <div class="importing-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="190" height="150" viewBox="0 0 190 150" fill="none">
                        <path d="M0.574219 135.292C0.574219 143.243 7.02502 149.688 14.9827 149.688H175.025C182.983 149.688 189.433 143.243 189.433 135.292V38.0034H0.574219V135.292Z" fill="#F6FAFE"/>
                        <path d="M175.02 150H14.9776C6.86054 150 0.257812 143.403 0.257812 135.293V37.6934H189.74V135.293C189.74 143.401 183.137 150 175.02 150ZM0.880477 38.3155V135.293C0.880477 143.06 7.20426 149.378 14.9776 149.378H175.02C182.793 149.378 189.117 143.06 189.117 135.293V38.3155H0.880477Z" fill="#CFE5FC"/>
                        <path d="M175.025 0.311035H14.9827C7.02502 0.311035 0.574219 6.75368 0.574219 14.7068V38.0038H189.433V14.7068C189.433 6.75368 182.983 0.311035 175.025 0.311035Z" fill="#F6FAFE"/>
                        <path d="M189.74 38.3149H0.257812V14.7068C0.257812 6.59693 6.86054 0 14.9776 0H175.02C183.137 0 189.74 6.59693 189.74 14.7068V38.3149ZM0.880477 37.6928H189.117V14.7068C189.117 6.94034 182.793 0.622117 175.02 0.622117H14.9776C7.20426 0.622117 0.880477 6.94034 0.880477 14.7068V37.6928Z" fill="#CFE5FC"/>
                        <path d="M27.3374 20.7321C28.2052 16.4598 25.4424 12.2936 21.1664 11.4265C16.8904 10.5594 12.7205 13.3198 11.8526 17.5921C10.9848 21.8643 13.7476 26.0305 18.0236 26.8976C22.2996 27.7647 26.4695 25.0043 27.3374 20.7321Z" fill="#CFE5FC"/>
                        <path d="M48.4505 24.7399C51.5357 21.6573 51.5357 16.6595 48.4505 13.577C45.3652 10.4945 40.363 10.4945 37.2778 13.577C34.1925 16.6596 34.1925 21.6573 37.2778 24.7399C40.363 27.8224 45.3652 27.8224 48.4505 24.7399Z" fill="#F6FAFE"/>
                        <path d="M42.8679 27.3606C38.3399 27.3606 34.6562 23.6802 34.6562 19.1561C34.6562 14.6321 38.3399 10.9517 42.8679 10.9517C47.396 10.9517 51.0797 14.6321 51.0797 19.1561C51.0772 23.6802 47.396 27.3606 42.8679 27.3606ZM42.8679 11.5763C38.6836 11.5763 35.2789 14.978 35.2789 19.1586C35.2789 23.3392 38.6836 26.741 42.8679 26.741C47.0523 26.741 50.457 23.3392 50.457 19.1586C50.457 14.978 47.0523 11.5763 42.8679 11.5763Z" fill="#CFE5FC"/>
                        <path d="M103.007 26.6907H71.5549C67.3905 26.6907 64.0156 23.3188 64.0156 19.1581C64.0156 14.9974 67.3905 11.6255 71.5549 11.6255H103.007C107.171 11.6255 110.546 14.9974 110.546 19.1581C110.546 23.3163 107.171 26.6907 103.007 26.6907Z" fill="#F6FAFE"/>
                        <path d="M103.002 27.0017H71.5498C67.221 27.0017 63.6992 23.483 63.6992 19.1581C63.6992 14.8331 67.221 11.3145 71.5498 11.3145H103.002C107.331 11.3145 110.852 14.8331 110.852 19.1581C110.852 23.483 107.331 27.0017 103.002 27.0017ZM71.5473 11.9341C67.5622 11.9341 64.3194 15.1741 64.3194 19.1556C64.3194 23.1372 67.5622 26.3771 71.5473 26.3771H102.999C106.984 26.3771 110.227 23.1372 110.227 19.1556C110.227 15.1741 106.984 11.9341 102.999 11.9341H71.5473Z" fill="#CFE5FC"/>
                        <path d="M95.3197 106.75L79.8477 91.2775L87.1605 83.9646L94.7103 91.5144L119.527 62.3308L127.415 69.0342L95.3197 106.75Z" fill="#FFC100"/>
                        <path d="M121.659 81.5269V92.767C121.659 108.138 113.771 117.448 107.135 122.56C100.059 128.011 92.9832 129.839 92.7124 129.941C92.4415 130.008 92.1707 130.042 91.8998 130.042C91.5951 130.042 91.3243 130.008 91.0196 129.941C90.7149 129.873 83.6729 127.909 76.597 122.425C67.0836 115.044 62.0729 104.82 62.0729 92.767L61.9375 68.7295C80.4566 68.7295 91.7644 57.3201 91.7983 57.2185C92.0691 57.7602 98.5017 65.8179 109.843 67.9846L105.002 73.6724C98.4001 71.7765 94.2697 68.6279 91.8321 66.0887C88.345 69.7451 81.4046 74.5865 68.7086 75.3313V92.767C68.7086 102.788 72.7375 111.015 80.6597 117.143C85.3318 120.766 90.0039 122.56 91.866 123.203C93.7619 122.594 98.5356 120.766 103.242 117.109C111.028 111.015 114.989 102.822 114.989 92.7332V89.3137L121.659 81.5269Z" fill="#CFE5FC"/>
                        </svg>
                        <div class="sucessful-button-group">
                            <a href="<?php echo esc_url(admin_url()); ?>">
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector" d="M2 6L17 5.99984" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path id="Vector 6908" d="M6 0.999756L1.70711 5.29265C1.37377 5.62598 1.20711 5.79265 1.20711 5.99976C1.20711 6.20686 1.37377 6.37353 1.70711 6.70686L6 10.9998" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                </svg>
                                <?php esc_html_e("Back To Dashboard", "travelfic-toolkit"); ?>
                            </a>
                            <a href="<?php echo esc_url(site_url()); ?>" target="_blank" class="visit-site">
                                <?php esc_html_e("Visit Your Website", "travelfic-toolkit"); ?>
                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector 4130" d="M12.5 2.00012L1.5 13.0001" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round"/>
                                <path id="Vector" d="M6.5 1.13151C6.5 1.13151 12.1335 0.65662 12.9885 1.51153C13.8434 2.36645 13.3684 8 13.3684 8" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=tf_settings')); ?>">
                                <?php esc_html_e("Tourfic Settings", "travelfic-toolkit"); ?>
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector" d="M16 5.99963L1 5.99963" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path id="Vector 6907" d="M12 0.999756L16.2929 5.29265C16.6262 5.62598 16.7929 5.79265 16.7929 5.99976C16.7929 6.20686 16.6262 6.37353 16.2929 6.70686L12 10.9998" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
		}

		/**
		 * redirect to set up wizard when active plugin
		 */
		public function travelfic_toolkit_activation_redirect() {
            if ( ! get_option( 'tf_setup_wizard' ) && ! get_option( 'tf_settings' ) ) {
                update_option( 'tf_setup_wizard', 'active' );
                update_option( 'tf_settings', '' );
            }
			if ( ! get_option( 'travelfic_toolkit_template_wizard' ) ) {
				update_option( 'travelfic_toolkit_template_wizard', 'active' );

                $current_active_theme = !empty(get_option('stylesheet')) ? get_option('stylesheet') : 'No';
                if ( $current_active_theme != 'travelfic' && $current_active_theme != 'travelfic-child' && $current_active_theme != 'ultimate-hotel-booking' && $current_active_theme != 'ultimate-hotel-booking-child' ) {
                    wp_redirect( admin_url( 'themes.php' ) );
                }else{
				    wp_redirect( admin_url( 'admin.php?page=travelfic-template-list' ) );
                }
				exit;
			}
		}
	}
}

new Travelfic_Template_List();