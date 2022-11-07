<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Homeo_Elementor_Compare_Btn extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_compare_btn';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Compare Button', 'homeo' );
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
                    '{{WRAPPER}} .btn-compare' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Color Hover Text', 'homeo' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-compare:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-compare:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $compare_items = WP_RealEstate_Compare::get_compare_items();
        $compare_properties_page_id = wp_realestate_get_option('compare_properties_page_id');
        if ( method_exists('WP_RealEstate_Mixes', 'get_lang_post_id') ) {
            $compare_properties_page_id = WP_RealEstate_Mixes::get_lang_post_id($compare_properties_page_id);
        }
        ?>
        <div class="widget-compare-btn <?php echo esc_attr($el_class); ?>">
            <a class="btn-compare" href="<?php echo esc_url( get_permalink( $compare_properties_page_id ) ); ?>" title="<?php esc_attr_e('Compare','homeo'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17.5" viewBox="0 0 20 20"><path id="icon-share" d="M20,35.571a3.57,3.57,0,0,1-3.571,3.571,3.442,3.442,0,0,1-2.594-1.156L7.094,41.4a3.723,3.723,0,0,1,0,1.205l6.741,3.371a3.572,3.572,0,1,1-.978,2.455,3.407,3.407,0,0,1,.219-1.237l-6.5-3.25a3.571,3.571,0,1,1,0-3.884l6.5-3.25A3.572,3.572,0,1,1,20,35.571ZM3.531,44.143a2.143,2.143,0,1,0,0-4.286,2.143,2.143,0,1,0,0,4.286Zm12.9-10.714a2.143,2.143,0,1,0,2.143,2.143A2.143,2.143,0,0,0,16.429,33.429Zm0,17.143a2.143,2.143,0,1,0-2.143-2.143A2.143,2.143,0,0,0,16.429,50.571Z" transform="translate(0 -32)" fill="#484848"/></svg>
                <span class="count"><?php echo (!empty($compare_items) ? count($compare_items) : '0') ; ?></span>
            </a>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Homeo_Elementor_Compare_Btn );