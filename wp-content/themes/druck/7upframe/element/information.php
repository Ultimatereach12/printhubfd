<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_information'))
{
    function s7upf_vc_information($attr,$content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'     	 => '',
            'image'     	 => '',
			'size'           => '', 
            'icon'      	 => '',
            'title'      	 => '',
            'sub_title'      => '',
            'desc'      	 => '',
			'list_icon'      => '',
			'list_info'      => '',
			'list_service'   => '',
            'video'      	 => '',
            'link'       	 => '',
            'button'    	 => '',
			'cats'      	 => '',
			'list_cats'      => '',
			'date'      	 => '',
			'color'      	 => '',
			'background'     => '',
			'percent'      	 => '',
			'radius'      	 => '90',
			'el_class'       => '',
			'custom_css'     => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		$el_class .= ' '.$css_class;
		if(!empty($button)) $button = vc_build_link($button);
		if(!empty($size)) {
			$size = explode('x', $size);
		}else{ 
			$size = 'full';
		}	
		if(!empty($image)) $bg_image = S7upf_Assets::build_css('background-image:url('.wp_get_attachment_url($image).')');
        if(!empty($icon)) $icon = '<i class="'.esc_attr($icon).'"></i>';
		if(isset($list_category)) $data_category = (array) vc_param_group_parse_atts( $list_category );
		if(isset($list_icon)) $data_icon  = (array) vc_param_group_parse_atts( $list_icon );
		if(isset($list_link)) $data_link  = (array) vc_param_group_parse_atts( $list_link );
		ob_start();
        switch ($style) {
			
			case 'tab-service':
				if(isset($list_service)): 
				$data_service  = (array) vc_param_group_parse_atts( $list_service );
				$unit_id = uniqid();
				?>
				<div class="service-tab <?php echo esc_attr($el_class);?>">
					<ul class="service-tab-title list-none flex-wrapper">
						<?php
							foreach($data_service as $key => $value):
							$class_active = ($key == 0) ? 'active' : 0;
						?>
						<li class="<?php echo esc_attr($class_active);?>">
							<a href="#<?php echo esc_attr($unit_id);?>-<?php echo esc_attr($key);?>" data-toggle="tab">
								<i class="black <?php echo esc_attr($value['icon']);?>"></i>
								<span class="gray"><?php echo esc_html($value['title']);?></span>
							</a>
						</li>
						<?php endforeach;?>
					</ul>
					<div class="tab-content">
						<?php
							foreach($data_service as $key => $value):
							$class_active = ($key == 0) ? 'active' : 0;
						?>
						<div id="<?php echo esc_attr($unit_id);?>-<?php echo esc_attr($key);?>" class="tab-pane <?php echo esc_attr($class_active);?>">
							<div class="service-tab-content flex-wrapper">
								<span class="title18 white bg-color round"><?php echo esc_html($key+1);?></span>
								<p class="desc"><?php echo esc_html($value['desc']);?></p>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'video-popup':
				if(!empty($video)):
				?>
				<div class="show-video-popup text-center <?php echo esc_attr($el_class);?>">
					<?php if(!empty($content)):?>
					<div class="intro-video-popup"><?php echo	wpb_js_remove_wpautop($content, true);?></div>
					<?php endif;?>
					<a href="<?php echo esc_url($video);?>" class="title60 bg-color btn-play-video fancybox fancybox-media"><i class="white la la-play-circle"></i></a>
				</div>
				<?php endif;		
			break;
			
			case 'banner-category':
				if(!empty($cats)):
				$term = get_term_by('slug',$cats,'product_cat');
				if(!empty($title)){
					$cat_name = $title;
				}else{
					$cat_name = $term->name;
				}
				$cat_link = get_category_link($term);
				$count = $term->count;
				?>
				<div class="item-cat-eye text-center <?php echo esc_attr($el_class);?>">
					<div class="cat-thumb banner-advs zoom-image image-shadow">
						<div class="adv-thumb-link box-hover-dir">
							<?php echo wp_get_attachment_image($image,$size);?>
							<div class="wrap-eye flex-wrapper align_items-center justify_content-center"><a href="<?php echo esc_url($cat_link);?>"><i class="bg-white color title30 la la-eye transition"></i></a></div>
						</div>
					</div>
					<div class="cat-info">
						<h3 class="title14 lora-font"><a href="<?php echo esc_url($cat_link);?>" class="wobble-horizontal"><?php echo esc_html($cat_name);?></a></h3>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'category-statistic':
				if(!empty($cats)):
				$term = get_term_by('slug',$cats,'product_cat');
				if(!empty($title)){
					$cat_name = $title;
				}else{
					$cat_name = $term->name;
				}
				$cat_link = get_category_link($term);
				$count = $term->count;
				?>
				<div class="item-cat-statistic <?php echo esc_attr($el_class);?>">
					<div class="banner-advs image-shadow zoom-in">
						<div class="adv-thumb-link">
							<?php echo wp_get_attachment_image($image,$size);?>
							<a href="<?php echo esc_url($cat_link);?>" class="absolute flex-wrapper flex_direction-column align_items-flex-start justify_content-flex-end">
								<div class="cat-info transition">
									<h3 class="title18 lora-font font-bold text-uppercase black"><?php echo esc_html($cat_name);?></h3>
									<span class="color transition"><?php echo esc_html($count);?> <?php echo esc_html__('products','druck');?></span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'list-category':
				if(!empty($list_cats)):
				?>
				<div class="box-category-list <?php echo esc_attr($el_class);?>">
					<h3 class="title18 lora-font font-bold text-uppercase title-first-letter"><?php echo esc_html($title);?></h3>
					<ul class="list-none">
					<?php
						$list_cats = explode(',',$list_cats);
						foreach($list_cats as $cats):
						$term = get_term_by('slug',$cats,'product_cat');
						$cat_name = $term->name;
						$cat_link = get_category_link($term);
						$count = $term->count;
					?>
					<li><a class="wobble-top gray" href="<?php echo esc_url($cat_link);?>"><?php echo esc_html($cat_name);?></a><span class="count"><?php echo esc_html($count);?></span></li>
					<?php endforeach;?>
					</ul>
				</div>
				<?php endif;		
			break;
			
			case 'banner-direction':
				?>
				<div class="banner-hover-direction text-center <?php echo esc_attr($el_class);?>">
					<div class="banner-thumb banner-advs zoom-image">
						<div class="adv-thumb-link box-hover-dir">
							<?php echo wp_get_attachment_image($image,$size);?>
							<?php if(!empty($content)):?>
							<div class="adv-info flex-wrapper flex_direction-column align_items-center justify_content-center">
								<?php echo	wpb_js_remove_wpautop($content, true);?>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>
				<?php	
			break;
			
			case 'contact-page':
				?>
				<div class="item-contact-info item-hover-active <?php echo esc_attr($el_class);?>">
					<?php if(!empty($title)):?>
					<h3 class="title18 lora-font font-bold text-uppercase"><?php echo esc_html($title);?></h3>
					<?php endif;?>
					<?php
						if(isset($list_info)):
						$data_info  = (array) vc_param_group_parse_atts( $list_info );
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
				<?php	
			break;
			
			case 'info-work':
				if(!empty($icon)):
				?>
				<div class="item-info-work flex-wrapper <?php echo esc_attr($el_class);?>">
					<div class="info-work-icon">
						<a href="<?php echo esc_url($link);?>" class="title60 grow"><?php echo apply_filters('s7upf_output_content',$icon);?></a>
					</div>
					<div class="info-work-text">
						<h3 class="title18 lora-font font-bold text-uppercase"><a href="<?php echo esc_url($link);?>" class="wobble-horizontal"><?php echo esc_html($title);?></a></h3>
						<p class="desc"><?php echo esc_html($desc);?></p>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'item-cat-icon':
				if(!empty($cats)):
				$term = get_term_by('slug',$cats,'product_cat');
				if(!empty($title)){
					$cat_name = $title;
				}else{
					$cat_name = $term->name;
				}
				$cat_link = get_category_link($term);
				$count = $term->count;
				?>
				<div class="item-cat-icon flex-wrapper justify_content-center align_items-center <?php echo esc_attr($el_class);?>">
					<div class="cat-icon">
						<a href="<?php echo esc_url($cat_link);?>" class="title60 white"><?php echo apply_filters('s7upf_output_content',$icon);?></a>
					</div>
					<div class="cat-text">
						<h3 class="title18 lora-font font-bold text-uppercase title-first-letter"><a href="<?php echo esc_url($cat_link);?>" class="white"><?php echo esc_html($cat_name);?></a></h3>
						<p class="desc smoke"><?php echo esc_html($count);?> <?php echo esc_html__('Products','druck');?></p>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'info-service':
				?>
				<div class="item-service item-hover-active text-center <?php echo esc_attr($el_class);?>">
					<?php if(!empty($icon)):?>
					<div class="service-icon">
						<a href="<?php echo esc_url($link);?>" class="title90 round inline-block"><?php echo apply_filters('s7upf_output_content',$icon);?></a>
					</div>
					<?php endif;?>
					<div class="service-text">
						<h3 class="title18 lora-font font-bold text-uppercase"><a href="<?php echo esc_url($link);?>" class="wobble-horizontal"><?php echo esc_html($title);?></a></h3>
						<h4 class="title12 color"><?php echo esc_html($sub_title);?></h4>
						<p class="desc"><?php echo esc_html($desc);?></p>
					</div>
				</div>
				<?php 
			break;
						
			case 'info-service2':
				?>
				<div class="item-service2 flex-wrapper <?php echo esc_attr($el_class);?>">
					<?php if(!empty($icon)):?>
					<div class="service-icon">
						<a href="<?php echo esc_url($link);?>" class="title60 round inline-block bg-color white"><?php echo apply_filters('s7upf_output_content',$icon);?></a>
					</div>
					<?php endif;?>
					<div class="service-text">
						<h3 class="title24 lora-font font-bold"><a href="<?php echo esc_url($link);?>" class="wobble-top white"><?php echo esc_html($title);?></a></h3>
						<p class="desc white"><?php echo esc_html($desc);?></p>
					</div>
				</div>
				<?php 
			break;
			
			case 'info-statistic':
				if(!empty($color)): 
				$class_color = S7upf_Assets::build_css('color:'.$color);
				?>
				<div class="item-statistic text-center <?php echo esc_attr($el_class);?>">
					<div class="wrap-percent-circle inline-block">
						<div id="<?php echo uniqid();?>" class="percentage" data-color="<?php echo esc_attr($color);?>" data-value="<?php echo esc_attr($percent);?>" data-radius="<?php echo esc_attr($radius);?>"></div>
						<span class="percent-text absolute title24 <?php echo esc_attr($class_color);?>"><span class="count-up"><?php echo esc_html($percent);?></span><?php echo esc_html__('%','druck')?></span>
					</div>
					<?php if(!empty($title)):?>
					<h3 class="title18 lora-font font-bold text-uppercase white"><?php echo esc_html($title);?></h3>
					<?php endif;?>
					<?php if(!empty($desc)):?>
					<p class="desc white"><?php echo esc_html($desc);?></p>
					<?php endif;?>
				</div>
				<?php endif;
			break;
			
			case 'info-contact':
				if(!empty($icon)):
				?>
				<div class="item-info-contact flex-wrapper <?php echo esc_attr($el_class);?>">
					<div class="info-contact-icon">
						<a href="<?php echo esc_url($link);?>" class="title48 color grow"><?php echo apply_filters('s7upf_output_content',$icon);?></a>
					</div>
					<div class="info-contact-text">
						<?php echo	wpb_js_remove_wpautop($content, true);?>
					</div>
				</div>
				<?php endif;		
			break;
			
			case 'testimonial':
				?>
				<div class="item-testimonial text-center <?php echo esc_attr($el_class);?>">
					<div class="testimo-thumb flex-wrapper align_items-center justify_content-center">
						<a href="<?php echo esc_url($link);?>">
							<?php echo wp_get_attachment_image($image,$size);?>
						</a>
					</div>
					<div class="testimo-info">
						<p class="desc"><?php echo esc_html($desc);?></p>
						<h3 class="title18 lora-font font-bold"><a href="<?php echo esc_url($link);?>" class="wobble-horizontal"><?php echo esc_html($title);?></a></h3>
					</div>
				</div>
				<?php
			break;
			
			case 'team-member':
			$data_icon  = (array) vc_param_group_parse_atts( $list_icon );
			?>
			<div class="item-team-member text-center <?php echo esc_attr($el_class);?>">
				<div class="member-thumb banner-advs zoom-image">
					<a href="<?php echo esc_url($link);?>" class="adv-thumb-link">
						<?php echo wp_get_attachment_image($image,$size);?>
					</a>
					<?php if(!empty($list_icon)):?>
					<div class="list-social-member">
						<ul class="list-inline-block transition">
							<?php
							foreach ($data_icon as $key => $value){
								if(!empty($value['link']) && !empty($value['icon'])){
							?>		
							<li><a href="<?php echo esc_url($link);?>" class="title24 white push"><i class="<?php echo esc_attr($value['icon']);?>"></i></a></li>
							<?php		
								}
							}
							?>
						</ul>
					</div>
					<?php endif;?>
				</div>
				<div class="member-info">
					<h3 class="title18 lora-font font-bold"><a href="<?php echo esc_url($link);?>" class="black wobble-horizontal"><?php echo esc_html($title);?></a></h3>
					<span class="silver"><?php echo esc_html($sub_title);?></span>
					<p class="desc"><?php echo esc_html($desc);?></p>
				</div>
			</div>
			<?php			
			break;
					
            default:
				if(!empty($content)):
				?>
				<div class="custom-information <?php echo esc_attr($el_class);?>">
					<?php echo	wpb_js_remove_wpautop($content, true);?>
				</div>
				<?php endif;					
			break;
        }   
		$html = ob_get_clean();	
		return $html;
    }
}
stp_reg_shortcode('s7upf_information','s7upf_vc_information');
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_information',10,100 );
if ( ! function_exists( 's7upf_add_information' ) ) {
	function s7upf_add_information(){
		vc_map( array(
			"name"      => esc_html__("Information", 'druck'),
			"base"      => "s7upf_information",
			"icon"      => "icon-st",
			"category"  => '7UP-Elements',
			"params"    => array(
				array(
					"type"          => "dropdown",
					"holder"        => "div",
					"heading"       => esc_html__("Style",'druck'),
					"param_name"    => "style",
					"value"         => array(
						esc_html__("Default",'druck')   => 'default',
						esc_html__("Info Work",'druck')   => 'info-work',
						esc_html__("Testimonial",'druck')   => 'testimonial',
						esc_html__("Team Member",'druck')   => 'team-member',
						esc_html__("Info Contact",'druck')   => 'info-contact',
						esc_html__("Info Service",'druck')   => 'info-service',
						esc_html__("Info Service 2",'druck')   => 'info-service2',
						esc_html__("Tab Service",'druck')   => 'tab-service',
						esc_html__("Info Statistic",'druck')   => 'info-statistic',
						esc_html__("Banner Category",'druck')   => 'banner-category',
						esc_html__("Category Statistic",'druck')   => 'category-statistic',
						esc_html__("Video Popup",'druck')   => 'video-popup',
						esc_html__("Banner Hover Direction",'druck')   => 'banner-direction',
						esc_html__("List Category",'druck')   => 'list-category',
						esc_html__("Contact Page",'druck')   => 'contact-page',
						esc_html__("Category Icon",'druck')   => 'item-cat-icon',
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link",'druck'),
					"param_name" => "link",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('info-work','testimonial','team-member','info-contact','info-service','info-service2'),
					)
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Image",'druck'),
					"param_name" => "image",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('category-statistic','testimonial','team-member','banner-category','banner-direction'),
					)
				),
				array(
					"type"          => "textfield",
					"heading"       => esc_html__("Image Size",'druck'),
					"param_name"    => "size",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('category-statistic','testimonial','team-member','banner-category','banner-direction'),
					),
					'description'   => esc_html__( 'Enter site thumbnail to crop. [width]x[height]. Example is 300x300', 'druck' ),
				),
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
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('info-work','info-contact','info-service','info-service2','item-cat-icon'),
					),
					'description' =>  esc_html__( 'Select an icon from icons library.', 'druck' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title",'druck'),
					"param_name" => "title",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('contact-page','item-cat-icon','list-category','info-work','testimonial','team-member','info-service','info-service2','info-statistic','banner-category'),
					)
				),
				array(
					'holder'     => 'div',
					'heading'     => esc_html__( 'Product Category', 'druck' ),
					'type'        => 'autocomplete',
					'param_name'  => 'cats',
					'settings' => array(
						'values' => s7upf_get_list_taxonomy('product_cat'),
					),
					'save_always' => true,
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('banner-category','category-statistic','item-cat-icon'),
					),
				),
				array(
					'holder'     => 'div',
					'heading'     => esc_html__( 'List Product Category', 'druck' ),
					'type'        => 'autocomplete',
					'param_name'  => 'list_cats',
					'settings'      => array(
                        'multiple'      => true,
                        'sortable'      => true,
                        'values'        => s7upf_get_list_taxonomy('product_cat'),
                    ),
					'save_always' => true,
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('list-category'),
					),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Sub Title",'druck'),
					"param_name" => "sub_title",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('team-member','info-service'),
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link Video",'druck'),
					"param_name" => "video",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('video-popup'),
					),
					"description"   => esc_html__( 'Enter link(Youtube/Vimeo) of video', 'druck' )
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description",'druck'),
					"param_name" => "desc",
					"dependency"    => array(
						"element"   => "style",
						"value"   => array('info-work','testimonial','team-member','info-service','info-service2','info-statistic'),
					),
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add List Social Network",'druck'),
					"param_name" => "list_icon",
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
							"heading" => esc_html__("Link",'druck'),
							"param_name" => "link",
						),
					),
					"dependency"    =>array(
						'element'   =>'style',
						'value'     =>array('team-member')
					),
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Add List Service",'druck'),
					"param_name" => "list_service",
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
							"heading" => esc_html__("Title",'druck'),
							"param_name" => "title",
						),
						array(
							"type" => "textarea",
							"heading" => esc_html__("Description",'druck'),
							"param_name" => "desc",
						),
					),
					"dependency"    =>array(
						'element'   =>'style',
						'value'     =>array('tab-service')
					),
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
					"dependency"    =>array(
						'element'   =>'style',
						'value'     =>array('contact-page')
					),
				),
				array(
					"type"          => "vc_link",
					"heading"       => esc_html__("Button",'druck'),
					"param_name"    => "button",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array(''),
					)
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"heading" => esc_html__("Content",'druck'),
					"param_name" => "content",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('default','info-contact','video-popup','banner-direction'),
					)
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Date",'druck'),
					"param_name" => "date",
					"dependency"    => array(
						"element"   => "style",
						'value'   => array(''),
					),
					'description'   => esc_html__( 'Enter date start count down.Format(m/d/y)', 'druck' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Percent",'druck'),
					"param_name" => "percent",
					"dependency"    => array(
						"element"   => "style",
						'value'   => array('info-statistic'),
					),
					'description'   => esc_html__( 'Enter percent number value(0->100)', 'druck' ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Radius",'druck'),
					"param_name" => "radius",
					"dependency"    => array(
						"element"   => "style",
						'value'   => array('info-statistic'),
					),
					'description'   => esc_html__( 'Enter circle radius(default:90)', 'druck' ),
				),
				array(
					"type"          => "colorpicker",
					"heading"       => esc_html__("Color",'druck'),
					"param_name"    => "color",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array('info-statistic'),
					)
				),
				array(
					"type"          => "colorpicker",
					"heading"       => esc_html__("Background Color",'druck'),
					"param_name"    => "background",
					'dependency'    => array(
						'element'   => 'style',
						'value'   => array(''),
					)
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Class Extra', 'druck' ),
					'param_name'  => 'el_class',
					'group'       => esc_html__('Design Option','druck') 
				),
				array(
					"type"          => "css_editor",
					"heading"       => esc_html__("Custom Style",'druck'),
					"param_name"    => "custom_css",
					'group'         => esc_html__('Design Option','druck')
				),
			)
		));
    }
}