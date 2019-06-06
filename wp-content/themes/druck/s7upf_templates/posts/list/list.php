<?php
if(empty($size_list)) $size_list = 'full';
global $post;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="item-post item-post-large item-default">
        <div class="row">
            <?php if(has_post_thumbnail()):?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="post-thumb">
                        <a href="<?php echo esc_url(get_the_permalink())?>">
                            <?php echo get_the_post_thumbnail(get_the_ID(),$size_list)?>
                        </a>
                    </div>
                </div>
            <?php endif;?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="post-info">
                    <?php s7upf_display_metabox('single');?>
                    <h3 class="title24 lora-font text-uppercase post-title">
                        <a class="dark" href="<?php echo esc_url(get_the_permalink()); ?>">
                            <?php the_title()?>
                            <?php echo (is_sticky()) ? '<i class="la la-star"></i>':''?>
                        </a>
                    </h3>
                    <?php if(has_excerpt() || !empty($post->post_content)):?><p class="desc"><?php echo get_the_excerpt();?></p><?php endif;?>
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" class="shop-button curl-top-right bg-color"><?php esc_html_e("Read more","druck")?></a>
                </div>
            </div>
        </div>
    </div>
</div>