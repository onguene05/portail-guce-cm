<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  medidove
 */
get_header(); ?>

   <section class="bd-case__area pt-120 pb-85 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
        <div class="container">
         <?php 
                if( have_posts() ):
                while( have_posts() ): the_post();
                    $categories = get_the_terms( get_the_id(), 'project-categories' );
                    $post_tags = get_the_terms( get_the_id(), 'project-tags' );
                    $portfolio_details_image = function_exists('get_field') ? get_field('portfolio_details_image') : '';
                    $project_button = function_exists('get_field') ? get_field('project_button') : '';
                    $project_button_url = function_exists('get_field') ? get_field('project_button_url') : '';

                    $portfolio_info_list = function_exists('get_field') ? get_field('portfolio_info_list') : '';
                    $portfolio_image_list = function_exists('get_field') ? get_field('portfolio_image_list') : '';

            ?>
            <div class="row">
               <div class="col-12">
                  <div class="bd-case__main__wrapper">
                     <div class="row">
                        <div class="col-xl-12">
                           <div class="bd-case__meta-wrapper mb-55">
                              <div class="bd-case__image w-img mb-40">
                                 <img src="<?php echo esc_html($portfolio_details_image['url']); ?>" alt="case-big-img">
                              </div>
                              <div class="bd-case__meta p-relative">
                                 <div class="bd-case__meta-item">
                                    <?php if (!empty($portfolio_info_list['portfolio_client_name'])) : ?>
                                    <div class="bd-case__meta-title">
                                       <h4><?php echo esc_html__('Client :','bdevs-toolkit'); ?></h4>
                                       <span><?php echo wp_kses_post( $portfolio_info_list['portfolio_client_name'] ); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($portfolio_info_list['portfolio_date_name'])) : ?>
                                    <div class="bd-case__meta-title">
                                       <h4><?php echo esc_html__('Date :','bdevs-toolkit'); ?></h4>
                                       <span><?php echo wp_kses_post( $portfolio_info_list['portfolio_date_name'] ); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($portfolio_info_list['service_title'])) : ?>
                                    <div class="bd-case__meta-title">
                                       <h4><?php echo esc_html__('Services :','bdevs-toolkit'); ?></h4>
                                       <span><?php echo wp_kses_post( $portfolio_info_list['service_title'] ); ?></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($categories)) : ?>
                                    <div class="bd-case__meta-title">
                                       <h4><?php echo esc_html__('Category :','bdevs-toolkit'); ?></h4>
                                       <?php foreach ( $categories as $category ) : ?>
                                       <span><a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>">
                                          <?php echo esc_html($category->name); ?>
                                       </a></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                 </div>
                                 <a class="bd-gadient__btn" href="<?php echo esc_html($project_button_url); ?>"><?php echo esc_html($project_button); ?> <i class="fas fa-chevron-right"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="bd-case__small-title mb-55">
                        <?php the_content(); ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php 
                endwhile; wp_reset_query();
                 endif; 
            ?>
        </div>
   </section>

<?php get_footer();  ?>