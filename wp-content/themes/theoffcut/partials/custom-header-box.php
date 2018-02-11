<?php
/**
 * Custom header box
 *
 * @package Atik
 */

$hi_title        = atik_get_thememod_value( 'header-image-title' );
$hi_desc         = atik_get_thememod_value( 'header-image-description' );
$hi_button_label = atik_get_thememod_value( 'header-image-button-label' );
$hi_button_url   = atik_get_thememod_value( 'header-image-button-url' );
$hi_box_position = atik_get_thememod_value( 'header-image-position' );

$show_content = ( '' === $hi_title && '' === $hi_desc && '' === $hi_button_url && '' === $hi_button_label ) ? false : true;

?>

<?php if ( $show_content || is_customize_preview() ) : ?>
	<div class="custom-header-box-wrapper">
		<div class="container">
			<?php if ( $show_content ) : ?>
				<div class="custom-header-box align-<?php echo esc_attr( $hi_box_position ); ?>">
					<?php if ( '' !== $hi_title || is_customize_preview() ) : ?>
						<h1 class="header-image-title"><?php echo atik_sanitize_text( $hi_title ); ?></h1>
					<?php endif; ?>
					<?php if ( '' !== $hi_desc || is_customize_preview() ) : ?>
						<div class="header-image-description">
							<?php echo wp_kses_post( do_shortcode( wpautop( $hi_desc ) ) ); ?>
						</div>
					<?php endif; ?>
					<?php if ( '' !== $hi_button_label && '' !== $hi_button_url ) : ?>
						<a href="<?php echo esc_url( $hi_button_url ); ?>" class="button alt accent-background"><?php echo esc_attr( $hi_button_label ); ?></a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
