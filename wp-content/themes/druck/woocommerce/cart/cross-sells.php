<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

extract(s7upf_show_single_product_data());
if ( $cross_sells ) : ?>

    <div class="cross-sells related-product">
        <h2><?php esc_html_e( 'You may be interested in&hellip;', 'druck' ) ?></h2>
        <div class="product-slider cross-sell-slider">
            <?php echo '<div class="wrap-item navi-nav-style smart-slider" data-item="" data-speed="" data-itemres="0:1,990:2" data-navigation="true">';?>

                <?php woocommerce_product_loop_start(); ?>

                <?php foreach ( $cross_sells as $cross_sell ) : ?>

                    <?php
                    $post_object = get_post( $cross_sell->get_id() );

                    setup_postdata( $GLOBALS['post'] =& $post_object );

                s7upf_get_template_woocommerce('loop/grid/grid',$item_style,array('size'=>$size),true);?>

                <?php endforeach; ?>

                <?php woocommerce_product_loop_end(); ?>

            </div>
        </div>
    </div>

<?php endif;

wp_reset_postdata();


