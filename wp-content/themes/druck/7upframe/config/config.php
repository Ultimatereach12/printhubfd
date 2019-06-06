<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!function_exists('s7upf_set_theme_config')){
    function s7upf_set_theme_config(){
        global $s7upf_dir,$s7upf_config;
        /**************************************** BEGIN ****************************************/
        $s7upf_dir = get_template_directory_uri() . '/7upframe';
        $s7upf_config = array();
        $s7upf_config['dir'] = $s7upf_dir;
        $s7upf_config['css_url'] = $s7upf_dir . '/assets/css/';
        $s7upf_config['js_url'] = $s7upf_dir . '/assets/js/';
        $s7upf_config['nav_menu'] = array(
            'primary' => esc_html__( 'Primary Navigation', 'druck' ),
        );
        $s7upf_config['mega_menu'] = '1';
        $s7upf_config['sidebars']=array(
            array(
                'name'              => esc_html__( 'Blog Sidebar', 'druck' ),
                'id'                => 'blog-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all blog page.', 'druck'),
                'before_title'      => '<h3 class="widget-title title-first-letter">',
                'after_title'       => '</h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            )
        );
		if(class_exists("woocommerce")){
            $s7upf_config['sidebars'][] = array(
                'name'              => esc_html__( 'Woocommerce Sidebar', 'druck' ),
                'id'                => 'woocommerce-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all woocommerce page.', 'druck'),
                'before_title'      => '<h3 class="widget-title title-first-letter">',
                'after_title'       => '</h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            );
        }
        $s7upf_config['import_config'] = array(
                'demo_url'                  => 'http://7uptheme.com/wordpress/druck',
                'homepage_default'          => 'Home',
                'blogpage_default'          => 'Blog',
                'menu_replace'              => 'Main Menu',
                'menu_locations'            => array("Main Menu" => "primary"),
                'set_woocommerce_page'      => 1
            );
        $s7upf_config['import_theme_option'] = 'YToxMDI6e3M6MTc6InM3dXBmX2hlYWRlcl9wYWdlIjtzOjM6IjcyNCI7czoxNzoiczd1cGZfZm9vdGVyX3BhZ2UiO3M6MjoiMjgiO3M6MTQ6InM3dXBmXzQwNF9wYWdlIjtzOjM6IjYzOSI7czoyMDoiczd1cGZfNDA0X3BhZ2Vfc3R5bGUiO3M6MDoiIjtzOjE4OiJiZWZvcmVfYXBwZW5kX3BhZ2UiO3M6MDoiIjtzOjE3OiJhZnRlcl9hcHBlbmRfcGFnZSI7czowOiIiO3M6MjA6InM3dXBmX3Nob3dfYnJlYWRydW1iIjtzOjM6Im9mZiI7czoxOToiczd1cGZfYmdfYnJlYWRjcnVtYiI7czowOiIiO3M6MTU6ImJyZWFkY3J1bWJfdGV4dCI7czowOiIiO3M6MjE6ImJyZWFkY3J1bWJfdGV4dF9ob3ZlciI7czowOiIiO3M6MTI6InNob3dfcHJlbG9hZCI7czozOiJvZmYiO3M6MTA6InByZWxvYWRfYmciO3M6MDoiIjtzOjEzOiJwcmVsb2FkX3N0eWxlIjtzOjA6IiI7czoxMToicHJlbG9hZF9pbWciO3M6MDoiIjtzOjE0OiJzN3VwZl9pY29uX2xpYiI7czoxMToibGluZWF3ZXNvbWUiO3M6MTU6InNob3dfc2Nyb2xsX3RvcCI7czoyOiJvbiI7czoyNjoic2hvd193aXNobGlzdF9ub3RpZmljYXRpb24iO3M6Mjoib24iO3M6MTQ6InNob3dfdG9vX3BhbmVsIjtzOjM6Im9mZiI7czoxNToidG9vbF9wYW5lbF9wYWdlIjtzOjA6IiI7czoxMjoic2Vzc2lvbl9wYWdlIjtzOjI6Im9uIjtzOjc6ImJvZHlfYmciO3M6MDoiIjtzOjEwOiJtYWluX2NvbG9yIjtzOjA6IiI7czoxMToibWFpbl9jb2xvcjIiO3M6MDoiIjtzOjE2OiJzN3VwZl9wYWdlX3N0eWxlIjtzOjA6IiI7czoxNToiY29udGFpbmVyX3dpZHRoIjtzOjA6IiI7czoxMToibWFwX2FwaV9rZXkiO3M6Mzk6IkFJemFTeUNFa1E2QVdfbG5IQXpQaVhQZFNOeTFHS1hpSTFJOUFHZyI7czoyMToiZGlzYWJsZV92ZXJpZnlfbm90aWNlIjtzOjM6Im9mZiI7czoxMzoic3ZfbWVudV9jb2xvciI7czowOiIiO3M6MTk6InN2X21lbnVfY29sb3JfaG92ZXIiO3M6MDoiIjtzOjIwOiJzdl9tZW51X2NvbG9yX2FjdGl2ZSI7czowOiIiO3M6MTQ6InN2X21lbnVfY29sb3IyIjtzOjA6IiI7czoyMDoic3ZfbWVudV9jb2xvcl9ob3ZlcjIiO3M6MDoiIjtzOjIxOiJzdl9tZW51X2NvbG9yX2FjdGl2ZTIiO3M6MDoiIjtzOjE4OiJiZWZvcmVfYXBwZW5kX3Bvc3QiO3M6MzoiNTk4IjtzOjE3OiJhZnRlcl9hcHBlbmRfcG9zdCI7czowOiIiO3M6Mjc6InM3dXBmX3NpZGViYXJfcG9zaXRpb25fYmxvZyI7czo1OiJyaWdodCI7czoxODoiczd1cGZfc2lkZWJhcl9ibG9nIjtzOjEyOiJibG9nLXNpZGViYXIiO3M6MTg6ImJsb2dfZGVmYXVsdF9zdHlsZSI7czo0OiJsaXN0IjtzOjEwOiJibG9nX3N0eWxlIjtzOjA6IiI7czoxNDoicG9zdF9saXN0X3NpemUiO3M6NzoiODUweDQwMCI7czoyMDoicG9zdF9saXN0X2l0ZW1fc3R5bGUiO3M6MDoiIjtzOjE2OiJwb3N0X2dyaWRfY29sdW1uIjtzOjE6IjMiO3M6MTQ6InBvc3RfZ3JpZF9zaXplIjtzOjA6IiI7czoxNzoicG9zdF9ncmlkX2V4Y2VycHQiO3M6MzoiMTIwIjtzOjIwOiJwb3N0X2dyaWRfaXRlbV9zdHlsZSI7czowOiIiO3M6MTQ6InBvc3RfZ3JpZF90eXBlIjtzOjA6IiI7czoyNzoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9wb3N0IjtzOjU6InJpZ2h0IjtzOjE4OiJzN3VwZl9zaWRlYmFyX3Bvc3QiO3M6MTI6ImJsb2ctc2lkZWJhciI7czoyMToicG9zdF9zaW5nbGVfdGh1bWJuYWlsIjtzOjI6Im9uIjtzOjE2OiJwb3N0X3NpbmdsZV9zaXplIjtzOjA6IiI7czoxNjoicG9zdF9zaW5nbGVfbWV0YSI7czoyOiJvbiI7czoxODoicG9zdF9zaW5nbGVfYXV0aG9yIjtzOjI6Im9uIjtzOjE5OiJwb3N0X3NpbmdsZV9leGNlcnB0IjtzOjM6Im9mZiI7czoxOToicG9zdF9zaW5nbGVfcmVsYXRlZCI7czoyOiJvbiI7czoyNToicG9zdF9zaW5nbGVfcmVsYXRlZF90aXRsZSI7czoxMjoiUmVsYXRlZCBQb3N0IjtzOjI2OiJwb3N0X3NpbmdsZV9yZWxhdGVkX251bWJlciI7czoxOiI2IjtzOjI0OiJwb3N0X3NpbmdsZV9yZWxhdGVkX2l0ZW0iO3M6OToiMDoxLDU2MDoyIjtzOjMwOiJwb3N0X3NpbmdsZV9yZWxhdGVkX2l0ZW1fc3R5bGUiO3M6Njoic2ltcGxlIjtzOjI3OiJwb3N0X3NpbmdsZV9yZWxhdGVkX2V4Y2VycHQiO3M6MzoiMTIwIjtzOjI3OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX3BhZ2UiO3M6Mjoibm8iO3M6MTg6InM3dXBmX3NpZGViYXJfcGFnZSI7czowOiIiO3M6MzU6InM3dXBmX3NpZGViYXJfcG9zaXRpb25fcGFnZV9hcmNoaXZlIjtzOjU6InJpZ2h0IjtzOjI2OiJzN3VwZl9zaWRlYmFyX3BhZ2VfYXJjaGl2ZSI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjM0OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX3BhZ2Vfc2VhcmNoIjtzOjI6Im5vIjtzOjI1OiJzN3VwZl9zaWRlYmFyX3BhZ2Vfc2VhcmNoIjtzOjA6IiI7czoxNzoiczd1cGZfYWRkX3NpZGViYXIiO2E6Mjp7aTowO2E6Mjp7czo1OiJ0aXRsZSI7czoxNToiUHJvZHVjdCBTaWRlYmFyIjtzOjIwOiJ3aWRnZXRfdGl0bGVfaGVhZGluZyI7czoyOiJoMyI7fWk6MTthOjI6e3M6NToidGl0bGUiO3M6MTM6IkZpdGVyIFNpZGViYXIiO3M6MjA6IndpZGdldF90aXRsZV9oZWFkaW5nIjtzOjI6ImgzIjt9fXM6MTI6Imdvb2dsZV9mb250cyI7YToxOntpOjA7YToxOntzOjY6ImZhbWlseSI7czowOiIiO319czoyNjoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl93b28iO3M6NToicmlnaHQiO3M6MTc6InM3dXBmX3NpZGViYXJfd29vIjtzOjE5OiJ3b29jb21tZXJjZS1zaWRlYmFyIjtzOjE4OiJzaG9wX2RlZmF1bHRfc3R5bGUiO3M6MTA6ImdyaWQtMy1jb2wiO3M6MTY6InNob3BfZ2FwX3Byb2R1Y3QiO3M6MDoiIjtzOjE1OiJ3b29fc2hvcF9udW1iZXIiO3M6MjoiMTIiO3M6MTU6InN2X3NldF90aW1lX3dvbyI7czowOiIiO3M6MTA6InNob3Bfc3R5bGUiO3M6MDoiIjtzOjk6InNob3BfYWpheCI7czoyOiJvbiI7czoyMDoic2hvcF90aHVtYl9hbmltYXRpb24iO3M6MTA6ImZhZGUtdGh1bWIiO3M6MTg6InNob3BfbnVtYmVyX2ZpbHRlciI7czoyOiJvbiI7czoxNjoic2hvcF90eXBlX2ZpbHRlciI7czoyOiJvbiI7czoxNDoic2hvcF9saXN0X3NpemUiO3M6NzoiMzAweDMwMCI7czoyMDoic2hvcF9saXN0X2l0ZW1fc3R5bGUiO3M6MDoiIjtzOjE0OiJzaG9wX2dyaWRfc2l6ZSI7czo3OiI0MTB4Mjc1IjtzOjIwOiJzaG9wX2dyaWRfaXRlbV9zdHlsZSI7czowOiIiO3M6MTQ6InNob3BfZ3JpZF90eXBlIjtzOjA6IiI7czoyMToiczd1cGZfaGVhZGVyX3BhZ2Vfd29vIjtzOjA6IiI7czoyMToiczd1cGZfZm9vdGVyX3BhZ2Vfd29vIjtzOjA6IiI7czoxNzoiYmVmb3JlX2FwcGVuZF93b28iO3M6MzoiNTg1IjtzOjE2OiJhZnRlcl9hcHBlbmRfd29vIjtzOjA6IiI7czozMDoic3Zfc2lkZWJhcl9wb3NpdGlvbl93b29fc2luZ2xlIjtzOjI6Im5vIjtzOjIxOiJzdl9zaWRlYmFyX3dvb19zaW5nbGUiO3M6MDoiIjtzOjE4OiJwcm9kdWN0X2ltYWdlX3pvb20iO3M6MTE6Inpvb20tc3R5bGUzIjtzOjEyOiJzaG93X2V4Y2VycHQiO3M6Mjoib24iO3M6MTE6InNob3dfbGF0ZXN0IjtzOjM6Im9mZiI7czoxMToic2hvd191cHNlbGwiO3M6Mzoib2ZmIjtzOjEyOiJzaG93X3JlbGF0ZWQiO3M6Mjoib24iO3M6MTg6InNob3dfc2luZ2xlX251bWJlciI7czoxOiI2IjtzOjE2OiJzaG93X3NpbmdsZV9zaXplIjtzOjA6IiI7czoxOToic2hvd19zaW5nbGVfaXRlbXJlcyI7czowOiIiO3M6MjI6InNob3dfc2luZ2xlX2l0ZW1fc3R5bGUiO3M6MDoiIjtzOjI0OiJiZWZvcmVfYXBwZW5kX3dvb19zaW5nbGUiO3M6MzoiNTg1IjtzOjE3OiJiZWZvcmVfYXBwZW5kX3RhYiI7czowOiIiO3M6MTY6ImFmdGVyX2FwcGVuZF90YWIiO3M6MDoiIjtzOjIzOiJhZnRlcl9hcHBlbmRfd29vX3NpbmdsZSI7czowOiIiO30=';
        $s7upf_config['import_widget'] = '{"blog-sidebar":{"s7upf_listpostswidget-2":{"title":"Recent Posts","posts_per_page":"4","category":"0","order":"desc","order_by":"none"},"categories-3":{"title":"Categories","count":1,"hierarchical":0,"dropdown":0},"media_gallery-2":{"title":"Gallery","columns":3,"size":"thumbnail","link_type":"post","orderby_random":false,"ids":[455,454,453,380,381,382,383,384,385]},"calendar-2":{"title":"Calendar"},"tag_cloud-2":{"title":"Tags","count":1,"taxonomy":"post_tag"},"text-2":{"title":"","text":"<div class=\"banner-advs widget-advs\">\r\n<div class=\"image-thumb\"><img class=\"alignnone size-full wp-image-498\" src=\"http:\/\/7uptheme.com\/wordpress\/druck\/wp-content\/uploads\/2018\/11\/banner-sidebar.jpg\" alt=\"\" width=\"270\" height=\"400\" \/><\/div>\r\n<div class=\"banner-info white text-center text-uppercase\">\r\n<h2 class=\"title24 lora-font\">up to 40% off<\/h2>\r\n<h3 class=\"title18 lora-font\">in 3 days<\/h3>\r\n<div><a class=\"shop-button bg-color curl-top-right\" href=\"http:\/\/7uptheme.com\/wordpress\/druck\/shop\/\">shop now<\/a><\/div>\r\n<\/div>\r\n<\/div>"}},"woocommerce-sidebar":{"s7upf_category_fillter-2":{"title":"Categories","category":["banners-frames","business-cards","business-stationery","cards-invites","documents","marketing-materials","posters-plans"]},"woocommerce_price_filter-1":{"title":"Price"},"s7upf_attribute_filter-2":{"title":"Color","attribute":"color"},"s7upf_attribute_filter-3":{"title":"Size","attribute":"size"},"s7upf_list_products-2":{"title":"Best Seller","number":"3","product_type":"bestsell"}},"product-sidebar":{"woocommerce_product_categories-2":{"title":"Categories","orderby":"name","dropdown":0,"count":1,"hierarchical":1,"show_children_only":0,"hide_empty":1,"max_depth":"1"},"s7upf_list_products-3":{"title":"Best Seller","number":"3","product_type":"bestsell"},"text-3":{"title":"","text":"<div class=\"banner-advs widget-advs\">\r\n<div class=\"image-thumb\"><img class=\"alignnone size-full wp-image-498\" src=\"http:\/\/7uptheme.com\/wordpress\/druck\/wp-content\/uploads\/2018\/11\/banner-sidebar.jpg\" alt=\"\" width=\"270\" height=\"400\" \/><\/div>\r\n<div class=\"banner-info white text-center text-uppercase\">\r\n<h2 class=\"title24 lora-font\">up to 40% off<\/h2>\r\n<h3 class=\"title18 lora-font\">in 3 days<\/h3>\r\n<div><a class=\"shop-button bg-color curl-top-right\" href=\"http:\/\/7uptheme.com\/wordpress\/druck\/shop\/\">shop now<\/a><\/div>\r\n<\/div>\r\n<\/div>"}},"fiter-sidebar":{"s7upf_category_fillter-3":{"title":"Categories","category":["backdrop","brochure","business-cards","cards-invites","catalog","documents","envelop"]},"woocommerce_price_filter-2":{"title":"Price"},"s7upf_attribute_filter-4":{"title":"Size","attribute":"size"},"s7upf_attribute_filter-5":{"title":"Color","attribute":"color"}},"undefined":{"search-2":{"title":""},"recent-posts-2":{"title":"","number":5},"recent-comments-2":{"title":"","number":5},"categories-2":{"title":"","count":0,"hierarchical":0,"dropdown":0},"meta-2":{"title":""}}}';
        $s7upf_config['import_category'] = '{"backdrop":{"thumbnail":"0","parent":"business-cards"},"banners-frames":{"thumbnail":"0","parent":""},"brochure":{"thumbnail":"0","parent":"business-cards"},"business-cards":{"thumbnail":"0","parent":""},"business-stationery":{"thumbnail":"0","parent":""},"card":{"thumbnail":"0","parent":"cards-invites"},"cards-invites":{"thumbnail":"0","parent":""},"catalog":{"thumbnail":"0","parent":"cards-invites"},"documents":{"thumbnail":"0","parent":""},"envelop":{"thumbnail":"0","parent":"documents"},"marketing-materials":{"thumbnail":"0","parent":""},"posters-plans":{"thumbnail":"0","parent":""},"print-full":{"thumbnail":"0","parent":"posters-plans"},"print-laser":{"thumbnail":"0","parent":"posters-plans"},"print-offset":{"thumbnail":"0","parent":"posters-plans"}}';

        /**************************************** PLUGINS ****************************************/

        $s7upf_config['require-plugin-begin'] = array(
            array(
                'name'      => esc_html__( '7up Core', 'druck'),
                'slug'      => '7up-core',
                'required'  => true,
                'source'    =>get_template_directory().'/plugins/7up-core.zip',
                'version'   => '1.3',
            ),
        );

        $s7upf_config['require-plugin'] = array(
            array(
                'name'      => esc_html__( '7up Core', 'druck'),
                'slug'      => '7up-core',
                'required'  => true,
                'source'    =>get_template_directory().'/plugins/7up-core.zip',
                'version'   => '1.3',
            ),   
            array(
                'name'      => esc_html__( 'WpBakery Page Builder', 'druck'),
                'slug'      => 'js_composer',
                'required'  => true,
                'source'    => get_template_directory().'/plugins/js_composer.zip',
                'version'   => '5.7',
            ),
            array(
                'name'      => esc_html__( 'WooCommerce', 'druck'),
                'slug'      => 'woocommerce',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__( 'Contact Form 7', 'druck'),
                'slug'      => 'contact-form-7',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('MailChimp for WordPress Lite','druck'),
                'slug'      => 'mailchimp-for-wp',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Compare','druck'),
                'slug'      => 'yith-woocommerce-compare',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Wishlist','druck'),
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => false,
            )
        );

    /**************************************** PLUGINS ****************************************/
        $s7upf_config['theme-option'] = array(
            'sections' => array(
                array(
                    'id'    => 'option_basic',
                    'title' => '<i class="fa fa-cog"></i>'.esc_html__(' Basic Settings', 'druck')
                ),
                array(
                    'id'    => 'option_menu',
                    'title' => '<i class="fa fa-align-justify"></i>'.esc_html__(' Menu Settings', 'druck')
                ),
                array(
                    'id'    => 'blog_post',
                    'title' => '<i class="fa fa-bold"></i>'.esc_html__(' Blog & Post', 'druck')
                ),
                array(
                    'id'    => 'option_layout',
                    'title' => '<i class="fa fa-columns"></i>'.esc_html__(' Layout Settings', 'druck')
                ),
                array(
                    'id'    => 'option_typography',
                    'title' => '<i class="fa fa-font"></i>'.esc_html__(' Typography', 'druck')
                )
            ),
            'settings' => array(
                 /*----------------Begin Basic --------------------*/
                array(
                    'id'          => 'tab_general_theme',
                    'type'        => 'tab',
                    'section'     => 'option_basic',
                    'label'       => esc_html__('General','druck')
                ),
                array(
                    'id'          => 's7upf_header_page',
                    'label'       => esc_html__( 'Header Page', 'druck' ),
                    'desc'        => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_header')
                ),
                array(
                    'id'          => 's7upf_footer_page',
                    'label'       => esc_html__( 'Footer Page', 'druck' ),
                    'desc'        => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_footer')
                ),
                array(
                    'id'          => 's7upf_404_page',
                    'label'       => esc_html__( '404 Page', 'druck' ),
                    'desc'        => esc_html__( 'Include page to 404 page', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item')
                ),
                array(
                    'id'          => 's7upf_404_page_style',
                    'label'       => esc_html__( '404 Style', 'druck' ),
                    'desc'        => esc_html__( 'Choose a style to display.', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => array(
                        array(
                            'value' => '',
                            'label' => esc_html__('Default','druck'),
                        ),
                        array(
                            'value' => 'full-width',
                            'label' => esc_html__('FullWidth','druck'),
                        ),
                    ),
                    'condition'   => 's7upf_404_page:not()',
                ),                                
                array(
                    'id'          => 'before_append_page',
                    'label'       => esc_html__('Append content before page(default)','druck'),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page with template default.','druck'),
                ),
                array(
                    'id'          => 'after_append_page',
                    'label'       => esc_html__('Append content after page(default)','druck'),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page with template default.','druck'),
                ),
                array(
                    'id'        => 'tab_breadcrumb',
                    'type'      => 'tab',
                    'section'   => 'option_basic',
                    'label'     => esc_html__('Breadcumb','druck')
                ),
                array(
                    'id'        => 's7upf_show_breadrumb',
                    'label'     => esc_html__('Show BreadCrumb', 'druck'),
                    'desc'      => esc_html__('This allow you to show or hide BreadCrumb', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'on'
                ),
                array(
                    'id'          => 's7upf_bg_breadcrumb',
                    'label'       => esc_html__('Background Breadcrumb','druck'),
                    'type'        => 'background',
                    'section'     => 'option_basic',
                    'condition'   => 's7upf_show_breadrumb:is(on)',
                    'desc'        => esc_html__( 'Custom background for breadcrumb.', 'druck' ),
                ),
                array(
                    'id'          => 'breadcrumb_text',
                    'label'       => esc_html__('Breadcrumb text','druck'),
                    'type'        => 'typography',
                    'section'     => 'option_basic',
                    'condition'   => 's7upf_show_breadrumb:is(on)',
                    'desc'        => esc_html__( 'Custom font in breadcrumb.', 'druck' ),
                ),
                array(
                    'id'          => 'breadcrumb_text_hover',
                    'label'       => esc_html__('Breadcrumb text hover','druck'),
                    'type'        => 'typography',
                    'section'     => 'option_basic',
                    'condition'   => 's7upf_show_breadrumb:is(on)',
                    'desc'        => esc_html__( 'Custom font when you hover in text of breadcrumb.', 'druck' ),
                ),
                array(
                    'id'        => 'tab_preload',
                    'type'      => 'tab',
                    'section'   => 'option_basic',
                    'label'     => esc_html__('Preload','druck')
                ),
                array(
                    'id'        => 'show_preload',
                    'label'     => esc_html__('Show Preload', 'druck'),
                    'desc'      => esc_html__('This allow you to show or hide preload', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'off'
                ),
                array(
                    'id'          => 'preload_bg',
                    'label'       => esc_html__('Background','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'Change default body background.', 'druck' ),
                    'condition'   => 'show_preload:is(on)',
                ),
                array(
                    'id'          => 'preload_style',
                    'label'       => esc_html__('Preload Style','druck'),
                    'type'        => 'select',
                    'std'         => '',
                    'section'     => 'option_basic',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Style 1','druck'),
                            'value' =>  '',
                        ),
                        array(
                            'label' =>  esc_html__('Style 2','druck'),
                            'value' =>  'style2'
                        ),
                        array(
                            'label' =>  esc_html__('Style 3','druck'),
                            'value' =>  'style3'
                        ),
                        array(
                            'label' =>  esc_html__('Style 4','druck'),
                            'value' =>  'style4'
                        ),
                        array(
                            'label' =>  esc_html__('Style 5','druck'),
                            'value' =>  'style5'
                        ),
                        array(
                            'label' =>  esc_html__('Style 6','druck'),
                            'value' =>  'style6'
                        ),
                        array(
                            'label' =>  esc_html__('Style 7','druck'),
                            'value' =>  'style7'
                        ),
                        array(
                            'label' =>  esc_html__('Custom image','druck'),
                            'value' =>  'custom-image'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for your site.', 'druck' ),
                    'condition'   => 'show_preload:is(on)',
                ),
                array(
                    'id'          => 'preload_img',
                    'label'       => esc_html__('Preload Image','druck'),
                    'type'        => 'upload',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'Choose a image to display as preload.', 'druck' ),
                    'condition'   => 'show_preload:is(on),preload_style:is(custom-image)',
                ),
                array(
                    'id'        => 'tab_other',
                    'type'      => 'tab',
                    'section'   => 'option_basic',
                    'label'     => esc_html__('Other','druck')
                ),
                array(
                    'id'          => 's7upf_icon_lib',
                    'label'       => esc_html__('Default icon','druck'),
                    'type'        => 'select',
                    'std'         => 'lineawesome',
                    'section'     => 'option_basic',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Line Awesome','druck'),
                            'value' =>  'lineawesome'
                        ),
                        array(
                            'label' =>  esc_html__('Font Awesome','druck'),
                            'value' =>  'fontawesome',
                        ),
                        array(
                            'label' =>  esc_html__('Open Iconic','druck'),
                            'value' =>  'openiconic'
                        ),
                        array(
                            'label' =>  esc_html__('Typicons','druck'),
                            'value' =>  'typicons'
                        ),
                        array(
                            'label' =>  esc_html__('Entypo','druck'),
                            'value' =>  'entypo'
                        ),
                        array(
                            'label' =>  esc_html__('Linecons','druck'),
                            'value' =>  'linecons'
                        ),
                        array(
                            'label' =>  esc_html__('Mono Social','druck'),
                            'value' =>  'monosocial'
                        ),
                        array(
                            'label' =>  esc_html__('Material','druck'),
                            'value' =>  'material'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for pages.', 'druck' ),
                ),
                array(
                    'id'        => 'show_scroll_top',
                    'label'     => esc_html__('Show scroll top button', 'druck'),
                    'desc'      => esc_html__('This allow you to show or hide scroll top button', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'off'
                ),
                array(
                    'id'        => 'show_wishlist_notification',
                    'label'     => esc_html__('Show wishlist notification', 'druck'),
                    'desc'      => esc_html__('This allow you to show or hide wishlist notification when add to wishlist.', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'off'
                ),
                array(
                    'id'        => 'show_too_panel',
                    'label'     => esc_html__('Show tool panel', 'druck'),
                    'desc'      => esc_html__('This allow you to show or hide tool panel.', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'off'
                ),
                array(
                    'id'          => 'tool_panel_page',
                    'label'       => esc_html__( 'Choose tool panel page', 'druck' ),
                    'desc'        => esc_html__( 'Choose a mega page to display.', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_basic',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'condition'   => 'show_too_panel:is(on)',
                ),
                array(
                    'id'        => 'session_page',
                    'label'     => esc_html__('Session page', 'druck'),
                    'desc'      => esc_html__('Enable session page to auto load header,footer,main color in other pages.', 'druck'),
                    'type'      => 'on-off',
                    'section'   => 'option_basic',
                    'std'       => 'off'
                ),
                array(
                    'id'          => 'body_bg',
                    'label'       => esc_html__('Body Background','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'Change default body background.', 'druck' ),
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'Change main color of your site.', 'druck' ),
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'Change main color 2 of your site.', 'druck' ),
                ),
                array(
                    'id'          => 's7upf_page_style',
                    'label'       => esc_html__('Page Style','druck'),
                    'type'        => 'select',
                    'std'         => '',
                    'section'     => 'option_basic',
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
                    'desc'        => esc_html__( 'Choose default style for pages.', 'druck' ),
                ),
                array(
                    'id'          => 'container_width',
                    'label'       => esc_html__('Custom container width(px)','druck'),
                    'type'        => 'text',
                    'section'     => 'option_basic',
                    'desc'        => esc_html__( 'You can custom width of container on your site. Default is 1200px.', 'druck' ),
                ), 
                array(
                    'id'          => 'map_api_key',
                    'label'       => esc_html__('Map API key','druck'),
                    'type'        => 'text',
                    'section'     => 'option_basic',
                    'std'         => '',// ex: AIzaSyBX2IiEBg-0lQKQQ6wk6sWRGQnWI7iogf0
                    'desc'        => esc_html__( 'Enter your Map API key to display your location on google maps element.', 'druck' ).' </br><a target="_blank" href="//developers.google.com/maps/documentation/javascript/get-api-key">Get API</a>',
                ),
                array(
                    'id'          => 'post_single_share',
                    'label'       => esc_html__('Show share box','druck'),
                    'type'        => 'checkbox',
                    'section'     => 'option_basic',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Post','druck'),
                            'value' =>  'post',
                        ),
                        array(
                            'label' =>  esc_html__('Page','druck'),
                            'value' =>  'page',
                        ),
                        array(
                            'label' =>  esc_html__('Product','druck'),
                            'value' =>  'product'
                        ),
                    ),
                    'desc'        => esc_html__( 'You can show/hide share box on post, page, product pages. ', 'druck' ),
                ),
                array(
                    'id'          => 'post_single_share_list',
                    'label'       => esc_html__('Add custom share box','druck'),
                    'type'        => 'list-item',
                    'section'     => 'option_basic',
                    'std'         => '',
                    'settings'    => array( 
                        array(
                            'id'          => 'social',
                            'label'       => esc_html__('Social','druck'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'total',
                                    'label'=>esc_html__('Total share','druck'),
                                ),
                                array(
                                    'value'=>'facebook',
                                    'label'=>esc_html__('Facebook','druck'),
                                ),
                                array(
                                    'value'=>'twitter',
                                    'label'=>esc_html__('Twitter','druck'),
                                ),
                                array(
                                    'value'=>'google',
                                    'label'=>esc_html__('Google plus','druck'),
                                ),
                                array(
                                    'value'=>'pinterest',
                                    'label'=>esc_html__('Pinterest','druck'),
                                ),
                                array(
                                    'value'=>'linkedin',
                                    'label'=>esc_html__('Linkedin','druck'),
                                ),
                                array(
                                    'value'=>'tumblr',
                                    'label'=>esc_html__('Tumblr','druck'),
                                ),
                                array(
                                    'value'=>'envelope',
                                    'label'=>esc_html__('Mail','druck'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'number',
                            'label'       => esc_html__('Show number','druck'),
                            'type'        => 'on-off',
                            'std'         => 'on',                            
                        ),
                    ),
                ),
                array(
                    'id'          => 'disable_verify_notice',
                    'label'       => esc_html__('Disable Verify Menu','druck'),
                    'type'        => 'on-off',
                    'std'         => 'off',
                    'section'     => 'option_basic',
                ),
                /*----------------End Basic ----------------------*/

                /*----------------Begin Menu --------------------*/
                array(
                    'id'          => 'sv_menu_color',
                    'label'       => esc_html__('Menu style','druck'),
                    'type'        => 'typography',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_hover',
                    'label'       => esc_html__('Hover color','druck'),
                    'desc'        => esc_html__('Choose color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_active',
                    'label'       => esc_html__('Background Hover color','druck'),
                    'desc'        => esc_html__('Choose color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color2',
                    'label'       => esc_html__('Menu Sub style','druck'),
                    'type'        => 'typography',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_hover2',
                    'label'       => esc_html__('Hover Sub color','druck'),
                    'desc'        => esc_html__('Choose color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_menu',
                ),
                array(
                    'id'          => 'sv_menu_color_active2',
                    'label'       => esc_html__('Background Sub Hover color','druck'),
                    'desc'        => esc_html__('Choose color','druck'),
                    'type'        => 'colorpicker-opacity',
                    'section'     => 'option_menu',
                ),
                /*----------------End Menu ----------------------*/
                
                /*----------------Begin Blog + Post --------------------*/
                array(
                    'id'        => 'tab_blog_general',
                    'type'      => 'tab',
                    'section'   => 'blog_post',
                    'label'     => esc_html__('General','druck')
                ),                
                array(
                    'id'          => 'before_append_post',
                    'label'       => esc_html__('Append content before post/blog/archive page','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of post/blog/archive page.','druck'),
                ),
                array(
                    'id'          => 'after_append_post',
                    'label'       => esc_html__('Append content after post/blog/archive page','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of post/blog/archive page.','druck'),
                ),
                array(
                    'id'          => 's7upf_sidebar_position_blog',
                    'label'       => esc_html__('Sidebar Blog','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'=>esc_html__('Set sidebar position for your blog page. Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_blog',
                    'label'       => esc_html__('Sidebar select display in blog','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'blog_post',
                    'condition'   => 's7upf_sidebar_position_blog:not(no)',
                    'desc'        => esc_html__('Choose a sidebar to display.','druck'),
                ),
                array(
                    'id'          => 'blog_default_style',
                    'label'       => esc_html__('Default style','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        =>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'list',
                            'label'=>esc_html__('List','druck'),
                        ),
                        array(
                            'value'=>'grid',
                            'label'=>esc_html__('Grid','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 'blog_style',
                    'label'       => esc_html__('Blog pagination','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        =>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default','druck'),
                        ),
                        array(
                            'value'=>'load-more',
                            'label'=>esc_html__('Load more','druck'),
                        )
                    )
                ),
                 //Tab list
                array(
                    'id'        => 'tab_blog_list',
                    'type'      => 'tab',
                    'section'   => 'blog_post',
                    'label'     => esc_html__('List Settings','druck')
                ),
                array(
                    'id'          => 'post_list_size',
                    'label'       => esc_html__('Custom list thumbnail size','druck'),
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck')
                ),
                array(
                    'id'          => 'post_list_item_style',
                    'label'       => esc_html__('List item style','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'=>esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_post_list_style('option')
                ),
                //Tab grid
                array(
                    'id'        => 'tab_blog_grid',
                    'type'      => 'tab',
                    'section'   => 'blog_post',
                    'label'     => esc_html__('Grid Settings','druck')
                ),
                array(
                    'id'          => 'post_grid_column',
                    'label'       => esc_html__('Grid column','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'std'         => '3',
                    'desc'=>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'2',
                            'label'=>esc_html__('2 column','druck'),
                        ),
                        array(
                            'value'=>'3',
                            'label'=>esc_html__('3 column','druck'),
                        ),
                        array(
                            'value'=>'4',
                            'label'=>esc_html__('4 column','druck'),
                        ),
                        array(
                            'value'=>'5',
                            'label'=>esc_html__('5 column','druck'),
                        ),
                        array(
                            'value'=>'6',
                            'label'=>esc_html__('6 column','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 'post_grid_size',
                    'label'       => esc_html__('Custom grid thumbnail size','druck'),
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck')
                ),
                array(
                    'id'          => 'post_grid_excerpt',
                    'label'       => esc_html__('Grid Sub string excerpt','druck'),
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'std'         => '80',
                    'desc'        => esc_html__('Enter number of character want to get from excerpt content. Default is 0(hidden). Example is 80. Note: This value only apply for items style can be show excerpt.','druck')
                ),
                array(
                    'id'          => 'post_grid_item_style',
                    'label'       => esc_html__('Grid item style','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        =>esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_post_style('option')
                ),
                array(
                    'id'          => 'post_grid_type',
                    'label'       => esc_html__('Grid display','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        =>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default','druck'),
                        ),
                        array(
                            'value'=>'list-masonry',
                            'label'=>esc_html__('Masonry','druck'),
                        )
                    )
                ),
                //Post detail
                array(
                    'id'        => 'tab_blog_post_detail',
                    'type'      => 'tab',
                    'section'   => 'blog_post',
                    'label'     => esc_html__('Post detail Settings','druck')
                ),
                array(
                    'id'          => 's7upf_sidebar_position_post',
                    'label'       => esc_html__('Sidebar Single Post','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        => esc_html__('Set sidebar position for your post detail page. Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_post',
                    'label'       => esc_html__('Sidebar select display in single post','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'blog_post',
                    'condition'   => 's7upf_sidebar_position_post:not(no)',                    
                    'desc'        => esc_html__('Choose a sidebar to display.','druck'),
                ),
                array(
                    'id'          => 'post_single_thumbnail',
                    'label'       => esc_html__('Show thumbnail/media','druck'),
                    'desc'        => 'Show/hide thumbnail image, gallery, media on post detail.',
                    'type'        => 'on-off',
                    'section'     => 'blog_post',
                    'std'         => 'on',
                ),                
                array(
                    'id'          => 'post_single_size',
                    'label'       => esc_html__('Custom single image size','druck'),
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck'),
                    'condition'   => 'post_single_thumbnail:is(on)',
                ),
                array(
                    'id'          => 'post_single_meta',
                    'label'       => esc_html__('Show meta data','druck'),
                    'desc'        => 'Show/hide meta data(author, date, comments, categories, tags) on post detail.',
                    'type'        => 'on-off',
                    'section'     => 'blog_post',
                    'std'         => 'off',
                ),
                array(
                    'id'          => 'post_single_author',
                    'label'       => esc_html__('Show author box','druck'),
                    'desc'        => 'Show/hide author box on post detail.',
                    'type'        => 'on-off',
                    'section'     => 'blog_post',
                    'std'         => 'off',
                ),
                array(
                    'id'          => 'post_single_excerpt',
                    'label'       => esc_html__('Show single post excerpt','druck'),
                    'desc'        => 'Show/hide excerpt on post detail.',
                    'type'        => 'on-off',
                    'section'     => 'blog_post',
                    'std'         => 'off',
                ),
                // Related section
                array(
                    'id'          => 'post_single_related',
                    'label'       => esc_html__('Show related post','druck'),
                    'desc'        => 'Show/hide related post on the post detail.',
                    'type'        => 'on-off',
                    'section'     => 'blog_post',
                    'std'         => 'off',
                ),
                array(
                    'id'          => 'post_single_related_title',
                    'label'       => esc_html__('Related title','druck'),
                    'desc'        => 'Enter title of related section.',
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'condition'   => 'post_single_related:is(on)',
                ),
                array(
                    'id'          => 'post_single_related_number',
                    'label'       => esc_html__('Related number post','druck'),
                    'desc'        => 'Enter number of related post to display.',
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'condition'   => 'post_single_related:is(on)',
                ),
                array(
                    'id'          => 'post_single_related_item',
                    'label'       => esc_html__('Related custom number item responsive','druck'),
                    'desc'        => 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.',
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'condition'   => 'post_single_related:is(on)',
                ),
                array(
                    'id'          => 'post_single_related_item_style',
                    'label'       => esc_html__('Related item style','druck'),
                    'type'        => 'select',
                    'section'     => 'blog_post',
                    'desc'        =>esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_post_style('option'),
                    'condition'   => 'post_single_related:is(on)',
                ),
				array(
                    'id'          => 'post_single_related_excerpt',
                    'label'       => esc_html__('Related excerpt post','druck'),
                    'desc'        => 'Enter number of related post excerpt string.',
                    'type'        => 'text',
                    'section'     => 'blog_post',
                    'condition'   => 'post_single_related:is(on)',
                ),
                // End related

                /*----------------End Blog + Post ----------------------*/

                /*----------------Begin Layout --------------------*/
                array(
                    'id'          => 's7upf_sidebar_position_page',
                    'label'       => esc_html__('Sidebar Page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'        => esc_html__('Set sidebar position for your default page. Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_page',
                    'label'       => esc_html__('Sidebar select display in page','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_page:not(no)',                    
                    'desc'        => esc_html__('Choose a sidebar to display.','druck'),
                ),
                /****end page****/
                array(
                    'id'          => 's7upf_sidebar_position_page_archive',
                    'label'       => esc_html__('Sidebar Position on Page Archives:','druck'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'        => esc_html__('Set sidebar position for your archives page(category/tag/author page...). Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_page_archive',
                    'label'       => esc_html__('Sidebar select display in page Archives','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_page_archive:not(no)',
                    'desc'        => esc_html__('Choose a sidebar to display.','druck'),
                ),
                array(
                    'id'          => 's7upf_sidebar_position_page_search',
                    'label'       => esc_html__('Sidebar Position on search page:','druck'),
                    'type'        => 'select',
                    'section'     => 'option_layout',
                    'desc'        => esc_html__('Set sidebar position for your search page. Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_page_search',
                    'label'       => esc_html__('Sidebar select display in page Archives','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_layout',
                    'condition'   => 's7upf_sidebar_position_page_search:not(no)',
                    'desc'        => esc_html__('Choose a sidebar to display.','druck'),
                ),
                // END                
                array(
                    'id'          => 's7upf_add_sidebar',
                    'label'       => esc_html__('Add SideBar','druck'),
                    'type'        => 'list-item',
                    'section'     => 'option_layout',
                    'std'         => '',
                    'settings'    => array( 
                        array(
                            'id'          => 'widget_title_heading',
                            'label'       => esc_html__('Choose heading title widget','druck'),
                            'type'        => 'select',
                            'std'        => 'h3',
                            'choices'     => array(
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','druck'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','druck'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','druck'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','druck'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','druck'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','druck'),
                                ),
                            )
                        ),
                    ),
                ),
                /*----------------End Layout ----------------------*/

                /*----------------Begin Blog ----------------------*/       
                

                /*----------------End BLOG----------------------*/

                /*----------------Begin Typography ----------------------*/
                array(
                    'id'          => 's7upf_custom_typography',
                    'label'       => esc_html__('Add Settings','druck'),
                    'type'        => 'list-item',
                    'section'     => 'option_typography',
                    'std'         => '',
                    'settings'    => array(
                        array(
                            'id'          => 'typo_area',
                            'label'       => esc_html__('Choose Area to style','druck'),
                            'type'        => 'select',
                            'std'        => 'main',
                            'choices'     => array(
                                array(
                                    'value'=>'body',
                                    'label'=>esc_html__('Body','druck'),
                                ),
                                array(
                                    'value'=>'header',
                                    'label'=>esc_html__('Header','druck'),
                                ),
                                array(
                                    'value'=>'main',
                                    'label'=>esc_html__('Main Content','druck'),
                                ),
                                array(
                                    'value'=>'widget',
                                    'label'=>esc_html__('Widget','druck'),
                                ),
                                array(
                                    'value'=>'footer',
                                    'label'=>esc_html__('Footer','druck'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typo_heading',
                            'label'       => esc_html__('Choose heading Area','druck'),
                            'type'        => 'select',
                            'std'        => '',
                            'choices'     => array(
                                array(
                                    'value'=>'',
                                    'label'=>esc_html__('All','druck'),
                                ),
                                array(
                                    'value'=>'h1',
                                    'label'=>esc_html__('H1','druck'),
                                ),
                                array(
                                    'value'=>'h2',
                                    'label'=>esc_html__('H2','druck'),
                                ),
                                array(
                                    'value'=>'h3',
                                    'label'=>esc_html__('H3','druck'),
                                ),
                                array(
                                    'value'=>'h4',
                                    'label'=>esc_html__('H4','druck'),
                                ),
                                array(
                                    'value'=>'h5',
                                    'label'=>esc_html__('H5','druck'),
                                ),
                                array(
                                    'value'=>'h6',
                                    'label'=>esc_html__('H6','druck'),
                                ),
                                array(
                                    'value'=>'a',
                                    'label'=>esc_html__('a','druck'),
                                ),
                                array(
                                    'value'=>'p',
                                    'label'=>esc_html__('p','druck'),
                                ),
                                array(
                                    'value'=>'span',
                                    'label'=>esc_html__('span','druck'),
                                ),
                                array(
                                    'value'=>'i',
                                    'label'=>esc_html__('i','druck'),
                                ),
                                array(
                                    'value'=>'quote',
                                    'label'=>esc_html__('quote','druck'),
                                ),
                            )
                        ),
                        array(
                            'id'          => 'typography_style',
                            'label'       => esc_html__('Add Style','druck'),
                            'type'        => 'typography',
                            'section'     => 'option_typography',
                        ),
                    ),
                ),        
                array(
                    'id'          => 'google_fonts',
                    'label'       => esc_html__('Add Google Fonts','druck'),
                    'type'        => 'google-fonts',
                    'section'     => 'option_typography',
                ),
                /*----------------End Typography ----------------------*/
            )
        );
        if(class_exists( 'WooCommerce' )){
            // Add woo sections
            $woo_sections = array(
                array(
                    'id' => 'option_woo',
                    'title' => '<i class="fa fa-shopping-cart"></i>'.esc_html__(' Shop Settings', 'druck')
                ),
                array(
                    'id' => 'option_product',
                    'title' => '<i class="fa fa-th-large"></i>'.esc_html__(' Product Settings', 'druck')
                )
            );
            $s7upf_config['theme-option']['sections'] = array_merge($s7upf_config['theme-option']['sections'],$woo_sections);
            // End add sections

            // Add woo setting
            $woo_settings = array(                
                array(
                    'id'        => 'tab_shop_general',
                    'type'      => 'tab',
                    'section'   => 'option_woo',
                    'label'     => esc_html__('General','druck')
                ),
                array(
                    'id'          => 's7upf_sidebar_position_woo',
                    'label'       => esc_html__('Sidebar Position WooCommerce page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Set sidebar position for your woocommerce page(Shop, Checkout, Cart, My Account, Product category/tag/taxonomy page...). Left, Right, or No sidebar.','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 's7upf_sidebar_woo',
                    'label'       => esc_html__('Sidebar select WooCommerce page','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_woo',
                    'condition'   => 's7upf_sidebar_position_woo:not(no)',
                    'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','druck'),

                ),
                array(
                    'id'          => 'shop_default_style',
                    'label'       => esc_html__('Default style','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'=>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(                        
                        array(
                            'value'=>'list',
                            'label'=>esc_html__('List','druck'),
                        ),
                        array(
                            'value'=>'grid-2-col',
                            'label'=>esc_html__('Grid 2 Column','druck'),
                        ),
                        array(
                            'value'=>'grid-3-col',
                            'label'=>esc_html__('Grid 3 Column','druck'),
                        ),
                        array(
                            'value'=>'grid-4-col',
                            'label'=>esc_html__('Grid 4 Column','druck'),
                        ),
                    )
                ),
                array(
                    'id'          => 'shop_gap_product',
                    'label'       => esc_html__('Gap Products','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'=>esc_html__('Choose space. The space between the items on the shop page.','druck'),
                    'choices'     => array(                        
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default','druck'),
                        ),
                        array(
                            'value'=>'gap-0',
                            'label'=>esc_html__('0','druck'),
                        ),
                        array(
                            'value'=>'gap-5',
                            'label'=>esc_html__('5px','druck'),
                        ),
                        array(
                            'value'=>'gap-10',
                            'label'=>esc_html__('10px','druck'),
                        ),
                        array(
                            'value'=>'gap-15',
                            'label'=>esc_html__('15px','druck'),
                        ),
                        array(
                            'value'=>'gap-20',
                            'label'=>esc_html__('20px','druck'),
                        ),
                        array(
                            'value'=>'gap-30',
                            'label'=>esc_html__('30px','druck'),
                        ),
                        array(
                            'value'=>'gap-40',
                            'label'=>esc_html__('40px','druck'),
                        ),
                        array(
                            'value'=>'gap-50',
                            'label'=>esc_html__('50px','druck'),
                        ),

                    )
                ),
                array(
                    'id'          => 'woo_shop_number',
                    'label'       => esc_html__('Product Number','druck'),
                    'type'        => 'text',
                    'section'     => 'option_woo',
                    'std'         => '12',
                    'desc'        => esc_html__('Enter number product to display per page. Default is 12.','druck')
                ),
                array(
                    'id'          => 'sv_set_time_woo',
                    'label'       => esc_html__('Product new in(days)','druck'),
                    'type'        => 'text',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Enter number to set time for product is new. Unit day. Default is 30.','druck')
                ),
                array(
                    'id'          => 'shop_style',
                    'label'       => esc_html__('Shop pagination','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'=>esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default','druck'),
                        ),
                        array(
                            'value'=>'load-more',
                            'label'=>esc_html__('Load more','druck'),
                        )
                    )
                ),
                array(
                    'id'          => 'shop_ajax',
                    'label'       => esc_html__('Shop ajax','druck'),
                    'type'        => 'on-off',
                    'section'     => 'option_woo',
                    'std'         => 'off',
                    'desc'        => esc_html__('Enable ajax process for your shop page.','druck'),
                ),
                array(
                    'id'          => 'shop_thumb_animation',
                    'label'       => esc_html__('Thumbnail animation','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Choose a animation.','druck'),
                    'choices'     => s7upf_get_product_thumb_animation('option')
                ),
                array(
                    'id'          => 'shop_number_filter',
                    'label'       => esc_html__('Show number filter','druck'),
                    'desc'        => 'Show/hide number filter on shop page.',
                    'type'        => 'on-off',
                    'section'     => 'option_woo',
                    'std'         => 'on',
                ),
                array(
                    'id'          => 'shop_number_filter_list',
                    'label'       => esc_html__('Add list number filter','druck'),
                    'type'        => 'list-item',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Add custom list number to filter on the shop page.','druck'),
                    'settings'    => array( 
                        array(
                            'id'          => 'number',
                            'label'       => esc_html__('Number','druck'),
                            'type'        => 'text',                            
                        ),
                    ),
                    'condition'   => 'shop_number_filter:is(on)',
                ),
                array(
                    'id'          => 'shop_type_filter',
                    'label'       => esc_html__('Show type filter','druck'),
                    'desc'        => 'Show/hide type filter(list/grid) on shop page.',
                    'type'        => 'on-off',
                    'section'     => 'option_woo',
                    'std'         => 'on',
                ),
                //Tab list
                array(
                    'id'        => 'tab_shop_list',
                    'type'      => 'tab',
                    'section'   => 'option_woo',
                    'label'     => esc_html__('List Settings','druck')
                ),

                array(
                    'id'          => 'shop_list_size',
                    'label'       => esc_html__('Custom list thumbnail size','druck'),
                    'type'        => 'text',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck')
                ),
                array(
                    'id'          => 'shop_list_item_style',
                    'label'       => esc_html__('List item style','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_product_list_style('option')
                ),
                //Tab grid
                array(
                    'id'        => 'tab_shop_grid',
                    'type'      => 'tab',
                    'section'   => 'option_woo',
                    'label'     => esc_html__('Grid Settings','druck')
                ),
                array(
                    'id'          => 'shop_grid_size',
                    'label'       => esc_html__('Custom grid thumbnail size','druck'),
                    'type'        => 'text',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck')
                ),
                array(
                    'id'          => 'shop_grid_item_style',
                    'label'       => esc_html__('Grid item style','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_product_style('option')
                ),
                array(
                    'id'          => 'shop_grid_type',
                    'label'       => esc_html__('Grid display','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'desc'        => esc_html__('Choose a style to active display','druck'),
                    'choices'     => array(
                        array(
                            'value'=>'',
                            'label'=>esc_html__('Default','druck'),
                        ),
                        array(
                            'value'=>'list-masonry',
                            'label'=>esc_html__('Masonry','druck'),
                        )
                    )
                ),
                array(
                    'id'        => 'tab_shop_advanced',
                    'type'      => 'tab',
                    'section'   => 'option_woo',
                    'label'     => esc_html__('Advanced','druck')
                ),                
                array(
                    'id'          => 's7upf_header_page_woo',
                    'label'       => esc_html__( 'Header Woocommerce Page', 'druck' ),
                    'desc'        => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'choices'     => s7upf_list_post_type('s7upf_header')
                ),
                array(
                    'id'          => 's7upf_footer_page_woo',
                    'label'       => esc_html__( 'Footer Woocommerce Page', 'druck' ),
                    'desc'        => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'druck' ),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'choices'     => s7upf_list_post_type('s7upf_footer')
                ),
                array(
                    'id'          => 'before_append_woo',
                    'label'       => esc_html__('Append content before Woocommerce page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','druck'),
                ),
                array(
                    'id'          => 'after_append_woo',
                    'label'       => esc_html__('Append content after Woocommerce page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_woo',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','druck'),
                ),
                // END Shop config
                array(
                    'id'        => 'tab_product_general',
                    'type'      => 'tab',
                    'section'   => 'option_product',
                    'label'     => esc_html__('General','druck')
                ),
                array(
                    'id'          => 'sv_sidebar_position_woo_single',
                    'label'       => esc_html__('Sidebar Position WooCommerce Single','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Left, or Right, or Center','druck'),
                    'std'         => 'no',
                    'choices'     => array(
                        array(
                            'value'=>'no',
                            'label'=>esc_html__('No Sidebar','druck'),
                        ),
                        array(
                            'value'=>'left',
                            'label'=>esc_html__('Left','druck'),
                        ),
                        array(
                            'value'=>'right',
                            'label'=>esc_html__('Right','druck'),
                        ),
                    )
                ),
                array(
                    'id'          => 'sv_sidebar_woo_single',
                    'label'       => esc_html__('Sidebar select WooCommerce Single','druck'),
                    'type'        => 'sidebar-select',
                    'section'     => 'option_product',
                    'condition'   => 'sv_sidebar_position_woo_single:not(no)',
                    'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','druck'),
                ),
                array(
                    'id'          => 'product_image_zoom',
                    'label'       => esc_html__('Image zoom','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
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
                    'id'          => 'show_excerpt',
                    'label'       => esc_html__('Show Excerpt','druck'),
                    'type'        => 'on-off',
                    'section'     => 'option_product',
                    'std'         => 'on'
                ),
                array(
                    'id'        => 'tab_product_extra',
                    'type'      => 'tab',
                    'section'   => 'option_product',
                    'label'     => esc_html__('Extra display','druck')
                ),               
                array(
                    'id'          => 'show_latest',
                    'label'       => esc_html__('Show latest products','druck'),
                    'type'        => 'on-off',
                    'section'     => 'option_product',
                    'std'         => 'on'
                ),
                array(
                    'id'          => 'show_upsell',
                    'label'       => esc_html__('Show upsell products','druck'),
                    'type'        => 'on-off',
                    'section'     => 'option_product',
                    'std'         => 'on'
                ),
                array(
                    'id'          => 'show_related',
                    'label'       => esc_html__('Show related products','druck'),
                    'type'        => 'on-off',
                    'section'     => 'option_product',
                    'std'         => 'on'
                ),
                array(
                    'id'          => 'show_single_number',
                    'label'       => esc_html__('Show Single Number','druck'),
                    'type'        => 'numeric-slider',
                    'min_max_step'=> '1,100,1',
                    'section'     => 'option_product',
                    'std'         => '6'
                ),
                array(
                    'id'          => 'show_single_size',
                    'label'       => esc_html__('Show Single Size','druck'),
                    'type'        => 'text',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Custom size for related,upsell products. Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','druck'),
                ),
                array(
                    'id'          => 'show_single_itemres',
                    'label'       => esc_html__('Custom item devices','druck'),
                    'type'        => 'text',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','druck'),
                ),
                array(
                    'id'          => 'show_single_item_style',
                    'label'       => esc_html__('Single item style','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'desc'        => esc_html__('Choose a style to active display','druck'),
                    'choices'     => s7upf_get_product_style('option')
                ),
                array(
                    'id'        => 'tab_product_advanced',
                    'type'      => 'tab',
                    'section'   => 'option_product',
                    'label'     => esc_html__('Advanced','druck')
                ),
                array(
                    'id'          => 'before_append_woo_single',
                    'label'       => esc_html__('Append content before product page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','druck'),
                ),
                array(
                    'id'          => 'before_append_tab',
                    'label'       => esc_html__('Append content before product tab','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','druck'),
                ),
                array(
                    'id'          => 'after_append_tab',
                    'label'       => esc_html__('Append content after product tab','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','druck'),
                ),
                array(
                    'id'          => 'after_append_woo_single',
                    'label'       => esc_html__('Append content after product page','druck'),
                    'type'        => 'select',
                    'section'     => 'option_product',
                    'choices'     => s7upf_list_post_type('s7upf_mega_item'),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','druck'),
                ),
            );
            $s7upf_config['theme-option']['settings'] = array_merge($s7upf_config['theme-option']['settings'],$woo_settings);
            // End add settings
        }
    }
}
s7upf_set_theme_config();