<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */
if(class_exists("woocommerce")){
if(!function_exists('s7upf_vc_shop')){
    function s7upf_vc_shop($attr){
        $html = $css_class = '';
        $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        if($order_default == 'menu_order') $order_default = $order_default.' title';
        $data_array = array_merge(array(
            'style'         => 'list',
            'number'        => '12',
            'cats'          => '',
            'orderby'       => $order_default,
            'size'          => '',
            'size_list'     => '',
            'item_style'    => '',
            'item_style_list' => '',
            'grid_type'     => '',
            'shop_style'    => '',
            'check_type'    => 'on',
            'check_number'  => 'on',
            'filter_extra'  => '',
			'filter_sidebar'   => '',
            'el_class'      => '',
            'custom_css'    => '',
            'animation'     => '',
            'shop_ajax'     => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        $el_class .= ' product-'.$style.'-view '.$grid_type;
		switch($style){
			case 'grid-2-col':
				$column = 2;
			break;
			case 'grid-3-col':
				$column = 3;
			break;
			case 'grid-4-col':
				$column = 4;
			break;
			default:
				$column = 1;
			break;
		}
        if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];
		if(isset($_GET['type'])) {
			$style = $_GET['type'];
			switch($style){
				case 'grid-2-col':
					$column = 2;
				break;
				case 'grid-3-col':
					$column = 3;
				break;
				case 'grid-4-col':
					$column = 4;
				break;
				default:
					$column = 1;
				break;
			}
		}
        if(isset($_GET['number'])) $number = $_GET['number'];
        $size = s7upf_get_size_crop($size);
        $size_list = s7upf_get_size_crop($size_list);
        $attr = array_merge($attr,array(
            'style'     => $style,
            'column'     => $column,
            'size'      => $size,
            'size_list' => $size_list,
            'number'    => $number,
            ));
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type'         => 'product',
            'order'             => 'ASC',
            'posts_per_page'    => $number,
            'paged'             => $paged,
            );
        $attr_taxquery = array();
        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
        if(!empty($_chosen_attributes) && is_array($_chosen_attributes)){
            $attr_taxquery = array('relation ' => 'AND');
            foreach ($_chosen_attributes as $key => $value) {
                $attr_taxquery[] =  array(
                                    'taxonomy'      => $key,
                                    'terms'         => $value['terms'],
                                    'field'         => 'slug',
                                    'operator'      => 'IN'
                                );
            }            
        }
        if(isset( $_GET['product_cat'])) $cats = $_GET['product_cat'];
        if(!empty($cats)) {
            $cats = explode(",",$cats);
            $attr_taxquery[]=array(
                'taxonomy'=>'product_cat',
                'field'=>'slug',
                'terms'=> $cats
            );
        }
        if (!empty($attr_taxquery)){
            $attr_taxquery['relation'] = 'AND';
            $args['tax_query'] = $attr_taxquery;
        }
        if( isset( $_GET['min_price']) && isset( $_GET['max_price']) ){
            $min = $_GET['min_price'];
            $max = $_GET['max_price'];
            $args['post__in'] = s7upf_filter_price($min,$max);
        }
        switch ($orderby) {
            case 'price' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'ASC';
                $args['meta_key'] = '_price';
            break;

            case 'price-desc' :
                $args['orderby']  = "meta_value_num ID";
                $args['order']    = 'DESC';
                $args['meta_key'] = '_price';
            break;

            case 'popularity' :
                $args['meta_key'] = 'total_sales';                        
                $args['order']    = 'DESC';
            break;

            case 'rating' :
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby'] = 'meta_value_num';
                $args['order']    = 'DESC';
            break;

            case 'date':
                $args['orderby'] = 'date';
                $args['order']    = 'DESC';
                break;
            
            default:
                $args['orderby'] = $order_default;
                break;
        }
        $html .= s7upf_get_template('top-filter','',array('style'=>$style,'number'=>$number,'check_number'=>$check_number,'check_type'=>$check_type,'filter_sidebar'   => $filter_sidebar,'filter_extra'   => $filter_extra,'check_order'=>true),false);
		switch($style){
			case 'grid-2-col':
				$style = 'grid';
			break;
			case 'grid-3-col':
				$style = 'grid';
			break;
			case 'grid-4-col':
				$style = 'grid';
			break;
			default:
				$style = 'list';
			break;
		}
        $attr_ajax = array(
                'item_style'    => $item_style,
                'item_style_list'=> $item_style_list,
                'column'        => $column,
                'size'          => $size,
                'size_list'     => $size_list,
                'shop_style'    => $shop_style,
                'number'        => $number,
                'animation'     => $animation,
                'cats'          => $cats,
                );
            $data_ajax = array(
                "attr"        => $attr_ajax,
                );
            $data_ajax = json_encode($data_ajax);
        $html .=    '<div class="'.esc_attr($el_class).' products-wrap js-content-wrap" data-load="'.esc_attr($data_ajax).'">
                        <div class="products row list-product-wrap js-content-main">';
        $product_query = new WP_Query($args);
        $max_page = $product_query->max_num_pages;
        $slug = $item_style;
        if($style == 'list') $slug = $item_style_list;
        if($product_query->have_posts()) {
            while($product_query->have_posts()) {
                $product_query->the_post();
                $html .= s7upf_get_template_woocommerce('loop/'.$style.'/'.$style,$slug,$attr,false);
            }
        }
        $html .=    '</div>';
        if($shop_style == 'load-more' && $max_page > 1){
            $data_load = array(
                "args"        => $args,
                "attr"        => $attr,
                );
            $data_loadjs = json_encode($data_load);
            $html .=    '<div class="btn-loadmore text-uppercase">
                            <a href="#" class="product-loadmore shop-button large curl-top-right" 
                                data-load="'.esc_attr($data_loadjs).'" data-paged="1" 
                                data-maxpage="'.esc_attr($max_page).'">
                                '.esc_html__("Load more","druck").'
                            </a>
                        </div>';
        }
        else $html .= s7upf_get_template_woocommerce('loop/pagination','',array('wp_query'=>$product_query),false);
        $html .=    '</div>';        
        wp_reset_postdata();
        return $html;
    }
}

stp_reg_shortcode('s7upf_shop','s7upf_vc_shop');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_admin_shop',10,100 );
if ( ! function_exists( 's7upf_admin_shop' ) ) {
    function s7upf_admin_shop(){
        $order_default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
        if($order_default == 'menu_order') $order_default = $order_default.' title';
        vc_map( array(
            "name"      => esc_html__("Shop", 'druck'),
            "base"      => "s7upf_shop",
            "icon"      => "icon-st",
            "category"      => esc_html__("7UP-Elements", 'druck'),
            "description"   => esc_html__( 'Display shop page', 'druck' ),
            "params"    => array(
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Active Style",'druck'),
                    "param_name"    => "style",
                    "value"         => array(
                        esc_html__("List",'druck')   => 'list',
                        esc_html__("Grid 2 Column",'druck')   => 'grid-2-col',
                        esc_html__("Grid 3 Column",'druck')   => 'grid-3-col',
                        esc_html__("Grid 4 Column",'druck')   => 'grid-4-col',
                        ),
                    ),
                array(
                    "type"          => "dropdown",
                    "admin_label"   => true,
                    "heading"       => esc_html__("Shop ajax",'druck'),
                    "param_name"    => "shop_ajax",
                    "value"         => array(
                        esc_html__("Off",'druck')   => '',
                        esc_html__("On",'druck')   => 'on',
                        ),
                    ),
                array(
                    'heading'     => esc_html__( 'Number', 'druck' ),
                    'type'        => 'textfield',
                    'description' => esc_html__( 'Enter number of product. Default is 12.', 'druck' ),
                    'param_name'  => 'number',
                    ),                
                array(
                    'heading'     => esc_html__( 'Product Categories', 'druck' ),
                    'type'        => 'autocomplete',
                    'param_name'  => 'cats',
                    'settings' => array(
                        'multiple' => true,
                        'sortable' => true,
                        'values' => s7upf_get_list_taxonomy(),
                    ),
                    'save_always' => true,
                    'description' => esc_html__( 'List of product categories', 'druck' ),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order By",'druck'),
                    "param_name" => "orderby",
                    "value"         => array(
                        esc_html__( 'Default sorting', 'druck' )          => $order_default,
                        esc_html__( 'Popularity (sales)', 'druck' )       => 'popularity',
                        esc_html__( 'Average Rating', 'druck' )           => 'rating',
                        esc_html__( 'Sort by most recent', 'druck' )      =>'date',
                        esc_html__( 'Sort by price (asc)', 'druck' )      => 'price',
                        esc_html__( 'Sort by price (desc)', 'druck' )     =>'price-desc',
                        ),
                    ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail(List)",'druck'),
                    "param_name"    => "size_list",
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'druck' ),
                    ),
                array(
                    'heading'       => esc_html__( 'Thumbnail animation', 'druck' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'    => 'animation',
                    'value'         => s7upf_get_product_thumb_animation(),
                    ),
                array(
                    'heading'       => esc_html__( 'List item style', 'druck' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'    => 'item_style_list',
                    'value'         => s7upf_get_product_list_style(),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show type filter",'druck'),
                    "param_name"    => "check_type",
                    "value"         => array(
                        esc_html__("On",'druck')   => 'on',
                        esc_html__("Off",'druck')   => 'off',
                        ),
                    'description'   => esc_html__( 'Show/hide type filter(list/grid) on blog page.', 'druck' ),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Show number filter",'druck'),
                    "param_name"    => "check_number",
                    "value"         => array(
                        esc_html__("On",'druck')   => 'on',
                        esc_html__("Off",'druck')   => 'off',
                        ),
                    'description'   => esc_html__( 'Show/hide number filter on blog page.', 'druck' ),
                    ),
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Shop Display",'druck'),
                    "param_name"    => "shop_style",
                    "value"         => array(
                        esc_html__("Default",'druck')             => '',
                        esc_html__("Load more button",'druck')    => 'load-more',
                        ),
                    ),  
				array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Filter Extra",'druck'),
                    "param_name"    => "filter_extra",
                    "value"         => array(
                        esc_html__("None",'druck')   => '',
                        esc_html__("Sidebar",'druck')   => 'sidebar',
                        esc_html__("Dropdown",'druck')   => 'dropdown',
                        ),
                    'description'   => esc_html__( 'Select filter extra style.', 'druck' ),
                    ),
				array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__( 'Select Sidebar', 'druck' ),
                    'param_name'  => 'filter_sidebar',
                    'value'       => s7upf_vc_sidebar_ids(),
                    "dependency"    =>  array(
                        "element"       => "filter_extra",
                        "value"         => array("sidebar","dropdown"),
                    ),
                ), 
                array(
                    "type"          => "dropdown",
                    "heading"       => esc_html__("Grid Display",'druck'),
                    "param_name"    => "grid_type",
                    "value"         => array(
                        esc_html__("Default",'druck')   => '',
                        esc_html__("Masonry",'druck')   => 'list-masonry',
                        ),
                    'group'         => esc_html__('Grid Settings','druck'),
                    ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Size Thumbnail(Grid)",'druck'),
                    "param_name"    => "size",
                    'group'         => esc_html__('Grid Settings','druck'),
                    'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height), for multi size: 200x100|200x200 separate by "|" or ",").', 'druck' ),
                    ),
                array(
                    'heading'       => esc_html__( 'Grid item style', 'druck' ),
                    'type'          => 'dropdown',
                    'description'   => esc_html__( 'Choose style to display.', 'druck' ),
                    'param_name'    => 'item_style',
                    'value'         => s7upf_get_product_style(),            
                    'group'         => esc_html__('Grid Settings','druck'),
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
                ),        
        ));
    }
}
}
