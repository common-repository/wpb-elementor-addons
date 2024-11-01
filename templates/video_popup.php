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

class WPB_EA_Video_PopUp extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-video-popup';
	}

	public function get_title() {
		return esc_html__( 'WPB Video PopUp', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-play';
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
		return array( 'fancybox', 'wpb-ea-super-js' );
	}

	protected function register_controls() {
		$wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

		// video popup section
		$this->start_controls_section(
			'wpb_ea_video_popup',
			array(
				'label' => esc_html__( 'Vide PopUp', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'video_popup_type',
			array(
				'label'   => esc_html__( 'Vide PopUp Type', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'wpb-elementor-addons' ),
					'content' => esc_html__( 'Content', 'wpb-elementor-addons' ),
					'fancy'   => esc_html__( 'Fancy Content', 'wpb-elementor-addons' ),
				),
			)
		);

		// video popup background image
		$this->add_control(
			'image',
			array(
				'label'     => esc_html__( 'Video Thumbnail', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => plugins_url( '../assets/images/video-thum.png', __FILE__ ),
				),
				'condition' => array(
					'.video_popup_type!' => 'content',
				),
			)
		);

		// video popup background image size
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Actually its `image_size`.
				'default'   => 'medium_large',
				'condition' => array(
					'.video_popup_type!' => 'content',
				),
			)
		);

		$this->add_control(
			'video_content_icon',
			array(
				'type'      => \Elementor\Controls_Manager::ICONS,
				'label'     => esc_html__( 'Video Content Icon', 'wpb-elementor-addons' ),
				'default'   => array(
					'value'   => 'fas fa-film',
					'library' => 'solid',
				),
				'condition' => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		$this->add_control(
			'video_title',
			array(
				'label'     => esc_html__( 'Video Title', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Lorem ipsum dolor sit amet', 'wpb-elementor-addons' ),
				'condition' => array(
					'.video_popup_type!' => 'default',
				),
			)
		);

		$this->add_control(
			'video_content',
			array(
				'label'     => esc_html__( 'Video Content', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. ', 'wpb-elementor-addons' ),
				'condition' => array(
					'.video_popup_type!' => 'default',
				),
			)
		);

		// video popup link
		$this->add_control(
			'wpb_ea_video_link',
			array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Link', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'Enter your YouTube link', 'wpb-elementor-addons' ),
				'default'     => 'https://youtu.be/YE7VzlLtp-4',
			)
		);

		$this->add_control(
			'video_link_title',
			array(
				'label'     => esc_html__( 'Link Title', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Watch Trailer', 'wpb-elementor-addons' ),
				'condition' => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		$this->add_control(
			'video_link_desc',
			array(
				'label'     => esc_html__( 'Link Description', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Watch the Video (3:05)', 'wpb-elementor-addons' ),
				'condition' => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		// video popup icon
		$this->add_control(
			'wpb_ea_video_popup_icon',
			array(
				'type'    => \Elementor\Controls_Manager::ICONS,
				'label'   => esc_html__( 'Play Icon', 'wpb-elementor-addons' ),
				'default' => array(
					'value'   => 'fas fa-play',
					'library' => 'solid',
				),
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
		 * video popup style
		 * -------------------------------------------
		 */

		// video popup style section
		$this->start_controls_section(
			'wpb_ea_video_popup_style_section',
			array(
				'label' => esc_html__( 'Video PopUp Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_content_bg',
			array(
				'label'     => esc_html__( 'Content Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-video-popup-content .wpb-ea-video-inner' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_content_color',
			array(
				'label'     => esc_html__( 'Content Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-video-popup-content .wpb-ea-video-inner' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-video-popup-content .wpb-ea-video-inner h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-video-popup-content .wpb-ea-video-inner h4' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		// video popup background overlay color
		$this->add_control(
			'wpb_ea_video_popup_bg_overlay_color',
			array(
				'label'     => esc_html__( 'Background Overlay Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => 'rgba(0, 0, 0, 0.2)',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-video .wpb-ea-video-inner:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_icon_bg',
			array(
				'label'     => esc_html__( 'Play Button Background Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-video .wpb-ea-video-inner .xt-button a' => 'background: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-video.wpb-ea-video-popup-content i.video-content-icon' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_icon_color',
			array(
				'label'     => esc_html__( 'Play Button Icon Color', 'wpb-elementor-addons' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-video .wpb-ea-video-inner .xt-button a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-video.wpb-ea-video-popup-content i.video-content-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'range'      => array(
					'px' => array(
						'step' => 1,
						'max'  => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-video .wpb-ea-video-inner' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 40,
					'bottom' => 40,
					'left'   => 20,
					'right'  => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-video-popup-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'.video_popup_type' => 'content',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_fancy_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'    => 20,
					'bottom' => 40,
					'left'   => 40,
					'right'  => 40,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-video-popup-fancy-content-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'.video_popup_type' => 'fancy',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_fancy_icon_right',
			array(
				'label'      => esc_html__( 'Icon Right Position', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => 40,
				),
				'range'      => array(
					'px' => array(
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-video-popup-fancy-content-details .xt-button' => 'right: {{SIZE}}{{UNIT}}',
					'.rtl {{WRAPPER}} .wpb-ea-video-popup-fancy-content-details .xt-button' => 'left: {{SIZE}}{{UNIT}}; right: unset;',
				),
				'condition'  => array(
					'.video_popup_type' => 'fancy',
				),
			)
		);

		$this->add_control(
			'wpb_ea_video_popup_fancy_icon_top',
			array(
				'label'      => esc_html__( 'Icon Top Position', 'wpb-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'unit' => 'px',
					'size' => -120,
				),
				'range'      => array(
					'px' => array(
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-video-popup-fancy-content-details .xt-button' => 'top: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'.video_popup_type' => 'fancy',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings         = $this->get_settings_for_display();
		$extra_css        = $settings['extra_css'];
		$video_popup_type = $settings['video_popup_type'];
		$video_title      = $settings['video_title'];
		$video_content    = $settings['video_content'];
		$video_link_title = $settings['video_link_title'];
		$video_link_desc  = $settings['video_link_desc'];

		if ( $extra_css ) {
			$extra_css = $extra_css . ' ';
		}

		$video_popup_icon = '';
		if ( $settings['wpb_ea_video_popup_icon']['value'] ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon(
				$settings['wpb_ea_video_popup_icon'],
				array(
					'aria-hidden'    => 'true',
					'class'          => 'wow fadeIn',
					'data-wow-delay' => '0.4s',
					'style'          => 'visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;',
				)
			);
			$video_popup_icon = ob_get_clean();
		}

		echo '<div class="' . esc_attr( $extra_css ) . 'wpb-ea-video wpb-ea-video-popup-' . esc_attr( $video_popup_type ) . '">';
			echo '<div class="wpb-ea-video-inner">';

		switch ( $video_popup_type ) {
			case 'content':
				echo '<div class="wpb-ea-video-popup-content-area">';
				if ( $settings['video_content_icon']['value'] ) {
						\Elementor\Icons_Manager::render_icon(
							$settings['video_content_icon'],
							array(
								'aria-hidden' => 'true',
								'class'       => 'video-content-icon',
							)
						);
				}
					echo '<h3>' . esc_html( $video_title ) . '</h3>';
					echo wp_kses_post( wpautop( $video_content ) );
					echo '<div class="wpb-ea-video-popup-link-area">';
				if ( $settings['wpb_ea_video_link'] ) :
					printf( '<div class="xt-button"><a data-fancybox href="%s">%s</a></div>', esc_url( $settings['wpb_ea_video_link'] ), wp_kses_post( $video_popup_icon ) );
					echo '<div class="wpb-ea-video-popup-link-details">';
						echo '<h4>' . esc_html( $video_link_title ) . '</h4>';
						echo wp_kses_post( wpautop( $video_link_desc ) );
					echo '</div>';
						endif;
					echo '</div>';
						echo '</div>';

				break;

			case 'fancy':
				echo '<div class="wpb-ea-video-popup-fancy-content-area">';
					echo '<div class="wpb-ea-video-popup-fancy-content-image">';
				if ( ! empty( $settings['image']['url'] ) ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) );
				}
					echo '</div>';

					echo '<div class="wpb-ea-video-popup-fancy-content-details">';

				if ( $settings['wpb_ea_video_link'] ) :
					printf( '<div class="xt-button"><a data-fancybox href="%s">%s</a></div>', esc_url( $settings['wpb_ea_video_link'] ), wp_kses_post( $video_popup_icon ) );
						endif;

						echo '<h3>' . esc_html( $video_title ) . '</h3>';
						echo wp_kses_post( wpautop( $video_content ) );
					echo '</div>';
						echo '</div>';

				break;

			default:
				if ( ! empty( $settings['image']['url'] ) ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings ) );
				}

				if ( $settings['wpb_ea_video_link'] ) :
					printf( '<div class="xt-button"><a data-fancybox href="%s">%s</a></div>', esc_url( $settings['wpb_ea_video_link'] ), wp_kses_post( $video_popup_icon ) );
				endif;

				break;
		}

			echo '</div>';
		echo '</div>';
	}
}
