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
<div class="block-element <?php echo esc_attr($el_class);?>">
	<div class="tab-product-scroll custom-scroll">
		<div class="title-tab-scroll">
			<ul class="list-none">
			<?php
			if($product_query->have_posts()) {
				$num = 0;
				while($product_query->have_posts()) {
					$product_query->the_post();
					if($num==0){
						$class_active = 'active';
					}else{
						$class_active = '';
					}
					echo '<li class="'.esc_attr($class_active).'"><a href="#product-'.get_the_ID().'" data-toggle="tab">'
							.s7upf_get_template_woocommerce('loop/grid/grid','tab',$attr,false).
						  '</a></li>';
					$num++;
				}
			}
			?>
			</ul>
		</div>
		<div class="products tab-content">
			<?php
			if($product_query->have_posts()) {
				$num = 0;
				while($product_query->have_posts()) {
					$product_query->the_post();
					if($num==0){
						$class_active = 'active';
					}else{
						$class_active = '';
					}
					$attr['count'] = $count;
					echo '<div id="product-'.get_the_ID().'" class="row tab-pane '.esc_attr($class_active).'">'
							.s7upf_get_template_woocommerce('loop/grid/grid',$item_style,$attr,false).
						'</div>';
					$count++;
					$num++;
				}
			}
			?>
		</div>
	</div>
</div>