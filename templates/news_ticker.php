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

class WPB_EA_News_Ticker_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-news-ticker';
	}

	public function get_title() {
		return esc_html__( 'News Ticker', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-post-navigation';
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
			'breaking-news-ticker',
			'wpb-ea-super-js',
		);
	}

	public function get_style_depends() {
		return array( 'breaking-news-ticker-css' );
	}

	protected function register_controls() {
		$wpb_ea_primary_color      = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );
		$wpb_ea_primary_color_dark = wpb_ea_get_option( 'wpb_ea_primary_color_dark', 'wpb_ea_style', '#004dcb' );

		$this->start_controls_section(
			'wpb_ea_pro_news_ticker_settings',
			array(
				'label' => esc_html__( 'News Ticker', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_news_ticker_label',
			array(
				'label'   => esc_html__( 'Label', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Ticker Label',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'label'       => esc_html__( 'Content', 'wpb-elementor-addons' ),
				'default'     => esc_html__( 'List title', 'wpb-elementor-addons' ),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'type'        => \Elementor\Controls_Manager::URL,
				'label'       => esc_html__( 'Link', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'https://yoursite.com', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_items',
			array(
				'label'       => esc_html__( 'Items', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'default'     => array(
					array( 'title' => esc_html__( '1. Breaking NEWS A', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '2. Breaking NEWS B', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '3. Breaking NEWS C', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '4. Breaking NEWS D', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '5. Breaking NEWS E', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '6. Breaking NEWS F', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '7. Breaking NEWS G', 'wpb-elementor-addons' ) ),
					array( 'title' => esc_html__( '8. Breaking NEWS H', 'wpb-elementor-addons' ) ),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{title}}',
			)
		);

		$this->add_control(
			'extra_css',
			array(
				'label'       => esc_html__( 'Extra CSS Class', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Put your extra CSS class if you need.', 'wpb-elementor-addons' ),
				'placeholder' => esc_html__( 'your-extra-css-class', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pro_news_ticker_settings_tab',
			array(
				'label' => esc_html__( 'Settings', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_animation_direction',
			array(
				'label'       => esc_html__( 'Direction', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'ltr',
				'options'     => array(
					'ltr' => esc_html__( 'Left to Right', 'wpb-elementor-addons' ),
					'rtl' => esc_html__( 'Right to Left', 'wpb-elementor-addons' ),
				),
				'description' => esc_html__( 'If you enable Right-to-left(RTL) in your website than by default it will be working in RTL and this option won\'t work.', 'wpb-elementor-addons' ),

			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_animation_type',
			array(
				'label'   => esc_html__( 'Animation Type', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'scroll',
				'options' => array(
					'scroll'      => esc_html__( 'Scroll', 'wpb-elementor-addons' ),
					'slide'       => esc_html__( 'Slide', 'wpb-elementor-addons' ),
					'fade'        => esc_html__( 'Fade', 'wpb-elementor-addons' ),
					'slide-up'    => esc_html__( 'Slide Up', 'wpb-elementor-addons' ),
					'slide-down'  => esc_html__( 'Slide Down', 'wpb-elementor-addons' ),
					'slide-left'  => esc_html__( 'Slide Left', 'wpb-elementor-addons' ),
					'slide-right' => esc_html__( 'Slide Right', 'wpb-elementor-addons' ),
					'typography'  => esc_html__( 'Typography', 'wpb-elementor-addons' ),
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_autoplay_interval',
			array(
				'label'     => esc_html__( 'Autoplay Interval', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '4000',
				'condition' => array(
					'.wpb_ea_pro_news_ticker_animation_type!' => 'scroll',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_animation_speed',
			array(
				'label'     => esc_html__( 'Animation Speed', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '2',
				'condition' => array(
					'.wpb_ea_pro_news_ticker_animation_type' => 'scroll',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_height',
			array(
				'label'   => esc_html__( 'Height', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '40',
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_autoplay',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Autoplay?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_pause_on_hover',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Pause On Hover?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'return_value' => 'yes',
				'condition'    => array(
					'.wpb_ea_pro_news_ticker_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_set_bottom_fixed',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Set Bottom?', 'wpb-elementor-addons' ),
				'default'      => 'no',
				'return_value' => 'yes',
				'description'  => esc_html__( 'Stick the news ticker to the bottom of the page.', 'wpb-elementor-addons' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'wpb_ea_pro_news_ticker_style_tab',
			array(
				'label' => esc_html__( 'Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_color',
			array(
				'label'     => esc_html__( 'Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker li'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker li:hover, .wpb-ea-pro-news-ticker.breaking-news-ticker li a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'      => 'wpb_ea_pro_news_ticker_typography',
				'selector'  => '{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker ul li',
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_each_item_padding',
			array(
				'label'      => esc_html__( 'Padding Each Item(Left & Right)', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-news ul li' => 'padding: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wpb_ea_pro_news_ticker_border',
				'label'    => esc_html__( 'Border', 'wpb-elementor-addons' ),
				'selector' => '{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker',
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'   => array(
					'size' => 2,
				),
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker.breaking-news-ticker' => 'border-radius: {{SIZE}}px;',
				),
			)
		);

		$this->add_control(
			'wpb_ea_news_ticker_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3878ff',
				'selectors' => array(
					'{{WRAPPER}} .breaking-news-ticker' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_label_style_heading',
			array(
				'label'     => esc_html__( 'Label', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_show_label',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Label?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Show', 'wpb-elementor-addons' ),
				'label_off'    => esc_html__( 'Hide', 'wpb-elementor-addons' ),
				'return_value' => 'yes',
				'description'  => esc_html__( 'Show/Hide Label.', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-label' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_label_bg_color',
			array(
				'label'     => esc_html__( 'Label Background Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $wpb_ea_primary_color,
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-label' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_label' => 'yes',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'      => 'wpb_ea_pro_news_ticker_label_typography',
				'selector'  => '{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-label',
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_label_padding',
			array(
				'label'      => esc_html__( 'Padding(Left & Right)', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'default'    => array(
					'size' => 15,
				),
				'selectors'  => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-label' => 'padding: 0 {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'.wpb_ea_pro_news_ticker_show_label' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_controls_style_heading',
			array(
				'label'     => esc_html__( 'Controls', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'after',
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_show_controls',
			array(
				'type'         => Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Controls?', 'wpb-elementor-addons' ),
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Show', 'wpb-elementor-addons' ),
				'label_off'    => esc_html__( 'Hide', 'wpb-elementor-addons' ),
				'return_value' => 'yes',
				'description'  => esc_html__( 'Show/Hide Controls.', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_controls_color',
			array(
				'label'     => esc_html__( 'Controls Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-arrow::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-pause::before, {{WRAPPER}} .wpb-ea-pro-news-ticker .bn-pause::after' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_controls' => 'yes',
				),
			)
		);

		$this->add_control(
			'wpb_ea_pro_news_ticker_controls_bg_color',
			array(
				'label'     => esc_html__( 'Controls Background Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f6f6f6',
				'selectors' => array(
					'{{WRAPPER}} .wpb-ea-pro-news-ticker .bn-controls button' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'.wpb_ea_pro_news_ticker_show_controls' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$label          = $settings['wpb_ea_news_ticker_label'];
		$show_label     = $settings['wpb_ea_pro_news_ticker_show_label'];
		$direction      = $settings['wpb_ea_pro_news_ticker_animation_direction'];
		$ticker_height  = $settings['wpb_ea_pro_news_ticker_height'];
		$autoplay       = $settings['wpb_ea_pro_news_ticker_autoplay'];
		$bottom_fixed   = $settings['wpb_ea_pro_news_ticker_set_bottom_fixed'];
		$animation_type = $settings['wpb_ea_pro_news_ticker_animation_type'];
		$extra_css      = $settings['extra_css'];

		( $animation_type == 'scroll' ) ? $animation_speed   = $settings['wpb_ea_pro_news_ticker_animation_speed'] : $animation_speed = '';
		( $animation_type != 'scroll' ) ? $autoplay_interval = $settings['wpb_ea_pro_news_ticker_autoplay_interval'] : $autoplay_interval = '';
		( $autoplay == 'yes' ) ? $pause_on_hover             = $settings['wpb_ea_pro_news_ticker_pause_on_hover'] : $pause_on_hover = '';
		if ( $extra_css ) {
			$extra_css = $extra_css . ' ';
		}
		$controls   = array( 'wpb-ea-pro-news-ticker breaking-news-ticker' );
		$controls[] = $extra_css;
		$data_attr  = array(
			'data-autoplay'          => esc_attr( $autoplay == 'yes' ? 'true' : 'false' ),
			'data-bottom_fixed'      => esc_attr( $bottom_fixed == 'yes' ? 'fixed-bottom' : 'false' ),
			'data-pause_on_hover'    => esc_attr( $pause_on_hover == 'yes' ? 'true' : 'false' ),
			'data-autoplay_interval' => esc_attr( $autoplay_interval ),
			'data-direction'         => ( ( is_rtl() || $direction == 'rtl' ) ? 'rtl' : 'ltr' ),
			'data-animation_speed'   => esc_attr( $animation_speed ),
			'data-ticker_height'     => esc_attr( $ticker_height ),
			'data-animation'         => esc_attr( $animation_type ),
		);

		echo '<div class="' . esc_attr( implode( ' ', $controls ) ) . '"' . wp_kses_data( wpb_ea_owl_carousel_data_attr_implode( $data_attr ) ) . '>';
			( $label && ( $show_label == 'yes' ) ) ? printf( '<div class="bn-label">%s</div>', esc_html( $label ) ) : '';
			echo '<div class="bn-news">';
		if ( is_array( $settings['wpb_ea_pro_news_ticker_items'] ) ) :
			echo '<ul>';
			foreach ( $settings['wpb_ea_pro_news_ticker_items'] as $list ) :
				if ( $list['link']['url'] ) :
					if ( $list['link']['is_external'] === 'on' ) {
							$target = 'target= _blank';
					} else {
								$target = '';
					}
					if ( $list['link']['nofollow'] === 'on' ) {
						$target .= ' rel= nofollow ';
					}
							echo '<li><a href="' . esc_url( $list['link']['url'] ) . '" ' . esc_attr( $target ) . '>' . esc_html( $list['title'] ) . '</a></li>';
						else :
							echo '<li>' . esc_html( $list['title'] ) . '</li>';
							endif;
						endforeach;
					echo '</ul>';
				endif;
			echo '</div>';
		if ( $settings['wpb_ea_pro_news_ticker_show_controls'] == 'yes' ) {
			echo '<div class="bn-controls">';
				echo '<button><span class="bn-arrow bn-prev"></span></button>';
				echo '<button><span class="bn-action"></span></button>';
				echo '<button><span class="bn-arrow bn-next"></span></button>';
			echo '</div>';
		}
		echo '</div>';
	}
}
