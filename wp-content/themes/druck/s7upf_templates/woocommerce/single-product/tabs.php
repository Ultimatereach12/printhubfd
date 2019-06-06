<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_style = s7upf_get_value_by_id('product_tab_detail');
if ( ! empty( $tabs ) ) : ?>

	<div class="detail-tabs detail-tab-<?php echo esc_attr($tab_style)?>">
		<?php if($tab_style == 'accordion'):?>
		<div class="toggle-tab">
			<?php 
				$i = 1;
				foreach ( $tabs as $key => $tab ) :
				if($i == 1) $active = 'active';
				else $active = '';
				$i++;
			?>
			<div class="item-toggle-tab <?php echo esc_attr($active)?>">
				<h3 class="toggle-tab-title title18 lora-font font-bold text-uppercase"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></h3>
				<div class="toggle-tab-content custom-scroll">
					<div class="detail-tab-desc">
						<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else:?>
		<div class="detail-tab-title title-tab-style2">
			<ul class="title-tab text-center text-uppercase list-inline-block">
				<?php 
				$i = 1;
				foreach ( $tabs as $key => $tab ) :
					if($i == 1) $active = 'active';
					else $active = '';
					$i++;
				?>
					<li class="<?php echo esc_attr( $key ); ?>_tab <?php echo esc_attr($active)?>" id="tab-title-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" data-target="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab">
							<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="detail-tab-content">
			<div class="tab-content">
				<?php 
				$i = 1;
				foreach ( $tabs as $key => $tab ) : 
					if($i == 1) $active = 'active';
					else $active = '';
					$i++;
				?>
					<div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane <?php echo esc_attr($active)?>">
						<div class="detail-tab-desc">
							<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif;?>
	</div>

<?php endif; ?>
