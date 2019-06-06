<?php
if(empty($size)) $size = array(270,180);
$size = s7upf_size_random($size);
?>
<?php if(isset($column)):?><div class="list-col-item list-<?php echo esc_attr($column)?>-item"><?php endif;?>
<div class="item-post item-post-default text-center">
    <div class="post-thumb banner-advs zoom-in fly-cross">
        <a href="<?php echo esc_url(get_the_permalink()) ?>" class="adv-thumb-link">
            <?php echo get_the_post_thumbnail(get_the_ID(),$size);?>
        </a>
    </div>
    <div class="post-info">
        <?php s7upf_display_metabox('info');?>
        <h3 class="title18 lora-font font-bold post-title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php the_title()?></a></h3>
		<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="post-author wobble-top silver"><?php echo esc_html__('by:','druck');?><?php echo get_the_author(); ?></a>
		<?php if($excerpt) echo '<p class="desc">'.s7upf_substr(get_the_excerpt(),0,(int)$excerpt).'</p>';?>
		<a href="<?php echo esc_url(get_the_permalink()) ?>" class="shop-button bg-color curl-top-right"><?php echo esc_html__('Learn more','druck');?></a>
    </div>
</div>
<?php if(isset($column)):?></div><?php endif;?>