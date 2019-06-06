<?php
$data = '';
if (get_post_meta(get_the_ID(), 'format_media', true)) {
    $media_url = get_post_meta(get_the_ID(), 'format_media', true);
    $data .= '<div class="audio single-post-thumb banner-advs">' . s7upf_remove_w3c(wp_oembed_get($media_url, array('height' => '176'))) . '</div>';
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