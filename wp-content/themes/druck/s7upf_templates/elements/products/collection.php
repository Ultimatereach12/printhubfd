<?php
$attr = array(
	'size'		   => $size,
	'animation'	   => $animation,
    'column'            => $column,
	'item_style'      => $item_style,
	'style'		      => 'grid',
    'item_style_list'       => '',
	);
if(!empty($image_size)) {
	$image_size = explode('x', $image_size);
}else{ 
	$image_size = 'full';
}	
?>
<div class="block-element collection-product-fixed <?php echo esc_attr($el_class);?> js-content-wrap clearfix">
    <div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12">
			<div class="banner-collection-fixed">
				<?php if(!empty($image_ads)) echo wp_get_attachment_image($image_ads,$image_size);?>
				<?php if(!empty($content)):?>
				<div class="banner-info wow fadeInRight">
					<?php echo	wpb_js_remove_wpautop($content, true);?>
				</div>
				<?php endif;?>
			</div>
		</div>
    	<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="products-wrap">
				<div class="products row list-product-wrap js-content-main">
					<?php
					if($product_query->have_posts()) {
						while($product_query->have_posts()) {
							$product_query->the_post();
							$attr['count'] = $count;
							s7upf_get_template_woocommerce('loop/grid/grid',$item_style,$attr,true);
							$count++;
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>