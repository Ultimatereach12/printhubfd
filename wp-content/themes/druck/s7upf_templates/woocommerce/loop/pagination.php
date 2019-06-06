<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!isset($wp_query)) global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
if(!isset($paged)) $paged = get_query_var( 'paged' );
?>
<nav class="pagi-nav text-left woocommerce-pagination">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, $paged ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => '<i class="fa fa-angle-left"></i>',
			'next_text'    => '<i class="fa fa-angle-right"></i>',
			'end_size'     => 2,
            'mid_size'     => 1
		) ) );
	?>
</nav>
