<div class="block-element instagram-box <?php echo esc_attr($el_class);?>">
<?php
    if(!empty($title)) echo '<h3 class="title18 font-bold text-uppercase">'.esc_html($title).'</h3>';
    if(!empty($des)) echo '<p class="desc-block">'.esc_html($des).'</p>';
?>
    <div class="grid-instagram follow-instagram">
    <?php
        if(!empty($data)){
            foreach ($data as $value) {
                echo '<div class="item-instagram banner-advs zoom-image overlay-image">
						<a class="adv-thumb-link" target="_blank" href="'. esc_url( $value['link'] ) .'">
							<img src="'. esc_url($value['image_url']) .'" alt="'.esc_attr__("instagram-image","druck").'">
							<div class="instagram-info transition absolute flex-wrapper align_items-center justify_content-center">
								<ul class="list-inline-block">
									<li class="like-count"><i class="title24 white fa fa-heart-o"></i><sub class="white">'.esc_html($value['like']).'</sub></li>
									<li class="comment-count"><i class="title24 white fa fa-comment-o"></i><sub class="white">'.esc_html($value['comment']).'</sub></li>
								</ul>
							</div>
						</a>
					</div>';
            }              
        }
    ?>
    </div>
</div>