<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_advertisement'))
{
    function s7upf_vc_advertisement($attr,$content = false)
    {
        $html = $css_class = $css_class2 = '';
        $data_array = array_merge(array(
            'style'         => '',
            'image'         => '',
            'image2'        => '',
            'link'          => '',
			'link2'         => '',
			'title'         => '',
			'date'          => '',
            'animation'     => '',
            'position'      => '',
            'el_class'      => '',
            'el_class2'     => '',
            'custom_css'    => '',
            'custom_css2'   => '',
            'size'          => '',
            'content'       => $content,
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .= ' '.$position;
        if(!empty($custom_css2)) $el_class2 .= ' '.vc_shortcode_custom_css_class( $custom_css2 );
        if(!empty($size)) $size = explode('x', $size);
        else $size = 'full';
        $attr = array_merge($attr,array(
            'el_class'  => $el_class,
            'el_class2' => $el_class2,
            'size'      => $size,
            'position'      => $position,
            ));

        $html = s7upf_get_template_element('advertisement/advertisement',$style,$attr);

        return $html;
    }
}

stp_reg_shortcode('s7upf_advertisement','s7upf_vc_advertisement');

vc_map( array(
    "name"          => esc_html__("Advertisement", 'druck'),
    "base"          => "s7upf_advertisement",
    "icon"          => "icon-st",
    "category"      => esc_html__("7UP-Elements", 'druck'),
    "description"   => esc_html__( 'Display a advertisement', 'druck' ),
    "params"        => array( 
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'druck'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'druck')   => '',
                esc_html__("Content Outer",'druck')   => 'outer',
                esc_html__("Banner Video",'druck')   => 'video',
            ),
            "description"   => esc_html__( 'Choose menu style to display.', 'druck' )
        ),
        array(
            "type"          => "attach_image",
            "admin_label"   => true,
            "heading"       => esc_html__("Image",'druck'),
            "param_name"    => "image",
            "description"   => esc_html__( 'Select image from media library.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Image custom size",'druck'),
            "param_name"    => "size",
            'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'druck' ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Animation",'druck'),
            "param_name"    => "animation",
            "value"         => array(
                esc_html__("Default",'druck')                    => '',
                esc_html__("Zoom",'druck')                       => 'zoom-image',
                esc_html__("Zoom Overlay",'druck')               => 'overlay-image zoom-image',
                esc_html__("Zoom in",'druck')                    => 'zoom-in',
                esc_html__("Zoom in Overlay",'druck')            => 'zoom-in overlay-image',
                esc_html__("Zoom out",'druck')                   => 'zoom-out',
                esc_html__("Zoom out Overlay",'druck')           => 'zoom-out overlay-image',
                esc_html__("Fade out-in",'druck')                => 'fade-out-in',
                esc_html__("Zoom Fade out-in",'druck')           => 'zoom-image fade-out-in',
                esc_html__("Fade in-out",'druck')                => 'fade-in-out',
                esc_html__("Zoom rotate",'druck')                => 'zoom-rotate',
                esc_html__("Zoom rotate Fade out-in",'druck')    => 'zoom-rotate fade-out-in',
                esc_html__("Overlay",'druck')                    => 'overlay-image',
                esc_html__("Zoom image line",'druck')            => 'zoom-image line-scale',
                esc_html__("Zoom in line",'druck')               => 'zoom-in line-scale',
                esc_html__("Gray image",'druck')                 => 'gray-image',
                esc_html__("Gray image line",'druck')            => 'gray-image line-scale',
                esc_html__("Pull curtain",'druck')               => 'pull-curtain',
                esc_html__("Pull curtain gray image",'druck')    => 'pull-curtain gray-image',
                esc_html__("Pull curtain zoom image",'druck')    => 'pull-curtain zoom-image',
                esc_html__("Fly Cross",'druck')                  => 'fly-cross',
                esc_html__("Fly Cross Zoom In",'druck')          => 'fly-cross zoom-in',
            ),
            "description"   => esc_html__( 'Select type of animation for image.', 'druck' )
        ),
        array(
            "type"          => "attach_image",
            "heading"       => esc_html__("Image fade",'druck'),
            "param_name"    => "image2",
            "dependency"    => array(
                "element"       => "animation",
                "value"     => array("zoom-out","zoom-out overlay-image"),
            ),
            "description"   => esc_html__( 'Select image from media library.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Link",'druck'),
            "param_name"    => "link",
            "description"   => esc_html__( 'Enter URL redirect when click to image.', 'druck' )
        ),  
		array(
            "type"          => "textfield",
            "heading"       => esc_html__("Link Video",'druck'),
            "param_name"    => "link2",
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('video')
			),
            "description"   => esc_html__( 'Enter link(Youtube/Vimeo) of video', 'druck' )
        ), 
		array(
            "type"          => "textfield",
            "heading"       => esc_html__("Title",'druck'),
            "param_name"    => "title",
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('countdown','collection')
			),
        ), 
		array(
            "type"          => "textfield",
            "heading"       => esc_html__("Time Count Down",'druck'),
            "param_name"    => "date",
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('countdown')
			),
			"description"   => esc_html__( 'Enter date/time countdown by format(m/d/y)', 'druck' )
        ), 
        array(
            "type"          => "textarea_html",
            "holder"        => "div",
            "heading"       => esc_html__("Content Info",'druck'),
            "param_name"    => "content",
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('','outer','countdown','product','collection')
			),
            "description"   => esc_html__( 'Enter info content of element.', 'druck' )
        ),
		array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Content Position",'druck'),
            "param_name"    => "position",
            "value"         => array(
                esc_html__("Right",'druck')   => '',
                esc_html__("Left",'druck')    => 'pos-left',
            ),
            "description"   => esc_html__( 'Set content position Left/Right.', 'druck' ),
			"dependency"    =>array(
				'element'   =>'style',
				'value'     =>array('product','collection')
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
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Extra class name",'druck'),
            "param_name"    => "el_class2",
            'group'         => esc_html__('Design Info Box','druck'),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'druck' )
        ),
        array(
            "type"          => "css_editor",
            "heading"       => esc_html__("CSS box",'druck'),
            "param_name"    => "custom_css2",
            'group'         => esc_html__('Design Info Box','druck')
        ),
    )
));