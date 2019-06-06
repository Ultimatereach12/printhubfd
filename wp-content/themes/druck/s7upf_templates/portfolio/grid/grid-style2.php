<?php
if(empty($size)) $size = 'full';
$size = s7upf_size_random($size);
?>
<div class="item-portfolio item-portfolio-grid">
    <div class="portfolio-thumb">
		<a href="<?php echo esc_url(get_the_permalink()) ?>" class="product-thumb-link">
			<?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
		</a>
    </div>
	<div class="portfolio-info text-center transition">
		<h3 class="title18 portfolio-title text-uppercase font-bold lora-font"><a class="black wobble-horizontal" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
		<span class="color"><?php echo get_post_meta(get_the_ID(),'portfolio_price',true);?></span>
	</div>
</div>