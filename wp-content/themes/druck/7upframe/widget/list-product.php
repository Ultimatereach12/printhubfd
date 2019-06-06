<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:20 AM
 */
if(class_exists("woocommerce")){
	if(!class_exists('S7upf_List_products'))
	{
		class S7upf_List_products extends WP_Widget {


			protected $default=array();

			static function _init()
			{
				add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
			}

			static function _add_widget()
			{
				s7upf_reg_widget( 'S7upf_List_products' );
			}

			function __construct() {
				// Instantiate the parent object
				parent::__construct( false, esc_html__('7uptheme List Products','druck'),
					array( 'description' => esc_html__( 'Get products widget', 'druck' ), ));

				$this->default=array(
					'title'            => '',
					'number'           => '',
					'product_type'     => '',
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
				$args_product=array(
					'post_type'         => 'product',
					'orderby'           => 'date',
					'showposts'         => $number,
				);
				if($product_type == 'trendding'){
					$args_product['meta_query'][] = array(
							'key'     => 'trending_product',
							'value'   => 'on',
							'compare' => '=',
						);
				}
				if($product_type == 'toprate'){
					$args_product['meta_key'] = '_wc_average_rating';
					$args_product['orderby'] = 'meta_value_num';
					$args_product['meta_query'] = WC()->query->get_meta_query();
					$args_product['tax_query'][] = WC()->query->get_tax_query();
				}
				if($product_type == 'mostview'){
					$args_product['meta_key'] = 'post_views';
					$args_product['orderby'] = 'meta_value_num';
				}
				if($product_type == 'bestsell'){
					$args_product['meta_key'] = 'total_sales';
					$args_product['orderby'] = 'meta_value_num';
				}
				if($product_type=='onsale'){
					$args_product['meta_query']['relation']= 'OR';
					$args_product['meta_query'][]=array(
						'key'   => '_sale_price',
						'value' => 0,
						'compare' => '>',                
						'type'          => 'numeric'
					);
					$args_product['meta_query'][]=array(
						'key'   => '_min_variation_sale_price',
						'value' => 0,
						'compare' => '>',                
						'type'          => 'numeric'
					);
				}
				if($product_type == 'featured'){
					$args_product['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
				}
				$query = new WP_Query($args_product);
				$html =    '';
				if($query->have_posts()) {
					?>
					<div class="wg-product-list">
						<?php
						while($query->have_posts()) {
							
							$query->the_post();
							global $product;
							s7upf_get_template_woocommerce('loop/grid/grid','table',false,true);
						} 
						?>	
					</div>  
					<?php
				}
				wp_reset_postdata();
				echo apply_filters('s7upf_output_content',$html);
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
					<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number', 'druck'); ?>: </label>
					<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" />
				</p>
				<p>
					<label for="<?php echo esc_attr($this->get_field_id('product_type')); ?>"><?php esc_html_e('Product Type', 'druck'); ?>: </label>
					<select id="<?php echo esc_attr($this->get_field_id( 'product_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'product_type' )); ?>">
						<option value="" <?php if($product_type == '') echo'selected="selected"';?>><?php esc_html_e('Recent Product','druck');?></option>
						<option value="featured" <?php if($product_type == 'featured') echo'selected="selected"';?>><?php esc_html_e('Featured Product','druck');?></option>
						<option value="trending" <?php if($product_type == 'trending') echo'selected="selected"';?>><?php esc_html_e('Trending Product','druck');?></option>
						<option value="onsale" <?php if($product_type == 'onsale') echo'selected="selected"';?>><?php esc_html_e('Sale Product','druck');?></option>
						<option value="bestsell" <?php if($product_type == 'bestsell') echo'selected="selected"';?>><?php esc_html_e('Bestsell Product','druck');?></option>
						<option value="toprate" <?php if($product_type == 'toprate') echo'selected="selected"';?>><?php esc_html_e('Top rate Product','druck');?></option>
						<option value="mostview" <?php if($product_type == 'mostview') echo'selected="selected"';?>><?php esc_html_e('Most view Product','druck');?></option>
					</select>
				</p>
			<?php
			}
		}

		S7upf_List_products::_init();

	}
}