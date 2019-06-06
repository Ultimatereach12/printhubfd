<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_account_manager'))
{
    function s7upf_vc_account_manager($attr,$content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'     	 => '',
            'popup'     	 => 'yes',
            'login_url'      => '',
            'register_url'   => '',
            'redirect_url'	 => '',
            'login_icon'     => '',
            'register_icon'  => '',
            'logout_icon'	 => '',
			'list'      	 => '',
			'el_class'       => '',
			'custom_css'     => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);

        // Variable process vc_shortcodes_css_class
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		if($popup == 'no') $el_class .= ' disable-popup';
        if(!empty($css_class)) $el_class .= ' '.$css_class;
		$data = (array) vc_param_group_parse_atts( $list );

		$default_val = array(
            'icon'      => '',
            'title'     => '',
            'link'      => '',
            'roles'     => '',
            );

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'data'          => $data,
            'default_val'   => $default_val,
            ));
        // Call function get template
        $html = s7upf_get_template_element('account-manager/account',$style,$attr);
        
        return $html;
    }
}
stp_reg_shortcode('s7upf_account_manager','s7upf_vc_account_manager');

vc_map( array(
	"name"      => esc_html__("Account manager", 'druck'),
	"base"      => "s7upf_account_manager",
	"icon"      => "icon-st",
	"category"  => '7UP-Elements',
	"params"    => array(
		array(
			"type"          => "dropdown",
			"holder"        => "div",
			"heading"       => esc_html__("Style",'druck'),
			"param_name"    => "style",
			"value"         => array(
				esc_html__("Default",'druck')   => '',
				),
		),		
		array(
			"type"          => "dropdown",
			"heading"       => esc_html__("Popup form",'druck'),
			"param_name"    => "popup",
			"value"         => array(
				esc_html__("Yes",'druck')   => 'yes',
				esc_html__("No",'druck')   => 'no',
				),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Login Url",'druck'),
			"param_name" => "login_url",
			'description'   => esc_html__( 'Enter login url. Default is myaccount page.', 'druck' ),
			'edit_field_class'=>'vc_col-sm-6 vc_column',
		),
		array(
            'type'          => 'iconpicker',
            'heading'       => esc_html__( 'Login Icon', 'druck' ),
            'param_name'    => 'login_icon',
            'value'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'type'          => s7upf_default_icon_lib(),
                'iconsPerPage'  => 4000,
            ),
            'description'   => esc_html__( 'Select icon from library.', 'druck' ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',
        ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Register Url",'druck'),
			"param_name" => "register_url",
			'description'   => esc_html__( 'Enter login url. Default is myaccount page.', 'druck' ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',
		),
		array(
            'type'          => 'iconpicker',
            'heading'       => esc_html__( 'Register Icon', 'druck' ),
            'param_name'    => 'register_icon',
            'value'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'type'          => s7upf_default_icon_lib(),
                'iconsPerPage'  => 4000,
            ),
            'description'   => esc_html__( 'Select icon from library.', 'druck' ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',
        ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Logout Redirect Url",'druck'),
			"param_name" => "redirect_url",
			'description'   => esc_html__( 'Enter url redirect when user logout. Default is home page.', 'druck' ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',
		),
		array(
            'type'          => 'iconpicker',
            'heading'       => esc_html__( 'Logout Icon', 'druck' ),
            'param_name'    => 'logout_icon',
            'value'         => '',
            'settings'      => array(
                'emptyIcon'     => true,
                'type'          => s7upf_default_icon_lib(),
                'iconsPerPage'  => 4000,
            ),
            'description'   => esc_html__( 'Select icon from library.', 'druck' ),
            'edit_field_class'=>'vc_col-sm-6 vc_column',
        ),
		array(
			"type" => "param_group",
			"heading" => esc_html__("Add List Link",'druck'),
			"param_name" => "list",
			"params"    => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title",'druck'),
					"param_name" => "title",
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link",'druck'),
					"param_name" => "link",
				),
				array(
                    'type'          => 'iconpicker',
                    'heading'       => esc_html__( 'Icon', 'druck' ),
                    'param_name'    => 'icon',
                    'value'         => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => s7upf_default_icon_lib(),
                        'iconsPerPage'  => 4000,
                    ),
                    'description'   => esc_html__( 'Select icon from library.', 'druck' ),
                ),                
				array(
					"type"          => "checkbox",
					"heading"       => esc_html__("Show with Role",'druck'),
					"param_name"    => "roles",
					"value"         => s7upf_get_list_role(),
					'description'   =>  esc_html__( 'Check to show link with role. Default show with all roles.', 'druck' ),
				),
			),
			'description' =>  esc_html__( 'List links only show when you was login.', 'druck' ),
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