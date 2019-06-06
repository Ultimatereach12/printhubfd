<?php
if(empty($size)) $size = 'full';
$size = s7upf_size_random($size);
?>
<?php if(isset($column)):?><div class="list-col-item list-<?php echo esc_attr($column)?>-item"><?php endif;?>
<div class="item-portfolio item-portfolio-default image-shadow transition">
    <div class="portfolio-thumb box-hover-dir">
		<?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
		<div class="portfolio-info flex-wrapper align_items-center justify_content-center flex_direction-column">
			<a href="<?php echo get_the_post_thumbnail_url(get_the_ID());?>" class="color bg-white title30 text-center inline-block fancybox" data-fancybox-group="gallery"><i class="la la-eye"></i></a>
			<h3 class="title18 portfolio-title text-uppercase font-bold lora-font"><a class="white wobble-horizontal" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
			<?php 
				$portfolio_price = get_post_meta(get_the_ID(),'portfolio_price',true);
				if(!empty($portfolio_price)):
			?>
			<span class="white"><?php echo get_post_meta(get_the_ID(),'portfolio_price',true);?></span>
			<?php endif;?>
		</div>
    </div>
</div>
<?php if(isset($column)):?></div><?php endif;?>