<?php
global $post;
if(!isset($animation)) $animation = s7upf_get_option('shop_thumb_animation');
if(empty($size_list)) $size_list = array(370,370);
$col_class = 'col-md-12 col-sm-12 col-xs-12';
?>
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-list">
		<div class="row">
			<?php do_action( 'woocommerce_before_shop_loop_item' );?>
			<div class="col-md-4 col-sm-5 col-xs-12">
				<div class="product-thumb">
					<!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
					<?php s7upf_woocommerce_thumbnail_loop($size_list,$animation);?>
					<?php s7upf_product_quickview()?>
					<?php s7upf_product_label()?>
					<?php do_action( 'woocommerce_before_shop_loop_item_title' );?>
				</div>
			</div>
			<div class="col-md-8 col-sm-7 col-xs-12">
				<div class="product-info">
					<h3 class="title24 product-title lora-font text-uppercase">
						<a title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
					</h3>
					<?php do_action( 'woocommerce_shop_loop_item_title' );?>
					<?php do_action( 'woocommerce_after_shop_loop_item_title' );?>
					<?php s7upf_get_price_html()?>
					<?php s7upf_get_rating_html(true,false);?>
					<div class="product-extra-link flex-wrapper align_items-center justify_content-space-between">
						<?php s7upf_addtocart_link(true,'','addcart-link-icon color title24 flex-wrapper');?>
						<div class="yith-link flex-wrapper align_items-center justify_content-flex-end">
							<?php echo s7upf_wishlist_url('<i class="la la-heart-o"></i>','','',esc_attr__('Wishlist','druck'));?>
							<?php echo s7upf_compare_url('<i class="la la-random"></i>',false,'','',esc_attr__('Compare','druck'));?>
						</div>
					</div>
					<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
				</div>
			</div>
			<?php do_action( 'woocommerce_after_shop_loop_item' );?>
		</div>
	</div>
</div>