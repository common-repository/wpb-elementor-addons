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
use Elementor\Group_Control_Typography;

class WPB_EA_Widget_Content_Timeline extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wpb-ea-timeline';
	}

	public function get_title() {
		return esc_html__( 'WPB Content Timeline', 'wpb-elementor-addons' );
	}

	public function get_icon() {
		return 'eicon-time-line';
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
		return array( 'wpb-ea-super-js' );
	}

	protected function register_controls() {
		$wpb_ea_primary_color = wpb_ea_get_option( 'wpb_ea_primary_color', 'wpb_ea_style', '#3878ff' );

		// timeline section
		$this->start_controls_section(
			'wpb_ea_testimonial',
			array(
				'label' => esc_html__( 'Content Timeline', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_timeline_type',
			array(
				'label'   => esc_html__( 'Timeline Type', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-right',
				'options' => array(
					'left-right' => esc_html__( 'Left and Right', 'wpb-elementor-addons' ),
					'left'       => esc_html__( 'Left Side Only', 'wpb-elementor-addons' ),
					'right'      => esc_html__( 'Right Side Only', 'wpb-elementor-addons' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image_size',
				'label'   => esc_html__( 'Image Size', 'wpb-elementor-addons' ),
				'default' => 'medium_large',
			)
		);

		$this->add_control(
			'wpb_ea_disable_date',
			array(
				'label'        => esc_html__( 'Disable date?', 'wpb-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-file',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'date',
			array(
				'label'          => esc_html__( 'Date', 'wpb-elementor-addons' ),
				'type'           => \Elementor\Controls_Manager::DATE_TIME,
				'label_block'    => true,
				'default'        => esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
				'picker_options' => array(
					'enableTime' => false,
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Timeline Item Title', 'wpb-elementor-addons' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'      => esc_html__( 'Content', 'wpb-elementor-addons' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'show_label' => false,
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label' => esc_html__( 'Image', 'wpb-elementor-addons' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$repeater->add_control(
			'shortcode',
			array(
				'label'       => esc_html__( 'ShortCode', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '[products]', 'wpb-elementor-addons' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => esc_html__( 'https://your-link.com', 'wpb-elementor-addons' ),
			)
		);

		$this->add_control(
			'wpb_ea_timeline_items',
			array(
				'label'       => esc_html__( 'Timeline Items', 'wpb-elementor-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'date'    => esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
						'icon'    => array(
							'value'   => 'fas fa-file',
							'library' => 'solid',
						),
						'title'   => esc_html__( 'Lorem ipsum dolor sit amet', 'wpb-elementor-addons' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
					),
					array(
						'date'    => esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
						'icon'    => array(
							'value'   => 'far fa-calendar',
							'library' => 'regular',
						),
						'title'   => esc_html__( 'Donec nec justo eget felis', 'wpb-elementor-addons' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
					),
					array(
						'date'    => esc_html__( 'March 23, 2020', 'wpb-elementor-addons' ),
						'icon'    => array(
							'value'   => 'fas fa-cloud',
							'library' => 'solid',
						),
						'title'   => esc_html__( 'Morbi in sem quis dui placerat', 'wpb-elementor-addons' ),
						'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.', 'wpb-elementor-addons' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		/**
		 * style settings
		 */

		$this->start_controls_section(
			'wpb_ea_timeline_style',
			array(
				'label' => esc_html__( 'Style', 'wpb-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wpb_ea_timeline_bg_color',
			array(
				'label'     => esc_html__( 'Timeline Background', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpb-timeline-content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-timeline-area .wpb-timeline-content::before' => 'background-color: {{VALUE}};',
				),
				'default'   => '#fff',
			)
		);

		$this->add_control(
			'wpb_ea_timeline_icon_bg_color',
			array(
				'label'     => esc_html__( 'Icon Background', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpb-timeline-icon'      => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpb-timeline-date span' => 'background-color: {{VALUE}};',
				),
				'default'   => '#3878ff',
			)
		);

		$this->add_control(
			'wpb_ea_timeline_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpb-timeline-icon i'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpb-timeline-date span' => 'color: {{VALUE}};',
				),
				'default'   => '#fff',
			)
		);

		$this->add_control(
			'wpb_ea_timeline_bar_bg_color',
			array(
				'label'     => esc_html__( 'Timeline Bar Background', 'wpb-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wpb-timeline-area::before' => 'background-color: {{VALUE}};',
				),
				'default'   => '#d7e4ed',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'wpb_ea_timeline_title_typography',
				'selector' => '{{WRAPPER}} .wpb-timeline-block h3',
			)
		);

		$this->add_control(
			'wpb_ea_timeline_shadow',
			array(
				'label'        => esc_html__( 'Timeline Shadow', 'wpb-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wpb-elementor-addons' ),
				'label_off'    => esc_html__( 'No', 'wpb-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
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

		return sprintf( '<img src="%s" alt="%s" />', esc_url( $image_src ), esc_html( $item['title'] ) );
	}

	protected function render() {
		$settings               = $this->get_settings_for_display();
		$wpb_ea_timeline_items  = $settings['wpb_ea_timeline_items'];
		$wpb_ea_timeline_type   = $settings['wpb_ea_timeline_type'];
		$wpb_ea_timeline_shadow = $settings['wpb_ea_timeline_shadow'];

		if ( is_array( $settings['wpb_ea_timeline_items'] ) ) : ?>
			<div class="wpb-timeline-area wpb-timeline-<?php echo esc_attr( $wpb_ea_timeline_type ); ?> wpb-timeline-shadow-<?php echo esc_attr( $wpb_ea_timeline_shadow ); ?>">

				<?php foreach ( $settings['wpb_ea_timeline_items'] as $item ) : ?>

					<div class="wpb-timeline-block">
						<?php do_action( 'wpb_ea_before_timeline_item', $item ); ?>
						<?php if ( $item['icon'] ) : ?>
							<div class="wpb-timeline-icon">
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], array( 'aria-hidden' => 'true' ) ); ?>
							</div>
						<?php endif; ?>
						<div class="wpb-timeline-content">
							<?php if ( $item['date'] && $settings['wpb_ea_disable_date'] != 'yes' ) : ?>
								<div class="wpb-timeline-date"><span class="wpb-timeline-date-inner"><?php echo esc_html( date_i18n( apply_filters( 'wpb_ea_timeline_date_format', get_option( 'date_format' ) ), strtotime( $item['date'] ) ) ); ?></span></div>
							<?php endif; ?>

							<?php
							if ( $item['link']['url'] ) {
								if ( $item['link']['is_external'] === 'on' ) {
									$target = 'target= _blank';
								} else {
									$target = '';
								}
								if ( $item['link']['nofollow'] === 'on' ) {
									$target .= ' rel= nofollow ';
								}

								( $item['title'] ? printf( '<h3><a href="%s" %s>%s</a></h3>', esc_url( $item['link']['url'] ), esc_attr( $target ), esc_html( $item['title'] ) ) : '' );

							} else {
								( $item['title'] ? printf( '<h3>%s</h3>', esc_html( $item['title'] ) ) : '' );
							}
							?>

							<?php echo wp_kses_post( wpautop( $item['content'] ) ); ?>

							<?php
							if ( $item['shortcode'] ) {
								echo do_shortcode( $item['shortcode'] );
							}
							?>

							<?php
								echo ( ! empty( $item['image']['url'] ) ? '<div class="wpb-timeline-image">' . wp_kses_post( $this->render_image( $item, $settings ) ) . '</div>' : '' );
							?>
						</div>
						<?php do_action( 'wpb_ea_after_timeline_item', $item ); ?>
					</div>

				<?php endforeach; ?>

			</div>
		<?php endif; ?>

		<?php
	}
}