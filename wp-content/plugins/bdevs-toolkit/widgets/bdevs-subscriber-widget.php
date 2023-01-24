<?php
	/**
	 * Medodove Social Widget
	 *
	 *
	 * @author 		bdevs
	 * @category 	Widgets
	 * @package 	Medodove/Widgets
	 * @version 	1.0.1
	 * @extends 	WP_Widget
	 */
	add_action('widgets_init', 'bdevs_subscriber_widget');
	function bdevs_subscriber_widget() {
		register_widget('bdevs_subscriber_widget');
	}
	
	
	class Bdevs_Subscriber_Widget  extends WP_Widget{
		
		public function __construct(){
			parent::__construct('bdevs_subscriber_widget',esc_html__('Businoz Footer Subscriber','bdevs-toolkit'),array(
				'description' => esc_html__('Businoz Subscriber Widget','bdevs-toolkit'),
			));
		}
		
		public function widget($args,$instance){
			extract($args);
			extract($instance);
		 	print $before_widget; 
		?>

	    <div class="footer_top-info">
            <div class="container custome-container">
                <div class="news-letter-area pt-50 pb-20">
                    <div class="row align-items-center">
                    	<?php if( !empty($instance['title']) ): ?>
                        <div class="col-lg-5">
                           <h5 class="news-letter-title mb-30"><?php echo apply_filters( 'widget_title', $instance['title'] ); ?></h5>
                        </div>
                        <?php endif; ?>
                        <?php if( !empty($mailchimp_shortcode) ): ?>
                        <div class="col-lg-7">
                        	<?php print do_shortcode($mailchimp_shortcode); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

	    <?php print $after_widget; ?>  

		<?php
		}
		

		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $instance
		 * @return void
		 */
		public function form($instance){
			$title  = isset($instance['title'])? $instance['title']:'';
			$mailchimp_shortcode  = isset($instance['mailchimp_shortcode'])? $instance['mailchimp_shortcode']:'';

			$mailchimp_text  = isset($instance['mailchimp_text'])? $instance['mailchimp_text']:'';
			$social_heading  = isset($instance['social_heading'])? $instance['social_heading']:'';
			$twitter  = isset($instance['twitter'])? $instance['twitter']:'';
			$facebook  = isset($instance['facebook'])? $instance['facebook']:'';
			$instagram  = isset($instance['instagram'])? $instance['instagram']:'';
			$youtube  = isset($instance['youtube'])? $instance['youtube']:'';
			$linkedin  = isset($instance['linkedin'])? $instance['linkedin']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','bdevs-toolkit'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  class="widefat" name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<p>
				<label for="title"><?php esc_html_e('Mailchimp Shortcode:','bdevs-toolkit'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('mailchimp_shortcode')); ?>" class="widefat" name="<?php print esc_attr($this->get_field_name('mailchimp_shortcode')); ?>" value="<?php print esc_attr($mailchimp_shortcode); ?>">

			<?php
		}
				
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['subscribe_style'] = ( ! empty( $new_instance['subscribe_style'] ) ) ? strip_tags( $new_instance['subscribe_style'] ) : '';
			$instance['mailchimp_shortcode'] = ( ! empty( $new_instance['mailchimp_shortcode'] ) ) ? strip_tags( $new_instance['mailchimp_shortcode'] ) : '';
			$instance['mailchimp_text'] = ( ! empty( $new_instance['mailchimp_text'] ) ) ? strip_tags( $new_instance['mailchimp_text'] ) : '';


			$instance['social_heading'] = ( ! empty( $new_instance['social_heading'] ) ) ? strip_tags( $new_instance['social_heading'] ) : '';
			$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
			$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
			$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
			$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
			$instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
			return $instance;
		}
	}