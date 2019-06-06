<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 */
$page_id = s7upf_get_option('s7upf_404_page');
if(!empty($page_id)){	
	$style = s7upf_get_option('s7upf_404_page_style');
	if($style == 'full-width') {
		get_header('none');
		echo S7upf_Template::get_vc_pagecontent($page_id);
		get_footer('none');
	}
	else{
		get_header(); ?>
		<div id="main-content" class="main-page-default">
		    <div class="container">
				<?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
			</div>
		</div>
		<?php do_action('s7upf_after_main_content')?>
		<?php get_footer();
	}
}
else{
	get_header(); ?>
	<div id="main-content" class="main-page-default">
	    <div class="container">
			<section class="error-404">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="icon-404 flex-wrapper flex_direction-column justify_content-center align_items-center">
							<h2 class="number lora-font font-bold"><?php esc_html_e('404','druck');?></h2>
							<h3 class="text"><?php esc_html_e('Page Not Found','druck');?></h3>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="info-404 text-center">
							<h2 class="title60 font-bold text-uppercase color lora-font"><?php esc_html_e('Oops!','druck');?></h2>
							<h3 class="title30 lora-font text-uppercase"><?php esc_html_e('Page not found on server','druck');?></h3>
							<p class="desc silver"><?php esc_html_e('The link you followed is either outdated, inaccurate or the server has been instructed not to let you have it.','druck');?></p>
							<a class="shop-button bg-color curl-top-right" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e('Go to Home','druck');?></a>
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->
		</div>
	</div>
	<?php do_action('s7upf_after_main_content')?>
	<?php get_footer(); 
}?>
