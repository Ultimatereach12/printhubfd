<?php
if(empty($item)) $item = '4';
if(empty($item) && empty($item_res)) $item_res = '0:1,480:2,767:3,990:4';
$attr = array(
    'size'      => $size,
    'excerpt'      => $excerpt,
    'animation' => $animation,
    'item_style'      => $item_style,
    'style'           => 'grid',
    'item_style_list'       => '',
    'pagination'        => '',
    );
?>
<div class="block-element <?php echo esc_attr($el_class);?> js-content-wrap">
    <div class="list-product-wrap">
        <div class="wrap-item smart-slider js-content-main clearfix <?php echo esc_attr($slider_navi)?> <?php echo esc_attr($slider_pagi)?>" 
            data-item="<?php echo esc_attr($item)?>" data-speed="<?php echo esc_attr($speed);?>" 
            data-itemres="<?php echo esc_attr($item_res)?>" 
            data-prev="" data-next="" 
            data-pagination="<?php echo esc_attr($slider_pagi)?>" data-navigation="<?php echo esc_attr($slider_navi)?>">
            <?php 
                if($portfolio_query->have_posts()) {
                    while($portfolio_query->have_posts()) {
                        $portfolio_query->the_post();
                        $attr['count'] = $count;
                        if($count % (int)$row_number == 1 || (int)$row_number == 1) echo '<div class="item">';
                        s7upf_get_template_portfolio('grid/grid',$item_style,$attr,true);
                        if($count % (int)$row_number == 0 || (int)$row_number == 1 || $count == $count_query) echo '</div>';
                        $count++;
                    }
                }
            ?>
        </div>
    </div>
</div>