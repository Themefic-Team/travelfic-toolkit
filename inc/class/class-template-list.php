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
        * Template List
        */
        public function template_list_header_footer(){
        ?>
        <div class="travelfic-template-top-header">
            <div class="header-logo">
                <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/travelfic-toolkit-icon.png' ?>" class="stc-logo-image" alt="Starter Templates">
            </div>
            <div class="top-header-right-navigation">
                <div class="travelfic-templte-sync-btn" title="<?php _e("Sync Library", "travelfic-toolkit"); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Refresh">
                    <path id="Vector" d="M5 7.99999L8.99999 12H5.99999C5.99999 15.31 8.69 18 12 18C13.01 18 13.97 17.75 14.8 17.3L16.26 18.76C15.03 19.54 13.57 20 12 20C7.58 20 4 16.42 4 12H1L5 7.99999ZM18 12C18 8.68999 15.31 6 12 6C10.99 6 10.03 6.25 9.2 6.7L7.73999 5.23999C8.96999 4.45999 10.43 4 12 4C16.42 4 20 7.57999 20 12H23L19 16L15 12H18Z" fill="#3D4C5C"/>
                    </g>
                    </svg>
                </div>
                <div class="header-exit-btn">
                    <a href="<?php echo admin_url(); ?>" title="<?php _e("Exit to Dashboard", "travelfic-toolkit"); ?>">
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
            <div class="travelfic-template-list-wrapper" id="travelfic-template-list-wrapper" style="background: url(<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png' ?>), #F8FAFC 50% / cover no-repeat;">
                <div class="travelfic-template-list-container">
                    <div class="travelfic-template-list-heading">
                        <h2><?php _e("What kind of travel site do you envision creating?", "travelfic-toolkit"); ?></h2>

                        <span class="settings-import-btn" style="display: none;"><?php _e("Settings Import", "travelfic-toolkit"); ?></span>
                        <span class="customizer-import-btn" style="display: none;"><?php _e("Customizer Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-hotel-import-btn" style="display: none;"><?php _e("Hotel Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-tour-import-btn" style="display: none;"><?php _e("Tour Import", "travelfic-toolkit"); ?></span>
                        <span class="demo-page-import-btn" style="display: none;"><?php _e("Pages Import", "travelfic-toolkit"); ?></span>
                        <span class="plug-tourfic-btn" style="display: none;"><?php _e("Tourfic Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-cf7-btn" style="display: none;"><?php _e("CF7 Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-woocommerce-btn" style="display: none;"><?php _e("Woocommerce Install", "travelfic-toolkit"); ?></span>
                        <span class="plug-elementor-btn" style="display: none;"><?php _e("Elementor Install", "travelfic-toolkit"); ?></span>
                        <span class="widget-import-btn" style="display: none;"><?php _e("Widget Import", "travelfic-toolkit"); ?></span>
                        <span class="menu-import-btn" style="display: none;"><?php _e("Menu Import", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-tourfic-btn" style="display: none;"><?php _e("Tourfic Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-cf7-btn" style="display: none;"><?php _e("CF7 Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-woocommerce-btn" style="display: none;"><?php _e("Woocommerce Active", "travelfic-toolkit"); ?></span>
                        <span class="plug-active-elementor-btn" style="display: none;"><?php _e("Elementor Active", "travelfic-toolkit"); ?></span>
                    </div>
                    <div class="travelfic-template-filter">
                        <div class="travelfic-search-form">
                            <input type="text" id="travelfic_template_search" placeholder="<?php _e("Search for templates", "travelfic-toolkit"); ?>">
                            <input type="hidden" value="all" id="travelfic_filter_value">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z" fill="#666D74"/>
                            </svg>
                        </div>
                        <div class="travelfic-filter-selection">
                            <ul>
                                <li class="active" data-value="all"><?php _e("All", "travelfic-toolkit"); ?></li>
                                <li data-value="tour"><?php _e("Tour", "travelfic-toolkit"); ?></li>
                                <li data-value="hotel"><?php _e("Hotel", "travelfic-toolkit"); ?></li>
                                <li data-value="apartment"><?php _e("Apartment", "travelfic-toolkit"); ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="travelfic-templates-list">
                        <?php 
                        $travelfic_sync_templates_list =  !empty(get_option('travelfic_template_sync__schudle_option')) ? get_option('travelfic_template_sync__schudle_option') : '';
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
                                                <?php _e("Preview", "travelfic-toolkit"); ?>
                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="content">
                                                <path id="Vector 4130" d="M12.5 2.00012L1.5 13.0001" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round"/>
                                                <path id="Vector" d="M6.5 1.13151C6.5 1.13151 12.1335 0.65662 12.9885 1.51153C13.8434 2.36645 13.3684 8 13.3684 8" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </g>
                                                </svg>
                                            </a>
                                            <div class="template-import-btn" data-template="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-design="<?php echo !empty($single_temp['demo']) ? esc_html($single_temp['demo']) : '' ?>">
                                                <?php _e("Import Demo", "travelfic-toolkit"); ?>
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
        <div class="travelfic-template-list-wrapper" id="travelfic-template-importing-wrapper" style="background: url(<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png' ?>), #F8FAFC 50% / cover no-repeat;">
            <div class="travelfic-template-import-container">
                <div class="travelfic-importing-bg" style="background-image: url(<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/importing-bg.png' ?>)"></div>
                <div class="travelfic-template-list-heading">
                    <h2><?php _e("Demo Import in progress...", "travelfic-toolkit"); ?></h2>
                    <div class="travelfic-installing-highlights-content">
                    </div>
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
                        <img src="<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/demo-importing.gif' ?>" alt="">
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
                            <a href="<?php echo site_url(); ?>" target="_blank">
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector" d="M2 6L17 5.99984" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path id="Vector 6908" d="M6 0.999756L1.70711 5.29265C1.37377 5.62598 1.20711 5.79265 1.20711 5.99976C1.20711 6.20686 1.37377 6.37353 1.70711 6.70686L6 10.9998" stroke="#003C79" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                </svg>
                                <?php _e("Back To Dashboard", "travelfic-toolkit"); ?>
                            </a>
                            <a href="<?php echo site_url(); ?>" target="_blank" class="visit-site">
                                <?php _e("Visit Your Website", "travelfic-toolkit"); ?>
                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="content">
                                <path id="Vector 4130" d="M12.5 2.00012L1.5 13.0001" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round"/>
                                <path id="Vector" d="M6.5 1.13151C6.5 1.13151 12.1335 0.65662 12.9885 1.51153C13.8434 2.36645 13.3684 8 13.3684 8" stroke="#F6FAFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                </svg>
                            </a>
                            <a href="<?php echo site_url(); ?>" target="_blank">
                                <?php _e("Tourfic Settings", "travelfic-toolkit"); ?>
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
                update_option( 'tf_settings', 'active' );
            }
			if ( ! get_option( 'travelfic_toolkit_template_wizard' ) ) {
				update_option( 'travelfic_toolkit_template_wizard', 'active' );
				wp_redirect( admin_url( 'admin.php?page=travelfic-template-list' ) );
				exit;
			}
		}
	}
}

new Travelfic_Template_List();