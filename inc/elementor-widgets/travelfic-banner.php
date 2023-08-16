<?php

class Travelfic_Toolkit_Banner extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tft-banner';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */

    public function get_title()
    {
        return __('Banner', 'travelfic-toolkit');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */

    public function get_icon()
    {
        return 'eicon-banner';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */

    public function get_categories()
    {
        return ['travelfic'];
    }


    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */

    public function get_keywords()
    {
        return ['travelfic', 'banner', 'image', 'text'];
    }

    public function get_style_depends()
    {
        return [
            'travelfic-toolkit-banner',
        ];
    }

    public function get_script_depends()
    {
        return [
            'travelfic-toolkit-banner-js',
        ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     * Settings are stored as JSON and are accessible through  $this->get_settings()
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_banner',
            [
                'label' => __('Banner', 'travelfic-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'banner_image',
            [
                'label' => __('Banner Image', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'banner_title',
            [
                'label' => __('Banner Title', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'banner_subtitle',
            [
                'label' => __('Banner Subtitle', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'banner_button_text',
            [
                'label' => __('Banner Button Text', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,

            ]
        );

        $repeater->add_control(
            'banner_button_link',
            [
                'label' => __('Banner Button Link', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
            ]
        );

        $this->add_control(
            'banner_list',
            [
                'label' => __('Banner List', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ banner_title }}}',
            ]
        );

        $this->end_controls_section();

        // banner social share icons
        $this->start_controls_section(
            'section_banner_social',
            [
                'label' => __('Banner Social Share', 'travelfic-toolkit'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater_social = new \Elementor\Repeater();

        $repeater_social->add_control(
            'icon',
            [
                'label' => esc_html__('Social Icons', 'textdomain'),
                'type' => \Elementor\Controls_Manager::ICON,
                'include' => [
                    'fa fa-facebook',
                    'fa fa-flickr',
                    'fa fa-google-plus',
                    'fa fa-instagram',
                    'fa fa-linkedin',
                    'fa fa-pinterest',
                    'fa fa-reddit',
                    'fa fa-twitch',
                    'fa fa-twitter',
                    'fa fa-vimeo',
                    'fa fa-youtube',
                ],
                'default' => 'fa fa-facebook',
            ]
        );

        $repeater_social->add_control(
            'social_link',
            [
                'label' => __('Social Link', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_social_list',
            [
                'label' => __('Banner Social List', 'travelfic-toolkit'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater_social->get_controls(),
                'title_field' => '{{{ social_link }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $banner_list = $settings['banner_list'];
        $social_list = $settings['banner_social_list'];

?>

        <div class="tft-banner-container">
            <?php if ($banner_list) { ?>
                <?php foreach ($banner_list as $banner_item) {
                ?>
                    <!-- banner slider start -->

                    <div class="tft-banner-slider-item " style="background-image: url(<?php echo esc_url($banner_item['banner_image']['url']) ?>);">



                        <div class="tft-banner-slider-item-content">
                            <h2 class="tft-slider-item-title">
                                <span class="tft-subtitle">
                                    <?php echo esc_html($banner_item['banner_subtitle']) ?>
                                </span>
                                <?php echo esc_html($banner_item['banner_title']) ?>
                            </h2>
                            <button class="tft-slider-item-button">
                                <a href="<?php echo esc_url($banner_item['banner_button_link']['url']) ?>">
                                    <span><?php echo esc_html($banner_item['banner_button_text']) ?></span>
                                    <i class="fa-solid fa-arrow-right" style="color: #fff !important;"></i>
                                </a>
                            </button>
                        </div>

                    </div>
            <?php }
            } ?>
            <!-- banner slider end -->

            <!-- dots -->
            <?php if ($banner_list) { ?>

                <div class="tft-slider-dots">
                    <?php foreach ($banner_list as $key => $banner_item) {
                    ?>

                        <span class="tft-slider-single-dot <?php if ($key == 0) echo 'active' ?> " onclick="currentSlide(<?php echo esc_attr($key + 1) ?>)"></span>
                    <?php
                    } ?>

                </div>
            <?php
            } ?>


            <!-- share icons  -->
            <div class="tft-slider-share-social">

                <?php if ($social_list) { ?>
                    <div class="tft-slider-share-icons">
                        <?php foreach ($social_list as $social_item) {
                        ?>
                            <a href="<?php echo esc_url($social_item['social_link']) ?>">
                                <!-- <img src="<?php echo esc_url($social_item['icon']) ?>" alt="facebook"> -->
                                <i class="<?php echo esc_attr($social_item['icon']); ?>" aria-hidden="true"></i>
                            </a>
                        <?php } ?>
                    </div>

                <?php
                } ?>
                <div class="tft-social-divider"></div>

                <div class="tft-social-title">Share</div>
            </div>
        </div>

<?php
    }
}
