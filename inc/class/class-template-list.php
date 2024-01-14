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
        <div class="travelfic-template-list-wrapper" id="travelfic-template-importing-wrapper" style="background: url(<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png' ?>), lightgray 50% / cover no-repeat;">
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
                        <a href="<?php echo site_url(); ?>" target="_blank">
                            <?php _e("Visit your website", "travelfic-toolkit"); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none">
                            <path d="M9.33268 10.6666C8.99555 10.9943 7.66602 11.8665 7.66602 12.3333M9.33268 14C8.99555 13.6723 7.66602 12.8001 7.66602 12.3333M7.66602 12.3333L12.9993 12.3333" stroke="#F0F0F1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.33398 14.6666H6.15217C3.97803 14.6666 2.89096 14.6666 2.13603 14.1347C1.91973 13.9823 1.72771 13.8016 1.56579 13.598C1.00065 12.8875 1.00065 11.8644 1.00065 9.81814V8.12117C1.00065 6.14572 1.00065 5.158 1.31328 4.36913C1.81586 3.10091 2.87874 2.10055 4.22623 1.62753C5.0644 1.33329 6.11386 1.33329 8.21277 1.33329C9.41215 1.33329 10.0118 1.33329 10.4908 1.50143C11.2608 1.77173 11.8682 2.34336 12.1553 3.06805C12.334 3.51884 12.334 4.08325 12.334 5.21208V8.66663" stroke="#F0F0F1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M0.999349 8C0.999349 6.7727 1.99427 5.77778 3.22157 5.77778C3.66543 5.77778 4.18871 5.85555 4.62026 5.73992C5.00369 5.63718 5.30319 5.33768 5.40593 4.95424C5.52157 4.52269 5.44379 3.99941 5.44379 3.55556C5.44379 2.32826 6.43872 1.33333 7.66602 1.33333" stroke="#F0F0F1" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
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