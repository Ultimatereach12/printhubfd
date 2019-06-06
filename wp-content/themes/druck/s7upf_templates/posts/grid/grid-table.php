<?php
if(empty($size)) $size = array(70,70);
$size = s7upf_size_random($size);
?>
<?php if(isset($column)):?><div class="list-col-item list-<?php echo esc_attr($column)?>-item"><?php endif;?>
<div class="item-post item-post-table table-custom">
    <div class="post-thumb banner-advs zoom-image overlay-image">
        <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link">
            <?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
        </a>
    </div>
    <div class="post-info">
		<h3 class="title14 post-title lora-font font-bold"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
		<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="silver"><span class="silver"><?php echo esc_html__('by: ','druck');?></span><?php echo get_the_author(); ?></a>
    </div>
</div>
<?php if(isset($column)):?>
</div>
<?php endif;?>