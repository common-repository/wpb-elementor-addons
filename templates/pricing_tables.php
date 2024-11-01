<?php
/**
 * @author  WpBean
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;


class WPB_EA_Widget_Pricing_Table extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'WPB Pricing Table', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return array( 'wpb_ea_widgets' );
	}

	protected function register_controls() {
		$wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

		$this->start_controls_section(
			'wpb_ea_pricing_plan_title',
			array(
				'label' => esc_html__( 'Plan Title', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'Pricing Plan', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Subtitle', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'Subtitle', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'Description', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pricing_plan_tag',
			array(
				'label' => esc_html__( 'Price Tag', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'price_tag_text',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Price', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'Price', 'wpb-elementor-addons' ),
				'default'     => esc_html__( '50', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'price_tag_currency',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Currency', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'Currency', 'wpb-elementor-addons' ),
				'default'     => esc_html__( '$', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'price_tag_currency_position',
			array(
				'type'    => \Elementor\Controls_Manager::SELECT,
				'label'   => esc_html__( 'Currency Position', 'wpb-elementor-addons' ),
				'default' => 'left',
				'options' => array(
					'left'  => esc_html__( 'Before', 'wpb-elementor-addons' ),
					'right' => esc_html__( 'After', 'wpb-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'price_tag_currency_indent',
			array(
				'label'     => esc_html__( 'Currency Spacing', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 3,
				),
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'condition' => array(
					'price_tag_currency!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .pricing-tag .pricing-currency-left'     => 'left: -{{SIZE}}px;',
					'{{WRAPPER}} .pricing-tag .pricing-currency-right'    => 'right: -{{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'price_tag_period',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Period', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( '/month', 'wpb-elementor-addons' ),
				'default'     => esc_html__( '/month', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pricing_plan_features',
			array(
				'label' => esc_html__( 'Features', 'wpb-elementor-addons' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'text',
			array(
				'label'       => esc_html__( 'Feature', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing feature', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'feature_list',
			array(
				'label'       => esc_html__( 'Plan Features', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'default'     => array(
					array( 'text' => esc_html__( 'Consectetur adipiscing', 'wpb-elementor-addons' ) ),
					array( 'text' => esc_html__( 'Nunc luctus nulla et tellus', 'wpb-elementor-addons' ) ),
					array( 'text' => esc_html__( 'Suspendisse quis metus', 'wpb-elementor-addons' ) ),
					array( 'text' => esc_html__( 'Vestibul varius fermentum erat', 'wpb-elementor-addons' ) ),
					array( 'text' => esc_html__( 'Lorem ipsum dolor sit amet', 'wpb-elementor-addons' ) ),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{text}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pricing_plan_button',
			array(
				'label' => esc_html__( 'Button', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_button_icon',
			array(
				'label' => esc_html__( 'Button Icon', 'wpb-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_button_icon_alignment',
			array(
				'label'     => esc_html__( 'Icon Position', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => esc_html__( 'Before', 'wpb-elementor-addons' ),
					'right' => esc_html__( 'After', 'wpb-elementor-addons' ),
				),
				'condition' => array(
					'wpb_ea_pricing_table_button_icon!' => '',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_button_icon_indent',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 7,
				),
				'range'     => array(
					'px' => array(
						'max' => 60,
					),
				),
				'condition' => array(
					'wpb_ea_pricing_table_button_icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary i.icon-left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary i.icon-right' => 'margin-left: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Text', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'GET STARTED', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'GET STARTED', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_btn_link',
			array(
				'label'         => esc_html__( 'Button Link', 'wpb-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'label_block'   => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'show_external' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pricing_table_settings',
			array(
				'label' => esc_html__( 'Settings', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_highlight',
			array(
				'label'        => esc_html__( 'If you want to highlight the pricing table. Default: no.', 'wpb-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'wpb_ea_pricing_table_icon_enabled',
			array(
				'label'        => esc_html__( 'List Icon', 'wpb-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'extra_css',
			array(
				'label'       => esc_html__( 'Extra CSS clss', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Put your extra CSS class if you need.', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'your-extra-css-class', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * pricing table style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'wpb_ea_pricing_table_style_section',
			array(
				'label' => esc_html__( 'Pricing Table Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// pricing table background color
		$this->add_control(
			'wpb_ea_pricing_table_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight' => '',
				),
				'default'   => '#f0f0f0',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table' => 'background-color: {{VALUE}};',
				),
			)
		);

		// pricing table(highlighted) background color
		$this->add_control(
			'wpb_ea_pricing_table_highlighted_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight!' => '',
				),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table.active' => 'background-color: {{VALUE}};',
				),
			)
		);

		// pricing table padding
		$this->add_control(
			'wpb_ea_pricing_table_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight' => '',
				),
				'default'    => array(
					'top'    => 50,
					'right'  => 30,
					'bottom' => 50,
					'left'   => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table(highlighted) padding
		$this->add_control(
			'wpb_ea_pricing_table_highlighted_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight!' => '',
				),
				'default'    => array(
					'top'    => 60,
					'right'  => 30,
					'bottom' => 60,
					'left'   => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table.active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table margin
		$this->add_control(
			'wpb_ea_pricing_table_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table(highlighted) margin
		$this->add_control(
			'wpb_ea_pricing_table_highlighted_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'condition'  => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_highlight!' => '',
				),
				'default'    => array(
					'top' => -20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table.active' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table border type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_border_type',
				'label'    => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table',
			)
		);

		// pricing table border radius
		$this->add_control(
			'wpb_ea_pricing_table_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table' => 'border-radius: {{SIZE}}px;',
				),
			)
		);

		// pricing table box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'wpb_ea_pricing_table_shadow',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table',
				),
			)
		);

		// pricing table content alignment
		$this->add_responsive_control(
			'wpb_ea_pricing_table_content_align',
			array(
				'label'     => esc_html__( 'Alignment', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'wpb-elementor-addons' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * color & typography
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_pricing_table_typography_section',
			array(
				'label' => esc_html__( 'Content Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// pricing table title style
		$this->add_control(
			'wpb_ea_pricing_table_title_style',
			array(
				'label' => esc_html__( 'Plan Title Style', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		// pricing table title color
		$this->add_control(
			'wpb_ea_pricing_table_title_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Title color', 'wpb-elementor-addons' ),
				'default'   => '#1f1f1f',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .pricing-title .pricing-heading'      => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table title typography
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_title_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .pricing-title .pricing-heading',
			)
		);

		// pricing table sub-title style
		$this->add_control(
			'wpb_ea_pricing_table_subtitle_style',
			array(
				'label'     => esc_html__( 'Plan Subtitle Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pricing table sub-title color
		$this->add_control(
			'wpb_ea_pricing_table_sub_title_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Subtitle Color', 'wpb-elementor-addons' ),
				'default'   => '#5a5959',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .pricing-title .pricing-subheading' => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table sub-title typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .pricing-title .pricing-subheading',
			)
		);

		// pricing table price currency style
		$this->add_control(
			'wpb_ea_pricing_table_price_currency_style',
			array(
				'label'     => esc_html__( 'Price Currency Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pricing table price currency color
		$this->add_control(
			'wpb_ea_pricing_table_pricing_currency_color',
			array(
				'label'     => esc_html__( 'Currency Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3878ff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .pricing-tag .price-currency' => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table price currency typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_price_currency_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .pricing-tag .price-currency',
				'exclude'  => array(
					'text_transform', // font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
				),
			)
		);

		// pricing table price tag style
		$this->add_control(
			'wpb_ea_pricing_table_price_tag_style',
			array(
				'label'     => esc_html__( 'Price Tag Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pricing table price tag color
		$this->add_control(
			'wpb_ea_pricing_table_prici_tag_color',
			array(
				'label'     => esc_html__( 'Price Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3878ff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .pricing-tag .pricing-money' => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table price tag typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .pricing-tag .pricing-money',
				// font_family, font_size, font_weight, text_transform, font_style, text_decoration, line_height, letter_spacing
				'exclude'  => array(
					'text_transform',
				),
			)
		);

		// pricing table pricing period style
		$this->add_control(
			'wpb_ea_pricing_table_pricing_period_style',
			array(
				'label'     => esc_html__( 'Pricing Period Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pricing table pricing period color
		$this->add_control(
			'wpb_ea_pricing_table_pricing_period_color',
			array(
				'label'     => esc_html__( 'Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#9c9c9c',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .pricing-time' => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table pricing period typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .pricing-time',
			)
		);

		// pricing table features style
		$this->add_control(
			'wpb_ea_pricing_table_features_style',
			array(
				'label'     => esc_html__( 'Features Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pricing table features icon color
		$this->add_control(
			'wpb_ea_pricing_table_features_icon_color',
			array(
				'label'     => esc_html__( 'Features Icon Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .priceing-features ul li i.feature-icon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_pricing_table_settings.wpb_ea_pricing_table_icon_enabled!' => '',
				),
			)
		);

		// pricing table features color
		$this->add_control(
			'wpb_ea_pricing_table_features_color',
			array(
				'label'     => esc_html__( 'Features Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .priceing-features ul li' => 'color: {{VALUE}};',
				),
			)
		);

		// pricing table features typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_features_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .priceing-features ul li',
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * button style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_pricing_table_btn_style_section',
			array(
				'label' => esc_html__( 'Button Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// pricing table button padding
		$this->add_responsive_control(
			'wpb_ea_pricing_table_btn_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => array(
					'top'    => 11,
					'right'  => 25,
					'bottom' => 11,
					'left'   => 25,
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table button margin
		$this->add_responsive_control(
			'wpb_ea_pricing_table_btn_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// pricing table button  typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a',
			)
		);

		$this->start_controls_tabs( 'wpb_ea_pricing_table_button_style_tabs' );

			// normal state tab
			$this->start_controls_tab( 'wpb_ea_pricing_table_btn_normal', array( 'label' => esc_html__( 'Normal', 'wpb-elementor-addons' ) ) );

			// pricing table button text color
			$this->add_control(
				'wpb_ea_pricing_table_btn_normal_text_color',
				array(
					'label'     => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $wpb_ea_primary_color,
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'color: {{VALUE}};',
					),
				)
			);

			// pricing table button background color
			$this->add_control(
				'wpb_ea_pricing_table_btn_normal_bg_color',
				array(
					'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => 'transparent',
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'background: {{VALUE}};',
					),
				)
			);

			// pricing table button border color
			$this->add_control(
				'wpb_ea_pricing_table_border_color',
				array(
					'type'      => \Elementor\Controls_Manager::COLOR,
					'label'     => esc_html__( 'Border Color', 'wpb-elementor-addons' ),
					'default'   => $wpb_ea_primary_color,
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'border-color: {{VALUE}}; border-color: {{VALUE}};',
					),
				)
			);

			// pricing table button border
			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'wpb_ea_pricing_table_btn_border',
					'label'    => esc_html__( 'Border', 'wpb-elementor-addons' ),
					'selector' => '{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a',
				)
			);

			// pricing table button border radius
			$this->add_control(
				'wpb_ea_pricing_table_btn_border_radius',
				array(
					'label'     => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => array(
						'size' => 5,
					),
					'range'     => array(
						'px' => array(
							'max' => 50,
						),
					),
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a' => 'border-radius: {{SIZE}}px;',
					),
				)
			);

			// pricing table button box shadow
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'wpb_ea_pricing_table_button_shadow',
					'selector'  => '{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a',
					'separator' => 'before',
				)
			);

			$this->end_controls_tab();

			// hover state tab
			$this->start_controls_tab( 'wpb_ea_pricing_table_btn_hover', array( 'label' => esc_html__( 'Hover', 'wpb-elementor-addons' ) ) );

			// pricing table button hover text color
			$this->add_control(
				'wpb_ea_pricing_table_btn_hover_text_color',
				array(
					'label'     => esc_html__( 'Text Color', 'wpb-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a:hover' => 'color: {{VALUE}};',
					),
				)
			);

			// pricing table button hover background color
			$this->add_control(
				'wpb_ea_pricing_table_btn_hover_bg_color',
				array(
					'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $wpb_ea_primary_color,
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a:hover' => 'background: {{VALUE}};',
					),
				)
			);

			// pricing table button hover border color
			$this->add_control(
				'wpb_ea_pricing_table_hover_border_color',
				array(
					'type'      => \Elementor\Controls_Manager::COLOR,
					'label'     => esc_html__( 'Border Color', 'wpb-elementor-addons' ),
					'default'   => $wpb_ea_primary_color,
					'selectors' => array(
						'{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a:hover' => 'border-color: {{VALUE}}; border-color: {{VALUE}};',
					),
				)
			);

			// pricing table button hover box shadow
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'wpb_ea_pricing_table_button_hover_shadow',
					'selector'  => '{{WRAPPER}} .wpb-ea-pricing-table .wpb-ea-button-primary a:hover',
					'separator' => 'before',
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$extra_css = $settings['extra_css'];
		if ( $extra_css ) {
			$extra_css = $extra_css . ' ';
		}

		if ( $settings['wpb_ea_pricing_table_btn_link']['is_external'] === 'on' ) {
			$target = 'target= _blank';
		} else {
			$target = '';
		}
		if ( $settings['wpb_ea_pricing_table_btn_link']['nofollow'] === 'on' ) {
			$target .= ' rel= nofollow ';
		}

		echo '<div class="' . esc_attr( $extra_css ) . 'wpb-ea-pricing-table' . ( $settings['wpb_ea_pricing_table_highlight'] == 'yes' ? ' active' : '' ) . '">';
		if ( ! empty( $settings['title'] ) || ! empty( $settings['subtitle'] ) ) :
			echo '<div class="pricing-title">';
				$settings['title'] ? printf( '<h2 class="pricing-heading">%s</h2>', esc_html( $settings['title'] ) ) : '';
				$settings['subtitle'] ? printf( '<div class="pricing-subheading">%s</div>', esc_html( $settings['subtitle'] ) ) : '';
			echo '</div>';
			endif;

		if ( ! empty( $settings['price_tag_text'] ) || ! empty( $settings['price_tag_currency'] ) || ! empty( $settings['price_tag_period'] ) ) :
			echo '<div class="pricing-tag">';
			if ( ! empty( $settings['price_tag_currency'] ) && ( $settings['price_tag_currency_position'] == 'left' ) ) {
				echo '<span class="price-currency pricing-currency-left">' . esc_html( $settings['price_tag_currency'] ) . '</span>';
			}
			if ( ( isset( $settings['price_tag_text'] ) && $settings['price_tag_text'] === '0' ) || ! empty( $settings['price_tag_text'] ) ) {
				echo '<span class="pricing-money">' . esc_html( $settings['price_tag_text'] ) . '</span>';
			}
			if ( ! empty( $settings['price_tag_currency'] ) && ( $settings['price_tag_currency_position'] == 'right' ) ) {
				echo '<span class="price-currency pricing-currency-right">' . esc_html( $settings['price_tag_currency'] ) . '</span>';
			}
			if ( ! empty( $settings['price_tag_period'] ) ) {
				echo '<div class="pricing-time">' . esc_html( $settings['price_tag_period'] ) . '</div>';
			}
				echo '</div>';
			endif;

		if ( ! empty( $settings['button_text'] ) ) :
			echo '<div class="wpb-ea-button-primary">';
				echo '<a href="' . esc_url( $settings['wpb_ea_pricing_table_btn_link']['url'] ) . '" ' . esc_attr( $target ) . '>';
			if ( ! empty( $settings['wpb_ea_pricing_table_button_icon']['value'] ) ) {
				if ( 'left' == $settings['wpb_ea_pricing_table_button_icon_alignment'] ) :
							\Elementor\Icons_Manager::render_icon(
								$settings['wpb_ea_pricing_table_button_icon'],
								array(
									'aria-hidden' => 'true',
									'class'       => 'icon-left',
								)
							);
							echo esc_html( $settings['button_text'] );
					elseif ( 'right' == $settings['wpb_ea_pricing_table_button_icon_alignment'] ) :
						echo esc_html( $settings['button_text'] );
						\Elementor\Icons_Manager::render_icon(
							$settings['wpb_ea_pricing_table_button_icon'],
							array(
								'aria-hidden' => 'true',
								'class'       => 'icon-right',
							)
						);
					endif;
			} else {
				echo esc_html( $settings['button_text'] );
			}
					echo '</a>';
					echo '</div>';
			endif;

		if ( is_array( $settings['feature_list'] ) ) :
			echo '<div class="priceing-features">';
				echo '<ul class="wpb-ea-pricing-feature-list">';
			foreach ( $settings['feature_list']  as $key => $feature ) :
				echo '<li class="wpb-ea-singl-price-feature">';
				if ( 'yes' === $settings['wpb_ea_pricing_table_icon_enabled'] ) :
					echo '<i class="fa fa-check feature-icon"></i>';
				endif;
				echo esc_html( $feature['text'] );
				echo '</li>';
						endforeach;
				echo '</ul>';
				echo '</div>';
			endif;
		echo '</div>';
	}
}
