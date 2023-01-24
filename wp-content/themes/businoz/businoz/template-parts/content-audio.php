<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package businoz
 */

    $businoz_audio_url = function_exists( 'get_field' ) ? get_field( 'fromate_style' ) : NULL;
    $categories = get_the_terms( $post->ID, 'category' );
    $businoz_blog_date = get_theme_mod( 'businoz_blog_date', true );
    $businoz_blog_comments = get_theme_mod( 'businoz_blog_comments', true );
    $businoz_blog_author = get_theme_mod( 'businoz_blog_author', true );
    $businoz_blog_cat = get_theme_mod( 'businoz_blog_cat', false );
    if ( is_single() ): 
?>


    <article id="post-<?php the_ID();?>" <?php post_class( 'bd-postbox__item  mb-40 format-audio' );?>>
        <?php if ( !empty( $businoz_audio_url ) ): ?>
        <div class="postbox__audio embed-responsive embed-responsive-16by9 position-relative">
            <?php echo wp_oembed_get( $businoz_audio_url ); ?>
        </div>
        <?php endif;?>

        <div class="bd-postbox__content p-relative">
            <div class="bd-postbox__meta meta__postbox-bt mb-30">
                <?php if ( !empty($businoz_blog_comments) ): ?>
                <span>
                    <a href="<?php comments_link();?>"><i class="fal fa-comments"></i> <?php comments_number();?></a>
                </span>
                <?php endif;?>

                <?php if ( !empty($businoz_blog_date) ): ?>
                <span><i class="fal fa-calendar-alt"></i> <?php the_time( get_option('date_format') ); ?></span>
                <?php endif;?>
            </div>

            <h3 class="bd-post-box__big-title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>

            <div class="post-text mb-35">
               <?php the_content();?>
                <?php
                    wp_link_pages( [
                        'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'businoz' ),
                        'after'       => '</div>',
                        'link_before' => '<span class="page-number">',
                        'link_after'  => '</span>',
                    ] );
                ?>
            </div>
            <?php print businoz_get_tag();?>
        </div>
    </article>


    <?php else: ?>

    <article id="post-<?php the_ID();?>" <?php post_class( 'bd-postbox__item  mb-40 format-audio' );?>>
        <?php if ( !empty( $businoz_audio_url ) ): ?>
        <div class="postbox__audio embed-responsive embed-responsive-16by9 position-relative">
            <?php echo wp_oembed_get( $businoz_audio_url ); ?>
        </div>
        <?php endif;?>
        <div class="bd-postbox__content p-relative">
            <div class="bd-postbox__meta meta__postbox-bt mb-30">
                <?php if ( !empty($businoz_blog_comments) ): ?>
                <span>
                    <a href="<?php comments_link();?>"><i class="fal fa-comments"></i> <?php comments_number();?></a>
                </span>
                <?php endif;?>

                <?php if ( !empty($businoz_blog_date) ): ?>
                <span><i class="fal fa-calendar-alt"></i> <?php the_time( get_option('date_format') ); ?></span>
                <?php endif;?>
            </div>

            <?php if ( has_post_thumbnail() ): ?> 
            <div class="bd-poxbox-card-2">
                <div class="postbox-card-wrapper"> 
                    <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><i class="far fa-user"></i> <?php print get_the_author();?></a>
                </div>
            </div>
            <?php endif; ?>

            <h3 class="bd-post-box__big-title">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </h3>

            <div class="post-text mb-35">
              <?php the_excerpt();?>
            </div>

            <!-- blog btn -->
            <?php
                $businoz_blog_btn = get_theme_mod( 'businoz_blog_btn', 'Read More' );
                $businoz_blog_btn_switch = get_theme_mod( 'businoz_blog_btn_switch', true );
            ?>

            <?php if ( !empty( $businoz_blog_btn_switch ) ): ?>
            <div class="read-more-btn">
                <a href="<?php the_permalink();?>" class="bd-gadient__btn"><?php print esc_html( $businoz_blog_btn );?></a>
            </div>
            <?php endif;?>
        </div>
    </article>


<?php
endif;?>


