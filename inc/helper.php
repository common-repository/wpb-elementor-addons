<?php

namespace WPB_Elementor_Addons\Traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


trait Helper {

	/**
	 * Get all types of post.
	 *
	 * @return array
	 */
	public function wpb_get_all_types_post( $post_type = 'any' ) {
		$posts = get_posts(
			array(
				'post_type'   => $post_type,
				'post_status' => 'publish',
				'numberposts' => -1,
			)
		);

		if ( ! empty( $posts ) ) {
			return wp_list_pluck( $posts, 'post_title', 'ID' );
		}

		return array();
	}

	/**
	 * Post Query Controls
	 */
	protected function wpb_post_query_controls() {
		$post_types          = $this->wpb_get_post_types();
		$post_types['by_id'] = esc_html__( 'Manual Selection', 'wpb-elementor-addons' );
		$taxonomies          = get_taxonomies( array(), 'objects' );

		$this->start_controls_section(
			'wpb_section_post_filters',
			array(
				'label'     => esc_html__( 'Query', 'wpb-elementor-addons' ),
				'condition' => array(
					'content_source' => 'post',
				),
			)
		);

		$this->add_control(
			'post_type',
			array(
				'label'   => esc_html__( 'Source', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $post_types,
				'default' => key( $post_types ),
			)
		);

		$this->add_control(
			'posts_ids',
			array(
				'label'       => esc_html__( 'Search & Select', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->wpb_get_all_types_post(),
				'label_block' => true,
				'multiple'    => true,
				'condition'   => array(
					'post_type' => 'by_id',
				),
			)
		);

		$this->add_control(
			'authors',
			array(
				'label'       => esc_html__( 'Author', 'wpb-elementor-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => array(),
				'options'     => $this->wpb_get_authors(),
				'condition'   => array(
					'post_type!' => 'by_id',
				),
			)
		);

		foreach ( $taxonomies as $taxonomy => $object ) {
			if ( ! isset( $object->object_type[0] ) || ! in_array( $object->object_type[0], array_keys( $post_types ) ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids',
				array(
					'label'       => $object->label,
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'object_type' => $taxonomy,
					'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
					'condition'   => array(
						'post_type' => $object->object_type,
					),
				)
			);
		}

		$this->add_control(
			'post__not_in',
			array(
				'label'       => esc_html__( 'Exclude', 'wpb-elementor-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $this->wpb_get_all_types_post(),
				'label_block' => true,
				'post_type'   => '',
				'multiple'    => true,
				'condition'   => array(
					'post_type!' => 'by_id',
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Posts Per Page', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			)
		);

		$this->add_control(
			'offset',
			array(
				'label'   => esc_html__( 'Offset', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0',
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order By', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->wpb_get_post_orderby_options(),
				'default' => 'date',

			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => esc_html__( 'Ascending', 'wpb-elementor-addons' ),
					'desc' => esc_html__( 'Descending', 'wpb-elementor-addons' ),
				),
				'default' => 'desc',

			)
		);

		$this->end_controls_section();
	}

	/**
	 * Category Query Controls
	 */
	protected function wpb_category_query_controls() {
		$taxonomies     = $this->wpb_get_taxonomies();
		$all_taxonomies = get_taxonomies( array(), 'objects' );

		$this->start_controls_section(
			'wpb_section_category_filters',
			array(
				'label'     => esc_html__( 'Category Query', 'wpb-elementor-addons' ),
				'condition' => array(
					'content_source' => 'category',
				),
			)
		);

		$this->add_control(
			'category_taxonomy',
			array(
				'label'   => esc_html__( 'Taxonomy', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $taxonomies,
				'default' => key( $taxonomies ),
			)
		);

		foreach ( $all_taxonomies as $taxonomy => $object ) {

			if ( ! isset( $object->object_type[0] ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids_for_cat_include',
				array(
					'label'       => $object->label . __( ' Include', 'wpb-elementor-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'object_type' => $taxonomy,
					'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
					'condition'   => array(
						'category_taxonomy' => $object->name,
					),
				)
			);
		}

		foreach ( $all_taxonomies as $taxonomy => $object ) {

			if ( ! isset( $object->object_type[0] ) ) {
				continue;
			}

			$this->add_control(
				$taxonomy . '_ids_for_cat_exclude',
				array(
					'label'       => $object->label . __( ' Exclude', 'wpb-elementor-addons' ),
					'type'        => Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple'    => true,
					'object_type' => $taxonomy,
					'options'     => wp_list_pluck( get_terms( $taxonomy ), 'name', 'term_id' ),
					'condition'   => array(
						'category_taxonomy' => $object->name,
					),
				)
			);
		}

		$this->add_control(
			'term_orderby',
			array(
				'label'   => esc_html__( 'Order By', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->wpb_get_terms_orderby_options(),
				'default' => 'name',

			)
		);

		$this->add_control(
			'term_order',
			array(
				'label'   => esc_html__( 'Order', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'ASC'  => esc_html__( 'Ascending', 'wpb-elementor-addons' ),
					'DESC' => esc_html__( 'Descending', 'wpb-elementor-addons' ),
				),
				'default' => 'ASC',

			)
		);

		$this->add_control(
			'term_hide_empty',
			array(
				'label'        => esc_html__( 'Hide Empty', 'wpb-elementor-addons' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wpb-elementor-addons' ),
				'label_off'    => esc_html__( 'No', 'wpb-elementor-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'term_number',
			array(
				'label'   => esc_html__( 'Number of items to show', 'wpb-elementor-addons' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => '0',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Menu Query Controls
	 */
	protected function wpb_menu_query_controls() {

		$this->start_controls_section(
			'wpb_section_menu_filters',
			array(
				'label'     => esc_html__( 'Menu Query', 'wpb-elementor-addons' ),
				'condition' => array(
					'content_source' => 'menu',
				),
			)
		);

		$this->add_control(
			'menu_to_show',
			array(
				'label'   => esc_html__( 'Select a Navigation Menu', 'wpb-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => wp_list_pluck( wp_get_nav_menus( array(), 'objects' ), 'name', 'term_id' ),
				'default' => key( wp_list_pluck( wp_get_nav_menus( array(), 'objects' ), 'name', 'term_id' ) ),
			)
		);

		$this->end_controls_section();
	}

	public function wpb_get_query_args( $settings = array(), $requested_post_type = 'post' ) {
		$settings = wp_parse_args(
			$settings,
			array(
				'post_type'      => $requested_post_type,
				'posts_ids'      => array(),
				'orderby'        => 'date',
				'order'          => 'desc',
				'posts_per_page' => 3,
				'offset'         => 0,
				'post__not_in'   => array(),
			)
		);

		$args = array(
			'orderby'             => $settings['orderby'],
			'order'               => $settings['order'],
			'ignore_sticky_posts' => 1,
			'post_status'         => 'publish',
			'posts_per_page'      => $settings['posts_per_page'],
			'offset'              => $settings['offset'],
		);

		if ( 'by_id' === $settings['post_type'] ) {
			$args['post_type'] = 'any';
			$args['post__in']  = empty( $settings['posts_ids'] ) ? array( 0 ) : $settings['posts_ids'];
		} else {
			$args['post_type'] = $settings['post_type'];

			if ( $args['post_type'] !== 'page' ) {
				$args['tax_query'] = array();

				$taxonomies = get_object_taxonomies( $settings['post_type'], 'objects' );

				foreach ( $taxonomies as $object ) {
					$setting_key = $object->name . '_ids';

					if ( ! empty( $settings[ $setting_key ] ) ) {
						$args['tax_query'][] = array(
							'taxonomy' => $object->name,
							'field'    => 'term_id',
							'terms'    => $settings[ $setting_key ],
						);
					}
				}

				if ( ! empty( $args['tax_query'] ) ) {
					$args['tax_query']['relation'] = 'AND';
				}
			}
		}

		if ( ! empty( $settings['authors'] ) ) {
			$args['author__in'] = $settings['authors'];
		}

		if ( ! empty( $settings['post__not_in'] ) ) {
			$args['post__not_in'] = $settings['post__not_in'];
		}

		return $args;
	}

	/**
	 * List Category query args
	 *
	 * https://developer.wordpress.org/reference/functions/wp_list_categories/
	 */
	public function wpb_get_taxonomy_query_args( $settings = array() ) {
		$settings = wp_parse_args(
			$settings,
			array(
				'depth' => 1,
			)
		);

		$args = array(
			'taxonomy'   => $settings['category_taxonomy'],
			'orderby'    => $settings['term_orderby'],
			'order'      => $settings['term_order'],
			'number'     => $settings['term_number'],
			'hide_empty' => ( $settings['term_hide_empty'] == 'yes' ? true : false ),
		);

		if ( ! empty( $settings['depth'] ) ) {
			$args['depth'] = $settings['depth'];
		}

		$taxonomy_include_ids = $settings['category_taxonomy'] . '_ids_for_cat_include';

		if ( ! empty( $settings[ $taxonomy_include_ids ] ) ) {
			$args['include'] = $settings[ $taxonomy_include_ids ];
		}

		$taxonomy_exclude_ids = $settings['category_taxonomy'] . '_ids_for_cat_exclude';

		if ( ! empty( $settings[ $taxonomy_exclude_ids ] ) ) {
			$args['exclude'] = $settings[ $taxonomy_exclude_ids ];
		}

		return $args;
	}

	/**
	 * Nav Menu query args
	 *
	 * https://developer.wordpress.org/reference/functions/wp_nav_menu/
	 */
	public function wpb_get_menu_query_args( $settings = array() ) {
		$settings = wp_parse_args(
			$settings,
			array(
				'depth' => 1,
				'echo'  => 0,
			)
		);

		$args = array(
			'menu'      => $settings['menu_to_show'],
			'echo'      => 0,
			'container' => 0,
		);

		if ( ! empty( $settings['depth'] ) ) {
			$args['depth'] = $settings['depth'];
		}

		return $args;
	}

	/**
	 * Get All POst Types
	 *
	 * @return array
	 */
	public function wpb_get_post_types() {
		$post_types = get_post_types(
			array(
				'public'            => true,
				'show_in_nav_menus' => true,
			),
			'objects'
		);
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );

		return array_diff_key( $post_types, array( 'elementor_library', 'attachment' ) );
	}

	/**
	 * Get All Taxonomies
	 *
	 * @return array
	 */
	public function wpb_get_taxonomies() {
		$taxonomies = get_taxonomies(
			array(
				'public'  => true,
				'show_ui' => true,
			),
			'objects'
		);
		$taxonomies = wp_list_pluck( $taxonomies, 'label', 'name' );

		return array_diff_key( $taxonomies, array() );
	}

	/**
	 * Get Post Thumbnail Size
	 *
	 * @return array
	 */
	public function wpb_get_thumbnail_sizes() {
		$sizes = get_intermediate_image_sizes();
		foreach ( $sizes as $s ) {
			$ret[ $s ] = $s;
		}

		return $ret;
	}

	/**
	 * POst Orderby Options
	 *
	 * @return array
	 */
	public function wpb_get_post_orderby_options() {
		$orderby = array(
			'ID'            => esc_html__( 'Post ID', 'wpb-elementor-addons' ),
			'author'        => esc_html__( 'Post Author', 'wpb-elementor-addons' ),
			'title'         => esc_html__( 'Title', 'wpb-elementor-addons' ),
			'date'          => esc_html__( 'Date', 'wpb-elementor-addons' ),
			'modified'      => esc_html__( 'Last Modified Date', 'wpb-elementor-addons' ),
			'parent'        => esc_html__( 'Parent Id', 'wpb-elementor-addons' ),
			'rand'          => esc_html__( 'Random', 'wpb-elementor-addons' ),
			'comment_count' => esc_html__( 'Comment Count', 'wpb-elementor-addons' ),
			'menu_order'    => esc_html__( 'Menu Order', 'wpb-elementor-addons' ),
		);

		return $orderby;
	}

	/**
	 * get_terms Orderby Options
	 *
	 * @return array
	 */
	public function wpb_get_terms_orderby_options() {
		$orderby = array(
			'name'       => esc_html__( 'Name', 'wpb-elementor-addons' ),
			'count'      => esc_html__( 'Count', 'wpb-elementor-addons' ),
			'slug'       => esc_html__( 'Slug', 'wpb-elementor-addons' ),
			'term_group' => esc_html__( 'Term Group', 'wpb-elementor-addons' ),
			'term_order' => esc_html__( 'Term Order', 'wpb-elementor-addons' ),
			'term_id'    => esc_html__( 'Term ID', 'wpb-elementor-addons' ),
			'include'    => esc_html__( 'Include', 'wpb-elementor-addons' ),
			'slug__in'   => esc_html__( 'Slug In', 'wpb-elementor-addons' ),
			'none'       => esc_html__( 'None', 'wpb-elementor-addons' ),
		);

		return $orderby;
	}

	/**
	 * Get Post Categories
	 *
	 * @return array
	 */
	public function wpb_post_type_categories( $type = 'term_id', $term_key = 'category' ) {
		$terms = get_terms(
			array(
				'taxonomy'   => $term_key,
				'hide_empty' => true,
			)
		);

		$options = array();

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->{$type} ] = $term->name;
			}
		}

		return $options;
	}

	/**
	 * WooCommerce Product Query
	 *
	 * @return array
	 */
	public function wpb_woocommerce_product_categories() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
			return $options;
		}
	}

	/**
	 * WooCommerce Get Product By Id
	 *
	 * @return array
	 */
	public function wpb_woocommerce_product_get_product_by_id() {
		$postlist = get_posts(
			array(
				'post_type' => 'product',
				'showposts' => 9999,
			)
		);
		$options  = array();

		if ( ! empty( $postlist ) && ! is_wp_error( $postlist ) ) {
			foreach ( $postlist as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
			return $options;

		}
	}

	/**
	 * WooCommerce Get Product Category By Id
	 *
	 * @return array
	 */
	public function wpb_woocommerce_product_categories_by_id() {
		$terms = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
			)
		);

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->term_id ] = $term->name;
			}
			return $options;
		}
	}

	/**
	 * Get all elementor page templates
	 *
	 * @return array
	 */
	public function wpb_get_page_templates( $type = null ) {
		$args = array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => -1,
		);

		if ( $type ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms'    => $type,
				),
			);
		}

		$page_templates = get_posts( $args );
		$options        = array();

		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}

	/**
	 * Get all Authors
	 *
	 * @return array
	 */
	public function wpb_get_authors() {
		$args = array(
			'capability'          => array( 'edit_posts' ),
			'has_published_posts' => true,
			'fields'              => array(
				'ID',
				'display_name',
			),
		);

		// Capability queries were only introduced in WP 5.9.
		if ( version_compare( $GLOBALS['wp_version'], '5.9-alpha', '<' ) ) {
			$args['who'] = 'authors';
			unset( $args['capability'] );
		}

		$users = get_users( $args );

		if ( ! empty( $users ) ) {
			return wp_list_pluck( $users, 'display_name', 'ID' );
		}

		return array();
	}

	/**
	 * Get all Tags
	 *
	 * @param  array $args
	 *
	 * @return array
	 */
	public function wpb_get_tags( $args = array() ) {
		$options = array();
		$tags    = get_tags( $args );

		if ( is_wp_error( $tags ) ) {
			return array();
		}

		foreach ( $tags as $tag ) {
			$options[ $tag->term_id ] = $tag->name;
		}

		return $options;
	}

	/**
	 * Get all taxonomies by post
	 *
	 * @param  array  $args
	 *
	 * @param  string $output
	 * @param  string $operator
	 *
	 * @return array
	 */
	public function wpb_get_taxonomies_by_post( $args = array(), $output = 'names', $operator = 'and' ) {
		global $wp_taxonomies;

		$field = ( 'names' === $output ) ? 'name' : false;

		// Handle 'object_type' separately.
		if ( isset( $args['object_type'] ) ) {
			$object_type = (array) $args['object_type'];
			unset( $args['object_type'] );
		}

		$taxonomies = wp_filter_object_list( $wp_taxonomies, $args, $operator );

		if ( isset( $object_type ) ) {
			foreach ( $taxonomies as $tax => $tax_data ) {
				if ( ! array_intersect( $object_type, $tax_data->object_type ) ) {
					unset( $taxonomies[ $tax ] );
				}
			}
		}

		if ( $field ) {
			$taxonomies = wp_list_pluck( $taxonomies, $field );
		}

		return $taxonomies;
	}

	/**
	 * Get all Posts
	 *
	 * @return array
	 */
	public function wpb_get_posts() {
		$post_list = get_posts(
			array(
				'post_type'      => 'post',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => -1,
			)
		);

		$posts = array();

		if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
			foreach ( $post_list as $post ) {
				$posts[ $post->ID ] = $post->post_title;
			}
		}

		return $posts;
	}

	/**
	 * Get all Pages
	 *
	 * @return array
	 */
	public function wpb_get_pages() {
		$page_list = get_posts(
			array(
				'post_type'      => 'page',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => -1,
			)
		);

		$pages = array();

		if ( ! empty( $page_list ) && ! is_wp_error( $page_list ) ) {
			foreach ( $page_list as $page ) {
				$pages[ $page->ID ] = $page->post_title;
			}
		}

		return $pages;
	}

	/**
	 * WPB News Ticker Attr
	 */
	public function wpb_get_news_ticker_attr( $settings ) {
		$direction      = $settings['wpb_ea_pro_news_ticker_animation_direction'];
		$ticker_height  = $settings['wpb_ea_pro_news_ticker_height'];
		$autoplay       = $settings['wpb_ea_pro_news_ticker_autoplay'];
		$bottom_fixed   = $settings['wpb_ea_pro_news_ticker_set_bottom_fixed'];
		$animation_type = $settings['wpb_ea_pro_news_ticker_animation_type'];

		( $animation_type == 'scroll' ) ? $animation_speed   = $settings['wpb_ea_pro_news_ticker_animation_speed'] : $animation_speed = '';
		( $animation_type != 'scroll' ) ? $autoplay_interval = $settings['wpb_ea_pro_news_ticker_autoplay_interval'] : $autoplay_interval = '';
		( $autoplay == 'yes' ) ? $pause_on_hover             = $settings['wpb_ea_pro_news_ticker_pause_on_hover'] : $pause_on_hover = '';

		$data_attr = array(
			'data-autoplay'          => esc_attr( $autoplay == 'yes' ? 'true' : 'false' ),
			'data-bottom_fixed'      => esc_attr( $bottom_fixed == 'yes' ? 'fixed-bottom' : 'false' ),
			'data-pause_on_hover'    => esc_attr( $pause_on_hover == 'yes' ? 'true' : 'false' ),
			'data-autoplay_interval' => esc_attr( $autoplay_interval ),
			'data-direction'         => ( ( is_rtl() || $direction == 'rtl' ) ? 'rtl' : 'ltr' ),
			'data-animation_speed'   => esc_attr( $animation_speed ),
			'data-ticker_height'     => esc_attr( $ticker_height ),
			'data-animation'         => esc_attr( $animation_type ),
		);

		return $data_attr;
	}
}
