<?php
/**
 * The template for displaying all single posts.
 *
 * @package 7up-framework
 */
?>
<?php get_header();?>
<?php do_action('s7upf_before_main_content')?>
<div id="main-content"  class="main-page-default">
    <div class="container">
        <div class="row">
            <?php s7upf_output_sidebar('left')?>
            <div class="<?php echo esc_attr(s7upf_get_main_class()); ?>">
				<div class="content-single-portfolio">
					<div class="content-top-single">
						<?php s7upf_display_metabox('single');?>
						<h1 class="single-post-title title36 lora-font text-uppercase">
							<?php the_title()?>
							<?php echo (is_sticky()) ? '<i class="fa fa-star"></i>':''?>
						</h1>
					</div>
					<?php
				  
					while ( have_posts() ) : the_post();

						the_content();
						
						if ( comments_open() || get_comments_number() ) { comments_template(); }
					   
					endwhile; ?>
				</div>
            </div>
            <?php s7upf_output_sidebar('right')?>
        </div>
    </div>
</div>
<?php do_action('s7upf_after_main_content')?>
<?php get_footer();?>