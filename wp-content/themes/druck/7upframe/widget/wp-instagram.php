<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:20 AM
 */

if(!class_exists('s7upf_new_instagram'))
{
	class s7upf_new_instagram extends WP_Widget {


		protected $default=array();

		static function _init()
		{
			add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
		}

		static function _add_widget()
		{
			s7upf_reg_widget( 's7upf_new_instagram' );
		}

		function __construct() {
			// Instantiate the parent object
			parent::__construct( false, esc_html__('7uptheme Instagram','druck'),
				array( 'description' => esc_html__( 'Get list instagram recent', 'druck' ), ));

			$this->default=array(
				'title'            => '',
				'user'             => '',
				'photos'           => '',
			);
		}

		function widget( $args, $instance ) {
			// Widget output
			echo apply_filters('s7upf_output_content',$args['before_widget']);
			if ( ! empty( $instance['title'] ) ) {
			   echo apply_filters('s7upf_output_content',$args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			$instance = wp_parse_args($instance,$this->default);
			extract($instance);
			?>	
				<?php
					$data = array();
					if(!empty($user) && function_exists('s7upf_scrape_instagram')){
						$media_array = s7upf_scrape_instagram($user, $photos, '', 0);
						if(is_array($media_array)) if(isset($media_array['photos'])) $media_array = $media_array['photos'];
						if(!empty($media_array)){
							foreach ($media_array as $item) {
								if(isset($item['link']) && isset($item['thumbnail_src'])){
									$data[] = array(
										'image_url' => $item['thumbnail_src'],
										'link'      => $item['link'],
										'like'      => $item['like'],
										'comment'      => $item['comment'],
									);
								}
							}              
						}
					}
				?>
				<div class="wg-instagram instagram-box">
					<div class="list-instagram clearfix">
					<?php
						if(!empty($data)){
							foreach ($data as $value) {
								echo    '<div class="pull-left item-instagram banner-advs zoom-image overlay-image">
											<a class="adv-thumb-link" target="_blank" href="'. esc_url( $value['link'] ) .'">
												<img src="'. esc_url($value['image_url']) .'" alt="'.esc_attr__("instagram-image","druck").'">
												<div class="instagram-info transition absolute flex-wrapper align_items-center justify_content-center">
													<ul class="list-inline-block">
														<li class="like-count"><i class="title14 white fa fa-heart-o"></i><sub class="white title10">'.esc_html($value['like']['count']).'</sub></li>
														<li class="comment-count"><i class="title14 white fa fa-comment-o"></i><sub class="white title10">'.esc_html($value['comment']['count']).'</sub></li>
													</ul>
												</div>
											</a>
										</div>';
							}              
						}
					?>
					</div>
				</div>
			<?php
			echo apply_filters('s7upf_output_content',$args['after_widget']);
		}

		function update( $new_instance, $old_instance ) {

			// Save widget options
			$instance=array();
			$instance=wp_parse_args($instance,$this->default);
			$new_instance=wp_parse_args($new_instance,$instance);

			return $new_instance;
		}

		function form( $instance ) {
			// Output admin widget options form

			$instance=wp_parse_args($instance,$this->default);
			extract($instance);
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:' ,'druck'); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php esc_html_e('User', 'druck'); ?>: </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('user')); ?>" name="<?php echo esc_attr($this->get_field_name('user')); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('photos')); ?>"><?php esc_html_e('Photos', 'druck'); ?>: </label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('photos')); ?>" name="<?php echo esc_attr($this->get_field_name('photos')); ?>" type="text" value="<?php echo esc_attr($photos); ?>" />
			</p>
		<?php
		}
	}

	s7upf_new_instagram::_init();

}
