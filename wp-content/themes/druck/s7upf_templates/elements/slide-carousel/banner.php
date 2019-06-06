<div class="banner-slider <?php echo esc_attr($el_class)?>">
    <div class="wrap-item sv-slider <?php echo esc_attr($navigation.' '.$pagination)?>" 
        data-item="1" data-speed="<?php echo esc_attr($speed)?>" 
        data-itemres="0:1" data-animation="<?php echo esc_attr($animation)?>" 
        data-navigation="<?php echo esc_attr($navigation)?>" data-pagination="<?php echo esc_attr($pagination)?>" 
        data-prev="<?php echo esc_attr($nav_prev)?>" data-next="<?php echo esc_attr($nav_next)?>">

		<?php echo wpb_js_remove_wpautop($content, false);?>
		
    </div>
</div>