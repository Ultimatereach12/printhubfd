<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 13/08/15
 * Time: 10:20 AM
 */
if(!isset($main_color)) $main_color = s7upf_get_value_by_id('main_color');
if(!isset($main_color2)) $main_color2 = s7upf_get_value_by_id('main_color2');
$body_bg = s7upf_get_value_by_id('body_bg');
$container_width = s7upf_get_value_by_id('container_width');
$preload_bg = s7upf_get_option('preload_bg');
$important = '';
?>
<?php
$style = '';

if(!empty($body_bg)){
    $style .= 'body
    {background-color:'.$body_bg.$important.'}'."\n";
}
if(!empty($preload_bg)){
    $style .= '.preload #loading
    {background-color:'.$preload_bg.$important.'}'."\n";
}

if(!empty($container_width)) {
    $style .= '.container,.page-content-box .wrap{max-width: '.$container_width.'px !important;}';
}

/*****BEGIN MAIN COLOR*****/

if(!empty($main_color)){
	$style .= 'a:hover,
	a:focus,
	a:active,
	.color,
	.main-nav > ul > li > a:hover,
	.product-title a:hover ,
	.popup-icon,
	.main-nav > ul > li:hover > a,
	.title-first-letter::first-letter ,
	.product-price > span, .product-price ins,
	.item-post-info:hover .post-info .post-title a,
	.title-tab-style2 .title-tab li.active a,
	.title-tab-style3 .title-tab li.active a ,
	.product-slider3 .owl-theme .owl-controls .owl-buttons div:hover ,
	.contact-store-event .desc::before,
	.item-contact-info h3::before,
	.widget a.active,
	.widget a.selected,
	.list-link-amazing li::before,
	.title-cat-ajax li a.active *,
	.latest-post-footer .post-title a:hover,
	.latest-post-footer .post-info .silver:hover,
	.title-tab-style1 .title-tab > li > a:hover,
	.wrap-button-lightbox > a:hover,
	.detail-tab-accordion .item-toggle-tab.active .toggle-tab-title,
	.service-tab-title li::after,
	.intro-print5 ul li::before
    {color:'.$main_color.$important.'}'."\n";
    
    $style .= '.bg-color,
	.dropdown-list li a:hover ,
	.preload #loading ,
	.shop-button:hover ,
	.mini-cart-link .mini-cart-number,
	.wrap-search-overlay .search-form .submit-form::after,
	.dropdown-list li.active a,
	.form-newsletter input[type="submit"]:hover,
	.wishlist-button a:hover,
	 body .scroll-top:hover,
	.dropdown-list li a.active,
	.main-nav .toggle-mobile-menu span,
	.main-nav .toggle-mobile-menu::before, 
	.main-nav .toggle-mobile-menu::after,
	.woocommerce.widget .woocommerce-widget-layered-nav-dropdown__submit:hover,
	.woocommerce #respond input#submit.alt:hover, 
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover,
	.button:hover,
	.btn:hover,
	.woocommerce #respond input#submit.alt:hover, 
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit:hover,
	a.added_to_cart:hover,
	.woocommerce a.added_to_cart:hover,
	.woocommerce a.button.addcart-link:hover,
	.woocommerce-MyAccount-navigation ul li.is-active a,
	.woocommerce-MyAccount-navigation ul li:hover a,
	.woocommerce-account .addresses .title .edit:hover,
	.post-password-form input[type=submit]:hover,
	.shop-button.border:hover,
	.owl-theme .owl-controls .owl-buttons div:hover,
	.owl-theme .owl-controls .owl-page.active span,
	.item-testimonial .testimo-thumb::before,
	.item-testimonial .testimo-thumb::after,
	.item-team-member .member-info .desc::before,
	.item-team-member .member-thumb::before,
	.item-service.active .service-icon a,
	.item-print2 .info-contact-icon a:hover::before, 
	.main-nav3 > ul > li.current-menu-item,
	.main-nav3 > ul > li.current-menu-ancestor,
	.title-tab-style2 .title-tab li.active a::before,
	.tab-product3 .title-tab li.active a::after,
	.search-form4 .submit-form:hover::after,
	li.active > a > .item-contact-info,
	.pagi-nav .current,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
	.woocommerce a.button.alt.disabled:hover, 
	.woocommerce a.button.alt:disabled:hover, 
	.woocommerce a.button.alt:disabled[disabled]:hover, 
	.woocommerce button.button.alt.disabled:hover, 
	.woocommerce button.button.alt:disabled:hover, 
	.woocommerce button.button.alt:disabled[disabled]:hover, 
	.woocommerce input.button.alt.disabled:hover,
	.detail-gallery .gallery-control > a:hover,
	.portfolio-slider .slick-arrow:hover,
	.banner-hover-direction .shop-button:hover,
	.page-links > span,
	.shop-button.bg-white:hover,
	.item-slider5 .content-banner-info,
	.service-tab-title li.active::before, .extra-attrs-wrap .variations .detail-attr.type-label .swatch:hover,
.extra-attrs-wrap .variations .detail-attr.type-label .swatch.selected
    {background-color:'.$main_color.$important.'}'."\n";

    $style .= '.woocommerce-MyAccount-navigation ul li.is-active a,
	.woocommerce-MyAccount-navigation ul li:hover a, 
	.main-nav3 > ul > li.current-menu-item,
	.item-slider3 .content-banner-info h2,
	.item-slider3 .content-banner-info h3,
	.wrap-contact-map,
	.pagi-nav .current,
	.single-block-quote,
	.detail-gallery .carousel li a.active img,
	.page-links > span
    {border-color: '.$main_color.$important.'}'."\n";

    list($r, $g, $b) = sscanf($main_color, "#%02x%02x%02x");
    $style .= '.bg-rgb,
	.item-product-grid-center .product-extra-link,
	.item-cat-eye .wrap-eye,
	.item-portfolio-default .portfolio-info,
	.item-team-member .list-social-member ul
    {background-color: rgba('.$r.','.$g.','.$b.', 0.9)'.$important.'}'."\n";
}

if(!empty($main_color2)){
    $style .= '.color2
    {color:'.$main_color2.$important.'}'."\n";
    
    $style .= '.bg-color2,
	.block-trend1::before,
	.final-countdown .clock,
	.testimo-thumb a,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range
    {background-color:'.$main_color2.$important.'}'."\n";

    $style .= '.testimo-thumb a,
	.wrap-deal2
    {border-color: '.$main_color2.$important.'}'."\n";
}

/*****END MAIN COLOR*****/

/*****BEGIN CUSTOM CSS*****/
$custom_css = s7upf_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}

/*****END CUSTOM CSS*****/

/*****BEGIN BREADCRUMB COLOR*****/
$bread_color = s7upf_get_option('breadcrumb_text');
$bread_color_hover = s7upf_get_option('breadcrumb_text_hover');
if(is_array($bread_color) && !empty($bread_color)){
    $style .= '.bread-crumb a,.bread-crumb span{';
    $style .= s7upf_fill_css_typography($bread_color);
    $style .= '}'."\n";
}
if(is_array($bread_color_hover) && !empty($bread_color_hover)){
    $style .= '.bread-crumb a:hover{';
    $style .= s7upf_fill_css_typography($bread_color_hover);
    $style .= '}'."\n";
}
/*****END CUSTOM CSS*****/

/*****BEGIN MENU COLOR*****/
$menu_color = s7upf_get_option('sv_menu_color');
$menu_hover = s7upf_get_option('sv_menu_color_hover');
$menu_active = s7upf_get_option('sv_menu_color_active');
$menu_color2 = s7upf_get_option('sv_menu_color2');
$menu_hover2 = s7upf_get_option('sv_menu_color_hover2');
$menu_active2 = s7upf_get_option('sv_menu_color_active2');
if(is_array($menu_color) && !empty($menu_color)){
    $style .= '.main-nav>ul>li>a{';
    $style .= s7upf_fill_css_typography($menu_color,' !important');
    $style .= '}'."\n";
}
if(!empty($menu_hover)){
    $style .= 'nav.main-nav ul>li:hover>a,
    nav.main-nav>ul>li>a:focus,
    nav.main-nav>ul>li.current-menu-item>a,
    nav.main-nav>ul>li.current-menu-ancestor>a
    {color:'.$menu_hover.'}'."\n";
}
if(!empty($menu_active)){
    $style .= 'nav.main-nav>ul>li.current-menu-item>a,
    nav.main-nav>ul>li.current-menu-ancestor>a,
    nav.main-nav>ul>li:hover>a
    {background-color:'.$menu_active.'}'."\n";
}
// Sub menu
if(is_array($menu_color2) && !empty($menu_color2)){
    $style .= 'nav .sub-menu>li>a{';
    $style .= s7upf_fill_css_typography($menu_color2);
    $style .= '}'."\n";
}
if(!empty($menu_hover2)){
    $style .= 'nav.main-nav li:not(.has-mega-menu) .sub-menu li:hover >a,
    nav.main-nav li:not(.has-mega-menu) .sub-menu li>a:focus,
    nav.main-nav .sub-menu li.current-menu-item >a,
    nav.main-nav .sub-menu li.current-menu-ancestor >a
    {color:'.$menu_hover2.'}'."\n";
}
if(!empty($menu_active2)){
    $style .= 'nav.main-nav li:not(.has-mega-menu) .sub-menu li:hover,
    nav.main-nav .sub-menu li.current-menu-item,
    nav.main-nav .sub-menu li.current-menu-ancestor
    {background-color:'.$menu_active2.'}'."\n";
}
/*****END MENU COLOR*****/

/*****BEGIN TYPOGRAPHY*****/
$typo_data = s7upf_get_option('s7upf_custom_typography');
if(is_array($typo_data) && !empty($typo_data)){
    foreach ($typo_data as $value) {
        switch ($value['typo_area']) {
             case 'body':
                $style_class = 'body';
                break;

            case 'header':
                $style_class = '#header';
                break;

            case 'footer':
                $style_class = '#footer';
                break;

            case 'widget':
                $style_class = '#main-content .widget';
                break;
            
            default:
                $style_class = '#main-content';
                break;
        }
        $class_array = explode(',', $style_class);
        $new_class = '';
        if(is_array($class_array)){
            foreach ($class_array as $prefix) {
                $new_class .= $prefix.' '.$value['typo_heading'].',';
            }
        }
        if(!empty($new_class)) $style .= $new_class.' .nocss{';
        $style .= s7upf_fill_css_typography($value['typography_style']);        
        $style .= '}';
        $style .= "\n";
    }
}

/*****END TYPOGRAPHY*****/

$custom_css = s7upf_get_option('custom_css');
if(!empty($custom_css)){
    $style .= $custom_css."\n";
}
if(!empty($style)) echo apply_filters('s7upf_output_content',$style);
?>