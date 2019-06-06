<div class="banner-advs banner-video-advs <?php echo esc_attr($el_class);?> <?php echo esc_attr($animation);?>">
	<?php if(!empty($link)) echo '<a href="'.esc_url($link).'" class="adv-thumb-link">';?>
    <?php 
	    echo wp_get_attachment_image($image,$size);
	    echo wp_get_attachment_image($image2,$size);
    ?>
	<?php if(!empty($link)) echo '</a>';?>
	<?php if(!empty($link2)):?>
	<a href="<?php echo esc_url($link2);?>" class="title14 btn-video-popup fancybox absolute inline-block round fancybox-media"><i class="fa fa-play"></i></a>
	<?php endif;?>
</div>