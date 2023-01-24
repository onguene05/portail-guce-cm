<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package businoz
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<div class="blog-area pt-150 pb-95">
    <div class="container container-box">
        <div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?> blog-post-items">
				<div class="blog__wrapper mr-35">
				<?php if ( have_posts() ): ?>
					<header class="page-header d-none">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					<?php
						/* Start the Loop */
						while ( have_posts() ):
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;
					?>

					<div class="bd-basic-pagination basic-pagination-2 mb-60">
						<?php businoz_pagination( '<i class="fal fa-long-arrow-left"></i>', '<i class="fal fa-long-arrow-right"></i>', '', [ 'class' => '' ] );?>
					</div>
					<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
		        <div class="col-lg-4 sidebar-blog right-side">
					<?php get_sidebar();?>
	            </div>
			<?php
				}
			?>
        </div>
    </div>
</div>
<?php
get_footer();
