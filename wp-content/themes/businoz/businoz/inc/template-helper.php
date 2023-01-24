<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package businoz
 */

/** 
 *
 * businoz header
 */

function businoz_check_header()
{
    $businoz_header_style = function_exists('get_field') ? get_field('header_style') : NULL;
    $businoz_default_header_style = get_theme_mod('choose_default_header', 'header-style-1');


    if ($businoz_header_style == 'header-style-1') {
        businoz_header_style_1();
    } elseif ($businoz_header_style == 'header-style-2') {
        businoz_header_style_2();
    } elseif ($businoz_header_style == 'header-style-3') {
        businoz_header_style_3();
    } elseif ($businoz_header_style == 'header-style-4') {
        businoz_header_style_4();
    } elseif ($businoz_header_style == 'header-style-5') {
        businoz_header_style_5();
    } elseif ($businoz_header_style == 'header-style-6') {
        businoz_header_style_6();
    } else {

        /** default header style **/
        if ($businoz_default_header_style == 'header-style-2') {
            businoz_header_style_2();
        } elseif ($businoz_default_header_style == 'header-style-3') {
            businoz_header_style_3();
        } elseif ($businoz_default_header_style == 'header-style-4') {
            businoz_header_style_4();
        } elseif ($businoz_default_header_style == 'header-style-5') {
            businoz_header_style_5();
        } elseif ($businoz_default_header_style == 'header-style-6') {
            businoz_header_style_6();
        } else {
            businoz_header_style_1();
        }
    }
}
add_action('businoz_header_style', 'businoz_check_header', 10);


// Header deafult
function businoz_header_style_1()
{

    $businoz_button_text = get_theme_mod('businoz_button_text', __('Hire Me Now', 'businoz'));
    $businoz_button_link = get_theme_mod('businoz_button_link', __('#', 'businoz'));
    $businoz_header_right = get_theme_mod('businoz_header_right', false);
    $businoz_search = get_theme_mod('businoz_search', false);

    $businoz_menu_col = $businoz_header_right ? 'col-xxl-6 col-xl-7 d-none d-xl-block' : 'col-xxl-9 col-xl-10 d-none d-xl-block text-end';
    $businoz_mob_menu =  $businoz_header_right ? 'd-none' : '';

?>

    <header>
        <!-- Header-area-start -->
        <div id="header-sticky" class="header__area-5 header__area-default header-trasnsparent">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-2 col-lg-6 col-md-6 col-6">
                        <div class="header__logo">
                            <?php businoz_header_logo(); ?>
                        </div>
                    </div>
                    <div class="<?php print esc_attr($businoz_menu_col); ?>">
                        <div class="main-menu main-menu-5">
                            <nav id="mobile-menu">
                                <?php businoz_header_menu(); ?>
                            </nav>
                        </div>
                    </div>


                    <?php if (!empty($businoz_header_right)) : ?>
                        <div class="col-xxl-3 col-xl-3 col-lg-6 col-6">
                            <div class="bd-header__action">
                                <ul>
                                    <?php if (!empty($businoz_search)) : ?>
                                        <li>
                                            <div class="bd-header__search d-none d-sm-block">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" class="search" data-bs-target="#search-modal">
                                                    <i class="far fa-search"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php endif; ?>

                                    <li>
                                        <div class="bd-header__toogle-btn ml-5">
                                            <a href="javascript:void(0)" class="sidebar-toggle-btn">
                                                <div class="bd-heder__tagol-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px">
                                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M12.934,13.999 L8.915,13.999 C8.327,13.999 7.849,13.521 7.849,12.934 L7.849,8.914 C7.849,8.327 8.327,7.847 8.915,7.847 L12.934,7.847 C13.522,7.847 14.000,8.327 14.000,8.914 L14.000,12.934 C14.000,13.521 13.522,13.999 12.934,13.999 ZM12.934,6.150 L8.915,6.150 C8.327,6.150 7.849,5.673 7.849,5.084 L7.849,1.065 C7.849,0.477 8.327,-0.001 8.915,-0.001 L12.934,-0.001 C13.522,-0.001 14.000,0.477 14.000,1.065 L14.000,5.084 C14.000,5.673 13.522,6.150 12.934,6.150 ZM5.085,13.999 L1.066,13.999 C0.478,13.999 -0.000,13.521 -0.000,12.934 L-0.000,8.914 C-0.000,8.327 0.478,7.847 1.066,7.847 L5.085,7.847 C5.673,7.847 6.151,8.327 6.151,8.914 L6.151,12.934 C6.151,13.521 5.673,13.999 5.085,13.999 ZM5.085,6.150 L1.066,6.150 C0.478,6.150 -0.000,5.673 -0.000,5.084 L-0.000,1.065 C-0.000,0.477 0.478,-0.001 1.066,-0.001 L5.085,-0.001 C5.673,-0.001 6.151,0.477 6.151,1.065 L6.151,5.084 C6.151,5.673 5.673,6.150 5.085,6.150 Z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if (has_nav_menu('main-menu')) : ?>
                        <div class="<?php print esc_attr($businoz_mob_menu); ?> col-6 d-xl-none text-end">
                            <div class="bd-header__action">
                                <ul>
                                    <li>
                                        <div class="bd-header__toogle-btn ml-5">
                                            <a href="javascript:void(0)" class="sidebar-toggle-btn">
                                                <div class="bd-heder__tagol-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px">
                                                        <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M12.934,13.999 L8.915,13.999 C8.327,13.999 7.849,13.521 7.849,12.934 L7.849,8.914 C7.849,8.327 8.327,7.847 8.915,7.847 L12.934,7.847 C13.522,7.847 14.000,8.327 14.000,8.914 L14.000,12.934 C14.000,13.521 13.522,13.999 12.934,13.999 ZM12.934,6.150 L8.915,6.150 C8.327,6.150 7.849,5.673 7.849,5.084 L7.849,1.065 C7.849,0.477 8.327,-0.001 8.915,-0.001 L12.934,-0.001 C13.522,-0.001 14.000,0.477 14.000,1.065 L14.000,5.084 C14.000,5.673 13.522,6.150 12.934,6.150 ZM5.085,13.999 L1.066,13.999 C0.478,13.999 -0.000,13.521 -0.000,12.934 L-0.000,8.914 C-0.000,8.327 0.478,7.847 1.066,7.847 L5.085,7.847 C5.673,7.847 6.151,8.327 6.151,8.914 L6.151,12.934 C6.151,13.521 5.673,13.999 5.085,13.999 ZM5.085,6.150 L1.066,6.150 C0.478,6.150 -0.000,5.673 -0.000,5.084 L-0.000,1.065 C-0.000,0.477 0.478,-0.001 1.066,-0.001 L5.085,-0.001 C5.673,-0.001 6.151,0.477 6.151,1.065 L6.151,5.084 C6.151,5.673 5.673,6.150 5.085,6.150 Z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area-end -->


    <!-- sidebar area start -->
    <?php businoz_side_info(); ?>
    <!-- sidebar area end -->

<?php
}


/**
 * header style 2
 */
function businoz_header_style_2()
{

    $businoz_header_right = get_theme_mod('businoz_header_right', false);
    $businoz_search = get_theme_mod('businoz_search', false);
    $businoz_topbar_switch = get_theme_mod('businoz_topbar_switch', false);

    $businoz_email = get_theme_mod('businoz_email', __('info@webmail.com', 'businoz'));
    $businoz_phone = get_theme_mod('businoz_phone', __('(098) 90 9090 00', 'businoz'));
    $businoz_career_text = get_theme_mod('businoz_career_text', __(': Junior UI & UX Designer,  .', 'businoz'));
    $businoz_address_01 = get_theme_mod('businoz_address_01', __('22 Marion Street', 'businoz'));
    $businoz_address_02 = get_theme_mod('businoz_address_02', __('Columbia, SC 29201', 'businoz'));
    $businoz_open_hour = get_theme_mod('businoz_open_hour', __('Mon - Sat 8.00 - 18.00', 'businoz'));
    $businoz_close_day = get_theme_mod('businoz_close_day', __('Sunday Closed', 'businoz'));

    $businoz_button_text = get_theme_mod('businoz_button_text', __('Get Appointment', 'businoz'));
    $businoz_button_link = get_theme_mod('businoz_button_link', __('#', 'businoz'));

?>


    <header>
        <?php if (!empty($businoz_topbar_switch)) : ?>
            <!-- Topbar-area-srart -->
            <div class="bd-topbar__area theme-bg d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-7 col-md-6">
                            <div class="bd-topbar__info">
                                <div class="topbar__lang">
                                    <div class="nice-select">
                                        <span><?php 
                                        print esc_html__('Langue', 'businoz'); 
                                        ?></span>
                                        <?php //pll_the_languages(); Langue position initial ?>
                                    </div>
                                </div>
                                <div class="header__contact">
                                    <ul>
                                        <?php if (!empty($businoz_email)) : ?>
                                            <li>
                                                <a href="mailto:<?php print esc_attr($businoz_email) ?>"><i class="fal fa-envelope"></i>
                                                    <?php print esc_html($businoz_email); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if (!empty($businoz_phone)) : ?>
                                            <li>
                                                <a href="tel:<?php print esc_url($businoz_phone); ?>"><i class="fas fa-phone"></i>
                                                    <?php print esc_html($businoz_phone); ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($businoz_career_text)) : ?>
                            <div class="col-xl-6 col-lg-5 col-md-6">
                                <div class="topbar__right text-end">
                                    <div class="text">
                                        <h6><?php businoz_header_lang_defualt(); print esc_html__('', 'businoz'); ?> <span><i><?php print esc_html($businoz_career_text); ?></i></span> <?php print esc_html__(' ', 'businoz'); ?></h6>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Topbar-area-end -->
        <?php endif; ?>

        <!-- Header-widget-area-start -->
        <div class="bd-header__widgets__area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-6 ">
                        <div class="logo">
                            <?php businoz_header_logo(); ?>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10 col-6">
                        <div class="bd-header__widgets">
                            <div class="bd-widget__features">
                                <div class="widget__feature-img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/widget-1.png" alt="widet-icon">
                                </div>
                                <div class="widget-text">
                                    <span><?php print esc_html($businoz_address_01); ?></span>
                                    <h6><?php print esc_html($businoz_address_02); ?></h6>
                                </div>
                            </div>
                            <div class="bd-widget__features">
                                <div class="widget__feature-img">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/widget-2.png" alt="widet-icon">
                                </div>
                                <div class="widget-text">
                                    <span><?php print esc_html($businoz_open_hour); ?></span>
                                    <h6><?php print esc_html($businoz_close_day); ?></h6>
                                </div>
                            </div>
                            <div class="bd-header__toggle-btn ml-70">
                                <a class="sidebar-toggle-btn" href="javascript:void(0)">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/header-icon.png" alt="header-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header-widget-area-start -->

        <!-- Header-area-start -->
        <div id="header-sticky" class="header-area bd-trsnsparent__header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 col-6">
                        <div class="sticky-logo d-none">
                            <?php businoz_header_sticky_logo(); ?>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-8 d-none d-xl-block">
                        <div class="bd-navaigation text-center">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <?php businoz_header_menu(); ?>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-8 col-md-6 col-sm-6 col-6">
                        <div class="header-right d-flex justify-content-end">
                            <?php if (!empty($businoz_button_text)) : ?>
                                <div class="header__btn d-none d-xl-block">
                                    <a class="bd-theme__btn-1" href="<?php print esc_url($businoz_button_link); ?>">
                                        <?php print esc_html($businoz_button_text); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="bd-header__toggle-btn d-xl-none">
                                <a class="sidebar-toggle-btn" href="javascript:void(0)">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/header-icon.png" alt="header-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header-area-end -->
    </header>

    <!-- Header Side Info -->
    <?php businoz_side_info(); ?>
    <!--End Header Side Info -->


<?php
}

/**
 * header style 3
 */
function businoz_header_style_3()
{

    $businoz_button_text = get_theme_mod('businoz_button_text', __('Get Appointment', 'businoz'));
    $businoz_button_link = get_theme_mod('businoz_button_link', __('#', 'businoz'));

?>


    <header>
        <!-- Header-area-start -->
        <div id="header-sticky" class="header-area-3 header-trasnsparent">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-4">
                        <div class="header__logo">
                            <?php businoz_header_logo(); ?>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-4 col-4">
                        <div class="main-menu main-menu-3">
                            <nav id="mobile-menu">
                                <?php businoz_header_menu(); ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-2 col-md-4 col-4">
                        <div class="header-right">
                            <div class="bd-heder-toggle d-flex justify-content-end d-xl-none">
                                <div class="menu-bar">
                                    <a class="sidebar-toggle-btn" href="javascript:void(0)">
                                        <div class="bar-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <?php if (!empty($businoz_button_text)) : ?>
                                <div class="bd-header__action d-none d-xl-block">
                                    <a class="bd-theme-3-btn-1" href="<?php print esc_url($businoz_button_link); ?>">
                                        <?php print esc_html($businoz_button_text); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area-end -->


    <!-- Header Side Info -->
    <?php businoz_side_info(); ?>
    <!--End Header Side Info -->


<?php
}

/**
 * header style 4
 */
function businoz_header_style_4()
{

    $businoz_email = get_theme_mod('businoz_email', __('info@webmail.com', 'businoz'));
    $businoz_phone = get_theme_mod('businoz_phone', __('(098) 90 9090 00', 'businoz'));

?>

    <!-- Header-area-start -->
    <header>
        <!-- Header-area-start -->
        <div class="header-main__wrapper header-trasnsparent">
            <!-- Topbar-area-srart -->
            <div class="bd-topbar__area blue-bg d-none d-md-block">
                <div class="container">
                    <div class="bd-topbar-style-2">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-4">
                                <div class="header__top-social">
                                    <?php businoz_header_social_profiles(); ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-8">
                                <div class="bd-topbar__info justify-content-end">
                                    <div class="header__contact">
                                        <ul>
                                            <?php if (!empty($businoz_email)) : ?>
                                                <li>
                                                    <a href="mailto:<?php print esc_attr($businoz_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($businoz_email); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                            <?php if (!empty($businoz_phone)) : ?>
                                                <li>
                                                    <a href="tel:<?php print esc_url($businoz_phone); ?>"><i class="fas fa-phone"></i>
                                                        <?php print esc_html($businoz_phone); ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Topbar-area-end -->
            <div id="header-sticky" class="header-area-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-2 col-lg-3 col-md-4 col-4">
                            <div class="header__logo">
                                <?php businoz_header_logo(); ?>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-4 col-4">
                            <div class="main-menu main-menu-4">
                                <nav id="mobile-menu">
                                    <?php businoz_header_menu(); ?>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-2 col-md-4 col-4">
                            <div class="bd-heder-toggle d-flex justify-content-end">
                                <div class="menu-bar">
                                    <a class="sidebar-toggle-btn" href="javascript:void(0)">
                                        <div class="bar-icon">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area-end -->

    <!-- side info start -->
    <?php businoz_side_info(); ?>
    <!-- side info end -->



<?php
}

/**
 * header style 5
 */
function businoz_header_style_5()
{

    $businoz_button_text = get_theme_mod('businoz_button_text', __('Hire Me Now', 'businoz'));
    $businoz_button_link = get_theme_mod('businoz_button_link', __('#', 'businoz'));

?>

    <header>
        <!-- Header-area-start -->
        <div id="header-sticky" class="header__area-5 header-trasnsparent">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-4">
                        <div class="header__logo">
                            <?php businoz_header_logo(); ?>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-4 col-4">
                        <div class="main-menu main-menu-5">
                            <nav id="mobile-menu">
                                <?php businoz_header_menu(); ?>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-4">
                        <div class="bd-heder-toggle d-flex justify-content-end d-lg-none">
                            <div class="menu-bar">
                                <a class="sidebar-toggle-btn" href="javascript:void(0)">
                                    <div class="bar-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <?php if (!empty($businoz_button_text)) : ?>
                            <div class="bd-header-btn text-end d-none d-lg-block">
                                <a class="bd-theme-5-btn-1" href="<?php print esc_url($businoz_button_link); ?>">
                                    <?php print esc_html($businoz_button_text); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area-end -->


    <!-- sidebar area start -->
    <?php businoz_side_info(); ?>
    <!-- sidebar area end -->

<?php
}

function businoz_header_style_6()
{
    $businoz_header_right = get_theme_mod('businoz_header_right', false);
    $businoz_search = get_theme_mod('businoz_search', false);
    $businoz_topbar_switch = get_theme_mod('businoz_topbar_switch', false);

    $businoz_email = get_theme_mod('businoz_email', __('info@webmail.com', 'businoz'));
    $businoz_phone = get_theme_mod('businoz_phone', __('(098) 90 9090 00', 'businoz'));

    $businoz_menu_col = $businoz_header_right ? 'col-xxl-7 col-xl-7  d-none d-xl-block' : 'col-xxl-9 col-xl-9 text-end';
    $businoz_mob_menu =  $businoz_header_right ? 'd-none' : '';

?>


    <!-- Header-area-end -->
    <header>
        <div class="header-area-common header-trasnsparent">
            <?php if (!empty($businoz_topbar_switch)) : ?>
                <!-- Topbar-area-srart -->
                <div class="hader-topbar__area d-none d-lg-block">
                    <div class="container">
                        <div class="bd-topbar__area secound">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-lg-7">
                                    <div class="bd-topbar__info">
                                        <div class="topbar__lang">
                                            <div class="nice-select">
                                                <span><?php print esc_html__('English', 'businoz'); ?></span>
                                                <?php businoz_header_lang_defualt(); ?>
                                            </div>
                                        </div>
                                        <div class="header__contact">
                                            <ul>
                                                <?php if (!empty($businoz_email)) : ?>
                                                    <li><a href="mailto:<?php print esc_attr($businoz_email) ?>"><i class="fal fa-envelope"></i><?php print esc_html($businoz_email); ?></a></li>
                                                <?php endif; ?>

                                                <?php if (!empty($businoz_phone)) : ?>
                                                    <li>
                                                        <a href="tel:<?php print esc_url($businoz_phone); ?>"><i class="fas fa-phone"></i>
                                                            <?php print esc_html($businoz_phone); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Topbar-area-end -->
            <?php endif; ?>

            <div id="header-sticky" class="bd-header__area">
                <div class="container">
                    <div class="bd-navigation-2">
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-6">
                                <div class="header__logo">
                                    <?php businoz_header_logo(); ?>
                                </div>
                            </div>
                            <div class="<?php print esc_attr($businoz_menu_col); ?>">
                                <div class="main-menu main-menu-2">
                                    <nav id="mobile-menu">
                                        <?php businoz_header_menu(); ?>
                                    </nav>
                                </div>
                            </div>

                            <?php if (!empty($businoz_header_right)) : ?>
                                <div class="col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-6">
                                    <div class="bd-header__action">
                                        <ul>
                                            <?php if (!empty($businoz_search)) : ?>
                                                <li>
                                                    <div class="bd-header__search d-none d-sm-block">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="search" data-bs-target="#search-modal">
                                                            <i class="far fa-search"></i>
                                                        </a>
                                                    </div>
                                                </li>
                                            <?php endif; ?>

                                            <li>
                                                <div class="bd-header__toogle-btn ml-5">
                                                    <a href="javascript:void(0)" class="sidebar-toggle-btn">
                                                        <div class="bd-heder__tagol-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px">
                                                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M12.934,13.999 L8.915,13.999 C8.327,13.999 7.849,13.521 7.849,12.934 L7.849,8.914 C7.849,8.327 8.327,7.847 8.915,7.847 L12.934,7.847 C13.522,7.847 14.000,8.327 14.000,8.914 L14.000,12.934 C14.000,13.521 13.522,13.999 12.934,13.999 ZM12.934,6.150 L8.915,6.150 C8.327,6.150 7.849,5.673 7.849,5.084 L7.849,1.065 C7.849,0.477 8.327,-0.001 8.915,-0.001 L12.934,-0.001 C13.522,-0.001 14.000,0.477 14.000,1.065 L14.000,5.084 C14.000,5.673 13.522,6.150 12.934,6.150 ZM5.085,13.999 L1.066,13.999 C0.478,13.999 -0.000,13.521 -0.000,12.934 L-0.000,8.914 C-0.000,8.327 0.478,7.847 1.066,7.847 L5.085,7.847 C5.673,7.847 6.151,8.327 6.151,8.914 L6.151,12.934 C6.151,13.521 5.673,13.999 5.085,13.999 ZM5.085,6.150 L1.066,6.150 C0.478,6.150 -0.000,5.673 -0.000,5.084 L-0.000,1.065 C-0.000,0.477 0.478,-0.001 1.066,-0.001 L5.085,-0.001 C5.673,-0.001 6.151,0.477 6.151,1.065 L6.151,5.084 C6.151,5.673 5.673,6.150 5.085,6.150 Z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <?php if (has_nav_menu('main-menu')) : ?>
                                <div class="<?php print esc_attr($businoz_mob_menu); ?> col-6 d-xl-none text-end">
                                    <div class="bd-header__action">
                                        <ul>
                                            <li>
                                                <div class="bd-header__toogle-btn ml-5">
                                                    <a href="javascript:void(0)" class="sidebar-toggle-btn">
                                                        <div class="bd-heder__tagol-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px">
                                                                <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M12.934,13.999 L8.915,13.999 C8.327,13.999 7.849,13.521 7.849,12.934 L7.849,8.914 C7.849,8.327 8.327,7.847 8.915,7.847 L12.934,7.847 C13.522,7.847 14.000,8.327 14.000,8.914 L14.000,12.934 C14.000,13.521 13.522,13.999 12.934,13.999 ZM12.934,6.150 L8.915,6.150 C8.327,6.150 7.849,5.673 7.849,5.084 L7.849,1.065 C7.849,0.477 8.327,-0.001 8.915,-0.001 L12.934,-0.001 C13.522,-0.001 14.000,0.477 14.000,1.065 L14.000,5.084 C14.000,5.673 13.522,6.150 12.934,6.150 ZM5.085,13.999 L1.066,13.999 C0.478,13.999 -0.000,13.521 -0.000,12.934 L-0.000,8.914 C-0.000,8.327 0.478,7.847 1.066,7.847 L5.085,7.847 C5.673,7.847 6.151,8.327 6.151,8.914 L6.151,12.934 C6.151,13.521 5.673,13.999 5.085,13.999 ZM5.085,6.150 L1.066,6.150 C0.478,6.150 -0.000,5.673 -0.000,5.084 L-0.000,1.065 C-0.000,0.477 0.478,-0.001 1.066,-0.001 L5.085,-0.001 C5.673,-0.001 6.151,0.477 6.151,1.065 L6.151,5.084 C6.151,5.673 5.673,6.150 5.085,6.150 Z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header-area-end -->

    <!-- Header Side Info -->
    <?php businoz_side_info(); ?>
    <!--End Header Side Info -->

<?php
}




// businoz_mobile_info
function businoz_mobile_info()
{

    $businoz_contact_info_hide = get_theme_mod('businoz_contact_info_hide', false);

    $businoz_contact_title = get_theme_mod('businoz_contact_title', __('Contact Title', 'businoz'));
    $businoz_extra_address = get_theme_mod('businoz_extra_address', __('28/4 Palmal, London', 'businoz'));
    $businoz_extra_phone = get_theme_mod('businoz_extra_phone', __('333 888 200 - 55', 'businoz'));
    $businoz_extra_email = get_theme_mod('businoz_extra_email', __('info@businoz.com', 'businoz'));

?>

    <!-- mobile menu info -->
    <div class="fix">
        <div class="side-info">
            <button class="side-info-close"><i class="fal fa-times"></i></button>
            <div class="side-info-content">
                <div class="bd-mobile-menu"></div>
                <div class="contact-infos mb-30">
                    <?php if (!empty($businoz_contact_info_hide)) : ?>
                        <div class="contact-list mb-30">
                            <?php if (!empty($businoz_contact_title)) : ?>
                                <h4><?php print esc_html($businoz_contact_title); ?></h4>
                            <?php endif; ?>
                            <ul>
                                <?php if (!empty($businoz_extra_address)) : ?>
                                    <li><i class="flaticon-location-1"></i><?php print esc_html($businoz_extra_address); ?></li>
                                <?php endif; ?>

                                <?php if (!empty($businoz_extra_email)) : ?>
                                    <li><i class="flaticon-email"></i><a href="mailto:<?php print esc_url($businoz_extra_email) ?>"><?php print esc_html($businoz_extra_email); ?></a></li>
                                <?php endif; ?>

                                <?php if (!empty($businoz_extra_phone)) : ?>
                                    <li><i class="flaticon-phone-call"></i><a href="tel:<?php print esc_url($businoz_extra_phone) ?>"><?php print esc_html($businoz_extra_phone); ?></a></li>
                                <?php endif; ?>
                            </ul>


                            <div class="sidebar__menu--social">
                                <?php businoz_header_social_profiles(); ?>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-overlay"></div>
    <!-- mobile menu info -->

<?php }


// businoz_side_info
function businoz_side_info()
{

    $businoz_side_logo_hide = get_theme_mod('businoz_side_logo_hide', false);
    $businoz_side_search = get_theme_mod('businoz_side_search', false);
    $businoz_side_dec_hide = get_theme_mod('businoz_side_dec_hide', false);
    $businoz_side_map_hide = get_theme_mod('businoz_side_map_hide', false);
    $businoz_contact_info_hide = get_theme_mod('businoz_contact_info_hide', false);
    $businoz_side_social_hide = get_theme_mod('businoz_side_social_hide', false);

    $businoz_side_dec = get_theme_mod('businoz_side_dec', __('But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and will give you a complete account of the system and expound the actual teachings of the great explore', 'businoz'));

    $businoz_side_map_url = get_theme_mod('businoz_side_map_url', __('https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29176.030811137334!2d90.3883827!3d23.924917699999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1605272373598!5m2!1sen!2sbd', 'businoz'));

    $businoz_contact_title = get_theme_mod('businoz_contact_title', __('Contact Info', 'businoz'));
    $businoz_extra_address = get_theme_mod('businoz_extra_address', __('12/A, Mirnada City Tower, NYC', 'businoz'));
    $businoz_extra_phone = get_theme_mod('businoz_extra_phone', __('+8801 094 0637', 'businoz'));
    $businoz_extra_email = get_theme_mod('businoz_extra_email', __('evenex@gmail.com', 'businoz'));

?>



    <!-- Sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="sidebar__content">
                <?php if (!empty($businoz_side_logo_hide)) : ?>
                    <div class="sidebar__logo mb-40">
                        <?php print businoz_sidebar_logo('side_logo', esc_html__('Side Logo', 'businoz')); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($businoz_side_search)) : ?>
                    <div class="sidebar__search mb-25">
                        <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                            <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('What are you searching for?', 'businoz'); ?>">
                            <button type="submit"><i class="far fa-search"></i></button>
                        </form>
                    </div>
                <?php endif; ?>

                <div class="mobile-menu mt-50 fix mb-10"></div>

                <?php if (!empty($businoz_side_dec_hide)) : ?>
                    <div class="sidebar__text d-none d-lg-block">
                        <?php if (!empty($businoz_side_dec)) : ?>
                            <p><?php print esc_html($businoz_side_dec); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($businoz_side_map_hide)) : ?>
                    <div class="sidebar__map d-none d-lg-block mb-15">
                        <iframe src="<?php print esc_attr($businoz_side_map_url); ?>"></iframe>
                    </div>
                <?php endif; ?>


                <?php if (!empty($businoz_contact_info_hide)) : ?>
                    <div class="sidebar__contact mt-30 mb-30">
                        <?php if (!empty($businoz_contact_title)) : ?>
                            <h4><?php print esc_html($businoz_contact_title); ?></h4>
                        <?php endif; ?>

                        <ul>
                            <?php if (!empty($businoz_extra_address)) : ?>
                                <li class="d-flex align-items-center">
                                    <div class="sidebar__contact-icon mr-15">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="sidebar__contact-text">
                                        <a target="_blank" href="<?php print esc_attr($businoz_side_map_url); ?>"><?php print esc_html($businoz_extra_address); ?>
                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($businoz_extra_phone)) : ?>
                                <li class="d-flex align-items-center">
                                    <div class="sidebar__contact-icon mr-15">
                                        <i class="far fa-phone"></i>
                                    </div>
                                    <div class="sidebar__contact-text">
                                        <a href="tel:<?php print esc_url($businoz_extra_phone) ?>"><?php print esc_html($businoz_extra_phone); ?>
                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($businoz_extra_email)) : ?>
                                <li class="d-flex align-items-center">
                                    <div class="sidebar__contact-icon mr-15">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="sidebar__contact-text">
                                        <a href="mailto:<?php print esc_url($businoz_extra_email) ?>"><?php print esc_html($businoz_extra_email); ?>
                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($businoz_side_social_hide)) : ?>
                    <div class="sidebar__social">
                        <?php businoz_side_social_profiles(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- Sidebar area end -->


    <?php }



function businoz_sidebar_logo()
{
    $logo = get_theme_mod('side_logo', get_template_directory_uri() . '/assets/img/logo/logo-3.png');
    return '<a href="/"><img src="' . esc_url($logo) . '" alt="' . esc_attr__('img', 'businoz') . '"></a>';
}




/**
 * [businoz_header_lang description]
 * @return [type] [description]
 */
function businoz_header_lang_defualt()
{
    $businoz_header_lang = get_theme_mod('businoz_header_lang', false);
    if ($businoz_header_lang) : ?>

        <ul class="list">
            <?php pll_the_languages();?>
            <li data-value="EN" class="option selected focus"><?php //print esc_html__('EN', 'businoz'); ?>
                <?php do_action('businoz_language'); ?>
            </li>
        </ul>


    <?php endif; ?>
<?php
}

/**
 * [businoz_language_list description]
 * @return [type] [description]
 */
function _businoz_language($mar)
{
    return $mar;
}
function businoz_language_list()
{

    $mar = '';
    $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');
    if (!empty($languages)) {
        $mar = '<ul>';
        foreach ($languages as $lan) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<li class="option selected"><a href="#">' . esc_html__('USA', 'businoz') . '</a></li>';
        $mar .= '<li class="option selected"><a href="#">' . esc_html__('UK', 'businoz') . '</a>';
    }
    print _businoz_language($mar);
}
add_action('businoz_language', 'businoz_language_list');

// favicon logo
function businoz_favicon_logo_func()
{
    $businoz_favicon = get_template_directory_uri() . '/assets/img/favicon.png';
    $businoz_favicon_url = get_theme_mod('favicon_url', $businoz_favicon);
?>

    <link rel="shortcut icon" type="image/x-icon" href="<?php print esc_url($businoz_favicon_url); ?>">

<?php
}
add_action('wp_head', 'businoz_favicon_logo_func');

// header logo
function businoz_header_logo()
{
?>
    <?php
    $businoz_logo_on = function_exists('get_field') ? get_field('is_enable_sec_logo') : NULL;
    $businoz_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
    $businoz_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-white.png';

    $businoz_site_logo = get_theme_mod('logo', $businoz_logo);
    $businoz_secondary_logo = get_theme_mod('seconday_logo', $businoz_logo_white);

    $header_page_logo = function_exists('get_field') ? get_field('header_page_logo') : NULL;
    $businoz_site_logo = $header_page_logo ? $header_page_logo['url'] : $businoz_site_logo;
    ?>

    <?php
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        if (!empty($businoz_logo_on)) {
    ?>
            <a class="standard-logo" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($businoz_secondary_logo); ?>" alt="<?php print esc_attr__('logo', 'businoz'); ?>" />
            </a>
        <?php
        } else {
        ?>
            <a class="standard-logo" href="<?php print esc_url(home_url('/')); ?>">
                <img src="<?php print esc_url($businoz_site_logo); ?>" alt="<?php print esc_attr__('logo', 'businoz'); ?>" />
            </a>
    <?php
        }
    }
    ?>
<?php
}


// header logo
function businoz_header_sticky_logo()
{ ?>
    <?php
    $businoz_logo_white = get_template_directory_uri() . '/assets/img/logo/logo-3.png';
    $businoz_secondary_logo = get_theme_mod('seconday_logo', $businoz_logo_white);
    ?>
    <a href="<?php print esc_url(home_url('/')); ?>">
        <img src="<?php print esc_url($businoz_secondary_logo); ?>" alt="<?php print get_bloginfo('name'); ?>" />
    </a>
<?php
}



// header logo
function businoz_footer_logo()
{ ?>
    <?php
    $businoz_footer_logo = get_template_directory_uri() . '/assets/img/logo/logo-10.png';
    $businoz_footer_logo2 = get_theme_mod('businoz_footer_logo', $businoz_footer_logo);

    $footer_page_logo = function_exists('get_field') ? get_field('footer_page_logo') : NULL;
    $businoz_footer_logo2 = $footer_page_logo ? $footer_page_logo['url'] : $businoz_footer_logo2;
    ?>
    <a href="<?php print esc_url(home_url('/')); ?>">
        <img src="<?php print esc_url($businoz_footer_logo2); ?>" alt="<?php print esc_attr__('footer logo', 'businoz'); ?>">
    </a>
<?php
}


/**
 * [businoz_header_social_profiles description]
 * @return [type] [description]
 */
function businoz_header_social_profiles()
{
    $businoz_topbar_fb_url = get_theme_mod('businoz_topbar_fb_url', __('#', 'businoz'));
    $businoz_topbar_twitter_url = get_theme_mod('businoz_topbar_twitter_url', __('#', 'businoz'));
    $businoz_topbar_instagram_url = get_theme_mod('businoz_topbar_instagram_url', __('#', 'businoz'));
    $businoz_topbar_vimeo_url = get_theme_mod('businoz_topbar_vimeo_url', __('#', 'businoz'));
    $businoz_topbar_linkedin_url = get_theme_mod('businoz_topbar_linkedin_url', __('#', 'businoz'));
    $businoz_topbar_youtube_url = get_theme_mod('businoz_topbar_youtube_url', __('#', 'businoz'));
?>


    <?php if (!empty($businoz_topbar_fb_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_fb_url); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
    <?php endif; ?>

    <?php if (!empty($businoz_topbar_twitter_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_twitter_url); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
    <?php endif; ?>

    <?php if (!empty($businoz_topbar_instagram_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_instagram_url); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
    <?php endif; ?>

    <?php if (!empty($businoz_topbar_vimeo_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_vimeo_url); ?>" target="_blank"><i class="fab fa-vimeo-v"></i></a>
    <?php endif; ?>

    <?php if (!empty($businoz_topbar_linkedin_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_linkedin_url); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    <?php endif; ?>

    <?php if (!empty($businoz_topbar_youtube_url)) : ?>
        <a href="<?php print esc_url($businoz_topbar_youtube_url); ?>" target="_blank"><i class="fab fa-youtube"></i></a>
    <?php endif; ?>

<?php
}


function businoz_side_social_profiles()
{
    $businoz_sidebar_fb_url = get_theme_mod('businoz_sidebar_fb_url', __('#', 'businoz'));
    $businoz_sidebar_twitter_url = get_theme_mod('businoz_sidebar_twitter_url', __('#', 'businoz'));
    $businoz_sidebar_instagram_url = get_theme_mod('businoz_sidebar_instagram_url', __('#', 'businoz'));
    $businoz_sidebar_linkedin_url = get_theme_mod('businoz_sidebar_linkedin_url', __('#', 'businoz'));
    $businoz_sidebar_youtube_url = get_theme_mod('businoz_sidebar_youtube_url', __('#', 'businoz'));
?>

    <ul>
        <?php if (!empty($businoz_sidebar_fb_url)) : ?>
            <li>
                <a href="<?php print esc_url($businoz_sidebar_fb_url); ?>">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($businoz_sidebar_twitter_url)) : ?>
            <li>
                <a href="<?php print esc_url($businoz_sidebar_twitter_url); ?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($businoz_sidebar_instagram_url)) : ?>
            <li>
                <a href="<?php print esc_url($businoz_sidebar_instagram_url); ?>">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($businoz_sidebar_linkedin_url)) : ?>
            <li>
                <a href="<?php print esc_url($businoz_sidebar_linkedin_url); ?>">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (!empty($businoz_sidebar_youtube_url)) : ?>
            <li>
                <a href="<?php print esc_url($businoz_sidebar_youtube_url); ?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
<?php
}


function businoz_footer_social_profiles()
{
    $businoz_footer_fb_url = get_theme_mod('businoz_footer_fb_url', __('#', 'businoz'));
    $businoz_footer_twitter_url = get_theme_mod('businoz_footer_twitter_url', __('#', 'businoz'));
    $businoz_footer_instagram_url = get_theme_mod('businoz_footer_instagram_url', __('#', 'businoz'));
    $businoz_footer_linkedin_url = get_theme_mod('businoz_footer_linkedin_url', __('#', 'businoz'));
    $businoz_footer_youtube_url = get_theme_mod('businoz_footer_youtube_url', __('#', 'businoz'));
?>


    <?php if (!empty($businoz_footer_fb_url)) : ?>
        <a href="<?php print esc_url($businoz_footer_fb_url); ?>">
            <i class="fab fa-facebook-f"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($businoz_footer_twitter_url)) : ?>
        <a href="<?php print esc_url($businoz_footer_twitter_url); ?>">
            <i class="fab fa-twitter"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($businoz_footer_instagram_url)) : ?>
        <a href="<?php print esc_url($businoz_footer_instagram_url); ?>">
            <i class="fab fa-instagram"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($businoz_footer_linkedin_url)) : ?>
        <a href="<?php print esc_url($businoz_footer_linkedin_url); ?>">
            <i class="fab fa-linkedin"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($businoz_footer_youtube_url)) : ?>
        <a href="<?php print esc_url($businoz_footer_youtube_url); ?>">
            <i class="fab fa-youtube"></i>
        </a>
    <?php endif; ?>
<?php
}


/**
 * [businoz_header_menu description]
 * @return [type] [description]
 */
function businoz_header_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Businoz_Navwalker_Class::fallback',
        'walker'         => new Businoz_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [businoz_header_menu description]
 * @return [type] [description]
 */
function businoz_mobile_menu()
{
?>
    <?php
    $businoz_menu = wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class'     => '',
        'container'      => '',
        'menu_id'        => 'mobile-menu-active',
        'echo'           => false,
    ]);

    $businoz_menu = str_replace("menu-item-has-children", "menu-item-has-children has-children", $businoz_menu);
    echo wp_kses_post($businoz_menu);
    ?>
<?php
}

/**
 * [businoz_search_menu description]
 * @return [type] [description]
 */
function businoz_header_search_menu()
{
?>
    <?php
    wp_nav_menu([
        'theme_location' => 'header-search-menu',
        'menu_class'     => '',
        'container'      => '',
        'fallback_cb'    => 'Businoz_Navwalker_Class::fallback',
        'walker'         => new Businoz_Navwalker_Class,
    ]);
    ?>
<?php
}

/**
 * [businoz_footer_menu description]
 * @return [type] [description]
 */
function businoz_footer_menu()
{
    wp_nav_menu([
        'theme_location' => 'footer-menu',
        'menu_class'     => 'm-0',
        'container'      => '',
        'fallback_cb'    => 'Businoz_Navwalker_Class::fallback',
        'walker'         => new Businoz_Navwalker_Class,
    ]);
}


/**
 * [businoz_category_menu description]
 * @return [type] [description]
 */
function businoz_category_menu()
{
    wp_nav_menu([
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Businoz_Navwalker_Class::fallback',
        'walker'         => new Businoz_Navwalker_Class,
    ]);
}

/**
 *
 * businoz footer
 */
add_action('businoz_footer_style', 'businoz_check_footer', 10);

function businoz_check_footer()
{
    $businoz_footer_style = function_exists('get_field') ? get_field('footer_style') : NULL;
    $businoz_default_footer_style = get_theme_mod('choose_default_footer', 'footer-style-1');

    if ($businoz_footer_style == 'footer-style-1') {
        businoz_footer_style_1();
    } elseif ($businoz_footer_style == 'footer-style-2') {
        businoz_footer_style_2();
    } elseif ($businoz_footer_style == 'footer-style-3') {
        businoz_footer_style_3();
    } elseif ($businoz_footer_style == 'footer-style-4') {
        businoz_footer_style_4();
    } elseif ($businoz_footer_style == 'footer-style-5') {
        businoz_footer_style_5();
    } else {

        /** default footer style **/
        if ($businoz_default_footer_style == 'footer-style-2') {
            businoz_footer_style_2();
        } elseif ($businoz_default_footer_style == 'footer-style-3') {
            businoz_footer_style_3();
        } elseif ($businoz_default_footer_style == 'footer-style-4') {
            businoz_footer_style_4();
        } elseif ($businoz_default_footer_style == 'footer-style-5') {
            businoz_footer_style_5();
        } else {
            businoz_footer_style_1();
        }
    }
}

/**
 * footer  style_defaut
 */
function businoz_footer_style_1()
{

    $businoz_social_switch = get_theme_mod('businoz_social_switch', false);
    $footer_bg_img = get_theme_mod('businoz_footer_bg');
    $businoz_footer_logo = get_theme_mod('businoz_footer_logo');


    $businoz_footer_bg_url_from_page = function_exists('get_field') ? get_field('businoz_footer_bg') : '';
    $businoz_footer_bg_color_from_page = function_exists('get_field') ? get_field('businoz_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('businoz_footer_bg_color');

    $businoz_copyright_center = $businoz_social_switch ? 'col-xl-6 col-lg-6 col-md-7' : 'col-12 text-center';

    // bg image
    $bg_img = !empty($businoz_footer_bg_url_from_page['url']) ? $businoz_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty($businoz_footer_bg_color_from_page) ? $businoz_footer_bg_color_from_page : $footer_bg_color;


    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for ($num = 1; $num <= $footer_widgets; $num++) {
        if (is_active_sidebar('footer-' . $num)) {
            $footer_columns++;
        }
    }

    switch ($footer_columns) {
        case '1':
            $footer_class[1] = 'col-lg-12';
            break;
        case '2':
            $footer_class[1] = 'col-lg-6 col-md-6';
            $footer_class[2] = 'col-lg-6 col-md-6';
            break;
        case '3':
            $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
            $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
            $footer_class[3] = 'col-xl-4 col-lg-6';
            break;
        case '4':
            $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            $footer_class[2] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            $footer_class[3] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            break;
        default:
            $footer_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
    }

?>


    <!-- Footer-area-start -->
    <footer>
        <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>
            <div class="bd-footer__area footer-bg-3 pt-100 pb-40">
                <div class="bd-footer__style-5">
                    <div class="container">
                        <div class="row g-0">
                            <?php
                            if ($footer_columns > 4) {
                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-1');
                                print '</div>';

                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-2');
                                print '</div>';

                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-3');
                                print '</div>';

                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-4');
                                print '</div>';
                            } else {
                                for ($num = 1; $num <= $footer_columns; $num++) {
                                    if (!is_active_sidebar('footer-' . $num)) {
                                        continue;
                                    }
                                    print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                    dynamic_sidebar('footer-' . $num);
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bd-bottom__area footer-bg-4">
            <div class="footer-bottom__area-5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="<?php print esc_attr($businoz_copyright_center); ?>">
                            <div class="bd-copyright__text">
                                <p><?php print businoz_copyright_text(); ?></p>
                            </div>
                        </div>

                        <?php if (!empty($businoz_social_switch)) : ?>
                            <div class="col-xl-6 col-lg-6 col-md-5">
                                <div class="footer__social text-md-end">
                                    <?php businoz_footer_social_profiles(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-area-end -->

<?php
}

/**
 * footer  style 2
 */
function businoz_footer_style_2()
{
    $footer_bg_img = get_theme_mod('businoz_footer_bg');
    $businoz_footer_logo = get_theme_mod('businoz_footer_logo');
    $businoz_footer_menu_switch = get_theme_mod('businoz_footer_menu_switch');

    $businoz_footer_bg_url_from_page = function_exists('get_field') ? get_field('businoz_footer_bg') : '';
    $businoz_footer_bg_color_from_page = function_exists('get_field') ? get_field('businoz_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('businoz_footer_bg_color');
    $footer_top_space = get_theme_mod('businoz_footer_top_space');

    $footer_menu_link1 = get_theme_mod('footer_menu_link1', __('#', 'businoz'));
    $footer_menu_link2 = get_theme_mod('footer_menu_link2', __('#', 'businoz'));
    $footer_menu_link3 = get_theme_mod('footer_menu_link3', __('#', 'businoz'));


    // bg image
    $bg_img = !empty($businoz_footer_bg_url_from_page['url']) ? $businoz_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty($businoz_footer_bg_color_from_page) ? $businoz_footer_bg_color_from_page : $footer_bg_color;

    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for ($num = 1; $num <= $footer_widgets; $num++) {
        if (is_active_sidebar('footer-2-' . $num)) {
            $footer_columns++;
        }
    }

    switch ($footer_columns) {
        case '1':
            $footer_class[1] = 'col-lg-12';
            break;
        case '2':
            $footer_class[1] = 'col-lg-6 col-md-6';
            $footer_class[2] = 'col-lg-6 col-md-6';
            break;
        case '3':
            $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
            $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
            $footer_class[3] = 'col-xl-4 col-lg-6';
            break;
        case '4':
            $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[2] = 'col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6';
            $footer_class[3] = 'col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-sm-6';
            $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            break;
        case '5':
            $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6';
            $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-70';
            $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-90';
            $footer_class[4] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6';
            $footer_class[5] = 'col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6';
            break;
        default:
            $footer_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
    }

?>

    <!-- Footer-area-start -->
    <footer>
        <?php if (is_active_sidebar('footer-2-1') or is_active_sidebar('footer-2-2') or is_active_sidebar('footer-2-3') or is_active_sidebar('footer-2-4')) : ?>
            <div class="bd-footer__top__area">
                <div class="container">
                    <div class="bd-footer__top__main">
                        <div class="row align-items-center">
                            <div class="col-xl-4 col-lg-3 col-md-6">
                                <div class="footer__top__logo">
                                    <?php businoz_footer_logo(); ?>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-5 col-md-6">
                                <?php if (!empty($businoz_footer_menu_switch)) : ?>
                                    <div class="bd-footer__top__user text-center">
                                        <a href="<?php print esc_url($footer_menu_link1); ?>"><?php print esc_html__('FAQ', 'businoz'); ?></a>
                                        <a href="<?php print esc_url($footer_menu_link2); ?>"><?php print esc_html__('Terms &amp; Conditions', 'businoz'); ?> </a>
                                        <a href="<?php print esc_url($footer_menu_link3); ?>"><?php print esc_html__('Refund', 'businoz'); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <div class="bd-footer__top__social text-md-end">
                                    <?php businoz_footer_social_profiles(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bd-footer__area footer__height footer__bg p-relative" data-background="<?php print esc_url($bg_img); ?>" data-bg-color="<?php print esc_attr($bg_color); ?>">
                <div class="bd-footer__style-2">
                    <div class="container">
                        <div class="bd-footer__main-wrapper pt-145">
                            <div class="row">
                                <?php
                                if ($footer_columns > 4) {
                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-2-1');
                                    print '</div>';

                                    print '<div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-2-2');
                                    print '</div>';

                                    print '<div class="col-xxl-2 col-xl-2 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-2-3');
                                    print '</div>';

                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-2-4');
                                    print '</div>';
                                } else {
                                    for ($num = 1; $num <= $footer_columns; $num++) {
                                        if (!is_active_sidebar('footer-2-' . $num)) {
                                            continue;
                                        }
                                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                        dynamic_sidebar('footer-2-' . $num);
                                        print '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bd-footer-bttom-area">
            <div class="bd-footer__bottom-main">
                <div class="container">
                    <div class="bd-copyright__wrapper">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="bd-copyright__text text-center">
                                    <p><?php print businoz_copyright_text(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-area-end -->

<?php
}


// footer style 03
function businoz_footer_style_3()
{

    $businoz_social_switch = get_theme_mod('businoz_social_switch', false);
    $businoz_footer_menu_switch = get_theme_mod('businoz_footer_menu_switch', false);

    $footer_menu_link1 = get_theme_mod('footer_menu_link1', __('#', 'businoz'));
    $footer_menu_link2 = get_theme_mod('footer_menu_link2', __('#', 'businoz'));
    $footer_menu_link3 = get_theme_mod('footer_menu_link3', __('#', 'businoz'));

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for ($num = 1; $num <= $footer_widgets; $num++) {
        if (is_active_sidebar('footer-3-' . $num)) {
            $footer_columns++;
        }
    }

    switch ($footer_columns) {
        case '1':
            $footer_class[1] = 'col-lg-12';
            break;
        case '2':
            $footer_class[1] = 'col-lg-6 col-md-6';
            $footer_class[2] = 'col-lg-6 col-md-6';
            break;
        case '3':
            $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
            $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
            $footer_class[3] = 'col-xl-4 col-lg-6';
            break;
        case '4':
            $footer_class[1] = 'col-xxl-4 col-xl-3 col-lg-6 col-md-6';
            $footer_class[2] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            $footer_class[3] = 'col-xxl-2 col-xl-3 col-lg-6 col-md-6';
            $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6';
            break;
        case '5':
            $footer_class[1] = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6';
            $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-70';
            $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-4 col-sm-6 footer__pl-90';
            $footer_class[4] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6';
            $footer_class[5] = 'col-xxl-2 col-xl-3 col-lg-3 col-md-4 col-sm-6';
            break;
        default:
            $footer_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
    }

?>

    <!-- Footer-area-start -->
    <footer>
        <?php if (is_active_sidebar('footer-3-1') or is_active_sidebar('footer-3-2') or is_active_sidebar('footer-3-3') or is_active_sidebar('footer-3-4')) : ?>
            <div class="bd-footer__area black-bg pt-100 pb-40">
                <div class="container">
                    <div class="bd-footer-style-2">
                        <div class="row g-0">
                            <?php
                            if ($footer_columns > 4) {
                                print '<div class="col-xxl-4 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-3-1');
                                print '</div>';

                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-3-2');
                                print '</div>';

                                print '<div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-3-3');
                                print '</div>';

                                print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6">';
                                dynamic_sidebar('footer-3-4');
                                print '</div>';
                            } else {
                                for ($num = 1; $num <= $footer_columns; $num++) {
                                    if (!is_active_sidebar('footer-3-' . $num)) {
                                        continue;
                                    }
                                    print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                    dynamic_sidebar('footer-3-' . $num);
                                    print '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bd-bottom__area theme-bg pt-20">
            <div class="container">
                <div class="bd-footer-bottom-2">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-4 col-md-4 order-last order-md-first">
                            <div class="bd-copyright__text text-center mb-20">
                                <p><?php print businoz_copyright_text(); ?></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 order-first order-md-1">
                            <div class="bd-footer__logo text-center mb-20">
                                <?php businoz_footer_logo(); ?>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-7 order-md-last">
                            <?php if (!empty($businoz_footer_menu_switch)) : ?>
                                <div class="bd-copyright__trams text-sm-end mb-20">
                                    <a href="<?php print esc_url($footer_menu_link1); ?>"><?php print esc_html__('FAQ', 'businoz'); ?></a>
                                    <a href="<?php print esc_url($footer_menu_link2); ?>"><?php print esc_html__('Terms &amp; Conditions', 'businoz'); ?> </a>
                                    <a href="<?php print esc_url($footer_menu_link3); ?>"><?php print esc_html__('Refund', 'businoz'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-area-end -->


<?php
}


// footer style 04
function businoz_footer_style_4()
{

    $footer_bg_img = get_theme_mod('businoz_footer_bg');

    $businoz_footer_bg_url_from_page = function_exists('get_field') ? get_field('businoz_footer_bg') : '';
    $businoz_footer_bg_color_from_page = function_exists('get_field') ? get_field('businoz_footer_bg_color') : '';
    $footer_bg_color = get_theme_mod('businoz_footer_bg_color');

    $businoz_footer_shape_switch = get_theme_mod('businoz_footer_shape_switch', false);
    $businoz_footer_menu_switch = get_theme_mod('businoz_footer_menu_switch', false);

    $footer_menu_link1 = get_theme_mod('footer_menu_link1', __('#', 'businoz'));
    $footer_menu_link2 = get_theme_mod('footer_menu_link2', __('#', 'businoz'));
    $footer_menu_link3 = get_theme_mod('footer_menu_link3', __('#', 'businoz'));


    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for ($num = 1; $num <= $footer_widgets; $num++) {
        if (is_active_sidebar('footer-4-' . $num)) {
            $footer_columns++;
        }
    }

    switch ($footer_columns) {
        case '1':
            $footer_class[1] = 'col-lg-12';
            break;
        case '2':
            $footer_class[1] = 'col-lg-6 col-md-6';
            $footer_class[2] = 'col-lg-6 col-md-6';
            break;
        case '3':
            $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
            $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
            $footer_class[3] = 'col-xl-4 col-lg-6';
            break;
        case '4':
            $footer_class[1] = 'col-xxl-4 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[2] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[3] = 'col-xxl-2 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            break;
        default:
            $footer_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
    }

?>

    <!-- Footer-area-start -->
    <footer>
        <?php if (is_active_sidebar('footer-4-1') or is_active_sidebar('footer-4-2') or is_active_sidebar('footer-4-3') or is_active_sidebar('footer-4-4')) : ?>
            <div class="bd-footer__area section-bg-2 p-relative z-index-11">
                <?php if (!empty($businoz_footer_shape_switch)) : ?>
                    <div class="bd-footer__shape-wrapper p-relative">
                        <img class="footer__shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-shape-1.png" alt="footer-shape-1">
                        <img class="footer__shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-shape-2.png" alt="footer-shape-2">
                    </div>
                <?php endif; ?>

                <div class="bd__footer-style-3">
                    <div class="bd__footer-main-wrapper pt-100 pb-35">
                        <div class="container">
                            <div class="row">
                                <?php
                                if ($footer_columns > 3) {
                                    print '<div class="col-xxl-4 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-4-1');
                                    print '</div>';

                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-4-2');
                                    print '</div>';

                                    print '<div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-4-3');
                                    print '</div>';

                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-4-4');
                                    print '</div>';
                                } else {
                                    for ($num = 1; $num <= $footer_columns; $num++) {
                                        if (!is_active_sidebar('footer-4-' . $num)) {
                                            continue;
                                        }
                                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                        dynamic_sidebar('footer-4-' . $num);
                                        print '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bd-bottom__area footer-bg-2 pt-20">
            <div class="bd-footer-bottom-style-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-4 col-md-4 order-last order-md-first">
                            <div class="bd-copyright__text mb-20">
                                <ul>
                                    <li><?php print businoz_copyright_text(); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 order-first order-md-1">
                            <div class="bd-footer__logo text-center mb-20">
                                <?php businoz_footer_logo(); ?>
                            </div>
                        </div>

                        <?php if (!empty($businoz_footer_menu_switch)) : ?>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-7 order-md-last">
                                <div class="bd-copyright__trams text-sm-end mb-20">
                                    <a href="<?php print esc_url($footer_menu_link1); ?>"><?php print esc_html__('FAQ', 'businoz'); ?></a>
                                    <a href="<?php print esc_url($footer_menu_link2); ?>"><?php print esc_html__('Terms &amp; Conditions', 'businoz'); ?> </a>
                                    <a href="<?php print esc_url($footer_menu_link3); ?>"><?php print esc_html__('Refund', 'businoz'); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer-area-end -->



<?php
}



// footer style 05
function businoz_footer_style_5()
{

    $footer_bg_img = get_theme_mod('businoz_footer_bg');

    $businoz_footer_menu_switch = get_theme_mod('businoz_footer_menu_switch');

    $businoz_footer_logo_switch = get_theme_mod('businoz_footer_logo_switch', false);

    $businoz_copyright_center = $businoz_footer_logo_switch  ? 'col-xl-6 col-md-7' : 'col-12 text-center';



    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod('footer_widget_number', 4);

    for ($num = 1; $num <= $footer_widgets; $num++) {
        if (is_active_sidebar('footer-5-' . $num)) {
            $footer_columns++;
        }
    }

    switch ($footer_columns) {
        case '1':
            $footer_class[1] = 'col-lg-12';
            break;
        case '2':
            $footer_class[1] = 'col-lg-6 col-md-6';
            $footer_class[2] = 'col-lg-6 col-md-6';
            break;
        case '3':
            $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
            $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
            $footer_class[3] = 'col-xl-4 col-lg-6';
            break;
        case '4':
            $footer_class[1] = 'col-xxl-4 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[2] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[3] = 'col-xxl-2 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            $footer_class[4] = 'col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6';
            break;
        default:
            $footer_class = 'col-xl-3 col-lg-3 col-md-6';
            break;
    }

?>



    <!-- footer-area-start -->
    <footer>
        <?php if (is_active_sidebar('footer-5-1') or is_active_sidebar('footer-5-2') or is_active_sidebar('footer-5-3') or is_active_sidebar('footer-5-4')) : ?>
            <div class="bd-footer__area blue-bg p-relative pt-100 pb-35">
                <div class="bd-footer__style-4">
                    <div class="container">
                        <div class="bd-footer__main-wrapper">
                            <div class="row">
                                <?php
                                if ($footer_columns > 3) {
                                    print '<div class="col-xxl-4 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-5-1');
                                    print '</div>';

                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-5-2');
                                    print '</div>';

                                    print '<div class="col-xxl-2 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-5-3');
                                    print '</div>';

                                    print '<div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">';
                                    dynamic_sidebar('footer-5-4');
                                    print '</div>';
                                } else {
                                    for ($num = 1; $num <= $footer_columns; $num++) {
                                        if (!is_active_sidebar('footer-5-' . $num)) {
                                            continue;
                                        }
                                        print '<div class="' . esc_attr($footer_class[$num]) . '">';
                                        dynamic_sidebar('footer-5-' . $num);
                                        print '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bd-footer-bttom-area blue-bg">
            <div class="container">
                <div class="bd-footer__bottom-style-3 yello-bg">
                    <div class="row align-items-center">
                        <?php if (!empty($businoz_footer_logo_switch)) : ?>
                            <div class="col-xl-6 col-md-5">
                                <div class="bd-footer__logo">
                                    <?php businoz_footer_logo(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="<?php print esc_attr($businoz_copyright_center); ?>">
                            <div class="bd-copyright__text text-md-end">
                                <p><?php print businoz_copyright_text(); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->


    <?php
}





// businoz_copyright_text
function businoz_copyright_text()
{
    print get_theme_mod('businoz_copyright', esc_html__('© 2022 All rights reserved | Design & Develop by BDevs', 'businoz'));
}

/**
 * [businoz_breadcrumb_func description]
 * @return [type] [description]
 */
function businoz_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image') : '';

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'businoz'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'businoz'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_home() && function_exists('tutor')) {
        if (get_option('page_for_posts')) {

            $user_name = sanitize_text_field(get_query_var('tutor_student_username'));
            $get_user = tutor_utils()->get_user_by_login($user_name);

            if ($get_user == NULL) {
                $title = get_the_title(get_option('page_for_posts'));
                $id = get_option('page_for_posts');
            } else {
                $title = ucwords($get_user->user_login);
            }
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
    } elseif ('product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_shop_title', __('Shop', 'businoz'));
    } elseif (is_single() && 'product' == get_post_type()) {
        $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'businoz'));
    } elseif (is_single() && 'bdevs-services' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_single() && 'courses' == get_post_type()) {
        $title = esc_html__('Course Details', 'businoz');
    } elseif (is_single() && 'bdevs-event' == get_post_type()) {
        $title = esc_html__('Event Details', 'businoz');
    } elseif (is_single() && 'bdevs-cases' == get_post_type()) {
        $title = get_the_title();
    } elseif (is_search()) {

        $title = esc_html__('Search Results for : ', 'businoz') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'businoz');
    } elseif (is_archive()) {

        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }



    $_id = get_the_ID();

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (function_exists("is_shop") and is_shop()) {
        $_id = wc_get_page_id('shop');
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';
    if (!empty($_GET['s'])) {
        $is_breadcrumb = null;
    }

    if (empty($is_breadcrumb) && $breadcrumb_show == 1) {

        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image', $_id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image', $_id) : '';

        // get_theme_mod
        $bg_img_url = get_template_directory_uri() . '/assets/img/breadcrumb/breadcrumb-1.jpg';

        $bg_img = get_theme_mod('breadcrumb_bg_img');

        $breadcrumb_img = get_theme_mod('breadcrumb_img');

        $businoz_breadcrumb_shape_switch = get_theme_mod('businoz_breadcrumb_shape_switch', true);
        $breadcrumb_info_switch = get_theme_mod('breadcrumb_info_switch', true);
        $breadcrumb_subtitle_switch = get_theme_mod('breadcrumb_subtitle_switch', false);

        $businoz_breadcrumb_padding_top = function_exists('get_field') ? get_field('businoz_breadcrumb_padding_top') : '320px';
        $businoz_breadcrumb_padding_bottom = function_exists('get_field') ? get_field('businoz_breadcrumb_padding_bottom') : '180px';

        $businoz_breadcrumb_subtitle = get_theme_mod('businoz_breadcrumb_subtitle', __('Welcome To Our Agency', 'businoz'));



        if ($hide_bg_img && empty($_GET['s'])) {
            $bg_img = '';
        } else {
            $bg_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
        }

    ?>


        <!-- Breadcrumb-area-start -->
        <section class="bd-breadcrumb__area breadcrumb__overlay include-bg p-relative" data-background="<?php print esc_attr($bg_img); ?>">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <?php if (!empty($breadcrumb_info_switch)) : ?>
                            <div class="bd-breadcrumb__content" data-top-space="<?php print esc_attr($businoz_breadcrumb_padding_top); ?>px" data-bottom-space="<?php print esc_attr($businoz_breadcrumb_padding_bottom); ?>px">
                                <div class="bd-section__title">
                                    <?php if (!empty($breadcrumb_subtitle_switch)) : ?>
                                        <h6 class="bd-breadcrumb-small-title">
                                            <?php print esc_html($businoz_breadcrumb_subtitle); ?>
                                        </h6>
                                    <?php endif; ?>
                                    <h2 class="bd-breadcrumb-big-title" style="color:#FFF"><?php echo wp_kses_post($title); ?></h2>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (!empty($breadcrumb_img)) : ?>
                <div class="bd-breadcrumb__img">
                    <img src="<?php print esc_attr($breadcrumb_img); ?>" alt="breadcrumb-img">
                </div>
            <?php endif; ?>
        </section>
        <!-- Breadcrumb-area-start -->

    <?php
    }
}

add_action('businoz_before_main_content', 'businoz_breadcrumb_func');

// businoz_search_form
function businoz_search_form()
{
    ?>
    <!-- Modal-area-start -->
    <div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                    <input type="search" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Search here...', 'businoz'); ?>">
                    <button>
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal-area-end -->
<?php
}

add_action('businoz_before_main_content', 'businoz_search_form');


/**
 *
 * pagination
 */
if (!function_exists('businoz_pagination')) {

    function _businoz_pagi_callback($pagination)
    {
        return $pagination;
    }

    //page navegation
    function businoz_pagination($prev, $next, $pages, $args)
    {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if (!$pages) {
                $pages = 1;
            }
        }

        $pagination = [
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ($wp_rewrite->using_permalinks()) {
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
        }

        if (!empty($wp_query->query_vars['s'])) {
            $pagination['add_args'] = ['s' => get_query_var('s')];
        }

        $pagi = '';
        if (paginate_links($pagination) != '') {
            $paginations = paginate_links($pagination);
            $pagi .= '<ul>';
            foreach ($paginations as $key => $pg) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _businoz_pagi_callback($pagi);
    }
}


function businoz_style_functions()
{
    wp_enqueue_style('businoz-custom', BUSINOZ_THEME_CSS_DIR . 'businoz-custom.css', []);

    // breadcrumb-bg-color
    $color_code = get_theme_mod('businoz_breadcrumb_bg_color', '#222');
    if ($color_code != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-bg.gray-bg{ background: " . $color_code . "}";

        wp_add_inline_style('businoz-breadcrumb-bg', $custom_css);
    }

    // breadcrumb-spacing top
    $padding_px = get_theme_mod('businoz_breadcrumb_spacing', '160px');
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-top: " . $padding_px . "}";

        wp_add_inline_style('businoz-breadcrumb-top-spacing', $custom_css);
    }

    // breadcrumb-spacing bottom
    $padding_px = get_theme_mod('businoz_breadcrumb_bottom_spacing', '160px');
    if ($padding_px != '') {
        $custom_css = '';
        $custom_css .= ".breadcrumb-spacing{ padding-bottom: " . $padding_px . "}";

        wp_add_inline_style('businoz-breadcrumb-bottom-spacing', $custom_css);
    }

    // scrollup
    $scrollup_switch = get_theme_mod('businoz_scrollup_switch', false);
    if ($scrollup_switch) {
        $custom_css = '';
        $custom_css .= "#scrollUp{ display: none !important;}";

        wp_add_inline_style('businoz-scrollup-switch', $custom_css);
    }

    $logo_size = get_theme_mod('businoz_logo_size', '153');
    if ($logo_size != '') {
        $custom_css = '';
        $custom_css .= ".standard-logo img { max-width: " . $logo_size . "px}";
        wp_add_inline_style('businoz-custom', $custom_css);
    }

    // theme color
    $color_code = get_theme_mod('businoz_color_option', '#0e51ac');
    if ($color_code != '') {
        $custom_css = '';
        //background color
        $custom_css .= ".bd-theme__btn-1, .bd-hero__shape-2 { background-color: " . $color_code . "}";
        // color
        $custom_css .= ".ghghghg { color: " . $color_code . "}";
        // border color
        $custom_css .= ".htgsdjd { border-color: " . $color_code . "}";
        $custom_css .= ".dsdfsdsd { stroke: " . $color_code . "}";
        wp_add_inline_style('businoz-custom', $custom_css);
    }
    // theme 2nd color
    $color_code = get_theme_mod('businoz_secondary_color', '#0e51ac');
    if ($color_code != '') {
        $custom_css = '';
        //background color
        $custom_css .= ".dfdf { background-color: " . $color_code . "}";
        // color
        $custom_css .= ".ghghghg { color: " . $color_code . "}";
        // border color
        $custom_css .= ".htgsdjd { border-color: " . $color_code . "}";
        $custom_css .= ".dsdfsdsd { stroke: " . $color_code . "}";
        wp_add_inline_style('businoz-custom', $custom_css);
    }
}
add_action('wp_enqueue_scripts', 'businoz_style_functions');


// businoz_kses_intermediate
function businoz_kses_intermediate($string = '')
{
    return wp_kses($string, businoz_get_allowed_html_tags('intermediate'));
}

function businoz_get_allowed_html_tags($level = 'basic')
{
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function businoz_kses($raw)
{

    $allowed_tags = array(
        'a'                         => array(
            'class'   => array(),
            'href'    => array(),
            'rel'  => array(),
            'title'   => array(),
            'target' => array(),
        ),
        'abbr'                      => array(
            'title' => array(),
        ),
        'b'                         => array(),
        'blockquote'                => array(
            'cite' => array(),
        ),
        'cite'                      => array(
            'title' => array(),
        ),
        'code'                      => array(),
        'del'                    => array(
            'datetime'   => array(),
            'title'      => array(),
        ),
        'dd'                     => array(),
        'div'                    => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'dl'                     => array(),
        'dt'                     => array(),
        'em'                     => array(),
        'h1'                     => array(),
        'h2'                     => array(),
        'h3'                     => array(),
        'h4'                     => array(),
        'h5'                     => array(),
        'h6'                     => array(),
        'i'                         => array(
            'class' => array(),
        ),
        'img'                    => array(
            'alt'  => array(),
            'class'   => array(),
            'height' => array(),
            'src'  => array(),
            'width'   => array(),
        ),
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
        'data-wow-duration'            => array(),
        'data-wow-delay'            => array(),
        'data-wallpaper-options'       => array(),
        'data-stellar-background-ratio'   => array(),
        'ul'                     => array(
            'class' => array(),
        ),
    );

    if (function_exists('wp_kses')) { // WP is here
        $allowed = wp_kses($raw, $allowed_tags);
    } else {
        $allowed = $raw;
    }

    return $allowed;
}
