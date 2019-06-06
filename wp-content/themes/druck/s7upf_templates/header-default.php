<?php
$page_id = apply_filters('s7upf_header_page_id',s7upf_get_value_by_id('s7upf_header_page'));
if(!empty($page_id)){?>
    <div id="header" class="header-page">
        <div class="container">
            <?php echo S7upf_Template::get_vc_pagecontent($page_id);?>
        </div>
    </div>
<?php
}
else{?>
    <div id="header" class="header header-default">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-10">
					<div class="logo">
						<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr__("logo","druck");?>">
							<?php $s7upf_logo=s7upf_get_option('logo');?>
							<?php if($s7upf_logo!=''){
								echo '<h1 class="hidden">'.get_bloginfo('name', 'display').'</h1><img src="' . esc_url($s7upf_logo) . '" alt="'.esc_attr__("logo","druck").'">';
							}   else { echo '<h2 class="title36 lora-font font-bold text-uppercase">'.get_bloginfo('name', 'display').'</h2>'; }
							?>
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-md-12 col-sm-12 col-xs-2">
					<?php if ( has_nav_menu( 'primary' ) ) {?>
					<nav class="main-nav">
					<?php wp_nav_menu( array(
							'theme_location'    => 'primary',
							'container'         =>false,
							'walker'            =>new S7upf_Walker_Nav_Menu(),
						 )
					);?>
						<a href="#" class="toggle-mobile-menu"><span></span></a>
					 </nav>
					<?php } ?>  
				</div>
			</div>
		</div>
    </div>
<?php
}
?>
