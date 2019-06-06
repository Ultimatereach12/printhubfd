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
                <?php
                $size               = s7upf_get_option('post_single_size');
                $check_thumb        = s7upf_get_option('post_single_thumbnail','on');
                $check_meta         = s7upf_get_option('post_single_meta','off'); 
                $check_related      = s7upf_get_option('post_single_related','off'); 
                $check_author       = s7upf_get_option('post_single_author','off'); 
                $check_excerpt      = s7upf_get_option('post_single_excerpt','off'); 
                $size = s7upf_get_size_crop($size);
                $data = array(
                    'size'              => $size,
                    'check_thumb'       => $check_thumb,
                    'check_meta'        => $check_meta,
                    'check_excerpt'        => $check_excerpt,
                    );
                while ( have_posts() ) : the_post();

                    /*
                    * Include the post format-specific template for the content. If you want to
                    * use this in a child theme, then include a file called called content-___.php
                    * (where ___ is the post format) and that will be used instead.
                    */
                    s7upf_get_template_post( 'single-content/content',get_post_format(),$data,true );
                    
                    s7upf_get_template( 'share','',false,true );
                    if($check_author == 'on') s7upf_get_template_post( 'single-content/author','',false,true );
                    if($check_related == 'on') s7upf_get_template_post( 'single-content/related','',false,true );
                    if ( comments_open() || get_comments_number() ) { comments_template(); }
                   
                endwhile; ?>
            </div>
            <?php s7upf_output_sidebar('right')?>
        </div>
    </div>
</div>
<?php do_action('s7upf_after_main_content')?>
<?php get_footer();?>