<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_mega_list_page'))
{
    function s7upf_vc_mega_list_page($attr)
    {
        $html = '';
        extract(shortcode_atts(array(
            'title'         => '',
            'list'          => '',
        ),$attr));
        $html .=    '<div class="mega-list-page widget">';
        if(!empty($title)) $html .= '<h2 class="widget-title title-first-letter">'.esc_html($title).'</h2>';
        if(!empty($list)){
			$data_list  = (array) vc_param_group_parse_atts( $list );
            $html .=    '<ul class="list-none">';
            if(is_array($data_list)){
                foreach ($data_list as $key => $value) {
					if(!empty($value['page_id'])){
						if(!empty($value['page_title'])){
							$title = $value['page_title'];
						}else{
							$title = get_the_title($value['page_id']);
						}
                        $custom_class ="";
						if(!empty($value['custom_class'])){
						    $custom_class = $value['custom_class'];
                        }else{
                            $custom_class = "";
                        }
						$html .=    '<li class="'.esc_attr($custom_class).'"><a href="'.get_the_permalink($value['page_id']).'">'.esc_html($title).'</a></li>';
					}
				}
            }
            $html .=    '</ul>';
        }
        $html .=    '</div>';
        return $html;
    }
}

stp_reg_shortcode('s7upf_mega_list_page','s7upf_vc_mega_list_page');

vc_map( array(
    "name"      => esc_html__("Mega List Pages", 'druck'),
    "base"      => "s7upf_mega_list_page",
    "icon"      => "icon-st",
    "category"      => esc_html__("7UP-Elements", 'druck'),
    "description"   => esc_html__( 'Display list of page', 'druck' ),
    "params"    => array(
        array(
            "type" => "textfield",
            "admin_label"   => true,
            "heading" => esc_html__("Title",'druck'),
            "param_name" => "title",
        ),
        array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item",'druck'),
            "param_name" => "list",
            "params"    => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Page Title",'druck'),
                    "param_name" => "page_title",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Page ID",'druck'),
                    "param_name" => "page_id",
					'description'   => esc_html__( 'Enter Page/Post/Product ID.', 'druck' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Custom class",'druck'),
                    "param_name" => "custom_class",
                    'description'   => esc_html__( 'Enter element custom class.', 'druck' ),
                ),
            ),
        ),
    )
));