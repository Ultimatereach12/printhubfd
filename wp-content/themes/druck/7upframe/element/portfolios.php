<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_portfolios')){
	function s7upf_vc_portfolios($attr, $content = false){
		$html = $css_class = '';
		$data_array = array_merge(array(
			'style'         => 'grid',
			'number'        => '8',
			'cats'          => '',
			'order_by'      => 'date',
			'order'         => 'DESC',
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
			'excerpt'       => '',
			'animation'     => '',
			'el_class'      => '',
			'custom_css'    => '',
			'custom_ids'    => '',
		),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		$el_class .= ' portfolio-'.$style.'-view '.$grid_type.' '.$style.' '.$css_class;
		$paged = (get_query_var('paged') && $style != 'slider') ? get_query_var('paged') : 1;
		$args = array(
			'post_type'         => 'portfolio',
			'posts_per_page'    => $number,
			'orderby'           => $order_by,
			'order'             => $order,
			'paged'             => $paged,
			);
		if(!empty($cats)) {
			$custom_list = explode(",",$cats);
			$args['tax_query'][]=array(
				'taxonomy'=>'portfolio_cat',
				'field'=>'slug',
				'terms'=> $custom_list
			);
		}
		if(!empty($custom_ids)){
			$args['post__in'] = explode(',', $custom_ids);
		}
		$portfolio_query = new WP_Query($args);
		$count = 1;
		$count_query = $portfolio_query->post_count;
		$max_page = $portfolio_query->max_num_pages;
		$size = s7upf_get_size_crop($size);
		if($gap != '') $el_class .= ' '.$gap;
		$attr = array_merge($attr,array(
			'el_class'      => $el_class,
			'portfolio_query' => $portfolio_query,
			'count'         => $count,
			'count_query'   => $count_query,
			'max_page'      => $max_page,
			'args'          => $args,
			'size'          => $size,
			'excerpt'       => $excerpt,
		));
		$html = s7upf_get_template_element('portfolios/'.$style,'',$attr);
		wp_reset_postdata();
		return $html;
	}
}
stp_reg_shortcode('s7upf_portfolios','s7upf_vc_portfolios');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_list_portfolio',10,100 );
if ( ! function_exists( 's7upf_add_list_portfolio' ) ) {
	function s7upf_add_list_portfolio(){
		$tab_id = 's7upf_'.uniqid();
		vc_map( array(
			"name"      => esc_html__("Portfolios", 'druck'),
			"base"      => "s7upf_portfolios",
			"icon"      => "icon-st",
			"category"      => esc_html__("7UP-Elements", 'druck'),
			"description"   => esc_html__( 'Display list of portfolio', 'druck' ),
			"params"    => array(                
				array(
					'type'        => 'textfield',
					"admin_label"   => true,
					'heading'     => esc_html__( 'Title', 'druck' ),
					'param_name'  => 'title',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Description', 'druck' ),
					'param_name'  => 'des',
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
					'description' => esc_html__( 'Enter number of portfolio. Default is 8.', 'druck' ),
					'param_name'  => 'number',
					'edit_field_class'=>'vc_col-sm-6 vc_column',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Custom IDs', 'druck' ),
					'param_name'  => 'custom_ids',
					'description' => esc_html__( 'Enter list ID. Separate values by ",". Example is 12,15,20', 'druck' ),
				),
				array(
					'heading'     => esc_html__( 'Portfolio Categories', 'druck' ),
					'type'        => 'autocomplete',
					'param_name'  => 'cats',
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'values' => s7upf_get_list_taxonomy('portfolio_cat'),
					),
					'save_always' => true,
					'description' => esc_html__( 'List of portfolio categories', 'druck' ),
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
					'heading'       => esc_html__( 'Portfolio style', 'druck' ),
					'type'          => 'dropdown',
					'description'   => esc_html__( 'Choose style to display.', 'druck' ),
					'param_name'    => 'item_style',
					'value'         => s7upf_get_portfolio_style(),
				),
				array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Grid Sub string excerpt",'druck'),
                    "param_name"    => "excerpt",
                    'description'   => esc_html__( 'Enter number of character want to get from excerpt content. Default is 0(hidden). Example is 80. Note: This value only apply for items style can be show excerpt.', 'druck' ),
					"dependency"    =>  array(
						"element"       => "item_style",
						"value"         => "popup",
					),
			   ),
				array(
					'heading'     => esc_html__( 'Gap Portfolios', 'druck' ),
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
					'description' => esc_html__( 'Select space for Portfolios.', 'druck' ),
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