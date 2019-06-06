<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
    if(!function_exists('s7upf_vc_tab_categories')){
        function s7upf_vc_tab_categories($attr, $content = false){
            $html = $css_class = '';
            $data_array = array_merge(array(
                'style'         => 'grid',
                'list_cats'     => '',
                'number'        => '8',
                'order_by'      => 'date',
                'order'         => 'DESC',
                'product_type'  => '',
                'column'        => '1',
                'row_number'    => '1',
                'gap'           => '',
                'pagination'    => '',
                'grid_type'     => '',
                'item_style'    => '',
                'item'          => '',
                'item_res'      => '',
                'speed'         => '',
                'slider_navi'   => '',
                'slider_pagi'   => '',
                'size'          => '',
                'animation'     => '',
                'el_class'      => '',
                'custom_css'    => '',
            ),s7upf_get_responsive_default_atts());
            $attr = shortcode_atts($data_array,$attr);
            extract($attr);
            $css_classes = vc_shortcode_custom_css_class( $custom_css );
            $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
            
            // Variable process vc_shortcodes_css_class
            if(!empty($css_class)) $el_class .= ' '.$css_class;
            $el_class .= ' product-'.$style.'-view ';
			
			if(isset($list_cats)) $data_cats = (array) vc_param_group_parse_atts( $list_cats );
			$size = s7upf_get_size_crop($size);
            
			$unit_id = uniqid();
			
			ob_start();
			?> 
			<div class="category-tab-ajax <?php echo esc_attr($el_class);?>"> 
				<ul class="list-inline-block title-cat-ajax">
					<?php
						if(is_array($data_cats)):
						foreach($data_cats as $key => $cats):
						$term = get_term_by('slug',$cats['cats'],'product_cat');
						$count = $term->count;
						if(empty($cats['title'])){
							$cat_name = $term->name;
						}else{
							$cat_name = $cats['title'];
						}
						if($key==0){
							$class_active = 'active';
						}else{
							$class_active = '';
						}
						$cat_id = $cats['cats'].'-'.$unit_id;
					?>
					<li class="<?php echo esc_attr($class_active);?>"><a href="#<?php echo esc_attr($cat_id);?>" data-toggle="tab"><span class="count white bg-color"><?php echo esc_html($count);?></span><i class="<?php echo esc_attr($cats['icon']);?>"></i><span class="cat-name white"><?php echo esc_html($cat_name);?></span></a></li>
					<?php endforeach;endif;?>
				</ul>
				<div class="tab-content">
					<?php 
						if(is_array($data_cats)):
						foreach($data_cats as $key => $cats):
						if($key==0){
							$class_active = 'active';
						}else{
							$class_active = '';
						}
						$cat_id = $cats['cats'].'-'.$unit_id;
						$paged = (get_query_var('paged') && $style != 'slider') ? get_query_var('paged') : 1;
						$args = array(
							'post_type'         => 'product',
							'posts_per_page'    => $number,
							'orderby'           => $order_by,
							'order'             => $order,
							'paged'             => $paged,
							);
						if($product_type == 'trending'){
							$args['meta_query'][] = array(
									'key'     => 'trending_product',
									'value'   => 'on',
									'compare' => '=',
								);
						}
						if($product_type == 'toprate'){
							$args['meta_key'] = '_wc_average_rating';
							$args['orderby'] = 'meta_value_num';
							$args['meta_query'] = WC()->query->get_meta_query();
							$args['tax_query'][] = WC()->query->get_tax_query();
						}
						if($product_type == 'mostview'){
							$args['meta_key'] = 'post_views';
							$args['orderby'] = 'meta_value_num';
						}
						if($product_type == 'menu_order'){
							$args['meta_key'] = 'menu_order';
							$args['orderby'] = 'meta_value_num';
						}
						if($product_type == 'bestsell'){
							$args['meta_key'] = 'total_sales';
							$args['orderby'] = 'meta_value_num';
						}
						if($product_type=='onsale'){
							$args['meta_query']['relation']= 'OR';
							$args['meta_query'][]=array(
								'key'   => '_sale_price',
								'value' => 0,
								'compare' => '>',                
								'type'          => 'numeric'
							);
							$args['meta_query'][]=array(
								'key'   => '_min_variation_sale_price',
								'value' => 0,
								'compare' => '>',                
								'type'          => 'numeric'
							);
						}
						if($product_type == 'featured'){
							$args['tax_query'][] = array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => 'featured',
								'operator' => 'IN',
							);
						}
						if(!empty($data_cats[$key]['cats'])){
							$args['tax_query'][]=array(
								'taxonomy'=>'product_cat',
								'field'=>'slug',
								'terms'=> $data_cats[$key]['cats']
							);
						}
						
						
						$product_query = new WP_Query($args);
						$count = 1;
						$count_query = $product_query->post_count;
						$max_page = $product_query->max_num_pages;
						$attr = array_merge($attr,array(
							'el_class'      => $el_class,
							'product_query' => $product_query,
							'count'         => $count,
							'count_query'   => $count_query,
							'max_page'      => $max_page,
							'args'          => $args,
							'size'          => $size,
							'gap'          => $gap,
						));
					?>
					<div id="<?php echo esc_attr($cat_id);?>" class="tab-pane <?php echo esc_attr($class_active);?>">
						<?php
							s7upf_get_template_element('tab-categories/'.$style,'',$attr,'true');
							wp_reset_postdata();
						?>
					</div>
					<?php endforeach;endif;?>
				</div>
			</div>
			<?php 
			$html = ob_get_clean();
            return $html;
        }
    }
stp_reg_shortcode('s7upf_tab_categories','s7upf_vc_tab_categories');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_list_tab_categories',10,100 );
if ( ! function_exists( 's7upf_add_list_tab_categories' ) ) {
    function s7upf_add_list_tab_categories(){
        $tab_id = 's7upf_'.uniqid();
        vc_map( array(
            "name"      => esc_html__("Tab Categories", 'druck'),
            "base"      => "s7upf_tab_categories",
            "icon"      => "icon-st",
            "category"      => esc_html__("7UP-Elements", 'druck'),
            "description"   => esc_html__( 'Display Tab product categories', 'druck' ),
            "params"    => array(   
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add Categories For Tab",'druck'),
					"param_name" => "list_cats",
					"params"    => array(
						array(
							'heading'     => esc_html__( 'Category', 'druck' ),
							'type'        => 'autocomplete',
							'param_name'  => 'cats',
							'settings' => array(
								'multiple' => false,
								'sortable' => false,
								'values' => s7upf_get_list_taxonomy(),
							),
							'save_always' => true,
							'description' => esc_html__( 'Add Tab categories', 'druck' ),
						),
						array(
							"type"          => "textfield",
							"heading"       => esc_html__("Category Title",'druck'),
							"param_name"    => "title",
						),
						array(  
							'type' => 'iconpicker' ,
							'heading' => esc_html__('Tab Icon', 'druck'),
							'param_name' => 'icon',
							'value' => '',
							'settings'      => array(
								'emptyIcon'     => true,
								'type'          => s7upf_default_icon_lib(),
								'iconsPerPage'  => 4000,
							),
							'description' =>  esc_html__( 'Select icon from Ion icon library.', 'druck' ),
						),
					),
				),
				
                array(
                    'heading'     => esc_html__( 'Style', 'druck' ),
                    "admin_label"   => true,
                    'type'        => 'dropdown',
                    'description' => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'  => 'style',
                    'value'       => array(                        
                        esc_html__('Grid','druck')      => 'grid',
                        esc_html__('Slider','druck')    => 'slider',
                        ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Number', 'druck' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 8.', 'druck' ),
                    'param_name'  => 'number',
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Product Type', 'druck' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'product_type',
                    'value' => array(
                        esc_html__('Default','druck')            => '',
                        esc_html__('Trending','druck')          => 'trending',
                        esc_html__('Featured Products','druck')  => 'featured',
                        esc_html__('Best Sellers','druck')       => 'bestsell',
                        esc_html__('On Sale','druck')            => 'onsale',
                        esc_html__('Top rate','druck')           => 'toprate',
                        esc_html__('Most view','druck')          => 'mostview',
                        esc_html__('Menu order','druck')         => 'menu_order',
                    ),
                    'description' => esc_html__( 'Select Product View Type', 'druck' ),
                ),
                
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Order By', 'druck' ),
                    'value' => s7upf_get_order_list(),
                    'param_name' => 'order_by',
                    'description' => esc_html__( 'Select Orderby Type ', 'druck' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ),
                array(
                    'heading'     => esc_html__( 'Order', 'druck' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'order',
                    'value' => array(                   
                        esc_html__('Desc','druck')  => 'DESC',
                        esc_html__('Asc','druck')  => 'ASC',
                    ),
                    'description' => esc_html__( 'Select Order Type ', 'druck' ),
                    'edit_field_class'=>'vc_col-sm-6 vc_column',
                ), 
                array(
                    'heading'       => esc_html__( 'Product style', 'druck' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'    => 'item_style',
                    'value'         => s7upf_get_product_style(),
                ),
                array(
                    'heading'     => esc_html__( 'Gap products', 'druck' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'gap',
                    'value' => array(                   
                        esc_html__('Default','druck')  => '',
                        esc_html__('0px','druck')   => 'gap-0',
                        esc_html__('5px','druck')   => 'gap-5',
                        esc_html__('10px','druck')  => 'gap-10',
                        esc_html__('15px','druck')  => 'gap-15',
                        esc_html__('20px','druck')  => 'gap-20',
                        esc_html__('30px','druck')  => 'gap-30',
                        esc_html__('40px','druck')  => 'gap-40',
                        esc_html__('50px','druck')  => 'gap-50',
                    ),
                    'description' => esc_html__( 'Select space for products.', 'druck' ),
					"dependency"    =>  array(
                        "element"       => "style",
                        "value"         => array('grid','slider'),
                    ),
                ),              
                array(
                    'heading'     => esc_html__( 'Grid style', 'druck' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'grid_type',
                    'value' => array(                   
                        esc_html__('Default','druck')  => '',
                        esc_html__('Masonry','druck')  => 'list-masonry',
                    ),
                    'description' => esc_html__( 'Select Column display ', 'druck' ),
                    "group"         => esc_html__("Grid Settings",'druck'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),  
                array(
                    'heading'     => esc_html__( 'Column', 'druck' ),
                    'type'        => 'dropdown',
                    'param_name'  => 'column',
                    'value' => array(                   
                        esc_html__('1 columns','druck')  => '1',
                        esc_html__('2 columns','druck')  => '2',
                        esc_html__('3 columns','druck')  => '3',
                        esc_html__('4 columns','druck')  => '4',
                        esc_html__('5 columns','druck')  => '5',
                        esc_html__('6 columns','druck')  => '6',
                        esc_html__('7 columns','druck')  => '7',
                        esc_html__('8 columns','druck')  => '8',
                        esc_html__('9 columns','druck')  => '9',
                        esc_html__('10 columns','druck')  => '10',
                    ),
                    'description' => esc_html__( 'Select Column display ', 'druck' ),
                    "group"         => esc_html__("Grid Settings",'druck'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),                
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Pagination",'druck'),
                    "param_name"    => "pagination",
                    "value"         => array(
                        esc_html__("None",'druck')                => '',
                        esc_html__("Pagination",'druck')          => 'pagination',
                        esc_html__("Load more button",'druck')    => 'load-more',
                        ),
                    'group'         => esc_html__('Grid Settings','druck'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "grid",
                    ),
                ),              
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail",'druck'),
                    "param_name"    => "size",
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height), for multi size: 200x100|200x200 separate by "|" or ",").', 'druck' ),
                ),
                array(
                    'heading'       => esc_html__( 'Thumbnail animation', 'druck' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'    => 'animation',
                    'value'         => s7upf_get_product_thumb_animation(),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item",'druck'),
                    "param_name"    => "item",
                    "group"         => esc_html__("Slider Settings",'druck'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Item Responsive",'druck'),
                    "param_name"    => "item_res",
                    "group"         => esc_html__("Slider Settings",'druck'),
                    'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'druck' ),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Speed",'druck'),
                    "param_name"    => "speed",
                    "group"         => esc_html__("Slider Settings",'druck'), 
                    'description'   => esc_html__( 'Enter number speed to auto slider (ms). Example is 5000. Default auto is disable.', 'druck' ),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),                   
                ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Row / item slider",'druck'),
                    "param_name"    => "row_number",
                    'value' => array(                   
                        esc_html__('1 row','druck')  => '1',
                        esc_html__('2 rows','druck')  => '2',
                        esc_html__('3 rows','druck')  => '3',
                        esc_html__('4 rows','druck')  => '4',
                        esc_html__('5 rows','druck')  => '5',
                        esc_html__('6 rows','druck')  => '6',
                        esc_html__('7 rows','druck')  => '7',
                        esc_html__('8 rows','druck')  => '8',
                        esc_html__('9 rows','druck')  => '9',
                        esc_html__('10 rows','druck')  => '10',
                    ),
                    'description'   => esc_html__( 'Choose number row to display', 'druck' ),
                    "group"         => esc_html__("Slider Settings",'druck'),
                    "dependency"    =>  array(
                        "element"       => "style",
                        "value"         => "slider",
                    ),  
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Navigation', 'druck' ),
                    'param_name'  => 'slider_navi',
                    'value'       => array(
                        esc_html__( 'Hidden', 'druck' )                  => '',
                        esc_html__( 'Default Navigation', 'druck' )      => 'navi-nav-style',
                        esc_html__( 'Group Navigation', 'druck' )        => 'group-navi',
                    ),
                    "group"         => esc_html__("Slider Settings",'druck'),
                        "dependency"    =>  array(
                            "element"       => "style",
                            "value"         => "slider",
                        ), 
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Pagination', 'druck' ),
                    'param_name'  => 'slider_pagi',
                    'value'       => array(
                        esc_html__( 'Hidden', 'druck' )                  => '',
                        esc_html__( 'Default Pagination', 'druck' )      => 'pagi-nav-style',
                    ),
                    "group"         => esc_html__("Slider Settings",'druck'),
					"dependency"    =>  array(
						"element"       => "style",
						"value"         => "slider",
					), 
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name",'druck'),
                    "param_name"    => "el_class",
                    'group'         => esc_html__('Design Options','druck'),
                    'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'druck' )
                ),
                array(
                    "type"          => "css_editor",
                    "heading"       => esc_html__("CSS box",'druck'),
                    "param_name"    => "custom_css",
                    'group'         => esc_html__('Design Options','druck')
                ),
            )
        ));
    }
}
}