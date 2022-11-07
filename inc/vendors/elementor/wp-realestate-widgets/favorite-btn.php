<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Homeo_Elementor_Favorite_Btn extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_favorites_btn';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Favorite Button', 'homeo' );
    }
    
	public function get_categories() {
        return [ 'homeo-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'homeo' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'homeo' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'homeo' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'homeo' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'homeo' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'homeo' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'homeo' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Color', 'homeo' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color Text', 'homeo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-favorites' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Color Hover Text', 'homeo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-favorites:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-favorites:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $favorites_items = WP_RealEstate_Favorite::get_property_favorites();
        if ( !empty($favorites_items) && is_array($favorites_items) ) {
            $favorites_items = count($favorites_items);
        } else {
            $favorites_items = 0;
        }
        $favorite_properties_page_id = wp_realestate_get_option('favorite_properties_page_id');
        if ( method_exists('WP_RealEstate_Mixes', 'get_lang_post_id') ) {
            $favorite_properties_page_id = WP_RealEstate_Mixes::get_lang_post_id($favorite_properties_page_id);
        }
        ?>
        <div class="widget-favorites-btn <?php echo esc_attr($el_class); ?>">
            <a class="btn-favorites" href="<?php echo esc_url( get_permalink( $favorite_properties_page_id ) ); ?>" title="<?php esc_attr_e('Favorite', 'homeo'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.5" viewBox="0 0 20 17.323"><path id="icon-likes" d="M16.171,3.88a5.671,5.671,0,0,0-4.129,1.786L12,5.708l-.043-.043a5.671,5.671,0,0,0-8.264,0,6.271,6.271,0,0,0,0,8.571l.557.586.05.05,7.236,6.157a.714.714,0,0,0,.929,0l7.229-6.157.057-.05.557-.586a6.271,6.271,0,0,0,0-8.571A5.714,5.714,0,0,0,16.171,3.88Zm3.1,9.371-.529.557L12,19.522,5.257,13.808l-.536-.557a4.85,4.85,0,0,1,0-6.6,4.25,4.25,0,0,1,6.2,0l.564.586a.714.714,0,0,0,1.029,0l.557-.586a4.25,4.25,0,0,1,6.2,0,4.836,4.836,0,0,1,0,6.6Z" transform="translate(-2 -3.878)" fill="#484848"/></svg>
                <span class="count"><?php echo trim($favorites_items); ?></span>
            </a>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Homeo_Elementor_Favorite_Btn );