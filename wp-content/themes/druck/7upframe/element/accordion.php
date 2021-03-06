<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_accordion'))
{
    function s7upf_vc_accordion($attr, $content = false)
    {
        $html = $list_html = $css_class = $el_class = '';
        $data_array = array_merge(array(
            'style'          => 'default-accordion',
            'list'           => '',
            'class_extra'    => '',
			'custom_css'     => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		$el_class = $style.' '.$css_class.' '.$class_extra;
		$data = (array) vc_param_group_parse_atts( $list );
		
		switch ($style) {
			case 'service-accordion':        
                if(is_array($data)){
					if(is_array($data)){
						foreach ($data as $key => $value) {
							$active="";
							if($key==0){$active="active";}
							$list_html .=   '<div class="item-toggle-tab '.$active.'">
												<div class="toggle-tab-title">
													<i class="title30 color '.esc_attr($value['icon']).'"></i>
													<h3 class="title18 text-uppercase sans-font">'.esc_html($value['title']).'</h3>
													<p class="desc silver">'.esc_html($value['sub_title']).'</p>
												</div>
												<div class="toggle-tab-content">
													<p class="desc">'.esc_html($value['desc']).'</p>
												</div>
											</div>';
						}
					}
					$html .=    	'<div class="toggle-tab '.$el_class.'">';
					$html .=       		 $list_html;
					$html .=    	'</div>';
                }
			break;
			
            case 'question-accordion':        
                if(is_array($data)){
					if(is_array($data)){
						foreach ($data as $key => $value) {
							$active="";
							if($key==0){$active="active";}
							$list_html .=   '<div class="item-toggle-tab '.$active.'">
												<div class="toggle-tab-title">
													<h3 class="title14 text-uppercase sans-font">'.esc_html($value['title']).'</h3>
												</div>
												<div class="toggle-tab-content">
													<p class="desc">'.esc_html($value['desc']).'</p>
												</div>
											</div>';
						}
					}
					$html .=    	'<div class="toggle-tab '.$el_class.'">';
					$html .=       		 $list_html;
					$html .=    	'</div>';
                }
			break;
			
            default:        
                if(is_array($data)){
					if(is_array($data)){
						foreach ($data as $key => $value) {
							$active="";
							if($key==0){$active="active";}
							$list_html .=   '<div class="item-toggle-tab '.$active.'">
												<div class="toggle-tab-title">
													<h3 class="title18 text-uppercase dark sans-font">'.esc_html($value['title']).'</h3>
												</div>
												<div class="toggle-tab-content">
													<p class="desc">'.esc_html($value['desc']).'</p>
												</div>
											</div>';
						}
					}
					$html .=    	'<div class="toggle-tab '.$el_class.'">';
					$html .=       		 $list_html;
					$html .=    	'</div>';
                }
			break;
        }
        return $html;
    }
}

stp_reg_shortcode('sv_accordion','s7upf_vc_accordion');

if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_accordion',10,100 );
if ( ! function_exists( 's7upf_add_accordion' ) ) {
	function s7upf_add_accordion(){
		vc_map( array(
			"name"      => esc_html__("Accordion", 'druck'),
			"base"      => "sv_accordion",
			"icon"      => "icon-st",
			"category"  => esc_html__("7UP-Elements", 'druck'),
			"params"    => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Style', 'druck' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__('Default','druck')=>'default-accordion',
						esc_html__('Question','druck')=>'question-accordion',
						esc_html__('Service','druck')=>'service-accordion',
					),
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add List Accordion",'druck'),
					"param_name" => "list",
					"params"    => array(
						array(  
							'type' => 'iconpicker' ,
							'heading' => esc_html__('Icon', 'druck'),
							'param_name' => 'icon',
							'value' => '', // default value to backend editor admin_label
							'settings'      => array(
								'emptyIcon'     => true,
								'type'          => s7upf_default_icon_lib(),
								'iconsPerPage'  => 4000,
							),
							'description' =>  esc_html__( 'Select icon from Ion icon library.(Only show on style:Service )', 'druck' ),
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__("Title",'druck'),
							"param_name" => "title",
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__("Sub Title",'druck'),
							"param_name" => "sub_title",
							'description' =>  esc_html__( 'Only show on style:Service', 'druck' ),
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__("Content",'druck'),
							"param_name" => "desc",
						),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Class Extra', 'druck' ),
					'param_name' => 'class_extra',
					'group' => esc_html__( 'Design options', 'druck' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Custom Style', 'druck' ),
					'param_name' => 'custom_css',
					'group' => esc_html__( 'Design options', 'druck' ),
				),
			)
		));
	}
}