<?php
/**
 * Template part for displaying sticky label.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>

<?php if ( is_sticky() && $sticky_label = atik_get_thememod_value( 'sticky-label' ) ) : ?>
	<div class="sticky-post-label-wrapper">
		<span class="sticky-post">
			<?php echo esc_html( wp_strip_all_tags( $sticky_label ) ); ?>
		</span>
	</div>
<?php endif;
