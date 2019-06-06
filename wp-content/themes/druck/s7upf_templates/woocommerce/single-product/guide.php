<?php
	$data_guide = get_post_meta(get_the_ID(),'s7upf_product_guide_data',true);
	if(is_array($data_guide)):
?>
<div class="list-product-attr-guide">
	<?php
		foreach($data_guide as $key => $value):
		$title_class = explode(' ',strtolower($value['title']));
		$title_class = implode('-',$title_class);
		if(!empty($value['attr_guide'])):
	?>
	<div class="item-attr-guide">
		<a href="#content-attr-guide-<?php echo esc_attr($key);?>" class="fancybox btn-attr-guide btn-<?php echo esc_attr($title_class);?>"><?php echo esc_html($value['title']);?></a>
		<div id ="content-attr-guide-<?php echo esc_attr($key);?>" class="content-attr-guide">
			<?php echo wpb_js_remove_wpautop($value['attr_guide'],true);?>
		</div>
	</div>
	<?php endif;endforeach;?>
</div>
<?php
	endif;
?>
