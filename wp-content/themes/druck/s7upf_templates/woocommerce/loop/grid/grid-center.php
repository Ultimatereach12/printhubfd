<?php
if(!isset($animation)) $animation = s7upf_get_option('shop_thumb_animation');
if(empty($size)) $size = array(350,236);
$size = s7upf_size_random($size);
if(isset($column)) $col_class = "list-col-item list-".esc_attr($column)."-item";
else $col_class = '';
?>	
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-grid-center text-center">
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<div class="product-thumb">
			<!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
			<?php s7upf_woocommerce_thumbnail_loop($size,$animation);?>
			<div class="product-extra-link transition">
				<?php s7upf_addtocart_link(true,'icon','');?>
				<?php echo s7upf_wishlist_url('<i class="la la-heart-o"></i>','','',esc_attr__('Wishlist','druck'));?>
				<?php echo s7upf_compare_url('<i class="la la-random"></i>',false,'','',esc_attr__('Compare','druck'));?>
				<?php s7upf_product_quickview('<i class="la la-search"></i>','','',true)?>
			</div>
			<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
		</div>
		<div class="product-info">
			<?php do_action( 'woocommerce_shop_loop_item_title' );?>
			<h3 class="title14 product-title lora-font font-bold">
				<a class="black" href="<?php the_permalink()?>"><?php the_title()?></a>
			</h3>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
			<?php echo s7upf_get_product_category('silver wobble-top');?>
			<?php s7upf_get_price_html()?>
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
	</div>
</div>