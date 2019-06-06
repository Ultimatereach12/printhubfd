<?php
if(!isset($animation)) $animation = s7upf_get_option('shop_thumb_animation');
if(empty($size)) $size = array(70,90);
$size = s7upf_size_random($size);
if(isset($column)) $col_class = "list-col-item list-".esc_attr($column)."-item";
else $col_class = '';
?>	
<div <?php post_class($col_class)?>>
	<div class="item-product item-product-table table-custom">
		<?php do_action( 'woocommerce_before_shop_loop_item' );?>
		<div class="product-thumb">
			<!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
			<?php s7upf_woocommerce_thumbnail_loop($size,$animation);?>
		</div>
		<div class="product-info">
			<h3 class="title14 lora-font text-uppercase product-title">
				<a class="dark" title="<?php echo esc_attr(the_title_attribute(array('echo'=>false)))?>" href="<?php the_permalink()?>"><?php the_title()?></a>
			</h3>
			<?php s7upf_get_price_html()?>
			<?php s7upf_get_rating_html(true,false);?>
		</div>		
		<?php do_action( 'woocommerce_after_shop_loop_item' );?>
	</div>
</div>