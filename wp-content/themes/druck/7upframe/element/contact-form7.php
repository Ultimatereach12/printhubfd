<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/12/15
 * Time: 10:00 AM
 */

if(!function_exists('s7upf_vc_contact_form') && class_exists('WPCF7')){
    function s7upf_vc_contact_form($attr){
        $html = '';
        $data_array = array_merge(array(
            'style'         => '',
            'link'       	=> '',
			'image'     	=> '',
			'size'          => '', 
            'icon'      	=> '',
            'title'      	=> '',
            'desc'      	=> '',
            'form_id'       => '',
            'el_class'      => '',
            'custom_css'    => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;        
		if(!empty($size)) {
			$size = explode('x', $size);
		}else{ 
			$size = 'full';
		}	

        ob_start();
		switch($style){
			case 'service':
				if(!empty($form_id)):
				?>
				<div class="item-service-pro <?php echo esc_attr($el_class);?>">
					<?php if(!empty($title)):?>
					<h3 class="title18 lora-font font-bold text-uppercase flex-wrapper align_items-center">
						<?php if(!empty($icon)) echo '<i class="title30 color '.esc_attr($icon).'"></i>';?>
						<a href="<?php echo esc_url($link);?>"><?php echo esc_html($title);?></a>
					</h3>
					<?php endif;?>
					<?php if(!empty($image)):?>
					<div class="banner-advs zoom-in fly-cross">
						<a href="<?php echo esc_url($link);?>" class="adv-thumb-link"><?php echo wp_get_attachment_image($image,$size);?></a>
					</div>
					<?php endif;?>
					<div class="info-service-pro">
						<?php if(!empty($desc)):?>
						<p class="desc"><?php echo esc_html($desc);?></p>
						<?php endif;?>
						<div class="wrap-button-service-pro flex-wrapper align_items-center justify_content-space-between">
							<a href="<?php echo esc_url($link);?>" class="shop-button bg-color curl-top-right"><?php echo esc_html__('Learn more','druck');?></a>
							<?php if(!empty($form_id)):?>
							<div class="wrap-service-form-popup">
								<a href="#contact-form-popup-<?php echo esc_attr($form_id);?>" class="fancybox shop-button curl-top-right"><?php echo esc_html__('Send an enquiry','druck');?></a>
								<div id ="contact-form-popup-<?php echo esc_attr($form_id);?>" class="contact-form-popup">
									<?php echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');?>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>
				</div>	
				<?php endif;
			break;
			default:
				if(!empty($form_id)):
				?>
				<div class="contact-form-default <?php echo esc_attr($el_class);?>">
					<?php echo do_shortcode('[contact-form-7 id="'.esc_attr($form_id).'"]');?>
				</div>
				<?php endif;					
			break;
		}
		$html = ob_get_clean();	
        return $html;
    }

	stp_reg_shortcode('s7upf_contact_form','s7upf_vc_contact_form');

	vc_map( array(
		"name"          => esc_html__("Contact Form 7", 'druck'),
		"base"          => "s7upf_contact_form",
		"icon"          => "icon-st",
		"category"      => esc_html__("7UP-Elements", 'druck'),
		"description"   => esc_html__( 'Display Form Contact', 'druck' ),
		"params"        => array(
			array(
				"type"          => "dropdown",
				"admin_label"   => true,
				"heading"       => esc_html__("Style",'druck'),
				"param_name"    => "style",
				"value"         => array(
					esc_html__("Default",'druck')         => '',
					esc_html__("Service",'druck')         => 'service',
				),
				"description"   => esc_html__( 'Choose a style to display.', 'druck' )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Link",'druck'),
				"param_name" => "link",
				'dependency'    => array(
					'element'   => 'style',
					'value'   => array('service'),
				)
			),
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image",'druck'),
				"param_name" => "image",
				'dependency'    => array(
					'element'   => 'style',
					'value'   => array('service'),
				)
			),
			array(
				"type"          => "textfield",
				"heading"       => esc_html__("Image Size",'druck'),
				"param_name"    => "size",
				'dependency'    => array(
					'element'   => 'style',
					'value'   => array('service'),
				),
				'description'   => esc_html__( 'Enter site thumbnail to crop. [width]x[height]. Example is 300x300', 'druck' ),
			),
			array(  
				'type' => 'iconpicker' ,
				'heading' => esc_html__('Icon', 'druck'),
				'param_name' => 'icon',
				'value' => '', // default value to backend editor admin_label
				'settings'      => array(
					'emptyIcon'     => true,
					'type'          => s7upf_default_icon_lib(),
					'iconsPerPage'  => 4000,
				),
				'dependency'    => array(
					'element'   => 'style',
					'value'   => array('service'),
				),
				'description' =>  esc_html__( 'Select an icon from icons library.', 'druck' ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title",'druck'),
				"param_name" => "title",
				'dependency'    => array(
					'element'   => 'style',
					'value'   => array('service'),
				)
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description",'druck'),
				"param_name" => "desc",
				"dependency"    => array(
					"element"   => "style",
					"value"   => array('service'),
				),
			),
			array(
				"type"          => "dropdown",
				"admin_label"   => true,
				"heading"       => esc_html__("Form ID",'druck'),
				"param_name"    => "form_id",
				"value"         => s7upf_list_post_type('wpcf7_contact_form'),
				"description"   => esc_html__( 'Select contact form 7.', 'druck' ),
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