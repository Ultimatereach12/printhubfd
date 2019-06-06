<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */

add_action('admin_init', 's7upf_custom_meta_boxes');
if(!function_exists('s7upf_custom_meta_boxes')){
    function s7upf_custom_meta_boxes(){
        //Format content
        $format_metabox = array(
            'id'        => 'block_format_content',
            'title'     => esc_html__('Format Settings', 'druck'),
            'desc'      => '',
            'pages'     => array('post'),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(                
                array(
                    'id'        => 'format_image',
                    'label'     => esc_html__('Upload Image', 'druck'),
                    'type'      => 'upload',
                    'desc'      => esc_html__('Choose image from media.','druck'),
                ),
                array(
                    'id'        => 'format_gallery',
                    'label'     => esc_html__('Add Gallery', 'druck'),
                    'type'      => 'Gallery',
                    'desc'      => esc_html__('Choose images from media.','druck'),
                ),
                array(
                    'id'        => 'format_media',
                    'label'     => esc_html__('Link Media', 'druck'),
                    'type'      => 'text',
                    'desc'      => esc_html__('Enter media url(Youtube, Vimeo, SoundCloud ...).','druck'),
                )
            ),
        );
        // SideBar
        $page_settings = array(
            'id'        => 's7upf_sidebar_option',
            'title'     => esc_html__('Page Settings','druck'),
            'pages'     => array( 'page','post','product','portfolio'),
            'context'   => 'normal',
            'priority'  => 'low',
            'fields'    => array(
                // General tab
                array(
                    'id'        => 'page_general',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','druck')
                ),
                array(
                    'id'        => 's7upf_header_page',
                    'label'     => esc_html__('Choose page header','druck'),
                    'type'      => 'select',
                    'choices'   => s7upf_list_post_type('s7upf_header'),
                    'desc'      => esc_html__('Include Header content. Go to Header page in admin menu to edit/create header content. Default is value of Theme Option.','druck'),
                ),
                array(
                    'id'         => 's7upf_footer_page',
                    'label'      => esc_html__('Choose page footer','druck'),
                    'type'       => 'select',
                    'choices'    => s7upf_list_post_type('s7upf_footer'),
                    'desc'       => esc_html__('Include Footer content. Go to Footer page in admin menu to edit/create footer content. Default is value of Theme Option.','druck'),
                ),
                array(
                    'id'         => 's7upf_sidebar_position',
                    'label'      => esc_html__('Sidebar position ','druck'),
                    'type'       => 'select',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','druck'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('No Sidebar','druck'),
                            'value' => 'no'
                        ),
                        array(
                            'label' => esc_html__('Left sidebar','druck'),
                            'value' => 'left'
                        ),
                        array(
                            'label' => esc_html__('Right sidebar','druck'),
                            'value' => 'right'
                        ),
                    ),
                    'desc'      => esc_html__('Choose sidebar position for current page/post(Left,Right or No Sidebar).','druck'),
                ),
                array(
                    'id'        => 's7upf_select_sidebar',
                    'label'     => esc_html__('Selects sidebar','druck'),
                    'type'      => 'sidebar-select',
                    'condition' => 's7upf_sidebar_position:not(no),s7upf_sidebar_position:not()',
                    'desc'      => esc_html__('Choose a sidebar to display.','druck'),
                ),
                array(
                    'id'          => 'before_append',
                    'label'       => esc_html__('Append content before','druck'),
                    'type'        => 'select',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','druck'),
                ),
                array(
                    'id'          => 'after_append',
                    'label'       => esc_html__('Append content after','druck'),
                    'type'        => 'select',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','druck'),
                ),
                array(
                    'id'          => 'show_title_page',
                    'label'       => esc_html__('Show title', 'druck'),
                    'type'        => 'on-off',
                    'std'         => 'on',
                    'desc'        => esc_html__('Show/hide title of page.','druck'),
                ),
                array(
                    'id' => 'post_single_page_share',
                    'label' => esc_html__('Show Share Box', 'druck'),
                    'type' => 'select',
                    'std'   => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Theme Option--','druck'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','druck'),
                            'value'=>'on'
                        ),
                        array(
                            'label'=>esc_html__('Off','druck'),
                            'value'=>'off'
                        ),
                    ),
                    'desc'        => esc_html__( 'You can show/hide share box independent on this page. ', 'druck' ),
                ),
                // End general tab
                // Custom color
                array(
                    'id'        => 'page_color',
                    'type'      => 'tab',
                    'label'     => esc_html__('Custom color','druck')
                ),
                array(
                    'id'          => 'body_bg',
                    'label'       => esc_html__('Body Background','druck'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change body background of page.', 'druck' ),
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color of this page.', 'druck' ),
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','druck'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color 2 of this page.', 'druck' ),
                ),
                // End Custom color
                // Display & Style tab
                array(
                    'id'        => 'page_layout',
                    'type'      => 'tab',
                    'label'     => esc_html__('Display & Style','druck')
                ),
                array(
                    'id'          => 's7upf_page_style',
                    'label'       => esc_html__('Page Style','druck'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','druck'),
                            'value' =>  '',
                        ),
                        array(
                            'label' =>  esc_html__('Page boxed','druck'),
                            'value' =>  'page-content-box'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for page.', 'druck' ),
                ),
                array(
                    'id'          => 'container_width',
                    'label'       => esc_html__('Custom container width(px)','druck'),
                    'type'        => 'text',
                    'desc'        => esc_html__( 'You can custom width of page container. Default is 1200px.', 'druck' ),
                ),                
                array(
                    'id'          => 'show_single_itemres',
                    'label'       => esc_html__('Custom item devices','druck'),
                    'type'        => 'text',
                    'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','druck'),
                ),
                // End Display & Style tab               
            )
        );
        
        $product_settings = array(
            'id' => 'block_product_settings',
            'title' => esc_html__('Product Settings', 'druck'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(    
                // Begin Product Settings
                array(
                    'id'        => 'block_product_custom_tab',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','druck')
                ), 
                array(
                    'id'          => 'before_append_tab',
                    'label'       => esc_html__('Append content before product tab','druck'),
                    'type'        => 'select',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','druck'),
                ),
                array(
                    'id'          => 'after_append_tab',
                    'label'       => esc_html__('Append content after product tab','druck'),
                    'type'        => 'select',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','druck'),
                ),
                array(
                    'id'          => 's7upf_product_tab_data',
                    'label'       => esc_html__('Add Custom Tab','druck'),
                    'type'        => 'list-item',
                    'settings'    => array(
                        array(
                            'id' => 'tab_content',
                            'label' => esc_html__('Content', 'druck'),
                            'type' => 'textarea',
                        ),
                        array(
                            'id'            => 'priority',
                            'label'         => esc_html__('Priority (Default 40)', 'druck'),
                            'type'          => 'numeric-slider',
                            'min_max_step'  => '1,50,1',
                            'std'           => '40',
                            'desc'          => esc_html__('Choose priority value to re-order custom tab position.','druck'),
                        ),
                    )
                ),
                array(
                    'id'          => 's7upf_product_video',
                    'label'       => esc_html__('Product Video','druck'),
                    'type'        => 'text',
                    'desc'        => esc_html__('Add video link(Youtube/Vimeo) for product','druck'),
                ),
				//Style Setting 
				array(
                    'id'        => 'block_product_style',
                    'type'      => 'tab',
                    'label'     => esc_html__('Product Style','druck')
                ), 
				array(
                    'id'          => 's7upf_detail_info_style',
                    'label'       => esc_html__('Product Layout','druck'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','druck'),
                            'value' =>  '',
                        ),
                        array(
                            'label' =>  esc_html__('Sticky Info','druck'),
                            'value' =>  'info-sticky'
                        ),
                        array(
                            'label' =>  esc_html__('Large Gallery','druck'),
                            'value' =>  'large-gallery'
                        ),
                        array(
                            'label' =>  esc_html__('Grid Gallery','druck'),
                            'value' =>  'grid-gallery'
                        ),
                        array(
                            'label' =>  esc_html__('Extra Attributes','druck'),
                            'value' =>  'extra-attrs'
                        ),
                    ),
                    'desc'        => esc_html__( 'Select Product Layout.', 'druck' ),
                ), 
				array(
                    'id'          => 'product_image_zoom',
                    'label'       => esc_html__('Product Zoom Style','druck'),
					'desc'        => esc_html__( 'Select Zoom Style.', 'druck' ),
                    'type'        => 'select',
					'desc'        => esc_html__('Choose a style to display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('None','druck'),
                        ),
                        array(
                            'value'=>'zoom-style1',
                            'label'=>esc_html__('Zoom 1','druck'),
                        ),
                        array(
                            'value'=>'zoom-style2',
                            'label'=>esc_html__('Zoom 2','druck'),
                        ),
                        array(
                            'value'=>'zoom-style3',
                            'label'=>esc_html__('Zoom 3','druck'),
                        ),
                        array(
                            'value'=>'zoom-style4',
                            'label'=>esc_html__('Zoom 4','druck'),
                        )
                    )
                ),  
				array(
                    'id'          => 'product_tab_detail',
                    'label'       => esc_html__('Product Tab Style','druck'),
					'desc'        => esc_html__( 'Select Tab Style.', 'druck' ),
                    'type'        => 'select',
					'std'         => 'horizontal',
                    'choices'     => array(                                                    
                        array(
                            'value'=> 'horizontal',
                            'label'=> esc_html__("Horizontal", 'druck'),
                        ),
                        array(
                            'value'=> 'vertical',
                            'label'=> esc_html__("Vertical", 'druck'),
                        ),
                        array(
                            'value'=> 'accordion',
                            'label'=> esc_html__("Accordion", 'druck'),
                        ),
                    )
                ),  
				array(
                    'id'          => 's7upf_product_sticky_addcart',
                    'label'       => esc_html__('Sticky Add to Cart','druck'),
                    'type'        => 'on-off',
					'std'         => 'off',
                ),  
				// Guide Settings
                array(
                    'id'        => 'block_product_guide',
                    'type'      => 'tab',
                    'label'     => esc_html__('Product Guide','druck')
                ), 
				array(
                    'id'          => 's7upf_product_guide_data',
                    'label'       => esc_html__('Add Attribute Guide','druck'),
                    'type'        => 'list-item',
                    'settings'    => array(
                        array(
                            'id' => 'attr_guide',
                            'label' => esc_html__('Content', 'druck'),
                            'type' => 'textarea',
                        ),
                    )
                ),
            ),
        );
        $product_type = array(
            'id' => 'product_trendding',
            'title' => esc_html__('Product Type', 'druck'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trending', 'druck'),
                    'type'        => 'on-off',
                    'std'         => 'off',
                    'desc'        => esc_html__( 'Set trending for current product.', 'druck' ),
                ),
                array(
                    'id'    => 'product_thumb_hover',
                    'label' => esc_html__('Product hover image', 'druck'),
                    'type'  => 'upload',
                    'desc'        => esc_html__( 'Product thumbnail 2. Some hover animation of thumbnail show back image. Default return main product thumbnail.', 'druck' ),
                ),
            ),
        );
        if (function_exists('ot_register_meta_box')){
            ot_register_meta_box($format_metabox);
            ot_register_meta_box($page_settings);
            ot_register_meta_box($product_settings);
            ot_register_meta_box($product_type);
        }
    }
}
?>