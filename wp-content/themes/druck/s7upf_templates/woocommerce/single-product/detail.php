<?php
s7upf_set_post_view();
$info_style = get_post_meta(get_the_id(),'s7upf_detail_info_style',true);
$thumb_class = 'col-md-6 col-sm-12 col-xs-12';
$info_class = 'col-md-6 col-sm-12 col-xs-12';
if($info_style == 'large-gallery'){
	$thumb_class = 'col-md-7 col-sm-12 col-xs-12';
	$info_class = 'col-md-5 col-sm-12 col-xs-12';
}
$zoom_style = s7upf_get_value_by_id('product_image_zoom');
global $product;
$thumb_id = array(get_post_thumbnail_id());
$attachment_ids = $product->get_gallery_image_ids();
$attachment_ids = array_merge($thumb_id,$attachment_ids);
$gallerys = ''; $i = 1;
foreach ( $attachment_ids as $attachment_id ) {
    $image_link = wp_get_attachment_url( $attachment_id );
    if($i == 1) $gallerys .= $image_link;
    else $gallerys .= ','.$image_link;
    $i++;
}
$check_sidebar = s7upf_check_sidebar();
if($check_sidebar){
	$detail_class = '';
}else{
	$detail_class = 'detail-full-width';
}
if($info_style == "extra-attrs" && $product->is_type( 'variable' )){
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
}

?>
<div class="product-detail <?php echo esc_attr($detail_class);?> <?php echo esc_attr($info_style);?>">
    <div class="row">
        <div class="<?php echo esc_attr($thumb_class)?>">
			<?php 
				if($info_style == 'info-sticky'){
			?>
            <div class="detail-gallery detail-gallery-sticky">
				<?php
				global $product;
				$thumb_id = array(get_post_thumbnail_id());
				$attachment_ids = $product->get_gallery_image_ids();
				$attachment_ids = array_merge($thumb_id,$attachment_ids);
				$gallerys = ''; $i = 1;
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					if($i == 1) $gallerys .= $image_link;
					else $gallerys .= ','.$image_link;
					$i++;
				}
				if ( $attachment_ids && has_post_thumbnail() ) {
				?>
				<div class="list-gallery-sticky">
					<?php
					foreach ( $attachment_ids as $attachment_id ) {
						$attributes      = array(
							'data-src'      => wp_get_attachment_image_url( $attachment_id, 'shop_single' ),
							'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'shop_single' ),
							'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
							);
						$html = wp_get_attachment_image($attachment_id,'shop_single',false,$attributes );
						echo   '<div class="item-gallery-sticky">
									<a title="'.esc_attr( get_the_title( $attachment_id ) ).'" class="fancybox fancybox-buttons" href="'.wp_get_attachment_image_url($attachment_id,'full').'"  data-fancybox-group="gallery">
										'.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
									</a>
								</div>';
					}
					?>
				</div>	
				<div class="wrap-button-lightbox">
					<?php
					$video = get_post_meta(get_the_ID(),'s7upf_product_video',true);
					if(!empty($video)):
					?>
					<a href="<?php echo esc_url($video);?>" class="bg-color fancybox fancybox-media"><i class="fa fa-video-camera"></i></a>
					<?php endif;?>
					<a href="javascript:void(0)" class="image-lightbox link-video bg-color" data-gallery="<?php echo esc_attr($gallerys)?>"><i class="fa fa-arrows-alt"></i></a>
				</div>
				<?php
					do_action( 'woocommerce_product_thumbnails' );
				}
				?>
            </div>
			<?php 
				}else if($info_style == 'grid-gallery'){
			?>
            <div class="detail-gallery detail-gallery-sticky detail-gallery-grid">
				<?php
				global $product;
				$thumb_id = array(get_post_thumbnail_id());
				$attachment_ids = $product->get_gallery_image_ids();
				$attachment_ids = array_merge($thumb_id,$attachment_ids);
				$gallerys = ''; $i = 1;
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					if($i == 1) $gallerys .= $image_link;
					else $gallerys .= ','.$image_link;
					$i++;
				}
				if ( $attachment_ids && has_post_thumbnail() ) {
				?>
				<div class="list-gallery-sticky">
					<div class="row">
						<?php
						foreach ( $attachment_ids as $key => $attachment_id ) {
							$wrap_button_html = '';		
							if($key == 0 ){
								$col_gallery = 'col-md-12 col-sm-12 col-xs-12';
								$wrap_button_html .= '<div class="wrap-button-lightbox">';
														$video = get_post_meta(get_the_ID(),'s7upf_product_video',true);
														if(!empty($video)){
								$wrap_button_html .= '<a href="'.esc_url($video).'" class="bg-color fancybox fancybox-media"><i class="fa fa-video-camera"></i></a>';
														}
								$wrap_button_html .= '<a href="javascript:void(0)" class="image-lightbox link-video bg-color" data-gallery="'.esc_attr($gallerys).'"><i class="fa fa-arrows-alt"></i></a>
													</div>';
							}else{
								$col_gallery = 'col-md-6 col-sm-6 col-xs-12';			
							}
							$attributes      = array(
								'data-src'      => wp_get_attachment_image_url( $attachment_id, 'shop_single' ),
								'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'shop_single' ),
								'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
								);
							$html = wp_get_attachment_image($attachment_id,'shop_single',false,$attributes );
							echo   '<div class="'.esc_attr($col_gallery).'">
										<div class="item-gallery-sticky">
											<a title="'.esc_attr( get_the_title( $attachment_id ) ).'" class="fancybox fancybox-buttons" href="'.wp_get_attachment_image_url($attachment_id,'full').'"  data-fancybox-group="gallery">
												'.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
											</a>
											'.apply_filters('s7upf_output_content',$wrap_button_html).'
										</div>
									</div>';
						}
						?>
					</div>	
				</div>	
				<?php
					do_action( 'woocommerce_product_thumbnails' );
				}
				?>
            </div>
			<?php }else{ ?>
            <div class="detail-gallery">
                <div class="wrap-detail-gallery images <?php echo esc_attr($zoom_style)?>">
                    <div class="mid woocommerce-product-gallery__image">
                        <?php 
                        $html = get_the_post_thumbnail(get_the_ID(),'shop_single',array('class'=> 'wp-post-image'));
                        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( get_the_ID() ) );
                        ?>
						<div class="wrap-button-lightbox">
							<?php
							$video = get_post_meta(get_the_ID(),'s7upf_product_video',true);
							if(!empty($video)):
							?>
							<a href="<?php echo esc_url($video);?>" class="bg-color fancybox fancybox-media"><i class="fa fa-video-camera"></i></a>
							<?php endif;?>
							<a href="#" class="image-lightbox link-video bg-color" data-gallery="<?php echo esc_attr($gallerys)?>"><i class="fa fa-arrows-alt"></i></a>
						</div>
                    </div>
                    <?php                    
                    if ( $attachment_ids && has_post_thumbnail() && count($attachment_ids) > 1) {
                    ?>
                    <div class="gallery-control">
                        <a href="#" class="prev"><i class="la la-angle-left"></i></a>
                        <div class="carousel" data-visible="4" data-vertical="false">
                            <ul class="list-none">
                                <?php
                                $i = 1;
                                foreach ( $attachment_ids as $attachment_id ) {
                                    if($i == 1) $active = 'active';
                                    else $active = '';
                                    $attributes      = array(
                                        'data-src'      => wp_get_attachment_image_url( $attachment_id, 'shop_single' ),
                                        'data-srcset'   => wp_get_attachment_image_srcset( $attachment_id, 'shop_single' ),
                                        'data-srcfull'  => wp_get_attachment_image_url( $attachment_id, 'full' ),
                                        );
                                    $html = wp_get_attachment_image($attachment_id,'woocommerce_thumbnail',false,$attributes );
                                    echo   '<li data-number="'.esc_attr($i).'">
                                                <a class="'.esc_attr($active).'" href="#">
                                                    '.apply_filters( 'woocommerce_single_product_image_thumbnail_html',$html,$attachment_id).'
                                                </a>
                                            </li>';
                                    $i++;
                                }
                                ?>
                            </ul>
                        </div>
                        <a href="#" class="next"><i class="la la-angle-right"></i></a>
                    </div>
                    <?php
                        do_action( 'woocommerce_product_thumbnails' );
                    }
                    ?>
                </div>
            </div>
			<?php }?>
        </div>
        <div class="<?php echo esc_attr($info_class)?> <?php if($info_style == 'info-sticky') echo esc_attr($info_style);?>">
            <div class="summary entry-summary detail-info">
                <h1 class="product-title title30 lora-font text-uppercase"><?php the_title()?></h1>
                <?php
                    do_action( 'woocommerce_single_product_summary' );
                ?>
                <?php s7upf_get_template( 'share','',false,true );?>
            </div>
        </div>
    <?php
    if($info_style == "extra-attrs" && $product->is_type( 'variable' )){
        ?>
        <div class="col-md-12 <?php echo esc_html($info_style) ?>-wrap ">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
        <?php
    }
    ?>
    </div>
	<?php
		$sticky_addcart = get_post_meta(get_the_id(),'s7upf_product_sticky_addcart',true);
		if($sticky_addcart == 'on'):
	?>
	<div class="sticky-addcart transition">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="item-product-sticky-addcart flex-wrapper align_items-center">
						<div class="product-thumb">
							<?php echo get_the_post_thumbnail( get_the_ID(),array(60,60));?>
						</div>
						<div class="product-info">
							<h3 class="title14"><?php echo esc_html(get_the_title());?></h3>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="wrap-sticky-cart-price flex-wrapper align_items-center justify_content-flex-end">
						<?php s7upf_get_price_html()?>
						<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
							<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

							<?php
							do_action( 'woocommerce_before_add_to_cart_quantity' );

							woocommerce_quantity_input( array(
								'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
								'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
								'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
							) );

							do_action( 'woocommerce_after_add_to_cart_quantity' );
							?>

							<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

							<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
						</form>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div>