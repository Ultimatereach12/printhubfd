<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_banner_slider'))
{
    function s7upf_vc_banner_slider($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'speed'         => '',
            'navigation'    => '',
            'pagination'    => '',
            'nav_next'      => '',
            'nav_prev'      => '',
            'banner_bg'     => '',
            'animation'     => '',
            'custom_css'    => '',
            'el_class'      => '',
            'content'       => $content,
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        $el_class .= ' '.$banner_bg.' '.$css_class;
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            ));
        $html = s7upf_get_template_element('slide-carousel/banner','',$attr);
        return $html;
    }
}
stp_reg_shortcode('banner_slider','s7upf_vc_banner_slider');
vc_map(
    array(
        'name'          => esc_html__( 'Banner Slider', 'druck' ),
        'base'          => 'banner_slider',
        "category"      => esc_html__("7UP-Elements", 'druck'),
        "description"   => esc_html__( 'Display banner slider', 'druck' ),
        'icon'          => 'icon-st',
        'as_parent'     => array( 'only' => 'banner_slider_item' ),
        'content_element' => true,
        'js_view'       => 'VcColumnView',
        'params'        => array(       
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Banner Style', 'druck' ),
                'param_name'  => 'banner_bg',
                'value'       => array(
                    esc_html__( 'Default', 'druck' )                        => '',
                    esc_html__( 'Banner Background', 'druck' )              => 'bg-slider',
                    esc_html__( 'Banner Background Parallax', 'druck' )     => 'bg-slider parallax-slider', 
                ),
            ),
            array(
                'heading'     => esc_html__( 'Speed', 'druck' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'druck' ),
                'param_name'  => 'speed',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Navigation', 'druck' ),
                'param_name'  => 'navigation',
                'value'       => array(
                    esc_html__( 'Hidden', 'druck' )                  => '',
                    esc_html__( 'Default Navigation', 'druck' )      => 'navi-nav-style',
                    esc_html__( 'Round Navigation', 'druck' )        => 'round-navi',
                ),
            ),
            array(
                'heading'     => esc_html__( 'Text prev', 'druck' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter text/html previous button slider', 'druck' ),
                'param_name'  => 'nav_prev',
                'dependency'  => array(
                    'element'   => 'navigation',
                    'not_empty' => true,
                    )
            ),
            array(
                'heading'     => esc_html__( 'Text next', 'druck' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter text/html next button slider', 'druck' ),
                'param_name'  => 'nav_next',
                'dependency'  => array(
                    'element'   => 'navigation',
                    'not_empty' => true,
                    )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Pagination', 'druck' ),
                'param_name'  => 'pagination',
                'value'       => array(
                    esc_html__( 'Hidden', 'druck' )                  => '',
                    esc_html__( 'Default Pagination', 'druck' )      => 'pagi-nav-style',
                    esc_html__( 'Pagination Style2', 'druck' )      => 'pagi-nav-style2',
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Slider Animation', 'druck' ),
                'param_name'  => 'animation',
                'value'       => array(
                    esc_html__( 'None', 'druck' )        => '',
                    esc_html__( 'Fade', 'druck' )        => 'fade',
                    esc_html__( 'BackSlide', 'druck' )   => 'backSlide',
                    esc_html__( 'GoDown', 'druck' )      => 'goDown',
                    esc_html__( 'FadeUp', 'druck' )      => 'fadeUp',
                    )
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
    )
);

/*******************************************END MAIN*****************************************/


/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('s7upf_vc_banner_slider_item'))
{
    function s7upf_vc_banner_slider_item($attr, $content = false)
    {
        $html = $ads_class = $css_class = '';
        $attr = shortcode_atts(array(
            'image'             => '',
            'link'              => '',
            'info_animation'    => '',
            'info_style'        => '',
            'item_style'        => '',
            'info_align'        => '',
            'info_transform'    => '',
            'ads_image'         => '',
            'ads_size'          => '',
            'ads_title'         => '',
            'ads_desc'          => '',
            'ads_button'        => '',
            'ads_animate'       => '',
            'custom_css'        => '',
            'el_class'          => '',
            'content'           => $content,
        ),$attr);
        extract($attr);
        if(!empty($custom_css)) $css_class = vc_shortcode_custom_css_class( $custom_css );
        $el_class .= ' '.$css_class;
		if(!empty($item_style)) $el_class .= ' item-style-'.$item_style;
        $info_class = $info_style.' '.$info_align.' '.$info_transform;
        if(!empty($info_animation)) $info_class .= ' animated';
        if(!empty($ads_animate)) $ads_class .= ' animated';
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'info_class'    => $info_class,
            'ads_class'    => $ads_class,
            ));
        if(!empty($image)){
            $html = s7upf_get_template_element('slide-carousel/item','',$attr);
        }
        return $html;
    }
}
stp_reg_shortcode('banner_slider_item','s7upf_vc_banner_slider_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Banner Item', 'druck' ),
        'base'     => 'banner_slider_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'banner_slider'),
        'params'   => array(     
			array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Banner Item Style', 'druck' ),
                'param_name'    => 'item_style',
                'value'         => array(
                    esc_html__( 'Default', 'druck' )        => '',
                    esc_html__( 'Image Ads', 'druck' )      => 'ads',
                    )
            ),
            array(
                'type'          => 'attach_image',
                'heading'       => esc_html__( 'Image Background', 'druck' ),
                'param_name'    => 'image',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Link Banner', 'druck' ),
                'param_name'    => 'link',
            ),        
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content",'druck'),
                "param_name"    => "content",
            ),
			
            array(
                'type'          => 'animation_style',
                'heading'       => esc_html__( 'Info Animation', 'druck' ),
                'param_name'    => 'info_animation',
				'group'         => esc_html__('Info Banner','druck'),
                'admin_label'   => true,
                'value'         => '',
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'druck' ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Style', 'druck' ),
                'param_name'    => 'info_style',
				'group'         => esc_html__('Info Banner','druck'),
                'value'         => array(
                    esc_html__( 'None', 'druck' )     => '',
                    esc_html__( 'Black', 'druck' )    => 'black',
                    esc_html__( 'White', 'druck' )    => 'white',
				)
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Align', 'druck' ),
                'param_name'    => 'info_align',
				'group'         => esc_html__('Info Banner','druck'),
                'value'         => array(
                    esc_html__( 'Default', 'druck' )    => '',
                    esc_html__( 'Left', 'druck' )       => 'text-left',
                    esc_html__( 'Right', 'druck' )      => 'text-right',
                    esc_html__( 'Center', 'druck' )     => 'text-center',
                    )
			),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Transform', 'druck' ),
                'param_name'    => 'info_transform',
				'group'         => esc_html__('Info Banner','druck'),
                'value'         => array(
                    esc_html__( 'Default', 'druck' )     => '',
                    esc_html__( 'Uppercase', 'druck' )   => 'text-uppercase',
                    )
			),
			array(
                'type'          => 'attach_image',
                'heading'       => esc_html__( 'Ads Image', 'druck' ),
                'param_name'    => 'ads_image',
				'group'         => esc_html__('Info Ads','druck'),
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				)
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Ads Image Size', 'druck' ),
                'param_name'    => 'ads_size',
				'group'         => esc_html__('Info Ads','druck'),
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				)
            ),        
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Ads Title",'druck'),
                "param_name"    => "ads_title",
				'group'         => esc_html__('Info Ads','druck'),
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				)
            ),     
            array(
                "type"          => "textarea",
                "heading"       => esc_html__("Ads Description",'druck'),
                "param_name"    => "ads_desc",
				'group'         => esc_html__('Info Ads','druck'),
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				)
            ),
			array(
				"type"          => "vc_link",
				"heading"       => esc_html__("Ads Button",'druck'),
				"param_name"    => "ads_button",
				'group'         => esc_html__('Info Ads','druck'),
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				)
			),
            array(
                'type'          => 'animation_style',
                'heading'       => esc_html__( 'Ads Animation', 'druck' ),
                'param_name'    => 'ads_animate',
				'group'         => esc_html__('Info Ads','druck'),
                'admin_label'   => true,
                'value'         => '',
				'dependency'    => array(
					'element'   => 'item_style',
					'value'   => array('ads'),
				),
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'druck' ),
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
    )
);

/**************************************END ITEM************************************/

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Banner_Slider extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Banner_Slider_Item extends WPBakeryShortCode {}    
}