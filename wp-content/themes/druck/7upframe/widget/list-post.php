<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!class_exists('S7upf_ListPostsWidget'))
{
    class S7upf_ListPostsWidget extends WP_Widget {


        protected $default=array();

        static function _init()
        {
            add_action( 'widgets_init', array(__CLASS__,'_add_widget') );
        }

        static function _add_widget()
        {
            s7upf_reg_widget( 'S7upf_ListPostsWidget' );
        }

        function __construct() {
            // Instantiate the parent object
            parent::__construct( false, esc_html__('7uptheme List Posts','druck'),
                array( 'description' => esc_html__( 'Get List Posts by multiple format', 'druck' ), ));

            $this->default=array(
                'title'             =>esc_html__('List Posts','druck'),
                'posts_per_page'    =>5,
                'category'          =>'',
                'order'             =>'desc',
                'order_by'          =>'date',
            );
        }



        function widget( $args, $instance ) {
            // Widget output
           echo apply_filters('s7upf_output_content',$args['before_widget']);
            if ( ! empty( $instance['title'] ) ) {
               echo apply_filters('s7upf_output_content',$args['before_title']) . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
            }

            $instance=wp_parse_args($instance,$this->default);
            extract($instance);
            $args_post = array(
                'post_type'         => 'post',
                'posts_per_page'    => $posts_per_page,
                'orderby'           => $order_by,
                'order'             => $order,
            );
            if(!empty($category)){
                $args_post['tax_query'][]=array(
                    'taxonomy'=>'category',
                    'field'=>'id',
                    'terms'=> $category
                );
            }
            $html = '';
            $html .=    '<div class="widget-content widget-latest-post">
                            <ul class="list-none">';
            $post_query = new WP_Query($args_post);
            if($post_query->have_posts()) {
                while($post_query->have_posts()) {
                    $post_query->the_post();
                    $html .=    '<li>
                                    <div class="item-wg-post table-custom">
                                        <div class="post-thumb banner-advs zoom-image overlay-image">
                                            <a href="'.esc_url(get_the_permalink()).'" class="adv-thumb-link">'.get_the_post_thumbnail(get_the_ID(),array(70,70)).'</a>
                                        </div>
                                        <div class="post-info">
                                            <h3 class="title14 lora-font"><a class="black" href="'.esc_url(get_the_permalink()).'" title="'.esc_attr(the_title_attribute(array('echo'=>false))).'">'.get_the_title().'</a></h3>
                                            <span class="title12 silver"><i class="color title14 la la-calendar"></i> '.get_the_date('M d Y').'</span>
                                        </div>
                                    </div>
                                </li>';
                }
            }
            $html .=        '</ul>
                        </div>';
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
                <label for="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>"><?php esc_html_e( 'Post Number:' ,'druck'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" type="text" value="<?php echo esc_attr( $posts_per_page ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>"><?php esc_html_e( 'Order By:' ,'druck'); ?></label>

                <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'order_by' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order_by' )); ?>">
                    <?php echo s7upf_get_order_list($order_by,array('post_view'=>esc_html__('Post View','druck')),'option');?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'order' )); ?>"><?php esc_html_e( 'Order:' ,'druck'); ?></label>

                <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'order' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'order' )); ?>">
                    <option <?php selected('desc',$order) ?> value="desc"><?php esc_html_e("DESC","'druck")?>
                    </option><option <?php selected('asc',$order) ?> value="asc"><?php esc_html_e("ASC","'druck")?></option>
                    
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php esc_html_e( 'Category:' ,'druck'); ?></label>

                <?php wp_dropdown_categories(array(
                    'selected'=>$category,
                    'show_option_all'=>esc_html__('--- Select ---','druck'),
                    'name'  =>$this->get_field_name( 'category' ),
                    'class'              => 'widefat',
                )); ?>
            </p>


        <?php
        }
    }

    S7upf_ListPostsWidget::_init();

}
