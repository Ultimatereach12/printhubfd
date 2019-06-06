<?php if ($links) :
    // Custom icon/text
    $links['prev_text'] = '<i class="fa fa-angle-left"></i>';
    $links['next_text'] = '<i class="fa fa-angle-right"></i>';
    ?>
    <div class="pagi-nav <?php echo esc_attr($style)?>">
        <?php echo apply_filters('s7upf_output_content',paginate_links($links)); ?>
    </div>
<?php endif;?>