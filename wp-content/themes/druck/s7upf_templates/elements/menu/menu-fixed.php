<div class="menu-fixed custom-scroll <?php echo esc_attr($el_class);?>">
	<a href="javascript:void(0)" class="btn-menu-fixed"><span></span></a>
	<nav class="main-nav">
		<?php wp_nav_menu($menu_data);?>
		<a href="javascript:void(0)" class="toggle-mobile-menu"><span></span></a>
		<a href="javascript:void(0)" class="close-main-nav"><i class="ion-android-close"></i></a>
	</nav>
</div>