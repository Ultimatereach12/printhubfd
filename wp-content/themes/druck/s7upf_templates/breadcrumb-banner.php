<div class="banner-slider bg-slider <?php echo esc_attr($el_class)?>">
	<div class="item-slider">
		<div class="banner-thumb">
			<?php echo wp_get_attachment_image($image,'full')?>
		</div>
		<div class="banner-info text-center flex-wrapper align_items-center">
			<div class="container">
				<h2 class="title30 lora-font font-bold text-uppercase">
				<?php 
					if($type==''):
				?>
				<?php
					if ( is_archive() ) {
						echo get_the_archive_title();
					}else{
						echo get_the_title(s7upf_get_current_id());
					}
				?>
				<?php endif;?>
				<?php 
					if($type=='blog'):
				?>
				<?php echo esc_html__('Blog','druck');?>
				<?php endif;?>
				<?php 
					if($type=='shop'):
				?>
				<?php echo esc_html__('Shop','druck');?>
				<?php endif;?>
				</h2>
				
				<a class="gray" href="<?php echo home_url('/');?>"><i class="title18 la la-home"></i><?php echo esc_html__(' Home','druck');?></a>
				<span class="gray">-</span>
				<strong class="title14 gray">
					<?php
						if ( is_archive() ) {
							echo get_the_archive_title();
						}else{
							echo get_the_title(s7upf_get_current_id());
						}
					?>
				</strong>
			</div>
		</div>
	</div>
</div>
