<div class="advs-content-outer <?php echo esc_attr($el_class);?>">
	<div class="banner-advs <?php echo esc_attr($animation);?>">
		<?php if(!empty($link)) echo '<a href="'.esc_url($link).'" class="adv-thumb-link">';?>
		<?php 
			echo wp_get_attachment_image($image,$size);
			echo wp_get_attachment_image($image2,$size);
		?>
		<?php if(!empty($link)) echo '</a>';?>
	</div> 
	<?php if(!empty($content)):?>
    <div class="advs-info <?php echo esc_attr($el_class2);?>">
    	<?php echo wpb_js_remove_wpautop($content, true);?>
    </div>
	<?php endif;?>
</div>