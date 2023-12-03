<?php
/**
 * All News Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * 
 * @package kemroc
 */

if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	// Create id attribute allowing for custom "anchor" value.
	$kemroc_ca_id = 'all-news-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ca_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ca_class_name = 'all-news bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ca_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ca_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ca_news_categories = get_categories();
	
	$kemroc_ca_posts_per_page = get_option( 'posts_per_page' );
	$kemroc_ca_page_number    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	global $post;
	$kemroc_ca_page_slug = $post->post_name;
	?>

	<section id="<?php echo esc_attr( $kemroc_ca_id ); ?>" class="<?php echo esc_attr( $kemroc_ca_class_name ); ?>">
		<div class="all-news__content">

			<?php if ( $kemroc_ca_news_categories ) : ?>
				<div class="scroll-list-wrapper all-news__categories-wrapper">
					<div class="container all-news__categories-container">
						<ul class="filter-btns all-news__categories-list">
							<li 
								class="all-news__categories-item"
								data-term-id="all"
							>
								<button class="filter-btn filter-btn--active">
									<?php esc_html_e( 'Alle Artikel', 'kemroc' ); ?>
								</button>
							</li>
							<!-- /.all-news__categories-item -->

							<?php foreach ( $kemroc_ca_news_categories as $kemroc_ca_news_category ) : ?>
								<li 
									class="all-news__categories-item"
									data-term-id="<?php echo esc_attr( $kemroc_ca_news_category->term_id ); ?>"
								>
									<button class="filter-btn">
										<?php echo esc_html( $kemroc_ca_news_category->name ); ?>
									</button>
								</li>
								<!-- /.all-news__categories-item -->
							<?php endforeach; ?>

						</ul>
						<!-- /.filter-btns all-news__categories-list -->        
					</div>
					<!-- /.container all-news__categories-container -->        
				</div>
				<!-- /.all-news__categories-wrapper -->        
			<?php endif; ?>

			<div class="container all-news__list-container">
				<div class="all-news__list">				
					<div class="all-news__list-skeletons">
						<div class="all-news__skeleton-item all-news__skeleton-item--pc">

							<?php 
							$kemroc_ca_i = 1;
								
							while ( $kemroc_ca_i++ <= $kemroc_ca_posts_per_page ) :  
								?>
								<div class="all-news__item">
									<?php	                      
									get_template_part( 
										'template-parts/cards/news/new', 
										'skeleton'
									);
									?>
								</div>
								<!-- /.all-news__item -->   
								<?php
							endwhile; 
							wp_reset_postdata();
							?>

						</div>
						<!-- /.all-news__skeleton-item all-news__skeleton-item--pc -->
						<div class="all-news__skeleton-item all-news__skeleton-item--tab">

							<?php 
							$kemroc_ca_i = 1;
								
							while ( $kemroc_ca_i++ <= 6 ) :  
								?>
								<div class="all-news__item">
									<?php	                      
									get_template_part( 
										'template-parts/cards/news/new', 
										'skeleton'
									);
									?>
								</div>
								<!-- /.all-news__item -->   
								<?php
							endwhile; 
							wp_reset_postdata();
							?>

						</div>
						<!-- /.all-news__skeleton-item all-news__skeleton-item--tab -->
						<div class="all-news__skeleton-item all-news__skeleton-item--mob">

							<?php 
							$kemroc_ca_i = 1;
								
							while ( $kemroc_ca_i++ <= 4 ) :  
								?>
								<div class="all-news__item">
									<?php	                      
									get_template_part( 
										'template-parts/cards/news/new', 
										'skeleton'
									);
									?>
								</div>
								<!-- /.all-news__item -->   
								<?php
							endwhile; 
							wp_reset_postdata();
							?>

						</div>
						<!-- /.all-news__list-skeletons--mob -->
					   
					</div>
					<!-- /.all-news__list-skeletons -->
					<div class="all-news__list-original"></div>
					<!-- /.all-news__list-original -->
				</div>
				<!-- /.all-news__list -->                

				<div class="all-news__navigation"></div>
				<!-- /.all-news__navigation -->
			</div>
			<!-- /.container all-news__list-container -->
		</div>
		<!-- /.all-news__content -->

		<script>
			var pageNumberGlobal = "<?php echo esc_html( $kemroc_ca_page_number ); ?>";
			var postsPerPageGlobal = "<?php echo esc_html( $kemroc_ca_posts_per_page ); ?>";
			var pageSlugGlobal = "<?php echo esc_html( $kemroc_ca_page_slug ); ?>";
		</script>

	</section>
	<!-- /.all-news -->

	<?php 
endif;
