<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_instagram_box')){
    function s7upf_vc_instagram_box($attr){
        $html = '';
        $data_array = array_merge(array(
            'style'         => 'default',
            'source'        => '',
            'title'         => '',
            'des'           => '',
            'user'          => '',
            'photos'        => '6',
            'token'         => '',
            'list'          => '',
            'size'          => '',
            'size_index'    => '0',
            'itemres'       => '',
            'speed'         => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        // Variable process
        $el_class .= ' '.$style;
        $size = s7upf_get_size_crop($size,'full');
        $data = array();
        if($source == 'media'){
            $default_val = array(
                'icon'      => '',
                'link'      => '',
                'like'      => '',
                'comment'      => '',
            );
            $data_media = (array) vc_param_group_parse_atts( $list );
            if(is_array($data_media)){
                foreach ($data_media as $key => $value){
                    $value = array_merge($default_val,$value);
                    $data[] = array(
                        'image_url' => wp_get_attachment_image_src($value['image'],$size)[0],
                        'link'      => $value['link'],
                        'like'      => $value['like'],
                        'comment'      => $value['comment'],
                    );
                }
            }            
        }
        else{
            if(!empty($user) && function_exists('s7upf_scrape_instagram')){
                $media_array = s7upf_scrape_instagram($user, $photos, $token, $size_index);
                if(is_array($media_array)) if(isset($media_array['photos'])) $media_array = $media_array['photos'];
                if(!empty($media_array)){
                    foreach ($media_array as $item) {
                        if(isset($item['link']) && isset($item['thumbnail_src'])){
                            $data[] = array(
                                'image_url' => $item['thumbnail_src'],
                                'link'      => $item['link'],
                                'like'      => $item['like']['count'],
                                'comment'      => $item['comment']['count'],
                            );
                        }
                    }              
                }
            }
        }
        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            'data' => $data,
            ));

        // Call function get template
        $html = s7upf_get_template_element('instagram/instagram',$style,$attr);

        return $html;
    }
}

stp_reg_shortcode('sv_instagram_box','s7upf_vc_instagram_box');

vc_map( array(
    "name"          => esc_html__("Instagram", 'druck'),
    "base"          => "sv_instagram_box",
    "icon"          => "icon-st",
    "category"      => esc_html__("7UP-Elements", 'druck'),
    "description"   => esc_html__( 'Display images from instagram', 'druck' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'druck'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'druck')     => 'default',
                esc_html__("Slider",'druck')      => 'slider',
                )
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Source",'druck'),
            "param_name"    => "source",
            "value"         => array(
                esc_html__("User name",'druck')           => 'username',
                esc_html__("From your media",'druck')     => 'media',
                )
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title",'druck'),
            "param_name"    => "title",
            "description"   => esc_html__( 'Enter title of element.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Description",'druck'),
            "param_name"    => "des",
            "description"   => esc_html__( 'Enter description of element.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("User",'druck'),
            "param_name"    => "user",
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('username'),
            ),
            "description"   => esc_html__( 'Enter user name of Instagram.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Number",'druck'),
            "param_name"    => "photos",
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('username'),
            ),
            "description"   => esc_html__( 'Enter number of photos to display. Default is 6.', 'druck' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Token",'druck'),
            "param_name"    => "token",
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('username'),
            ),
            "description"   => esc_html__("Enter token to view more 12 of photos. Create token your account at: https://outofthesandbox.com/pages/instagram-access-token",'druck'),
        ),
        
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Image custom size",'druck'),
            "param_name"    => "size_index",
            "value"         => array(
                esc_html__("Small",'druck')          => '0',
                esc_html__("Medium",'druck')         => '1',
                esc_html__("Large",'druck')          => '2',
                esc_html__("General",'druck')          => '3',
                ),
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('username'),
            ),
            'description'   => esc_html__( 'Choose instagram image size to display', 'druck' ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Image custom size",'druck'),
            "param_name"    => "size",
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('media'),
            ),
            'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'druck' ),
        ),
        array(
            "type"          => "param_group",
            "heading"       => esc_html__("Add Image List",'druck'),
            "param_name"    => "list",
            "params"        => array(
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__("Image",'druck'),
                    "param_name"    => "image",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Link",'druck'),
                    "param_name"    => "link",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Like Number",'druck'),
                    "param_name"    => "like",
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Comment Number",'druck'),
                    "param_name"    => "comment",
                ),
            ),
            'dependency'    => array(
                'element'       => 'source',
                'value'         => array('media'),
            ),
            'description'   => esc_html__( 'Add more image with link', 'druck' ),
        ),
        array(
            'heading'       => esc_html__( 'Custom Item', 'druck' ),
            'type'          => 'textfield',
            'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'druck' ),
            'param_name'    => 'itemres',
            'group'         => esc_html__("Slider Settings",'druck'),
            'dependency'    => array(
                'element'       => 'style',
                'value'         => array('slider'),
            )
        ),        
        array(
            'heading'       => esc_html__( 'Speed', 'druck' ),
            'type'          => 'textfield',
            'group'         => esc_html__("Slider Settings",'druck'),
            'description'   => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'druck' ),
            'param_name'    => 'speed',
            'dependency'    => array(
                'element'       => 'style',
                'value'         => array('slider'),
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
));