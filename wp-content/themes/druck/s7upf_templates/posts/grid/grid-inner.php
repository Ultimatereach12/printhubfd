<?php
if(empty($size)) $size = array(370,240);
$size = s7upf_size_random($size);
?>
<?php if(isset($column)):?><div class="list-col-item list-<?php echo esc_attr($column)?>-item"><?php endif;?>
<div class="item-post item-post-inner banner-hover-direction text-center">
    <div class="post-thumb banner-thumb banner-advs zoom-image">
        <div class="adv-thumb-link box-hover-dir">
            <?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
			<div class="post-info transition adv-info flex-wrapper flex_direction-column align_items-center justify_content-center">
				<?php s7upf_display_metabox('info');?>
				<h3 class="title18 lora-font font-bold post-title"><a class="color" href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
				<?php if($excerpt) echo '<p class="desc">'.s7upf_substr(get_the_excerpt(),0,(int)$excerpt).'</p>';?>
			</div>
        </div>
    </div>
</div>
<?php if(isset($column)):?></div><?php endif;?>