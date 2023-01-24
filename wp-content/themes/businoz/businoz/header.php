<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package businoz
 */
?>

<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
    <?php endif;?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head();?>
</head>

<body <?php body_class();?>>

    <?php
        $businoz_preloader = get_theme_mod( 'businoz_preloader', false );
        $businoz_backtotop = get_theme_mod( 'businoz_backtotop', false );

    ?>

    <?php if ( !empty( $businoz_preloader ) ): ?>
    <!-- Preloader start -->
    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>
    <!-- Preloader end -->
    <?php endif;?>

    <?php if (!empty($businoz_backtotop)) {

    $enable = 'progress-wrap';
    } else {
        $enable = 'progress-wrap d-none';
    }
    ?>

    <div class="<?php echo esc_attr($enable); ?>">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Back to top end -->

    
    

    <?php wp_body_open();?>

    <!-- header start -->
    <?php do_action( 'businoz_header_style' );?>
    <!-- header end -->
    
    <!-- wrapper-box start -->
    <?php do_action( 'businoz_before_main_content' );?>