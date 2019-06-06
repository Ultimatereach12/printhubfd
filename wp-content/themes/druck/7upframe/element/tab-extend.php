<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 05/09/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_tab_extend')){
	function s7upf_vc_tab_extend($attr, $content = false){
		$html = $css_class = '';
		$data_array = array_merge(array(
			'style'         => '',
			'list_tabs'     => '',
			'list_tabs2'    => '',
			'el_class'      => '',
			'custom_css'    => '',
		),s7upf_get_responsive_default_atts());
		$attr = shortcode_atts($data_array,$attr);
		extract($attr);
		$css_classes = vc_shortcode_custom_css_class( $custom_css );
		$css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		
		// Variable process vc_shortcodes_css_class
		if(!empty($css_class)) $el_class .= ' '.$css_class;
		
		
		
		$unit_id = uniqid();
		
		ob_start();
		?> 
		
		<div class="tab-extend-content <?php echo esc_attr($el_class);?>"> 
			
			<?php 
				if($style == 'contact'):
				if(isset($list_tabs2)) $data_tabs2 = (array) vc_param_group_parse_atts( $list_tabs2 );
			?>
				<div class="content-contact-page">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="list-info-contact-page">
								<ul class="list-none">
									<?php
										if(is_array($data_tabs2)):
										foreach($data_tabs2 as $key => $tabs):
										
										if($key==0){
											$class_active = 'active';
										}else{
											$class_active = '';
										}
										$tab_id = $tabs['mega_id'].'-'.$unit_id;
									?>
									<li class="<?php echo esc_attr($class_active);?>">
										<a href="#<?php echo esc_attr($tab_id);?>" data-toggle="tab">
											<div class="item-contact-info">
												<?php if(!empty($tabs['title'])):?>
												<h3 class="title18 black lora-font font-bold text-uppercase"><?php echo esc_html($tabs['title']);?></h3>
												<?php endif;?>
												<?php
													if(isset($tabs['list_info'])):
													$data_info  = (array) vc_param_group_parse_atts( $tabs['list_info'] );
												?>
												<ul class="list-none">
													<?php
														foreach($data_info as $value):
													?>
													<li>
														<i class="color <?php echo esc_attr($value['icon']);?>"></i>
														<p class="desc"><?php echo esc_html($value['text']);?></p>
													</li>
													<?php endforeach;?>
												</ul>
												<?php endif;?>
											</div>
										</a>
									</li>	
									<?php endforeach;endif;?>
								</ul>
							</div>
							
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="tab-content">
								<?php 
									if(is_array($data_tabs2)):
									foreach($data_tabs2 as $key => $tabs):
									if($key==0){
										$class_active = 'active';
									}else{
										$class_active = '';
									}
									$tab_id = $tabs['mega_id'].'-'.$unit_id;
								?>
								<div id="<?php echo esc_attr($tab_id);?>" class="tab-pane <?php echo esc_attr($class_active);?>">
									<?php echo S7upf_Template::get_vc_pagecontent($tabs['mega_id']);?>
								</div>
								<?php endforeach;endif;?>
							</div>	
						</div>
					</div>
				</div>
			<?php endif;?>
			
			<?php 
				if($style == ''):
				if(isset($list_tabs)) $data_tabs = (array) vc_param_group_parse_atts( $list_tabs );
			?>	
				<div class="title-tab-style2">
					<ul class="title-tab text-uppercase list-inline-block">
						<?php
							if(is_array($data_tabs)):
							foreach($data_tabs as $key => $tabs):
							
							if($key==0){
								$class_active = 'active';
							}else{
								$class_active = '';
							}
							$tab_id = $tabs['mega_id'].'-'.$unit_id;
						?>
						<li class="<?php echo esc_attr($class_active);?>"><a href="#<?php echo esc_attr($tab_id);?>" data-toggle="tab"><?php echo esc_html($tabs['title']);?></a></li>
						<?php endforeach;endif;?>
					</ul>
				</div>
				<div class="tab-content">
					<?php 
						if(is_array($data_tabs)):
						foreach($data_tabs as $key => $tabs):
						if($key==0){
							$class_active = 'active';
						}else{
							$class_active = '';
						}
						$tab_id = $tabs['mega_id'].'-'.$unit_id;
					?>
					<div id="<?php echo esc_attr($tab_id);?>" class="tab-pane <?php echo esc_attr($class_active);?>">
						<?php echo S7upf_Template::get_vc_pagecontent($tabs['mega_id']);?>
					</div>
					<?php endforeach;endif;?>
				</div>
			<?php endif;?>
		</div>
		<?php 
		$html = ob_get_clean();
		return $html;
	}
}
stp_reg_shortcode('s7upf_tab_extend','s7upf_vc_tab_extend');
$check_add = '';
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_list_tab_extend',10,100 );
if ( ! function_exists( 's7upf_add_list_tab_extend' ) ) {
    function s7upf_add_list_tab_extend(){
        $tab_id = 's7upf_'.uniqid();
        vc_map( array(
            "name"      => esc_html__("Tab Extend", 'druck'),
            "base"      => "s7upf_tab_extend",
            "icon"      => "icon-st",
            "category"      => esc_html__("7UP-Elements", 'druck'),
            "description"   => esc_html__( 'Display Tab Content Page', 'druck' ),
            "params"    => array(   
				array(
					"type"          => "dropdown",
					"admin_label"   => true,
					"heading"       => esc_html__("Style",'druck'),
					"param_name"    => "style",
					"value"         => array(
						esc_html__("Default",'druck')         => '',
						esc_html__("Contact",'druck')         => 'contact',
					),
					"description"   => esc_html__( 'Choose a style to display.', 'druck' )
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add List Tab",'druck'),
					"param_name" => "list_tabs",
					"params"    => array(
						array(
							"type"          => "textfield",
							"heading"       => esc_html__("Tab Title",'druck'),
							"param_name"    => "title",
						),
						array(
							"type"          => "dropdown",
							"heading"       => esc_html__("Tab Content ID",'druck'),
							"param_name"    => "mega_id",
							"value"         => s7upf_list_post_type('s7upf_mega_item'),
							"description"   => esc_html__( 'Select mega content page.', 'druck' ),
						),
					),
					'dependency'    => array(
						'element'   => 'style',
						'value'     => array(''),
					)
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add List Tab",'druck'),
					"param_name" => "list_tabs2",
					"params"    => array(
						array(
							"type"          => "textfield",
							"heading"       => esc_html__("Tab Title",'druck'),
							"param_name"    => "title",
						),
						array(
							"type" => "param_group",
							"heading" => esc_html__("Add List Contact Information",'druck'),
							"param_name" => "list_info",
							"params"    => array(
								array(  
									'type' => 'iconpicker' ,
									'heading' => esc_html__('Icon', 'druck'),
									'param_name' => 'icon',
									'value' => '',
									'settings'      => array(
										'emptyIcon'     => true,
										'type'          => s7upf_default_icon_lib(),
										'iconsPerPage'  => 4000,
									),
									'description' =>  esc_html__( 'Select icon from Ion icon library.', 'druck' ),
								),
								array(
									"type" => "textfield",
									"heading" => esc_html__("Text",'druck'),
									"param_name" => "text",
								),
							),
						),
						array(
							"type"          => "dropdown",
							"heading"       => esc_html__("Tab Content ID",'druck'),
							"param_name"    => "mega_id",
							"value"         => s7upf_list_post_type('s7upf_mega_item'),
							"description"   => esc_html__( 'Select mega content page.', 'druck' ),
						),
					),
					'dependency'    => array(
						'element'   => 'style',
						'value'     => array('contact'),
					)
				),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__("Extra class name",'druck'),
                    "param_name"    => "el_class",
                    'group'         => esc_html__('Design Options','druck'),
                    'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'druck' )
                ),
                array(
                    "type"          => "css_editor",
                    "heading"       => esc_html__("CSS box",'druck'),
                    "param_name"    => "custom_css",
                    'group'         => esc_html__('Design Options','druck')
                ),
            )
        ));
    }
}