<?php
$attr = array(
	'size'		   => $size,
	'animation'	   => $animation,
    'column'            => $column,
	'item_style'      => $item_style,
	'style'		      => 'grid',
    'item_style_list'       => '',
	'pagination'		=> $pagination,
	);
?>
<div class="js-content-wrap clearfix <?php echo esc_attr($gap);?>">
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