<?php
/**
 * Plugin: WPB Elementor Addons
 *
 * Author: WpBean
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get settings option.
 *
 * @param string $option Name of the option to retrieve.
 * @param string $section Name of the section to retrieve.
 * @param string $default_value Default value to return if the option does not exist.
 * @return mixed Value of the option. A value of any type may be returned, including scalar (string, boolean, float, integer), null, array, object.
 */
function wpb_ea_get_option( $option, $section, $default_value = '' ) {

	$options = get_option( $section );

	if ( isset( $options[ $option ] ) ) {
		return $options[ $option ];
	}

	return $default_value;
}

/**
 * Premium Addons for Admin discount notice.
 */
if ( ! function_exists( 'wpb_ea_premium_addons' ) ) {

	function wpb_ea_premium_addons() {

		$addons = array(
			'wpb-elementor-news-ticker-pro' => 'WPB Elementor News Ticker PRO',
		);

		return apply_filters( 'wpb_ea_premium_addons', $addons );
	}
}

/**
 * Premium Addons for settings
 */

add_filter( 'wpb_ea_required_addons', 'wpb_ea_pro_required_addon' );

function wpb_ea_pro_required_addon( $addons ) {

	$pro_addons = apply_filters(
		'wpb_ea_pro_required_addon',
		array(
			array(
				'name'  => WPB_EA_PREFIX . 'pro_addons',
				'label' => esc_html__( 'Pro Elements', 'wpb-elementor-addons' ),
				'type'  => 'section_title',
			),
		)
	);

	$addons = array_merge( $addons, $pro_addons );

	return $addons;
}

/**
 * Premium Addons Link for settings
 */

add_filter( 'wpb_ea_pro_required_addon', 'wpb_nt_pro_addons_link' );

function wpb_nt_pro_addons_link( $addons ) {

	if ( ! defined( 'WPB_NT_VERSION' ) ) {
		$addons[] = array(
			'name'    => WPB_EA_PREFIX . 'news_ticker_pro_link',
			'label'   => esc_html__( 'News Ticker PRO', 'wpb-elementor-addons' ),
			'desc'    => esc_html__( 'Scrolling dynamic data like posts, products, categories even a navigation menu.', 'wpb-elementor-addons' ),
			'icon'    => 'eicon-post-navigation',
			'type'    => 'premium',
			'options' => 'https://wpbean.com/downloads/wpb-elementor-news-ticker-pro/',
		);
	}

	return $addons;
}

/**
 * Include a template by precedance
 *
 * Looks at the theme directory first
 *
 * @param  string  $template_name
 * @param  array   $args
 *
 * @return void
 */

if ( ! function_exists( 'wpb_ea_get_template' ) ) {

	function wpb_ea_get_template( $template_name ) {

		$template = locate_template(
			array(
				WPB_EA_THEME_DIR_PATH . $template_name,
				$template_name,
			)
		);

		if ( ! $template ) {
			$template = WPB_EA_TEMPLATE_PATH . $template_name;
		}

		if ( file_exists( $template ) ) {
			require_once $template;
		}
	}
}


/**
 * PHP implode with key and value ( Owl carousel data attr )
 */
if ( ! function_exists( 'wpb_ea_owl_carousel_data_attr_implode' ) ) {

	function wpb_ea_owl_carousel_data_attr_implode( $attrs ) {

		foreach ( $attrs as $key => $value ) {

			if ( isset( $value ) && $value != '' ) {
				$output[] = $key . '="' . esc_attr( $value ) . '"';
			}
		}

		return implode( ' ', $output );
	}
}

/**
 * get all types of posts
 */
function wpb_ea_get_all_post_type_options() {

	$post_types = get_post_types( array( 'public' => true ), 'objects' );

	$options = array();

	foreach ( $post_types as $post_type ) {
		$options[ $post_type->name ] = $post_type->label;
	}

	return $options;
}

/**
 * get all taxonomy
 */
function wpb_ea_get_all_taxonomy_options() {

	$taxonomies = get_taxonomies( array( 'public' => true ), 'objects' );

	$options = array();

	foreach ( $taxonomies as $taxonomy ) {
		$options[ $taxonomy->name ] = $taxonomy->label;
	}

	return $options;
}

if ( ! function_exists( 'wpb_ea_enable_addons' ) ) {

	/**
	 * Check addon is enable or not.
	 *
	 * @param string $addon The addon name key to check.
	 * @param string $default_value The default vaule.
	 * @return void
	 */
	function wpb_ea_enable_addons( $addon = '', $default_value = '' ) {
		if ( $addon ) {
			$addons_status = wpb_ea_get_option( $addon, 'wpb_ea_addons', $default_value );
			if ( $addons_status === 'on' ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}


/**
 * Add a New Elementor Category
 */

add_action( 'elementor/elements/categories_registered', 'wpb_ea_add_elementor_category' );

if ( ! function_exists( 'wpb_ea_add_elementor_category' ) ) {

	function wpb_ea_add_elementor_category( $elements_manager ) {

		$elements_manager->add_category(
			'wpb_ea_widgets',
			array(
				'title' => esc_html__( 'WPB ADDONS', 'wpb-elementor-addons' ),
			)
		);
	}
}


/**
 * Add Elementor widgets
 */

add_action( 'elementor/widgets/register', 'wpb_ea_add_elementor_widgets' );

if ( ! function_exists( 'wpb_ea_add_elementor_widgets' ) ) {

	function wpb_ea_add_elementor_widgets( $widgets_manager ) {

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'content_box', 'on' ) ) {
			wpb_ea_get_template( 'content_box.php' );
			$widgets_manager->register( new WPB_EA_Widget_Content_Box() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'counter', 'on' ) ) {
			wpb_ea_get_template( 'counter.php' );
			$widgets_manager->register( new WPB_EA_CounterUp() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'fancy_list', 'on' ) ) {
			wpb_ea_get_template( 'fancy_list.php' );
			$widgets_manager->register( new WPB_EA_Fancy_List() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'image_gallery', 'on' ) ) {
			wpb_ea_get_template( 'image_gallery.php' );
			$widgets_manager->register( new WPB_EA_Widget_Image_Gallery() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'logo_slider', 'on' ) ) {
			wpb_ea_get_template( 'logo_slider.php' );
			$widgets_manager->register( new WPB_EA_Widget_Logo_Slider() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'news_ticker', 'on' ) ) {
			wpb_ea_get_template( 'news_ticker.php' );
			$widgets_manager->register( new WPB_EA_News_Ticker_Widget() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'post_grid_slider', 'on' ) ) {
			wpb_ea_get_template( 'post_grid_slider.php' );
			$widgets_manager->register( new WPB_EA_Post_Grid_Slider() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'pricing_tables', 'on' ) ) {
			wpb_ea_get_template( 'pricing_tables.php' );
			$widgets_manager->register( new WPB_EA_Widget_Pricing_Table() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'service_box', 'on' ) ) {
			wpb_ea_get_template( 'service_box.php' );
			$widgets_manager->register( new WPB_EA_Widget_Service_Box() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'slider', 'on' ) ) {
			wpb_ea_get_template( 'slider.php' );
			$widgets_manager->register( new WPB_EA_Widget_Slider() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'team_members', 'on' ) ) {
			wpb_ea_get_template( 'team_members.php' );
			$widgets_manager->register( new WPB_EA_Widget_Team_Member() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'testimonials', 'on' ) ) {
			wpb_ea_get_template( 'testimonials.php' );
			$widgets_manager->register( new WPB_EA_Widget_Testimonial() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'video_popup', 'on' ) ) {
			wpb_ea_get_template( 'video_popup.php' );
			$widgets_manager->register( new WPB_EA_Video_PopUp() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'timeline', 'on' ) ) {
			wpb_ea_get_template( 'timeline.php' );
			$widgets_manager->register( new WPB_EA_Widget_Content_Timeline() );
		}

		if ( wpb_ea_enable_addons( WPB_EA_PREFIX . 'videos_grid', 'on' ) ) {
			wpb_ea_get_template( 'videos_grid.php' );
			$widgets_manager->register( new WPB_EA_Videos_Grid() );
		}
	}
}

/**
 * Getting gallery categories array
 */
function wpb_ea_array_flatten( $categories ) {
	if ( ! is_array( $categories ) ) {
		return false;
	}

	$result = array();

	foreach ( $categories as $key => $value ) {
		if ( is_array( $value ) ) {
			$result = array_merge( $result, wpb_ea_array_flatten( $value ) );
		} else {
			$result[ $key ] = $value;
		}
	}

	return $result;
}

function wpb_ea_gallery_categories( $gallery_items ) {

	if ( ! is_array( $gallery_items ) ) {
		return false;
	}

	$gallery_category_names       = array();
	$gallery_category_names_final = array();

	if ( is_array( $gallery_items ) ) {

		foreach ( $gallery_items as $gallery_item ) :
			$gallery_category_names[] = $gallery_item['gallery_category_name'];
		endforeach;

		if ( is_array( $gallery_category_names ) && ! empty( $gallery_category_names ) ) {
			foreach ( $gallery_category_names as $gallery_category_name ) {
				$gallery_category_names_final[] = explode( ',', $gallery_category_name );
			}
		}

		if ( is_array( $gallery_category_names_final ) && ! empty( $gallery_category_names_final ) && function_exists( 'wpb_ea_array_flatten' ) ) {
			$gallery_category_names_final = wpb_ea_array_flatten( $gallery_category_names_final );
			return array_unique( array_filter( $gallery_category_names_final ) );
		}
	}
}

/**
 * Gallery Item category classes
 */
function wpb_ea_gallery_item_category_classes( $gallery_classes, $id ) {

	if ( ! ( $gallery_classes ) ) {
		return false;
	}

	$gallery_cat_classes = array();
	$gallery_classes     = explode( ',', $gallery_classes );

	if ( is_array( $gallery_classes ) && ! empty( $gallery_classes ) ) {
		foreach ( $gallery_classes as $gallery_class ) {
			$gallery_cat_classes[] = sanitize_title( $gallery_class ) . '-' . $id;
		}
	}

	return implode( ' ', $gallery_cat_classes );
}

/**
 * Body Class
 */
add_filter( 'body_class', 'wpb_ea_body_class' );

function wpb_ea_body_class( $classes ) {
	if ( ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		$classes[] = 'wpb-elementor-addons';
	}
	return $classes;
}

/**
 * Add Custom Icons to the New Icons Control
 */

add_filter( 'elementor/icons_manager/additional_tabs', 'wpb_ea_add_custom_icons_tab' );

function wpb_ea_add_custom_icons_tab( $tabs = array() ) {
	$load_line_icons = apply_filters( 'wpb_ea_load_line_icons', 'on' );

	if ( $load_line_icons == 'on' ) {
		// Line Icons
		$lineicons = array(
			'add-file',
			'empty-file',
			'remove-file',
			'files',
			'display-alt',
			'laptop-phone',
			'laptop',
			'mobile',
			'tab',
			'timer',
			'headphone',
			'rocket',
			'package',
			'popup',
			'scroll-down',
			'pagination',
			'unlock',
			'lock',
			'reload',
			'map-marker',
			'map',
			'game',
			'search',
			'alarm',
			'code',
			'website',
			'code-alt',
			'display',
			'shortcode',
			'headphone-alt',
			'alarm-clock',
			'bookmark-alt',
			'bookmark',
			'layout',
			'keyboard',
			'grid-alt',
			'grid',
			'mic',
			'signal',
			'download',
			'upload',
			'zip',
			'rss-feed',
			'warning',
			'cloud-sync',
			'cloud-upload',
			'cloud-check',
			'cloud-download',
			'cog',
			'dashboard',
			'folder',
			'database',
			'harddrive',
			'control-panel',
			'plug',
			'menu',
			'power-switch',
			'printer',
			'save',
			'layers',
			'link',
			'share',
			'inbox',
			'unlink',
			'microphone',
			'magnet',
			'mouse',
			'share-alt',
			'bluetooth',
			'crop',
			'cut',
			'protection',
			'shield',
			'bolt-alt',
			'bolt',
			'infinite',
			'hand',
			'flag',
			'zoom-out',
			'zoom-in',
			'pin-alt',
			'pin',
			'more-alt',
			'more',
			'check-box',
			'check-mark-circle',
			'cross-circle',
			'circle-minus',
			'close',
			'star-filled',
			'star',
			'star-empty',
			'star-half',
			'question-circle',
			'thumbs-down',
			'thumbs-up',
			'minus',
			'plus',
			'ban',
			'hourglass',
			'trash',
			'key',
			'pulse',
			'heart',
			'heart-filled',
			'help',
			'paint-roller',
			'ux',
			'radio-button',
			'brush-alt',
			'select',
			'slice',
			'move',
			'wheelchair',
			'vector',
			'ruler-pencil',
			'ruler',
			'brush',
			'eraser',
			'ruler-alt',
			'color-pallet',
			'paint-bucket',
			'bulb',
			'highlight-alt',
			'highlight',
			'handshake',
			'briefcase',
			'funnel',
			'world',
			'calculator',
			'target-revenue',
			'revenue',
			'invention',
			'network',
			'credit-cards',
			'pie-chart',
			'archive',
			'magnifier',
			'agenda',
			'tag',
			'target',
			'stamp',
			'clipboard',
			'licencse',
			'paperclip',
			'stats-up',
			'stats-down',
			'bar-chart',
			'bullhorn',
			'calendar',
			'quotation',
			'bus',
			'car-alt',
			'car',
			'train',
			'train-alt',
			'helicopter',
			'ship',
			'bridge',
			'scooter',
			'plane',
			'bi-cycle',
			'postcard',
			'road',
			'envelope',
			'reply',
			'bubble',
			'support',
			'comment-reply',
			'pointer',
			'phone',
			'phone-handset',
			'comment-alt',
			'comment',
			'coffee-cup',
			'home',
			'gift',
			'thought',
			'eye',
			'user',
			'users',
			'wallet',
			'tshirt',
			'medall-alt',
			'medall',
			'notepad',
			'crown',
			'ticket',
			'ticket-alt',
			'certificate',
			'cup',
			'library',
			'school-bench-alt',
			'school-bench',
			'microscope',
			'school-compass',
			'information',
			'graduation',
			'write',
			'pencil-alt',
			'pencil',
			'blackboard',
			'book',
			'shuffle',
			'gallery',
			'image',
			'volume-mute',
			'backward',
			'forward',
			'stop',
			'play',
			'pause',
			'music',
			'frame-expand',
			'full-screen',
			'video',
			'volume-high',
			'volume-low',
			'volume-medium',
			'volume',
			'camera',
			'invest-monitor',
			'grow',
			'money-location',
			'cloudnetwork',
			'diamond',
			'customer',
			'domain',
			'target-audience',
			'seo',
			'keyword-research',
			'seo-monitoring',
			'seo-consulting',
			'money-protection',
			'offer',
			'delivery',
			'investment',
			'shopping-basket',
			'coin',
			'cart-full',
			'cart',
			'burger',
			'restaurant',
			'service',
			'chef-hat',
			'cake',
			'pizza',
			'teabag',
			'dinner',
			'taxi',
			'caravan',
			'pyramids',
			'surfboard',
			'travel',
			'island',
			'mashroom',
			'sprout',
			'tree',
			'trees',
			'flower',
			'bug',
			'leaf',
			'fresh-juice',
			'heart-monitor',
			'dumbbell',
			'skipping-rope',
			'slim',
			'weight',
			'basketball',
			'first-aid',
			'ambulance',
			'hospital',
			'syringe',
			'capsule',
			'stethoscope',
			'wheelbarrow',
			'shovel',
			'construction-hammer',
			'brick',
			'hammer',
			'helmet',
			'trowel',
			'construction',
			'apartment',
			'juice',
			'spray',
			'candy-cane',
			'candy',
			'fireworks',
			'flags',
			'baloon',
			'cloud',
			'night',
			'cloudy-sun',
			'rain',
			'thunder',
			'drop',
			'thunder-alt',
			'sun',
			'spell-check',
			'text-format',
			'text-format-remove',
			'italic',
			'line-dotted',
			'text-align-center',
			'text-align-left',
			'text-align-right',
			'text-align-justify',
			'bold',
			'page-break',
			'strikethrough',
			'text-size',
			'line-dashed',
			'line-double',
			'direction-ltr',
			'direction-rtl',
			'list',
			'line-spacing',
			'sort-alpha-asc',
			'sort-amount-asc',
			'indent-decrease',
			'indent-increase',
			'pilcrow',
			'underline',
			'dollar',
			'rupee',
			'pound',
			'yen',
			'euro',
			'emoji-happy',
			'emoji-tounge',
			'emoji-cool',
			'emoji-friendly',
			'emoji-neutral',
			'emoji-sad',
			'emoji-smile',
			'emoji-suspect',
			'direction-alt',
			'enter',
			'exit-down',
			'exit-up',
			'exit',
			'chevron-up',
			'chevron-left',
			'chevron-down',
			'chevron-right',
			'arrow-down',
			'arrows-horizontal',
			'arrows-vertical',
			'direction',
			'arrow-left',
			'arrow-right',
			'arrow-up',
			'arrow-down-circle',
			'anchor',
			'arrow-left-circle',
			'arrow-right-circle',
			'arrow-up-circle',
			'angle-double-down',
			'angle-double-left',
			'angle-double-right',
			'angle-double-up',
			'arrow-top-left',
			'arrow-top-right',
			'chevron-down-circle',
			'chevron-left-circle',
			'chevron-right-circle',
			'chevron-up-circle',
			'shift-left',
			'shift-right',
			'pointer-down',
			'pointer-right',
			'pointer-left',
			'pointer-up',
			'spinner-arrow',
			'spinner-solid',
			'spinner',
			'google',
			'producthunt',
			'paypal',
			'paypal-original',
			'java',
			'microsoft',
			'windows',
			'flickr',
			'drupal',
			'drupal-original',
			'android',
			'android-original',
			'playstore',
			'git',
			'github-original',
			'github',
			'steam',
			'shopify',
			'snapchat',
			'soundcloud',
			'souncloud-original',
			'telegram',
			'twitch',
			'vimeo',
			'vk',
			'wechat',
			'whatsapp',
			'yahoo',
			'youtube',
			'stackoverflow',
			'slideshare',
			'slack',
			'lineicons-alt',
			'lineicons',
			'skype',
			'pinterest',
			'reddit',
			'line',
			'megento',
			'blogger',
			'bootstrap',
			'dribbble',
			'dropbox',
			'dropbox-original',
			'envato',
			'500px',
			'twitter-original',
			'twitter',
			'twitter-filled',
			'facebook-messenger',
			'facebook-original',
			'facebook-filled',
			'facebook',
			'joomla',
			'firefox',
			'amazon-original',
			'amazon',
			'linkedin-original',
			'linkedin',
			'linkedin-filled',
			'bitbucket',
			'quora',
			'medium',
			'instagram-original',
			'instagram-filled',
			'instagram',
			'bitcoin',
			'stripe',
			'wordpress-filled',
			'wordpress',
			'google-plus',
			'mastercard',
			'visa',
			'amex',
			'apple',
			'behance',
			'behance-original',
			'chrome',
			'spotify-original',
			'spotify',
			'html',
			'css',
			'ycombinator',
		);

		$tabs['lineicons'] = array(
			'name'          => 'lineicons',
			'label'         => esc_html__( 'Line Icons', 'wpb-elementor-addons' ),
			'labelIcon'     => 'lni-user',
			'prefix'        => 'lni-',
			'displayPrefix' => 'lni',
			'url'           => WPB_EA_URL . 'assets/icons/lineicons/lineicons.min.css',
			'icons'         => $lineicons,
			'ver'           => '1.0.0',
		);

		return $tabs;
	}
}
