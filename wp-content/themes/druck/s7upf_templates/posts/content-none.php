<div class="wrap-content-none">
	<?php if(is_search()) : ?>
        <h2 class="title24 text-uppercase lora-font margin-30"><?php printf( esc_html__( 'Search Results for: %s', 'druck' ), '<span class="color">' . get_search_query() . '</span>' );  ?></h2>
		<p class="desc silver margin-30"><?php echo esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.','druck'); ?></p>
		<div class="row flex-center margin-30">
			<div class="col-md-5 col-sm-8 col-xs-12">
				<?php get_search_form(); ?>
			</div>
		</div>
	 <?php else : ?>
		<?php echo esc_html_e('No any post to display. Please recheck your posts.','druck'); ?>
	<?php endif; ?>
</div>