<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 31/08/15
 * Time: 10:00 AM
**/
if(!function_exists('s7upf_vc_flex_wrapper'))
{
    function s7upf_vc_flex_wrapper($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'flex_direction'    => '',
            'flex_wrap'    => '',
            'justify_content'    => '',
            'align_items'      => '',
            'custom_css'    => '',
            'el_class'      => '',
            'content'       => $content,
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		if(!empty($flex_direction)) $flex_direction = 'flex_direction-'.$flex_direction;
		if(!empty($flex_wrap)) $flex_wrap = 'flex_wrap-'.$flex_wrap;
		if(!empty($justify_content)) $justify_content = 'justify_content-'.$justify_content;
		if(!empty($align_items)) $align_items = 'align_items-'.$align_items;
        if(!empty($custom_css)) $css_class = vc_shortcode_custom_css_class( $custom_css );
        $el_class .=  ' '.$css_class.' '.$flex_wrap.' '.$justify_content.' '.$align_items.' '.$flex_direction;
        $html .=   '<div class="flex-wrapper '.$el_class.'">
						'.wpb_js_remove_wpautop($content, false).'
					</div>';
        return $html;
    }
}
stp_reg_shortcode('flex_wrapper','s7upf_vc_flex_wrapper');
vc_map(
    array(
        'name'          => esc_html__( 'Flex Wrapper', 'druck' ),
        'base'          => 'flex_wrapper',
        "category"      => esc_html__("7UP-Elements", 'druck'),
        "description"   => esc_html__( 'Display Flex Box', 'druck' ),
        'icon'          => 'icon-st',
		'is_container' => true,
        'js_view'       => 'VcColumnView',
        'params'        => array(       
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Flex Direction', 'druck' ),
                'param_name'  => 'flex_direction',
                'value'       => array(
                    esc_html__( 'Default', 'druck' )                  => '',
                    esc_html__( 'Row', 'druck' )                     => 'row',
                    esc_html__( 'Column', 'druck' )                  => 'column',
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Flex Wrap', 'druck' ),
                'param_name'  => 'flex_wrap',
                'value'       => array(
                    esc_html__( 'Default', 'druck' )                  => '',
                    esc_html__( 'Wrap', 'druck' )                     => 'wrap',
                    esc_html__( 'No Wrap', 'druck' )                  => 'nowrap',
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Justify Content', 'druck' ),
                'param_name'  => 'justify_content',
                'value'       => array(
                    esc_html__( 'Default', 'druck' )                  => '',
                    esc_html__( 'Flex Start', 'druck' )               => 'flex-start',
                    esc_html__( 'Flex End', 'druck' )                 => 'flex-end',
                    esc_html__( 'Center', 'druck' )                   => 'center',
                    esc_html__( 'Space Between', 'druck' )            => 'space-between',
                    esc_html__( 'Space Around', 'druck' )             => 'space-around',
                ),
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Align Items', 'druck' ),
                'param_name'  => 'align_items',
                'value'       => array(
                    esc_html__( 'Default', 'druck' )                  => '',
                    esc_html__( 'Flex Start', 'druck' )               => 'flex-start',
                    esc_html__( 'Flex End', 'druck' )                 => 'flex-end',
                    esc_html__( 'Center', 'druck' )                   => 'center',
                    esc_html__( 'Baseline', 'druck' )                 => 'baseline',
                    esc_html__( 'Stretch', 'druck' )                  => 'stretch',
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
    )
);

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Flex_Wrapper extends WPBakeryShortCodesContainer {}
}