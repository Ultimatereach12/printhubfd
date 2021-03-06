<?php
$data = '';
$gallery = get_post_meta(get_the_ID(), 'format_gallery', true);
if (!empty($gallery)){
    $array = explode(',', $gallery);
    if(is_array($array) && !empty($array)){
        
        $data .= '<div class="post-gallery single-post-thumb banner-advs">
                    <div class="wrap-item smart-slider" 
                    data-item="" data-speed="" 
                    data-itemres="0:1" 
                    data-prev="" data-next="" 
                    data-pagination="" data-navigation="true">';
        foreach ($array as $key => $item) {
            $thumbnail_url = wp_get_attachment_url($item);
            $data .= '<div class="image-slider">';
            $data .=    '<img src="' . esc_url($thumbnail_url) . '" alt="'.esc_attr__("Image slider","druck").'">';           
            $data .= '</div>';
        }
        $data .='</div></div>';
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