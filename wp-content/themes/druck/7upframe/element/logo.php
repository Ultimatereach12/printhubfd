<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_logo')){
    function s7upf_vc_logo($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => 'img',
            'site_title'    => 'on',
            'logo_img'      => '',
            'el_class'      => '',
            'custom_css'    => '',
            'content'       => $content,            
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class
            ));

        // Call function get template
        $html = s7upf_get_template_element('logo/logo',$style,$attr);

        return $html;
    }
}

stp_reg_shortcode('s7upf_logo','s7upf_vc_logo');

vc_map( array(
    "name"          => esc_html__("Logo", 'druck'),
    "base"          => "s7upf_logo",
    "icon"          => "icon-st",
    "category"      => esc_html__("7UP-Elements", 'druck'),
    "description"   => esc_html__( 'Display logo on your site', 'druck' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'druck'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'druck')     => 'img',
                esc_html__("Logo Text",'druck')   => 'text',
            ),
            "description"   => esc_html__( 'Choose logo style to display.', 'druck' )
        ),
        array(
            "type"          => "attach_image",
            "admin_label"   => true,
            "heading"       => esc_html__("Logo image",'druck'),
            "param_name"    => "logo_img",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "img",
            ),
            "description"   => esc_html__( 'Choose a image to display as logo site.', 'druck' )
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Seo site title in logo",'druck'),
            "param_name"    => "site_title",
            "value"         => array(
                esc_html__("On",'druck')     => 'on',
                esc_html__("Off",'druck')   => 'off',
            ),
            "description"   => esc_html__( 'The site title will appear as html with the h1 tag.', 'druck' )
        ),
        array(
            "type"          => "textarea_html",
            "admin_label"   => true,
            "heading"       => esc_html__("Text",'druck'),
            "param_name"    => "content",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "text",
            ),
            "description"   => esc_html__( 'Enter content logo text to display.', 'druck' )
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