<?php

/**
 * businoz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package businoz
 */

if ( !function_exists( 'businoz_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function businoz_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on businoz, use a find and replace
         * to change 'businoz' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'businoz', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'businoz' ),
            'category-menu' => esc_html__( 'Category Menu', 'businoz' ),
            'header-search-menu' => esc_html__( 'Search Menu', 'businoz' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'businoz_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );


        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        remove_theme_support( 'widgets-block-editor' );

        add_image_size( 'businoz-case-details', 1170, 600, [ 'center', 'center' ] );
    }
endif;
add_action( 'after_setup_theme', 'businoz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function businoz_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'businoz_content_width', 640 );
}
add_action( 'after_setup_theme', 'businoz_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function businoz_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_style_3_switch', true );
    $footer_style_4_switch = get_theme_mod( 'footer_style_4_switch', true );
    $footer_style_5_switch = get_theme_mod( 'footer_style_5_switch', true );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'businoz' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="bd-sidebar__widget mb-45 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="bd-sidebar__title-2 mb-30"><h4>',
        'after_title'   => '</h4></div>',
    ] );


    register_sidebar(array(
        'name' => esc_html__('Product Sidebar', 'businoz'),
        'id' => 'product-sidebar',
        'before_widget' => '<div id="%1$s" class="businoz-pro-sidebar-widget mb-40 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="businoz-pro-widget-title mb-30">',
        'after_title' => '</h4>',
    ));


    /**
     * Service sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Service Sidebar', 'businoz' ),
        'id'            => 'service-sidebar',
        'before_widget' => '<div id="%1$s" class="bd-sidebar__title mb-50 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="bd-sidebar__title">',
        'after_title'   => '</h4>',
    ] );

    /**
     * portfolio sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Portfolio Sidebar', 'businoz' ),
        'id'            => 'portfolio-sidebar',
        'before_widget' => '<div id="%1$s" class="ts_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="port_widget_title">',
        'after_title'   => '</h3>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'businoz' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer %1$s', 'businoz' ), $num ),
            'before_widget' => '<div id="%1$s" class="bd-footer__widget footer-col-'.$num.' mb-50 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="bd-footer__widget-title"><h5>',
            'after_title'   => '</h5></div>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'businoz' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'businoz' ), $num ),
                'before_widget' => '<div id="%1$s" class="bd-footer__widget footer-col-2-'.$num.' mb-50 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="bd-footer__widget-title"><h5>',
                'after_title'   => '</h5></div>',
            ] );
        }
    }    

    // footer 3
    if ( $footer_style_3_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'businoz' ), $num ),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'businoz' ), $num ),
                'before_widget' => '<div id="%1$s" class="bd-footer__widget footer-col-3-'.$num.' mb-50 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="bd-footer__widget-title"><h5>',
                'after_title'   => '</h5></div>',
            ] );
        }
    }

    // footer 4
    if ( $footer_style_4_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 4 : %1$s', 'businoz' ), $num ),
                'id'            => 'footer-4-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 4 : %1$s', 'businoz' ), $num ),
                'before_widget' => '<div id="%1$s" class="bd-footer__widget footer-col-4-'.$num.' mb-50 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="bd-footer__widget-title"><h5>',
                'after_title'   => '</h5></div>',
            ] );
        }
    }

    // footer 5
    if ( $footer_style_5_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 5 : %1$s', 'businoz' ), $num ),
                'id'            => 'footer-5-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 5 : %1$s', 'businoz' ), $num ),
                'before_widget' => '<div id="%1$s" class="bd-footer__widget footer-col-5-'.$num.' mb-50 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="bd-footer__widget-title"><h5>',
                'after_title'   => '</h5></div>',
            ] );
        }
    }



}
add_action( 'widgets_init', 'businoz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

define( 'BUSINOZ_THEME_DIR', get_template_directory() );
define( 'BUSINOZ_THEME_URI', get_template_directory_uri() );
define( 'BUSINOZ_THEME_CSS_DIR', BUSINOZ_THEME_URI . '/assets/css/' );
define( 'BUSINOZ_THEME_JS_DIR', BUSINOZ_THEME_URI . '/assets/js/' );
define( 'BUSINOZ_THEME_INC', BUSINOZ_THEME_DIR . '/inc/' );

/**
 * businoz_scripts description
 * @return [type] [description]
 */
function businoz_scripts() {

    /**
     * all css files
     */

    wp_enqueue_style( 'businoz-fonts', businoz_fonts_url(), array(), '1.0.0' );

    wp_enqueue_style( 'bootstrap', BUSINOZ_THEME_CSS_DIR .'bootstrap.min.css', array() );
    wp_enqueue_style( 'animate', BUSINOZ_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'backtotop', BUSINOZ_THEME_CSS_DIR . 'backtotop.css', [] );
    wp_enqueue_style( 'flaticon', BUSINOZ_THEME_CSS_DIR . 'flaticon.css', [] );
    wp_enqueue_style( 'fontawesome-pro', BUSINOZ_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'magnific-popup', BUSINOZ_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'meanmenu', BUSINOZ_THEME_CSS_DIR . 'meanmenu.css', [] );
    wp_enqueue_style( 'nice-select', BUSINOZ_THEME_CSS_DIR . 'nice-select.css', [] );
    wp_enqueue_style( 'odometer-theme-default', BUSINOZ_THEME_CSS_DIR . 'odometer-theme-default.css', [] );
    wp_enqueue_style( 'swiper-bundle', BUSINOZ_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'owl-carousel', BUSINOZ_THEME_CSS_DIR . 'owl.carousel.min.css', [] );
    wp_enqueue_style( 'preloader', BUSINOZ_THEME_CSS_DIR . 'preloader.css', [] );
    wp_enqueue_style( 'progresscircle', BUSINOZ_THEME_CSS_DIR . 'progresscircle.css', [] );
    wp_enqueue_style( 'businoz-spacing', BUSINOZ_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'businoz-core', BUSINOZ_THEME_CSS_DIR . 'businoz-core.css', [], time() );
    wp_enqueue_style( 'businoz-unit', BUSINOZ_THEME_CSS_DIR . 'businoz-unit.css', [] );
    wp_enqueue_style( 'businoz-custom', BUSINOZ_THEME_CSS_DIR . 'businoz-custom.css', [], time() );
    wp_enqueue_style( 'businoz-style', get_stylesheet_uri() );

    // all js
    wp_enqueue_script( 'bootstrap-bundle', BUSINOZ_THEME_JS_DIR . 'bootstrap.bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'backtotop', BUSINOZ_THEME_JS_DIR . 'backtotop.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'appair', BUSINOZ_THEME_JS_DIR . 'appair.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'isotope-pkgd', BUSINOZ_THEME_JS_DIR . 'isotope.pkgd.min.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'waypoints', BUSINOZ_THEME_JS_DIR . 'waypoints.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'counterup', BUSINOZ_THEME_JS_DIR . 'counterup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'magnific-popup', BUSINOZ_THEME_JS_DIR . 'magnific-popup.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'knob', BUSINOZ_THEME_JS_DIR . 'knob.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'meanmenu', BUSINOZ_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'odometer', BUSINOZ_THEME_JS_DIR . 'odometer.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'nice-select', BUSINOZ_THEME_JS_DIR . 'nice-select.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'owl-carousel', BUSINOZ_THEME_JS_DIR . 'owl.carousel.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'swiper-bundle', BUSINOZ_THEME_JS_DIR . 'swiper-bundle.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'parallax', BUSINOZ_THEME_JS_DIR . 'parallax.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'progresscircle', BUSINOZ_THEME_JS_DIR . 'progresscircle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', BUSINOZ_THEME_JS_DIR . 'wow.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'businoz-main', BUSINOZ_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'businoz_scripts' );

/*
Register Fonts
 */
function businoz_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'businoz' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;500;600;700&display=swap';
    }
    return $font_url;
}

// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require BUSINOZ_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require BUSINOZ_THEME_INC . 'template-functions.php';


/**
 * Custom template helper function for this theme.
 */
require BUSINOZ_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
include_once BUSINOZ_THEME_INC . 'kirki-customizer.php';
include_once BUSINOZ_THEME_INC . 'class-businoz-kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require BUSINOZ_THEME_INC . 'jetpack.php';
}





/**
 * include businoz functions file
 */
require_once BUSINOZ_THEME_INC . 'class-navwalker.php';
require_once BUSINOZ_THEME_INC . 'class-tgm-plugin-activation.php';
require_once BUSINOZ_THEME_INC . 'add_plugin.php';

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function businoz_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'businoz_pingback_header' );

/**
 *
 * comment section
 *
 */
add_filter( 'comment_form_default_fields', 'businoz_comment_form_default_fields_func' );

function businoz_comment_form_default_fields_func( $default ) {

    $default['author'] = '<div class="row">
    <div class="col-xl-6 col-md-6">
    	<div class="bd-contact__input">
        	<input type="text" name="author" placeholder="' . esc_attr__( 'Your Name', 'businoz' ) . '">
        </div>
    </div>';
    $default['email'] = '<div class="col-xl-6 col-md-6">
		<div class="bd-contact__input">
        <input type="text" name="email" placeholder="' . esc_attr__( 'Your Email', 'businoz' ) . '">
    	</div>
    </div>';
    // $default['url'] = '';
    $defaults['comment_field'] = '';

    $default['url'] = '<div class="col-xl-12">
		<div class="bd-contact__input">
        <input type="text" name="url" placeholder="' . esc_attr__( 'Website', 'businoz' ) . '">
    	</div>
    </div>';
    return $default;
}

add_action( 'comment_form_top', 'businoz_add_comments_textarea' );
function businoz_add_comments_textarea() {
    if ( !is_user_logged_in() ) {
        echo '<div class="row"><div class="col-xl-12"><div class="bd-contact__input"><textarea id="comment" name="comment" cols="60" rows="6" placeholder="' . esc_attr__( 'Write your comment here...', 'businoz' ) . '" aria-required="true"></textarea></div></div></div>';
    }
}

add_filter( 'comment_form_defaults', 'businoz_comment_form_defaults_func' );

function businoz_comment_form_defaults_func( $info ) {
    if ( !is_user_logged_in() ) {
        $info['comment_field'] = '';
        $info['submit_field'] = '%1$s %2$s</div>';
    } else {
        $info['comment_field'] = '<div class="bd-contact__input"><textarea id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__( 'Comment *', 'businoz' ) . '"></textarea>';
        $info['submit_field'] = '%1$s %2$s</div>';
    }

    $info['submit_button'] = '<div class="col-xl-12"><button class="bd-gadient__btn" type="submit">' . esc_html__( 'Post Comment', 'businoz' ) . ' </button></div>';

    $info['title_reply_before'] = '<div class="post-comments-title">
                                        <h2>';
    $info['title_reply_after'] = '</h2></div>';
    $info['comment_notes_before'] = '';

    return $info;
}

if ( !function_exists( 'businoz_comment' ) ) {
    function businoz_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = 'Reply <i class="fal fa-reply"></i>';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
			<li id="comment-<?php comment_ID();?>">
				<div class="bd-postbox__comment-box">
					<div class="bd-postbox__comment-avater mr-30">
						<?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
					</div>
					<div class="bd-postbox__comment-info">
						<div class="bd-postbox__comment-avater-info d-flex justify-content-between">
                            <div class="bd-postbox__comment-name">
    							<h4><?php print get_comment_author_link();?></h4>
    							<span class="post-meta"><?php comment_time( get_option( 'date_format' ) );?></span>
                            </div>
                            <div class="bd-postbox__comment-reply">
						      <?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
                            </div>
						</div>
						<?php comment_text();?>
					</div>
				</div>
		<?php
}
}

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'businoz_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function businoz_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// businoz_search_filter_form
if ( !function_exists( 'businoz_search_filter_form' ) ) {
    function businoz_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="sidebar__widget-px"><div class="search-px"><form class="sidebar-search-form" action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="far fa-search"></i>  </button>
		</form></div></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'businoz' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'businoz_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'businoz_admin_custom_scripts' );

function businoz_admin_custom_scripts() {
    wp_enqueue_media();
    wp_enqueue_style( 'customizer-style', get_template_directory_uri() . '/inc/css/customizer-style.css',array());
    wp_register_script( 'businoz-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'businoz-admin-custom' );
}