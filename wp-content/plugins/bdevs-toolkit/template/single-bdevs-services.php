<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  lovelee
 */
get_header(); ?>


   <section class="bd-service-details-area pt-150 pb-100">
      <div class="container">
         <?php 
            if( have_posts() ):
            while( have_posts() ): the_post();
            $department_details_thumb = function_exists('get_field') ? get_field('department_details_thumb') : '';
         ?>
         <div class="row">
            <div class="col-xxl-9 col-xl-9 col-lg-12 col-md-12">
               <div class="bd-service__details-wrapper pr-20 mb-30">
                  <div class="bd-service__deatils-thumb w-img mb-60">
                     <?php the_post_thumbnail(); ?>
                  </div>
                  <div class="bd-service__details-content mb-55">
                     <h3 class="bd-service__details-title mb-10"><?php the_title(); ?></h3>
                     <?php the_content(); ?>
                  </div>
               </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-8">
               <div class="bd-service__sidebar mb-60">
                  <?php do_action("businoz_service_sidebar"); ?>
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