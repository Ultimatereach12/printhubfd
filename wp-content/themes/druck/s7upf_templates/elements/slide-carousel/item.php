<div class="item-slider <?php echo esc_attr($el_class)?>">
    <div class="banner-thumb">
		<?php if(!empty($link)):?>
        <a href="<?php echo esc_url($link)?>">
		<?php endif;?>
			<?php echo wp_get_attachment_image($image,'full')?>
		<?php if(!empty($link)):?>
		</a>
		<?php endif;?>
    </div>
	<?php if(!empty($content)):?>
    <div class="banner-info">
        <div class="container">
            <div class="content-banner-info <?php echo esc_attr($info_class)?>" data-animated="<?php echo esc_attr($info_animation)?>">
                <?php echo wpb_js_remove_wpautop($content, true)?>
            </div>
        </div>
    </div>
	<?php endif;?>
	<?php 
		if($item_style == 'ads'):
		if(!empty($ads_size)) {
			$ads_size = explode('x', $ads_size);
		}else{ 
			$ads_size = 'full';
		}	
		if(!empty($ads_button)) $ads_button = vc_build_link($ads_button);
	?>
	<div class="wrap-banner-slider-ads <?php echo esc_attr($ads_class)?>" data-animated="<?php echo esc_attr($ads_animate)?>">
		<div class="banner-advs zoom-image">
			<a href="<?php esc_url($ads_button['url']);?>" class="adv-thumb-link"><?php echo wp_get_attachment_image($ads_image,$ads_size);?></a>
			<div class="advs-info">
				<h3 class="title30 lora-font text-uppercase"><?php echo esc_html($ads_title);?></h3>
				<p class="desc"><?php echo esc_html($ads_desc);?></p>
				<a href="<?php esc_url($ads_button['url']);?>" class="shop-button border float-shadow arrow-right"><?php echo esc_html($ads_button['title']);?></a>
			</div>
		</div>
	</div>
	<?php endif;?>
	<?php if($item_style == 'bread-crumb'):?>
	<div class="info-bread-crumb">
		<div class="container">
			<div class="inner-bread-crumb">
				<?php
					$step = '';
					if(!s7upf_is_woocommerce_page()){
						if(function_exists('bcn_display')) bcn_display();
						else s7upf_breadcrumb($step);
					}
					else woocommerce_breadcrumb(array(
						'delimiter'		=> $step,
						'wrap_before'	=> '',
						'wrap_after'	=> '',
						'before'      	=> '<span>',
						'after'       	=> '</span>',
						));
				?>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>