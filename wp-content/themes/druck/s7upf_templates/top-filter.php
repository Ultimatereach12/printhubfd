<?php
	global $post,$wp_query;
	if(!isset($check_order)) $check_order = false;
	if(function_exists('is_shop')) if(is_shop()) $check_order = true;
	if(isset($post->post_content)) if(strpos($post->post_content, '[sv_shop')) $check_order = true;
	if($check_order == true) $add_class = 'load-shop-ajax';
	else $add_class = '';
	$orderby = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
	if(isset($_GET['orderby'])) $orderby = $_GET['orderby'];	
?>
<div class="tool-shop-filter flex-wrapper align_items-center justify_content-space-between">
	<div class="sort-pagi-bar flex-wrapper">
		<?php if($check_type == 'on'):?>
		<div class="view-type flex-wrapper">
			<a data-type="list" href="<?php echo esc_url(s7upf_get_key_url('type','list'))?>" class="list-view <?php echo esc_attr($add_class)?> <?php if($style == 'list') echo 'active'?>"><svg version="1.1" id="list-view" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18" height="18" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"> <rect width="18" height="2"></rect> <rect y="16" width="18" height="2"></rect> <rect y="8" width="18" height="2"></rect> </svg></a>
			<a data-type="grid-2-col" href="<?php echo esc_url(s7upf_get_key_url('type','grid-2-col'))?>" class="grid-view <?php echo esc_attr($add_class)?> <?php if($style == 'grid-2-col') echo 'active'?>"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <path d="M7,2v5H2V2H7 M9,0H0v9h9V0L9,0z"></path> <path d="M17,2v5h-5V2H17 M19,0h-9v9h9V0L19,0z"></path> <path d="M7,12v5H2v-5H7 M9,10H0v9h9V10L9,10z"></path> <path d="M17,12v5h-5v-5H17 M19,10h-9v9h9V10L19,10z"></path> </svg></a>
			<a data-type="grid-3-col" href="<?php echo esc_url(s7upf_get_key_url('type','grid-3-col'))?>" class="grid-view <?php echo esc_attr($add_class)?> <?php if($style == 'grid-3-col') echo 'active'?>"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="5" height="5"></rect> <rect x="7" width="5" height="5"></rect> <rect x="14" width="5" height="5"></rect> <rect y="7" width="5" height="5"></rect> <rect x="7" y="7" width="5" height="5"></rect> <rect x="14" y="7" width="5" height="5"></rect> <rect y="14" width="5" height="5"></rect> <rect x="7" y="14" width="5" height="5"></rect> <rect x="14" y="14" width="5" height="5"></rect> </svg></a>
			<?php
				$check_sidebar = s7upf_check_sidebar();
				if($check_sidebar == false):
			?>
			<a data-type="grid-4-col" href="<?php echo esc_url(s7upf_get_key_url('type','grid-4-col'))?>" class="grid-view <?php echo esc_attr($add_class)?> <?php if($style == 'grid-4-col') echo 'active'?>"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="4" height="4"></rect> <rect x="5" width="4" height="4"></rect> <rect x="10" width="4" height="4"></rect> <rect x="15" width="4" height="4"></rect> <rect y="5" width="4" height="4"></rect> <rect x="5" y="5" width="4" height="4"></rect> <rect x="10" y="5" width="4" height="4"></rect> <rect x="15" y="5" width="4" height="4"></rect> <rect y="15" width="4" height="4"></rect> <rect x="5" y="15" width="4" height="4"></rect> <rect x="10" y="15" width="4" height="4"></rect> <rect x="15" y="15" width="4" height="4"></rect> <rect y="10" width="4" height="4"></rect> <rect x="5" y="10" width="4" height="4"></rect> <rect x="10" y="10" width="4" height="4"></rect> <rect x="15" y="10" width="4" height="4"></rect> </svg></a>
			<?php endif;?>
		</div>
		<?php endif;?>
		<?php if($check_number == 'on'):
			$list   = s7upf_get_option('shop_number_filter_list');
			if(empty($list)){
				$list = array(9,12,18,24);
			}
			else{
				$temp = array();
				foreach ($list as $value) {
					$temp[] = (int)$value['number'];
				}
				$list = $temp;
			}
			if(!in_array((int)$number, $list)) $list = array_merge(array((int)$number),$list);
			sort($list);
			if(isset($_GET['number'])) $number = $_GET['number'];
		?>
		<div class="flex-wrapper show-by align_items-center">
			<span class="gray"><?php esc_html_e("Show:","druck")?></span>
			<ul class="list-inline-block list-number-show">
				<?php
				if(is_array($list)){
					foreach ($list as $value) {
						if($value == $number) $active = ' active';
						else $active = '';
						echo '<li><a data-number="'.esc_attr($value).'" class="'.esc_attr($add_class.$active).'" href="'.esc_url(s7upf_get_key_url('number',$value)).'">'.$value.'</a></li>';
					}
				}
				?>
			</ul>
		</div>
		<?php endif;?>
	</div>
	<?php
		if($check_order):?>
		<div class="sort-by flex-wrapper align_items-center">
			<span class="gray"><?php esc_html_e("Sort by:","druck");?></span>
			<div class="select-box">
				<?php s7upf_catalog_ordering($wp_query,$orderby,true,$add_class);?>
			</div>
		</div>
		<?php endif;
	?>
	<?php
		if(!empty($filter_extra)):
	?>
	<div class="block-filter-extra">
		<?php if($filter_extra == 'sidebar'):?>
		<div class="filter-extra-sidebar custom-scroll">
			<a href="javascript:void(0)" class="show-sidebar silver flex-wrapper align_items-center"><span class="gray"><?php esc_html_e('Show Sidebar','druck');?></span><i class="title24 la la-list"></i></a>
			<div class="wrap-sidebar-fixed transition">
				<a href="javascript:void(0)" class="close-sidebar lora-font"><?php esc_html_e('Close Sidebar','druck');?></a>
				<div class="sidebar">
					<?php dynamic_sidebar($filter_sidebar);?>
				</div>
			</div>
		</div>
		<?php endif;?>
		<?php if($filter_extra == 'dropdown'):?>
		<div class="filter-extra-dropdown">
			<a href="javascript:void(0)" class="toggle-filter-extra gray flex-wrapper align_items-center"><?php esc_html_e('Filters','druck');?></a>
			<div class="wrap-filter-extra">
				<div class="list-filter-extra flex-wrapper flex_wrap-wrap">
					<?php dynamic_sidebar($filter_sidebar);?>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
	<?php endif;?>
</div>