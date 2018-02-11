<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Atik
 */

global $query_string;

$total_results = 0;
$query_args = explode( '&', $query_string );
$search_query = array();

if ( strlen( $query_string ) > 0 ) {
	foreach ( $query_args as $key => $string ) {
		$query_split = explode( '=', $string );
		$search_query[ $query_split[0] ] = urldecode( $query_split[1] );
	}
}

$search = new WP_Query( $search_query );

get_header(); ?>

	<header class="page-header">
		<div class="container">
			<div class="inner">
				<div class="grid">
					<div class="grid__col grid__col--8-of-12 grid__col--am">
						<h1 class="page-title">
							<?php printf( esc_html__( 'Search Results for: %s', 'atik' ), '<span>' . get_search_query() . '</span>' ); ?>
						</h1>
					</div>
					<div class="grid__col grid__col--4-of-12 grid__col--am">
						<aside class="widget widget_search"><?php get_search_form( true ); ?></aside>
					</div>
				</div>
			</div>
		</div>
	</header><!-- .page-header -->

	<div class="container">
		<div class="grid">
			<div class="grid__col grid__col--2-of-3 grid__col--centered">
			<?php
			if ( atik_is_woocommerce_activated() ) {
				// Output woocommerce products.
				$search_query['post_type'] = 'product';
				$the_query = new WP_Query( $search_query );
				$total_results = $the_query->found_posts;
				global $product;

				if ( $the_query->have_posts() ) {
					?>
						<div class="search-results products">
							<h3 class="search-results-title">
								<?php esc_html_e( 'Products', 'atik' );  ?>
								<span><?php echo absint( $total_results ); ?></span>
							</h3>
							<ul class="search-result-list">
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<li>
									<div class="product-thumb">
										<a class="link-thumb" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_image(); // WPCS: XSS ok. ?>
										</a>
									</div>
									<div class="product-desc">
										<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
										<div class="cat-links"><?php echo $product->get_categories( ', ' ); // WPCS: XSS ok. ?></div>
										<a class="product-title" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>"><?php echo $product->get_title(); // WPCS: XSS ok. ?></a>
										<div class="price"><?php echo $product->get_price_html(); // WPCS: XSS ok. ?></div>
									</div>
								</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php
					/* Restore original Post Data */
					wp_reset_postdata();
				}
			} // End if().

			// Output posts.
			$search_query['post_type'] = 'post';
			$the_query = new WP_Query( $search_query );
			$total_results = $the_query->found_posts;

			if ( $the_query->have_posts() ) {
			?>
				<div class="search-results posts">
					<h3 class="search-results-title">
						<?php esc_html_e( 'Posts', 'atik' );  ?>
						<span><?php echo absint( $total_results ); ?></span>
					</h3>
					<ul class="search-result-list">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li>
							<div class="post-thumb">
								<a class="link-thumb" href="<?php esc_url( the_permalink() ); ?>" title="<?php echo esc_attr( the_title() ); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?>
								</a>
							</div>
							<div class="post-header">
								<a class="post-title" href="<?php esc_url( the_permalink() ); ?>" title="<?php echo esc_attr( the_title() ); ?>"><?php echo esc_attr( the_title() ); ?></a>
								<div class="post-meta">
									<div class="entry-meta">
										<?php atik_posted_on(); ?>
										<?php atik_entry_footer(); ?>
									</div><!-- .entry-meta -->
								</div>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php
			/* Restore original Post Data */
			wp_reset_postdata();
			}
			?>
			<?php
			// Output pages.
			$search_query['post_type'] = 'page';
			$the_query = new WP_Query( $search_query );
			$total_results = $the_query->found_posts;

			if ( $the_query->have_posts() ) {
			?>
				<div class="search-results pages">
					<h3 class="search-results-title">
						<?php esc_html_e( 'Pages', 'atik' );  ?>
						<span><?php echo absint( $total_results ); ?></span>
					</h3>
					<ul class="search-result-list">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li>
							<a class="post-title" href="<?php esc_url( the_permalink() ); ?>" title="<?php echo esc_attr( the_title() ); ?>"><?php echo esc_attr( the_title() ); ?></a>
						</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php
			/* Restore original Post Data */
			wp_reset_postdata();
			}
			?>
			<!-- if no search result -->
			<?php  if ( ! $search->have_posts() ) : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'atik' ); ?></p>
			<?php endif; ?>
			</div>
		</div>
	</div>

<?php
get_footer();
