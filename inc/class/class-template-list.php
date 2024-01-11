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
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.5835 7.33332L8.25016 11H5.50016C5.50016 14.0342 7.966 16.5 11.0002 16.5C11.926 16.5 12.806 16.2708 13.5668 15.8583L14.9052 17.1967C13.7777 17.9117 12.4393 18.3333 11.0002 18.3333C6.9485 18.3333 3.66683 15.0517 3.66683 11H0.916832L4.5835 7.33332ZM16.5002 11C16.5002 7.96582 14.0343 5.49999 11.0002 5.49999C10.0743 5.49999 9.19433 5.72916 8.4335 6.14166L7.09516 4.80332C8.22266 4.08832 9.561 3.66666 11.0002 3.66666C15.0518 3.66666 18.3335 6.94832 18.3335 11H21.0835L17.4168 14.6667L13.7502 11H16.5002Z" fill="#6B7280"></path>
                    </svg>
                </div>
                <div class="header-exit-btn">
                    <a href="<?php echo admin_url(); ?>" title="<?php _e("Exit to Dashboard", "travelfic-toolkit"); ?>">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.8333 15.8333H4.16667V4.16667H10V2.5H4.16667C3.24167 2.5 2.5 3.25 2.5 4.16667V15.8333C2.5 16.75 3.24167 17.5 4.16667 17.5H15.8333C16.75 17.5 17.5 16.75 17.5 15.8333V10H15.8333V15.8333ZM11.6667 2.5V4.16667H14.6583L6.46667 12.3583L7.64167 13.5333L15.8333 5.34167V8.33333H17.5V2.5H11.6667Z" fill="#6B7280"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="travelfic-template-bottom-footer">
            <div class="footer-back-btn">
                <a href="<?php echo admin_url(); ?>" title="<?php _e("Back to Dashboard", "travelfic-toolkit"); ?>">
                    <svg width="14" height="9" viewBox="0 0 14 9" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0009 4.4999C14.0009 4.36729 13.9482 4.24011 13.8544 4.14635C13.7607 4.05258 13.6335 3.9999 13.5009 3.9999H1.70789L4.85489 0.853899C4.90138 0.807411 4.93826 0.752222 4.96342 0.691483C4.98858 0.630743 5.00153 0.565643 5.00153 0.499899C5.00153 0.434155 4.98858 0.369055 4.96342 0.308316C4.93826 0.247576 4.90138 0.192387 4.85489 0.145899C4.80841 0.0994111 4.75322 0.062535 4.69248 0.0373759C4.63174 0.0122168 4.56664 -0.000732422 4.50089 -0.000732422C4.43515 -0.000732422 4.37005 0.0122168 4.30931 0.0373759C4.24857 0.062535 4.19338 0.0994111 4.14689 0.145899L0.146894 4.1459C0.100331 4.19234 0.0633877 4.24752 0.0381812 4.30827C0.0129748 4.36901 0 4.43413 0 4.4999C0 4.56567 0.0129748 4.63079 0.0381812 4.69153C0.0633877 4.75228 0.100331 4.80745 0.146894 4.8539L4.14689 8.8539C4.19338 8.90039 4.24857 8.93726 4.30931 8.96242C4.37005 8.98758 4.43515 9.00053 4.50089 9.00053C4.56664 9.00053 4.63174 8.98758 4.69248 8.96242C4.75322 8.93726 4.80841 8.90039 4.85489 8.8539C4.90138 8.80741 4.93826 8.75222 4.96342 8.69148C4.98858 8.63074 5.00153 8.56564 5.00153 8.4999C5.00153 8.43416 4.98858 8.36905 4.96342 8.30832C4.93826 8.24758 4.90138 8.19239 4.85489 8.1459L1.70789 4.9999H13.5009C13.6335 4.9999 13.7607 4.94722 13.8544 4.85345C13.9482 4.75968 14.0009 4.63251 14.0009 4.4999Z">
                        </path>
                    </svg>
                    <?php _e("Back", "travelfic-toolkit"); ?>    
                </a>
            </div>
        </div>
        <?php
        }

		private function travelfic_template_list_step() {
            $this->template_list_header_footer();
			?>
            <div class="travelfic-template-list-wrapper" id="travelfic-template-list-wrapper" style="background: url(<?php echo TRAVELFIC_TOOLKIT_URL . 'assets/admin/img/template_list_bg.png' ?>), lightgray 50% / cover no-repeat;">
                <div class="travelfic-template-list-container">
                    <div class="travelfic-template-list-heading">
                        <h2><?php _e("What type of website are you building?", "travelfic-toolkit"); ?></h2>

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
                        ?>
                        <div class="travelfic-single-template" data-template_type="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-template_name="<?php echo !empty($single_temp['title']) ? esc_html($single_temp['title']) : '' ?>">
                            <div class="template-img">
                                <?php if(!empty($single_temp['template_image_url'])){ ?>
                                <img src="<?php echo esc_url($single_temp['template_image_url']) ?>" alt="">
                                <?php } ?>
                                <?php if(!empty($single_temp['featured_title'])){ ?>
                                <span class="new-template-tag">
                                    <?php echo esc_html($single_temp['featured_title']); ?>
                                </span>
                                <?php } ?>
                                <div class="template-preview">
                                    <a href="<?php echo !empty($single_temp['demo_url']) ? esc_url($single_temp['demo_url']) : '' ?>" target="_blank">
                                        <?php _e("Preview", "travelfic-toolkit"); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M4.66602 11.3337L11.3327 4.66699M11.3327 4.66699H4.66602M11.3327 4.66699V11.3337" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <?php if(!empty($single_temp['title'])){ ?>
                            <h2>
                                <?php echo esc_html($single_temp['title']); ?>
                            </h2>
                            <?php } ?>
                            <?php if(!empty($single_temp['import_title'])){ ?>
                            <div class="template-import-btn" data-template="<?php echo !empty($single_temp['template_type']) ? esc_html($single_temp['template_type']) : '' ?>" data-design="<?php echo !empty($single_temp['demo']) ? esc_html($single_temp['demo']) : '' ?>">
                                <?php echo esc_html($single_temp['import_title']); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16" viewBox="0 0 15 16" fill="none">
                                <path d="M9.83268 10.6665C9.49555 10.9942 8.16602 11.8664 8.16602 12.3332M9.83268 13.9998C9.49555 13.6722 8.16602 12.8 8.16602 12.3332M8.16602 12.3332L13.4993 12.3332" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.83398 14.6665H6.65217C4.47803 14.6665 3.39096 14.6665 2.63603 14.1346C2.41973 13.9822 2.22771 13.8015 2.06579 13.5979C1.50065 12.8874 1.50065 11.8643 1.50065 9.81802V8.12105C1.50065 6.1456 1.50065 5.15788 1.81328 4.36901C2.31586 3.10079 3.37874 2.10043 4.72623 1.62741C5.5644 1.33317 6.61386 1.33317 8.71277 1.33317C9.91215 1.33317 10.5118 1.33317 10.9908 1.50131C11.7608 1.7716 12.3682 2.34324 12.6553 3.06793C12.834 3.51872 12.834 4.08313 12.834 5.21196V8.6665" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1.49935 8C1.49935 6.7727 2.49427 5.77778 3.72157 5.77778C4.16543 5.77778 4.68871 5.85555 5.12026 5.73992C5.50369 5.63718 5.80319 5.33768 5.90593 4.95424C6.02157 4.52269 5.94379 3.99941 5.94379 3.55556C5.94379 2.32826 6.93872 1.33333 8.16602 1.33333" stroke="#1D2327" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <?php } ?>
                        </div>
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