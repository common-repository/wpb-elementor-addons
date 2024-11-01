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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;


class WPB_EA_Widget_Content_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-our-content-box';
	}

	public function get_title() {
		return esc_html__( 'WPB Content Box', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return array( 'wpb_ea_widgets' );
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array(
			'wpb-ea-owl-carousel',
			'wpb-ea-super-js',
		);
	}

	protected function register_controls() {

		$wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

		// content box section
		$this->start_controls_section(
			'wpb_ea_content_box_content',
			array(
				'label' => esc_html__( 'Content Box', 'wpb-elementor-addons' ),
			)
		);

		// content box conent type
		$this->add_control(
			'wpb_ea_content_box_content_type',
			array(
				'label'     => esc_html__( 'Content Type', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slider',
				'options'   => array(
					'slider' => esc_html__( 'Slider', 'wpb-elementor-addons' ),
					'grid'   => esc_html__( 'Grid', 'wpb-elementor-addons' ),
				),
				'separator' => 'after',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'wpb_ea_content_box_title',
			array(
				'label'       => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Place your title text here.', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'wpb_ea_content_box_text',
			array(
				'label'       => esc_html__( 'Description', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Place your description text here.', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries.', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'wpb_ea_content_box_item_bg',
			array(
				'label'   => esc_html__( 'Item Background', 'wpb-elementor-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'     => esc_html__( 'White', 'wpb-elementor-addons' ),
					'blue'        => esc_html__( 'Blue', 'wpb-elementor-addons' ),
					'purple'      => esc_html__( 'Purple', 'wpb-elementor-addons' ),
					'red'         => esc_html__( 'Red', 'wpb-elementor-addons' ),
					'orange'      => esc_html__( 'Orange', 'wpb-elementor-addons' ),
					'coral'       => esc_html__( 'Coral', 'wpb-elementor-addons' ),
					'sky_blue'    => esc_html__( 'Sky blue', 'wpb-elementor-addons' ),
					'wet_asphalt' => esc_html__( 'Grey', 'wpb-elementor-addons' ),
					'tomato'      => esc_html__( 'Bruschetta Tomato', 'wpb-elementor-addons' ),
				),
			)
		);

		// content box field options
		$this->add_control(
			'wpb_ea_content_box_items',
			array(
				'label'       => esc_html__( 'Content Items', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 1', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 2', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 3', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 4', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 5', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_content_box_title' => esc_html__( 'Content Box 6', 'wpb-elementor-addons' ),
						'wpb_ea_content_box_text'  => esc_html__( 'Lorem Ipsum is placeholder text commonly used in the graphic, print.', 'wpb-elementor-addons' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ wpb_ea_content_box_title }}}',
			)
		);

		// content box extra CSS heading
		$this->add_control(
			'wpb_ea_content_box_extra_css_heading',
			array(
				'label'     => esc_html__( 'Extra CSS', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// extra CSS class
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
		 * content box settings tab starts here
		 * -------------------------------------------
		 */

		/**
		 * -------------------------------------------
		 * content box item's carousel section
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_content_box_carousel_settings',
			array(
				'label'     => esc_html__( 'Carousel Settings', 'wpb-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_SETTINGS,
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		// show navigation?
		$this->add_control(
			'arrows',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Show Prev/Next Arrows?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		// show pagination?
		$this->add_control(
			'dots',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Show dot indicators for navigation?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		// pause on hover?
		$this->add_control(
			'pause_on_hover',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Pause on Hover?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		// slider autoplay?
		$this->add_control(
			'autoplay',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Autoplay?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Show the carousel autoplay as in a slideshow.', 'wpb-elementor-addons' ),
			)
		);

		// slider loop?
		$this->add_control(
			'loop',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Loop?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Show the carousel loop as in a slideshow.', 'wpb-elementor-addons' ),
			)
		);

		// margin between two slider items
		$this->add_control(
			'slidergap',
			array(
				'label'   => esc_html__( 'Gap between the slider items', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'size' => 30,
				),
				'range'   => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
			)
		);

		// margin below the slider item
		$this->add_control(
			'slider_item_margin_bottom',
			array(
				'label'     => esc_html__( 'Gap below the slider item', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-items-slider .wpb-ea-content-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box item's responsive section
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'section_responsive',
			array(
				'label' => esc_html__( 'Responsive Options', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'heading_desktop',
			array(
				'label' => esc_html__( 'Desktop', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		// content box type grid desktop column
		$this->add_control(
			'content_box_type_grid_desktop_column',
			array(
				'label'     => esc_html__( 'Number of Columns', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => array(
					6 => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
					4 => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
					3 => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
					2 => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
					1 => esc_html__( '1 Columns', 'wpb-elementor-addons' ),
				),
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'grid',
				),
			)
		);

		// number of items in desktop
		$this->add_control(
			'desktop_columns',
			array(
				'label'     => esc_html__( 'Columns per row', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 8,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		$this->add_control(
			'small_heading_desktop',
			array(
				'label'     => esc_html__( 'Desktop Small', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		// number of items in small desktop
		$this->add_control(
			'small_desktop_columns',
			array(
				'label'     => esc_html__( 'Columns per row', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 7,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		$this->add_control(
			'heading_tablet',
			array(
				'label'     => esc_html__( 'Tablet', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// number of items in tablet
		$this->add_control(
			'tablet_display_columns',
			array(
				'label'     => esc_html__( 'Columns per row', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5,
				'step'      => 1,
				'default'   => 2,
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		// content box type grid tablet column
		$this->add_control(
			'content_box_type_grid_tablet_column',
			array(
				'label'     => esc_html__( 'Column', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 2,
				'options'   => array(
					6 => esc_html__( '6 Columns', 'wpb-elementor-addons' ),
					4 => esc_html__( '4 Columns', 'wpb-elementor-addons' ),
					3 => esc_html__( '3 Columns', 'wpb-elementor-addons' ),
					2 => esc_html__( '2 Columns', 'wpb-elementor-addons' ),
					1 => esc_html__( '1 Columns', 'wpb-elementor-addons' ),
				),
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'grid',
				),
			)
		);

		$this->add_control(
			'heading_mobile',
			array(
				'label'     => esc_html__( 'Mobile Phone', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		// number of items in mobile
		$this->add_control(
			'mobile_display_columns',
			array(
				'label'     => esc_html__( 'Columns per row', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 3,
				'step'      => 1,
				'default'   => 1,
				'condition' => array(
					'.wpb_ea_content_box.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box settings tab ends here
		 * -------------------------------------------
		 */

		/**
		 * -------------------------------------------
		 * content box style tab starts here
		 * -------------------------------------------
		 */

		/**
		 * -------------------------------------------
		 * content box style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_content_box_style_section',
			array(
				'label' => esc_html__( 'Content Box Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// content box background color
		$this->add_control(
			'wpb_ea_content_box_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box' => 'background-color: {{VALUE}};',
				),
			)
		);

		// content box padding
		$this->add_control(
			'wpb_ea_content_box_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 27,
					'bottom' => 27,
					'left'   => 30,
					'right'  => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box .wpb-ea-content-box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// content box margin
		$this->add_control(
			'wpb_ea_content_box_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'bottom' => 30,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-items-grid .wpb-ea-content-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'.wpb_ea_content_box_content.wpb_ea_content_box_content_type' => 'grid',
				),
			)
		);

		// content box border type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wpb_ea_content_box_border_type',
				'label'    => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
				'selector' => '{{WRAPPER}} .wpb-ea-content-box',
			)
		);

		// content box border radius
		$this->add_control(
			'wpb_ea_content_box_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box' => 'border-radius: {{SIZE}}px;',
				),
			)
		);

		// content box box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'wpb_ea_custom_content_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'wpb-elementor-addons' ),
				'selector' => '{{WRAPPER}} .wpb-ea-content-items-grid .wpb-ea-content-box',
			)
		);

		// content box alignment
		$this->add_responsive_control(
			'wpb_ea_content_box_align',
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
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box image style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_content_box_image_style',
			array(
				'label' => esc_html__( 'Image', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// content box image enable(lightbox)
		$this->add_control(
			'wpb_ea_content_box_image_lightbox_enable',
			array(
				'label'        => esc_html__( 'Enable Lightbox', 'wpb-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		// content box image type
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image_size',
				'label'   => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
				'default' => 'medium_large',
			)
		);

		// content box image custom height?
		$this->add_control(
			'wpb_ea_content_box_custom_image_height',
			array(
				'label'        => esc_html__( 'Custom Height?', 'wpb-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		// content box image height
		$this->add_control(
			'wpb_ea_content_box_image_height',
			array(
				'label'     => esc_html__( 'Image height', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 270,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box img' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'.wpb_ea_content_box_custom_image_height' => 'yes',
				),
			)
		);

		// content box image padding
		$this->add_control(
			'wpb_ea_content_box_image_padding_style',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// content box image margin
		$this->add_control(
			'wpb_ea_content_box_image_margin_style',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// content box image border type
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wpb_ea_content_box_image_border_type',
				'label'    => esc_html__( 'Border Type', 'wpb-elementor-addons' ),
				'selector' => '{{WRAPPER}} .wpb-ea-content-box img',
			)
		);

		// content box image border radius
		$this->add_control(
			'wpb_ea_content_box_image_border_radius_style',
			array(
				'label'      => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// content box image box shadow
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'wpb_ea_content_box_image_box_shadow_style',
				'selector'  => '{{WRAPPER}} .wpb-ea-content-box img',
				'separator' => '',
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box content style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_content_box_typography_section',
			array(
				'label' => esc_html__( 'Content Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// content box title style
		$this->add_control(
			'wpb_ea_content_box_title_style',
			array(
				'label' => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		// content box title color
		$this->add_control(
			'wpb_ea_content_box_title_color',
			array(
				'label'     => esc_html__( 'Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box-inner h3' => 'color: {{VALUE}};',
				),
			)
		);

		// content box title typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_content_box_title_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-content-box-inner h3',
			)
		);

		// content box title margin
		$this->add_control(
			'wpb_ea_content_box_title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box-inner h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// content box description style
		$this->add_control(
			'wpb_ea_content_box_description_style',
			array(
				'label'     => esc_html__( 'Description Style', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// content box description color
		$this->add_control(
			'wpb_ea_content_box_description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#777777',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-box-inner span.wpb-ea-content-box-text p' => 'color: {{VALUE}};',
				),
			)
		);

		// content box description typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_content_box_description_typography',
				'selector' => '{{WRAPPER}} .wpb-ea-content-box-inner span.wpb-ea-content-box-text p',
			)
		);

		// content box description margin
		$this->add_control(
			'wpb_ea_content_box_description_margin',
			array(
				'label'      => esc_html__( 'Margin', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-content-box-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box carousel style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_content_box_carousel_setting_style_options',
			array(
				'label'     => esc_html__( 'Carousel', 'wpb-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'.wpb_ea_content_box_content.wpb_ea_content_box_content_type' => 'slider',
				),
			)
		);

		// navigation background color
		$this->add_control(
			'wpb_ea_content_box_carousel_navigation_bg_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Navigation Background Color', 'wpb-elementor-addons' ),
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-items-slider.owl-theme .owl-nav [class*=owl-]'      => 'background: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_content_box_carousel_settings.arrows!' => '',
				),

			)
		);

		// navigation color
		$this->add_control(
			'wpb_ea_content_box_carousel_navigation_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Navigation Color', 'wpb-elementor-addons' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-items-slider .owl-prev .fa' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-content-items-slider .owl-next .fa' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_content_box_carousel_settings.arrows!' => '',
				),
			)
		);

		// pagination background color
		$this->add_control(
			'wpb_ea_content_box_carousel_pagination_bg_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-content-items-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_content_box_carousel_settings.dots!' => '',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * content box style tab ends here
		 * -------------------------------------------
		 */
	}

	// render image function
	private function render_image( $item, $settings ) {
		$image_id   = $item['image']['id'];
		$image_size = $settings['image_size_size'];
		if ( 'custom' === $image_size ) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
		} else {
			$image_src = wp_get_attachment_image_src( $image_id, $image_size );
			if ( ! empty( $image_src ) ) {
				$image_src = $image_src[0];
			}
		}

		return sprintf( '<img src="%s" alt="%s" />', esc_url( $image_src ), esc_html( $item['wpb_ea_content_box_text'] ) );
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$extra_css = $settings['extra_css'];
		if ( $extra_css ) {
			$extra_css = $extra_css . ' ';
		}

		// slider attributes
		$stop         = $settings['pause_on_hover'];
		$autoplay     = $settings['autoplay'];
		$loop         = $settings['loop'];
		$slidergap    = ( ! empty( $settings['slidergap']['size'] ) ? $settings['slidergap']['size'] : '' );
		$items        = $settings['desktop_columns'];
		$desktopsmall = $settings['small_desktop_columns'];
		$tablet       = $settings['tablet_display_columns'];
		$mobile       = $settings['mobile_display_columns'];
		$navigation   = $settings['arrows'];
		$pagination   = $settings['dots'];
		$slider_attr  = array(
			'data-stop'         => ( $stop == 'yes' ? 'true' : 'false' ),
			'data-loop'         => ( $loop == 'yes' ? 'true' : 'false' ),
			'data-autoplay'     => ( $autoplay == 'yes' ? 'true' : 'false' ),
			'data-slidergap'    => $slidergap,
			'data-items'        => $items,
			'data-desktopsmall' => $desktopsmall,
			'data-tablet'       => $tablet,
			'data-mobile'       => $mobile,
			'data-navigation'   => ( $navigation == 'yes' ? 'true' : 'false' ),
			'data-pagination'   => ( $pagination == 'yes' ? 'true' : 'false' ),
			'data-direction'    => ( is_rtl() ? 'true' : '' ),
		);

		// content box type grid column options
		if ( $settings['wpb_ea_content_box_content_type'] == 'grid' ) {
			$grid_desktop_column = 12 / $settings['content_box_type_grid_desktop_column'];
			$grid_tablet_column  = 12 / $settings['content_box_type_grid_tablet_column'];
			$grid_column         = 'col-lg-' . esc_attr( $grid_desktop_column ) . ' col-md-' . esc_attr( $grid_tablet_column );
		}

		if ( is_array( $settings['wpb_ea_content_box_items'] ) ) :
			echo '<div class="' . esc_attr( $extra_css ) . 'wpb-ea-content-items-' . ( $settings['wpb_ea_content_box_content_type'] == 'slider' ? 'slider owl-carousel owl-theme" ' . wp_kses_data( wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) ) : 'grid ea-row"' ) . '>';
			foreach ( $settings['wpb_ea_content_box_items'] as $item ) :
				echo $settings['wpb_ea_content_box_content_type'] == 'grid' ? '<div class="' . esc_attr( $grid_column ) . '">' : '';
					echo '<div class="wpb-ea-content-box wpb-ea-content-box-bg-' . esc_attr( $item['wpb_ea_content_box_item_bg'] ) . '">';
				if ( ! empty( $item['image']['url'] ) ) {
					echo '<div class="wpb-ea-content-box-image">';
					if ( ( $settings['wpb_ea_content_box_image_lightbox_enable'] == 'yes' ) ) {
						echo '<a href="' . esc_url( $item['image']['url'] ) . '" class="elementor-clickable">';
					}
						echo wp_kses_post( $this->render_image( $item, $settings ) );
					if ( $settings['wpb_ea_content_box_image_lightbox_enable'] == 'yes' ) {
						echo '</a>';
					}
					echo '</div>';
				}

						echo '<div class="wpb-ea-content-box-inner">';
				if ( ! empty( $item['wpb_ea_content_box_title'] ) ) :
					echo '<h3 class="wpb-ea-content-box-title">' . esc_html( $item['wpb_ea_content_box_title'] ) . '</h3>';
							endif;

				if ( ! empty( $item['wpb_ea_content_box_text'] ) ) :
					echo '<span class="wpb-ea-content-box-text">' . wp_kses_post( wpautop( ( $item['wpb_ea_content_box_text'] ), true ) ) . '</span>';
							endif;
							echo '</div>';
							echo '</div>';

							echo $settings['wpb_ea_content_box_content_type'] == 'grid' ? '</div>' : '';
				endforeach;
			echo '</div>';
		endif;
	}

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}
			return $settings['link'];
		}

		return array(
			'url' => $settings['image']['url'],
		);
	}
}
