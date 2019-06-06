<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('s7upf_vc_slide_carousel'))
{
    function s7upf_vc_slide_carousel($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'title'         => '',
            'item'          => '1',
            'speed'         => '',
            'itemres'       => '',
            'navigation'    => '',
            'pagination'    => '',
            'nav_next'      => '',
            'nav_prev'      => '',
            'animation'     => '',
            'custom_css'    => '',
            'el_class'      => '',
            'content'       => $content,
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        $el_class .= ' '.$css_class;
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            ));
        $html = s7upf_get_template_element('slide-carousel/carousel','',$attr);
        return $html;
    }
}
stp_reg_shortcode('slide_carousel','s7upf_vc_slide_carousel');
vc_map(
    array(
        'name'          => esc_html__( 'Carousel Slider', 'druck' ),
        'base'          => 'slide_carousel',
        "category"      => esc_html__("7UP-Elements", 'druck'),
        "description"   => esc_html__( 'Display banner slider', 'druck' ),
        'icon'          => 'icon-st',
        'as_parent'     => array( 'only' => 's7upf_advertisement,s7upf_information,sv_custom_link,vc_row' ),
        'content_element' => true,
		'is_container'            => true,
        'js_view'       => 'VcColumnView',
        'params'        => array(                       
            array(
                'heading'     => esc_html__( 'Title', 'druck' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter title for block.', 'druck' ),
                'param_name'  => 'title',
            ),            
            array(
                'heading'     => esc_html__( 'Item slider display', 'druck' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter number of item. Default is 1.', 'druck' ),
                'param_name'  => 'item',
            ),
            array(
                'heading'     => esc_html__( 'Custom Item', 'druck' ),
                'type'        => 'textfield',
                'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'druck' ),
                'param_name'  => 'itemres',
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
                    esc_html__( 'Transparent Navigation', 'druck' )      => 'round-navi',
                    esc_html__( 'Group Navigation', 'druck' )      => 'group-navi',
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

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slide_Carousel extends WPBakeryShortCodesContainer {}
}