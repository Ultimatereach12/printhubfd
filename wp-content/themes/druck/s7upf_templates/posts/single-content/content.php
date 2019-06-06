<?php
$data = '';
global $post;
if(empty($size)) $size = 'full';
$s7upf_image_blog = get_post_meta(get_the_ID(), 'format_image', true);
if($check_thumb == 'on'){
    if(!empty($s7upf_image_blog)){
        $data .='<div class="single-post-thumb banner-advs">
                    <img alt="'.esc_attr($post->post_name).'" title="'.esc_attr($post->post_name).'" src="' . esc_url($s7upf_image_blog) . '"/>
                </div>';
    }
    else{
        if (has_post_thumbnail()) {
            $data .= '<div class="single-post-thumb banner-advs">
                        '.get_the_post_thumbnail(get_the_ID(),$size).'                
                    </div>';
        }
    }
}
?>
<div class="content-single-blog <?php echo (is_sticky()) ? 'sticky':''?>">
	<div class="content-top-single">
		<?php s7upf_display_metabox('single');?>
		<h1 class="single-post-title title36 lora-font text-uppercase">
			<?php the_title()?>
			<?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
		</h1>
		<?php 
			$excerpt_check = get_the_excerpt();
			if($check_excerpt == 'on' && !empty($excerpt_check)):
		?>
		<p class="desc title18"><?php echo get_the_excerpt();?></p>
		<?php endif;?>
		<?php if(!empty($data)) echo apply_filters('s7upf_output_content',$data);?>
	</div>
    <div class="content-post-default">
        <div class="detail-content-wrap clearfix"><?php the_content(); ?></div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'druck' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		<?php if($check_meta == 'on') s7upf_display_metabox('social2');?>
		<?php 
			$tags = get_the_tag_list(' ',' ',' ');
			if($tags):?>
			<div class="single-data-tags tagcloud title12">
				<?php $tags = get_the_tag_list(' ',' ',' ');?>
				<?php if($tags) echo apply_filters('s7upf_output_content',$tags); else esc_html_e("No Tag",'druck');?>
			</div>
		<?php endif;?>
    </div>
</div>