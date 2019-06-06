<?php
if(!isset($animation)) $animation = s7upf_get_option('shop_thumb_animation');
if(empty($size)) $size = array(270,180);
$size = s7upf_size_random($size);
if(isset($column)) $col_class = "list-col-item list-".esc_attr($column)."-item";
else $col_class = '';
?>	
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-grid">
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<div class="product-thumb">
			<!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
			<?php s7upf_woocommerce_thumbnail_loop($size,$animation);?>
			<?php s7upf_product_quickview()?>
			<?php s7upf_product_label()?>
			<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
		</div>
		<div class="product-info">
			<h3 class="product-title title14 lora-font font-bold">
				<a href="<?php the_permalink()?>"><?php the_title()?></a>
			</h3>
			<?php echo s7upf_get_product_category('silver wobble-top');?>
			<?php do_action( 'woocommerce_shop_loop_item_title' );?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
			<div class="product-extra-link flex-wrapper align_items-center justify_content-space-between">
				<div class="wrap-cart-price flex-wrapper align_items-center">
					<?php s7upf_addtocart_link(true,'','addcart-link-icon color title24 flex-wrapper');?>
					<?php s7upf_get_price_html()?>
				</div>
				<div class="yith-link transition flex-wrapper align_items-center justify_content-flex-end">
					<?php echo s7upf_wishlist_url('<i class="la la-heart-o"></i>','','',esc_attr__('Wishlist','druck'));?>
					<?php echo s7upf_compare_url('<i class="la la-random"></i>',false,'','',esc_attr__('Compare','druck'));?>
				</div>
			</div>
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
	</div>
</div>