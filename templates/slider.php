<?php
/**
 * @author  WpBean
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class WPB_EA_Widget_Slider extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-slider-item';
	}

	public function get_title() {
		return esc_html__( 'WPB Slider', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
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
		$wpb_ea_primary_color      = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
		$wpb_ea_primary_color_dark = wpb_ea_get_option( 'wpb_ea_primary_color_dark', 'wpb_ea_style', '#004dcb' );

		// main slider section
		$this->start_controls_section(
			'wpb_ea_main_slider',
			array(
				'label' => esc_html__( 'Slider Items', 'wpb-elementor-addons' ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image_size',
				'label'   => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
				'default' => 'full',
			)
		);

		$this->add_responsive_control(
			'wpb_ea_main_slider_height',
			array(
				'label'     => esc_html__( 'Slider Height', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 100,
				'max'       => 2500,
				'step'      => 1,
				'default'   => 750,
				'selectors' => array(
					'{{WRAPPER}} .header-slider .item' => 'height: {{VALUE}}px;',
					'{{WRAPPER}} .header-slider .slider-preloader-wrap' => 'height: {{VALUE}}px;',
					'{{WRAPPER}} .header-slider .slider_preloader' => 'min-height: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_align',
			array(
				'label'     => esc_html__( 'Content Alignment', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'wpb-elementor-addons' ),
					'right'  => esc_html__( 'Right', 'wpb-elementor-addons' ),
					'center' => esc_html__( 'Center', 'wpb-elementor-addons' ),
				),
				'separator' => 'after',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			)
		);

		$repeater->add_control(
			'wpb_ea_main_slider_title',
			array(
				'label'   => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Slider Title', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'wpb_ea_main_slider_content',
			array(
				'label'   => esc_html__( 'Content', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'wpb_ea_main_slider_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'CLICK HERE', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'wpb_ea_main_slider_button_url',
			array(
				'label'         => esc_html__( 'Link', 'wpb-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url'         => '#',
					'is_external' => '',
				),
				'label_block'   => true,
				'show_external' => true,

				'placeholder'   => esc_html__( 'http://your-link.com', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_items',
			array(
				'label'       => esc_html__( 'Slider Items', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'wpb_ea_main_slider_title'   => esc_html__( 'Slider Title 1.', 'wpb-elementor-addons' ),
						'wpb_ea_main_slider_content' => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_main_slider_title'   => esc_html__( 'Slider Title 2.', 'wpb-elementor-addons' ),
						'wpb_ea_main_slider_content' => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
					),
					array(
						'wpb_ea_main_slider_title'   => esc_html__( 'Slider Title 3.', 'wpb-elementor-addons' ),
						'wpb_ea_main_slider_content' => esc_html__( 'Nullam a ultrices ex, quis finibus neque. Etiam facilisis consectetur ante ac bibendum. Sed pretium lacinia sollicitudin.', 'wpb-elementor-addons' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ wpb_ea_main_slider_title }}}',
			)
		);

		// slider extra CSS heading
		$this->add_control(
			'wpb_ea_test_extra_css_heading',
			array(
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

		// show preloader in slider?
		$this->add_control(
			'show_preloader',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Show Preloader?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Show preloader on the slider.', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * main slider carousel section
		 * -------------------------------------------
		*/
		$this->start_controls_section(
			'wpb_ea_main_slider_carousel_settings',
			array(
				'label' => esc_html__( 'Carousel Settings', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
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
				'default'      => 'yes',
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
				'default'      => 'yes',
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

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * main slider carousel style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'wpb_ea_main_slider_carousel_setting_style_options',
			array(
				'label' => esc_html__( 'Style Settings', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_bg_overlay',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Slider Background Overlay Color', 'wpb-elementor-addons' ),
				'default'   => 'rgba(0, 0, 0, 0.4)',
				'selectors' => array(
					'{{WRAPPER}} .header-slider .item::after'      => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_content_width',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Content Full-width?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Slider content full width? Default: No.', 'wpb-elementor-addons' ),
			)
		);

		$this->add_responsive_control(
			'wpb_ea_main_slider_content_padding',
			array(
				'label'      => esc_html__( 'Content Padding', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'devices'    => array( 'desktop', 'tablet', 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .theme-main-slider .slide-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_btn_type',
			array(
				'label'     => esc_html__( 'Slider button type', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'btn_border',
				'options'   => array(
					'btn_border'     => esc_html__( 'Button Border', 'wpb-elementor-addons' ),
					'btn_background' => esc_html__( 'Button Background', 'wpb-elementor-addons' ),
				),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_btn_primary_color',
			array(
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label'       => esc_html__( 'Button Primary Color', 'wpb-elementor-addons' ),
				'description' => esc_html__( 'Slider button primary color.', 'wpb-elementor-addons' ),
				'default'     => $wpb_ea_primary_color,
				'selectors'   => array(
					'{{WRAPPER}} .wpb-ea-button-primary.btn-white a:hover'                                    => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-button-primary a:hover'                                              => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slide-text .wpb-ea-button-primary.btn-white.wpb-ea-button-btn_background a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-button-primary.btn-white.wpb-ea-button-btn_background a'             => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_btn_secondary_color',
			array(
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label'       => esc_html__( 'Button Secondary Color', 'wpb-elementor-addons' ),
				'description' => esc_html__( 'Slider button secondary color.', 'wpb-elementor-addons' ),
				'default'     => '#ffffff',
				'selectors'   => array(
					'{{WRAPPER}} .slide-text .wpb-ea-button-primary.btn-white a'                    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-button-primary.btn-white a'                                => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-button-primary.btn-white.wpb-ea-button-btn_background a'   => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_main_slider_btn_bg_hover_bg_color',
			array(
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label'       => esc_html__( 'Button Hover Background', 'wpb-elementor-addons' ),
				'description' => esc_html__( 'Slider button hover background color.', 'wpb-elementor-addons' ),
				'default'     => $wpb_ea_primary_color_dark,
				'condition'   => array(
					'.wpb_ea_main_slider_btn_type' => 'btn_background',
				),
				'selectors'   => array(
					'{{WRAPPER}} .wpb-ea-button-primary.btn-white.wpb-ea-button-btn_background a:hover'   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slide-text .wpb-ea-button-primary.btn-white.wpb-ea-button-btn_background a:hover'   => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'wpb_ea_main_slider_carousel_navigation_pagination_style' );

		// navigation style tab
		$this->start_controls_tab(
			'wpb_ea_main_slider_navigation_style',
			array(
				'label'     => esc_html__( 'Navigation', 'wpb-elementor-addons' ),
				'condition' => array(
					'.wpb_ea_main_slider_carousel_settings.arrows!' => '',
				),
			)
		);

		// navigation background color
		$this->add_control(
			'wpb_ea_main_slider_carousel_navigation_bg_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .header-slider .owl-theme .owl-nav > button'      => 'background-color: {{VALUE}};',
				),
			)
		);

		// navigation color
		$this->add_control(
			'wpb_ea_main_slider_carousel_navigation_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'wpb-elementor-addons' ),
				'default'   => '#383838',
				'selectors' => array(
					'{{WRAPPER}} .header-slider .owl-theme .owl-nav > button i' => 'color: {{VALUE}};',
				),
			)
		);

		// navigation hover style
		$this->add_control(
			'wpb_ea_main_slider_navigation_hover_style',
			array(
				'label'     => esc_html__( 'Hover', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// navigation hover background color
		$this->add_control(
			'wpb_ea_main_slider_carousel_navigation_hover_bg_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .header-slider .owl-theme .owl-nav > button:hover'      => 'background-color: {{VALUE}};',
				),
			)
		);

		// navigation hover color
		$this->add_control(
			'wpb_ea_main_slider_carousel_navigation_hover_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'wpb-elementor-addons' ),
				'default'   => '#383838',
				'selectors' => array(
					'{{WRAPPER}} .header-slider .owl-theme .owl-nav > button:hover i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		// pagination style tab
		$this->start_controls_tab(
			'wpb_ea_main_slider_pagination_style',
			array(
				'label'     => esc_html__( 'pagination', 'wpb-elementor-addons' ),
				'condition' => array(
					'.wpb_ea_main_slider_carousel_settings.dots!' => '',
				),
			)
		);

		// pagination background color
		$this->add_control(
			'wpb_ea_main_slider_carousel_pagination_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Pagination Color', 'wpb-elementor-addons' ),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .theme-main-slider.owl-theme .owl-dots .owl-dot span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				),
			)
		);

		// pagination hover style
		$this->add_control(
			'wpb_ea_main_slider_pagination_hover_style',
			array(
				'label'     => esc_html__( 'Active', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		// pagination active color
		$this->add_control(
			'wpb_ea_main_slider_carousel_pagination_active_color',
			array(
				'type'      => \Elementor\Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .theme-main-slider.owl-theme .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * main slider style tab ends here
		 * -------------------------------------------
		 */
	}

	/**
	 * Render image function
	 *
	 * return image url
	 */
	private function render_image( $item, $settings ) {
		$image_id   = $item['wpb_ea_main_slider_img']['id'];
		$image_size = $settings['image_size_size'];
		if ( 'custom' === $image_size ) {
			$image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
		} else {
			$image_src = wp_get_attachment_image_src( $image_id, $image_size );
			if ( ! empty( $image_src ) ) {
				$image_src = $image_src[0];
			}
		}

		return $image_src;
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$extra_css = $settings['extra_css'];
		if ( $extra_css ) {
			$extra_css = $extra_css . ' ';
		}

		// slider attributes
		$stop        = $settings['pause_on_hover'];
		$autoplay    = $settings['autoplay'];
		$loop        = $settings['loop'];
		$navigation  = $settings['arrows'];
		$pagination  = $settings['dots'];
		$slider_attr = array(
			'data-stop'       => ( $stop == 'yes' ? 'true' : 'false' ),
			'data-loop'       => ( $loop == 'yes' ? 'true' : 'false' ),
			'data-autoplay'   => ( $autoplay == 'yes' ? 'true' : 'false' ),
			'data-navigation' => ( $navigation == 'yes' ? 'true' : 'false' ),
			'data-pagination' => ( $pagination == 'yes' ? 'true' : 'false' ),
			'data-direction'  => ( is_rtl() ? 'true' : '' ),
		);

		$slider_alignment         = '';
		$wpb_ea_main_slider_align = $settings['wpb_ea_main_slider_align'];

		if ( $wpb_ea_main_slider_align == 'right' ) {
			$slider_alignment = 'justify-content-end';
		} elseif ( $wpb_ea_main_slider_align == 'center' ) {
			$slider_alignment = 'justify-content-around';
		}

		$content_width                    = 'col-lg-7';
		$wpb_ea_main_slider_content_width = $settings['wpb_ea_main_slider_content_width'];
		if ( $wpb_ea_main_slider_content_width == 'yes' ) {
			$content_width = 'col-lg-12';
		} else {
			$content_width = 'col-lg-7';
		}

		if ( is_array( $settings['wpb_ea_main_slider_items'] ) ) :
			echo '<div class="' . esc_attr( $extra_css ) . 'header-slider header-slider-preloader">';
				echo '<div class="theme-main-slider animation-slides owl-carousel owl-theme"' . wp_kses_data( wpb_ea_owl_carousel_data_attr_implode( $slider_attr ) ) . '>';
			foreach ( $settings['wpb_ea_main_slider_items'] as $item ) :
				if ( ! empty( $item['wpb_ea_main_slider_button_url']['url'] ) ) {
					$this->add_link_attributes( 'wpb_ea_main_slider_button_url', $item['wpb_ea_main_slider_button_url'] );
				}
				echo '<div class="item slider-item-content-' . esc_attr( $wpb_ea_main_slider_align ) . ' text-' . esc_attr( $wpb_ea_main_slider_align ) . ' elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">';
				if ( $item['wpb_ea_main_slider_title'] || $item['wpb_ea_main_slider_content'] || $item['wpb_ea_main_slider_button_text'] ) :
						echo '<div class="slide-table">';
							echo '<div class="slide-tablecell">';
								echo '<div class="wpb-ea-container">';
									echo '<div class="ea-row d-flex ' . esc_attr( $slider_alignment ) . '">';
										echo '<div class="' . esc_attr( $content_width ) . '">';
											echo '<div class="slide-text">';
												$item['wpb_ea_main_slider_title'] ? printf( '<h2>%s</h2>', esc_html( $item['wpb_ea_main_slider_title'] ) ) : '';
												$item['wpb_ea_main_slider_content'] ? printf( '%s', wp_kses_post( wpautop( ( $item['wpb_ea_main_slider_content'] ) ) ) ) : '';
					if ( ! empty( $item['wpb_ea_main_slider_button_text'] ) ) :
						echo '<div class="wpb-ea-button-primary btn-white wpb-ea-button-' . esc_attr( $settings['wpb_ea_main_slider_btn_type'] ) . '">';
						?>
						<a <?php $this->print_render_attribute_string( 'wpb_ea_main_slider_button_url' ); ?>>
							<?php echo esc_html( $item['wpb_ea_main_slider_button_text'] ); ?>
						</a>
						<?php
						echo '</div>';
												endif;
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					endif;
						echo '</div>';
					endforeach;
				echo '</div>';
			if ( $settings['show_preloader'] == 'yes' ) :
				echo '<div class="slider_preloader">';
					echo '<div class="slider_preloader_status">&nbsp;</div>';
				echo '</div>';
				endif;
			echo '</div>';
		endif;
	}
}
