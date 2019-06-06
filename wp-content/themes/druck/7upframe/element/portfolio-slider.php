<?php
/**
 * Notepad++.
 * User: 7uptheme
 * Date: 05/24/15
 * Time: 10:00 AM
 */
if(!function_exists('s7upf_vc_trending'))
{
    function s7upf_vc_trending($attr,$content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'     	 => '',
            'num'     	     => '',
			'size'           => '',
			'el_class'       => '',
			'custom_css'     => '',
        ),s7upf_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
		$el_class .= ' '.$css_class;
		
		ob_start();
        switch ($style) {
			
            default:
				if(!empty($num)):
				$check_rtl = 'false';
				if(is_rtl()){
					$check_rtl = 'true';
				}
				?>
                <div class="portfolio-slider <?php echo esc_attr($el_class)?>" data-rtl="<?php echo esc_attr($check_rtl);?>">
					<div class="slider-for">
						<?php
							$args = array(
								'post_type'         => 'portfolio',
								'posts_per_page'    => $num
							);
							$portfolio_query = new WP_Query($args);
							$size = s7upf_get_size_crop($size);
							if($portfolio_query->have_posts()){
								while($portfolio_query->have_posts()){
									$portfolio_query->the_post();
									s7upf_get_template_portfolio('grid/grid','style2','',true);
								}
							}
							wp_reset_postdata();
						?>
					</div>
				</div>
				<?php endif;	
			break;
        }        
        $html = ob_get_clean();		
        return $html;
    }
}
stp_reg_shortcode('s7upf_trending','s7upf_vc_trending');
if(isset($_GET['return'])) $check_add = $_GET['return'];
if(empty($check_add)) add_action( 'vc_before_init_base','s7upf_add_trending',10,100 );
if ( ! function_exists( 's7upf_add_trending' ) ) {
	function s7upf_add_trending(){
		vc_map( array(
			"name"      => esc_html__("Portfolio Slider", 'druck'),
			"base"      => "s7upf_trending",
			"icon"      => "icon-st",
			"category"  => '7UP-Elements',
			"description"   => esc_html__( 'Display list of portfolio slider', 'druck' ),
			"params"    => array(
				array(
					"type"          => "dropdown",
					"holder"        => "div",
					"heading"       => esc_html__("Style",'druck'),
					"param_name"    => "style",
					"value"         => array(
						esc_html__("Default",'druck')  => '',
					),
				),
				array(
					"type"          => "textfield",
					"heading"       => esc_html__("Number Item Show",'druck'),
					"param_name"    => "num",
					'description'   => esc_html__( 'Enter number slider to show', 'druck' ),
				),
				array(
					"type"          => "textfield",
					"heading"       => esc_html__("Size Thumbnail",'druck'),
					"param_name"    => "size",
					'description'   => esc_html__( 'Enter image size for portfolio thumbnail (Example: 600x400).', 'druck' ),
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