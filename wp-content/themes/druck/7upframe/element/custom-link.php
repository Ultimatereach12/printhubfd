<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_custom_link'))
{
    function s7upf_vc_custom_link($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'custom-link-text',
            'display'       => 'list-none',
            'effect'        => '',
            'list_text'     => '',
            'list_image'    => '',
            'list_icon'     => '',
			'el_class'   => '',
			'custom_css'    => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		$el_class .= ' '.$style.' '.$display.' '.$css_class;
		switch($style){
			
			case 'custom-link-icon':
				$data_icon  = (array) vc_param_group_parse_atts( $list_icon );
				$html .=    '<ul class="'.esc_attr($el_class).'">';
				if(is_array($data_icon)){
					foreach ($data_icon as $key => $value){
						if(!empty($value['link'])) {
							$html .= '<li><a class="'.esc_attr($effect).' '.esc_attr($value['style']).' '.esc_attr($value['icon_color']).' '.esc_attr($value['bg_color']).'" href="'.esc_url($value['link']).'">';
								if(!empty($value['icon'])) {
									$html .= '<i class="'.esc_attr($value['icon']).'"></i>';
								}
							$html .= '</a></li>';
						}
					}
				}
				$html .=    '</ul>';  
			break;
			
			case 'custom-link-image':
				$data_image = (array) vc_param_group_parse_atts( $list_image );
				$html .=    '<ul class="'.esc_attr($el_class).'">';
				if(is_array($data_image)){
					foreach ($data_image as $key => $value){
						if(!empty($value['size'])) {
							$size = explode('x', $value['size']);
						}else {
							$size = 'full';
						}
						if(!empty($value['link'])) {
							$html .= '<li><a class="'.esc_attr($effect).' '.esc_attr($value['style']).'" href="'.esc_url($value['link']).'">';
								if(!empty($value['image'])) {
									$html .= wp_get_attachment_image($value['image'],$size);
								}
							$html .= '</a></li>';
						}
					}
				}
				$html .=    	'</ul>';   
			break;
			
			default:
				$data_text  = (array) vc_param_group_parse_atts( $list_text );
				$html .=    '<ul class="'.esc_attr($el_class).'">';
				if(is_array($data_text)){
					foreach ($data_text as $key => $value){
						if(!empty($value['link'])) {
							$html .= '<li><a class="'.esc_attr($effect).' '.$value['style'].' '.$value['text_color'].' '.$value['bg_color'].'" href="'.esc_url($value['link']).'">';
								$html .= esc_html($value['text']);
							$html .= '</a></li>';
						}
					}
				}
				$html .=    '</ul>';   
			break;
		}
		return  $html;
    }
}

stp_reg_shortcode('sv_custom_link','s7upf_vc_custom_link');


vc_map( array(
    "name"      => esc_html__("Custom Link", 'druck'),
    "base"      => "sv_custom_link",
    "icon"      => "icon-st",
    "category"  => '7UP-Elements',
    "params"    => array(
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => esc_html__( 'Style', 'druck' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__('Link Text','druck')=>'custom-link-text',
				esc_html__('Link Icon','druck')=>'custom-link-icon',
				esc_html__('Link Image','druck')=>'custom-link-image',
			),
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => esc_html__( 'Display', 'druck' ),
			'param_name' => 'display',
			'value' => array(
				esc_html__('Block','druck')=>'list-none',
				esc_html__('Inline','druck')=>'list-inline-block',
			),
		),
		array(
			'type' => 'dropdown',
			'admin_label' => true,
			'heading' => esc_html__( 'Hover Effect', 'druck' ),
			'param_name' => 'effect',
			'value' => array(
				esc_html__('Default','druck')=>'',
				esc_html__('Grow','druck')=>'grow',
				esc_html__('Shrink','druck')=>'shrink',
				esc_html__('Pulse','druck')=>'pulse',
				esc_html__('Pulse Grow','druck')=>'pulse-grow',
				esc_html__('Pulse Shrink','druck')=>'pulse-shrink',
				esc_html__('Push','druck')=>'push',
				esc_html__('Pop','druck')=>'pop',
				esc_html__('Rotate','druck')=>'rotate',
				esc_html__('Grow Rotate','druck')=>'grow-rotate',
				esc_html__('Float','druck')=>'float',
				esc_html__('Sink','druck')=>'sink',
				esc_html__('Hover','druck')=>'hover',
				esc_html__('Hang','druck')=>'hang',
				esc_html__('Skew','druck')=>'skew',
				esc_html__('Skew Forward','druck')=>'skew-forward',
				esc_html__('Skew Backward','druck')=>'skew-backward',
				esc_html__('Wobble Horizontal','druck')=>'wobble-horizontal',
				esc_html__('Wobble Vertical','druck')=>'wobble-vertical',
				esc_html__('Wobble To Bottom Right','druck')=>'wobble-to-bottom-right',
				esc_html__('Wobble To Top Right','druck')=>'wobble-to-top-right',
				esc_html__('Wobble Top','druck')=>'wobble-top',
				esc_html__('Wobble Bottom','druck')=>'wobble-bottom',
				esc_html__('Wobble Skew','druck')=>'wobble-skew',
				esc_html__('Buzz','druck')=>'buzz',
				esc_html__('Buzz Out','druck')=>'buzz-out',
				esc_html__('Float Shadow','druck')=>'float-shadow',
				esc_html__('Hover Shadow','druck')=>'hover-shadow',
				esc_html__('Curl Top Left','druck')=>'curl-top-left',
				esc_html__('Curl Top Right','druck')=>'curl-top-right',
				esc_html__('Curl Bottom Left','druck')=>'curl-bottom-left',
				esc_html__('Curl Bottom Right','druck')=>'curl-bottom-right',
			),
		),
		array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item",'druck'),
            "param_name" => "list_text",
            "params"    => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Style', 'druck' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__('Default','druck')=>'default',
						esc_html__('Button','druck')=>'shop-button',
						esc_html__('Button Color','druck')=>'shop-button bg-color',
						esc_html__('Button Large','druck')=>'shop-button large',
						esc_html__('Button Large Color','druck')=>'shop-button large bg-color',
					),
				),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Text",'druck'),
                    "param_name" => "text",
                ),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link",'druck'),
                    "param_name" => "link",
                ),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Text Color', 'druck' ),
					'param_name' => 'text_color',
					'value' => array(
						esc_html__('Default','druck')=>'gray',
						esc_html__('White','druck')=>'white',
						esc_html__('Black','druck')=>'black',
						esc_html__('Dark','druck')=>'dark',
						esc_html__('Silver','druck')=>'silver',
						esc_html__('Smoke','druck')=>'smoke',
						esc_html__('Main Color','druck')=>'color',
					),
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Background Color', 'druck' ),
					'param_name' => 'bg_color',
					'value' => array(
						esc_html__('Default','druck')=>'transparent',
						esc_html__('White','druck')=>'bg-white',
						esc_html__('Black','druck')=>'bg-black',
						esc_html__('Dark','druck')=>'bg-dark',
						esc_html__('Main Color','druck')=>'bg-color',
					),
				),
            ),
			"dependency"    =>array(
					'element'   =>'style',
					'value'     =>array('custom-link-text')
				),
        ),
		array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item",'druck'),
            "param_name" => "list_image",
            "params"    => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Style', 'druck' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__('Default','druck')=>'default',
					),
				),
                array(
                    "type" => "attach_image",
                    "heading" => esc_html__("Image",'druck'),
                    "param_name" => "image",
                ),
				array(
					"type"          => "textfield",
					"heading"       => esc_html__("Image Size",'druck'),
					"param_name"    => "size",
					'description'   => esc_html__( 'Enter image size. Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'druck' ),
				),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link",'druck'),
                    "param_name" => "link",
                ),
            ),
			"dependency"    =>array(
					'element'   =>'style',
					'value'     =>array('custom-link-image')
				),
        ),
		array(
            "type" => "param_group",
            "heading" => esc_html__("Add List Item",'druck'),
            "param_name" => "list_icon",
            "params"    => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Style', 'druck' ),
					'param_name' => 'style',
					'value' => array(
						esc_html__('Default','druck')=>'default',
					),
				),
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
					'description' =>  esc_html__( 'Select icon from icon library.', 'druck' ),
				),
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Link",'druck'),
                    "param_name" => "link",
                ),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Icon Color', 'druck' ),
					'param_name' => 'icon_color',
					'value' => array(
						esc_html__('Default','druck')=>'gray',
						esc_html__('White','druck')=>'white',
						esc_html__('Black','druck')=>'black',
						esc_html__('Dark','druck')=>'dark',
						esc_html__('Silver','druck')=>'silver',
						esc_html__('Smoke','druck')=>'smoke',
						esc_html__('Main Color','druck')=>'color',
					),
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__( 'Background Color', 'druck' ),
					'param_name' => 'bg_color',
					'value' => array(
						esc_html__('Default','druck')=>'transparent',
						esc_html__('White','druck')=>'bg-white',
						esc_html__('Black','druck')=>'bg-black',
						esc_html__('Dark','druck')=>'bg-dark',
						esc_html__('Main Color','druck')=>'bg-color',
					),
				),
            ),
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('custom-link-icon')
			),
        ),
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Class Extra', 'druck' ),
			'param_name'  => 'el_class',
			'group'         => esc_html__('Design Option','druck')
		),
		array(
			"type"          => "css_editor",
			"heading"       => esc_html__("Custom Style",'druck'),
			"param_name"    => "custom_css",
			'group'         => esc_html__('Design Option','druck')
		),
    )
));