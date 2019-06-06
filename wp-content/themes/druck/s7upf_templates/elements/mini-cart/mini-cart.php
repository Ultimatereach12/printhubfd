<?php
$content_class = 'dropdown-list text-left';
?>
<div class="mini-cart-box <?php echo esc_attr($el_class)?>">
    <?php 
    switch ($style) {
        case 'value':
            # code...
            break;
        
        default:
            ?>
            <a class="mini-cart-link" href="<?php echo wc_get_cart_url()?>">
                <span class="mini-cart-icon title24"><i class="<?php echo esc_attr($icon)?>"></i></span>
				<span class="mini-cart-number set-cart-number">0</span>
            </a>
            <?php
            break;
    }
    ?>    
    <div class="mini-cart-content <?php echo esc_attr($content_class)?>">
        <h2 class="title18 font-bold"><span class="set-cart-number">0</span> <?php echo esc_html_e("items","druck")?></h2>
        <div class="mini-cart-main-content"><?php echo s7upf_get_template_woocommerce('cart/mini-cart')?></div>
        <div class="total-default hidden"><?php echo wc_price(0)?></div>
        <span class="close-minicart"><i class="la la-times"></i></span>
    </div>
</div>