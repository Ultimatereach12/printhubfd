<?php
$check_related = s7upf_get_option('post_single_related','on');
if($check_related == 'on'):
    $categories = get_the_category(get_the_ID());
    $category_ids = array();
    foreach($categories as $individual_category){
        $category_ids[] = $individual_category->term_id;
    }
    $title_df   = esc_html__("You May Also Like","druck");
    $title 		= s7upf_get_option('post_single_related_title',$title_df);
    $number 	= s7upf_get_option('post_single_related_number','6');
    $size 		= s7upf_get_option('post_single_related_size','410x230');
    $itemres 	= s7upf_get_option('post_single_related_item','0:1,480:2,990:3');
    $itemstyle 	= s7upf_get_option('post_single_related_item_style');
    $excerpt 	= s7upf_get_option('post_single_related_excerpt',120);
    $speed      = '';
    $size = s7upf_get_size_crop($size);
    $attr = array(
        'size'      => $size,
        'excerpt'   => $excerpt,
        );
    $args=array(
        'category__in' 		=> $category_ids,
        'post__not_in' 		=> array(get_the_ID()),
        'posts_per_page'	=> (int)$number,
        'meta_query' 		=> array(array('key' => '_thumbnail_id')) 
        );
    $query = new wp_query($args);
    if($query->post_count > 0):
    ?>
    <div class="single-related-post">
    	<h2 class="title30 lora-font text-uppercase title-single-related-post">
    		<?php echo esc_html($title)?> 
    	</h2>
    	<div class="related-post-slider">
    		<div class="wrap-item smart-slider group-navi" 
            data-item="" data-speed="<?php echo esc_attr($speed);?>" 
            data-itemres="<?php echo esc_attr($itemres)?>" 
            data-prev="" data-next="" 
            data-pagination="" data-navigation="navi-nav-style">
            <?php 
            if($query->have_posts()) {
                while($query->have_posts()) {
                    $query->the_post();
                    s7upf_get_template_post('grid/grid',$itemstyle,$attr,true);
                }
            }
            ?>
    		</div>
    	</div>
    </div>
    <?php 
    endif;
    wp_reset_postdata();
    ?>
<?php endif?>