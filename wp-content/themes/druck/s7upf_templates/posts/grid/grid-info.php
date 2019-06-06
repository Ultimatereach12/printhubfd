<?php
if(empty($size)) $size = 'full';
$size = s7upf_size_random($size);
?>
<?php if(isset($column)):?><div class="list-col-item list-<?php echo esc_attr($column)?>-item"><?php endif;?>
<div class="item-post item-post-info border image-shadow">
    <div class="post-thumb banner-advs zoom-in overlay-image">
        <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link">
            <?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
        </a>
		<div class="post-info absolute flex-wrapper align_items-flex-start justify_content-center flex_direction-column">
			<?php s7upf_display_metabox('info');?>
			<h3 class="title24 lora-font font-bold post-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="wobble-top gray"><?php echo esc_html__('by:','druck');?><?php echo get_the_author(); ?></a>
		</div>
    </div>
</div>
<?php if(isset($column)):?></div><?php endif;?>