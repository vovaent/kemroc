<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kemroc
 */

$kemroc_table_of_contents         = get_field( 'table_of_contents' );
$kemroc_article_navigation_option = get_field( 'article_navigation_option' );
$kemroc_header_tag                = get_field( 'header_tag' );

if ( 'multiple' === $kemroc_article_navigation_option ) {
	$kemroc_header_tag = '';
}

$kemroc_headers_insides = kemroc_get_headers_insides_in_content( get_the_content(), $kemroc_header_tag );
?>

<?php if ( ! empty( $kemroc_header_tag ) ) : ?>
<script>
	var headerTag = '<?php echo esc_html( $kemroc_header_tag ); ?>';
</script>   
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
	<header class="article__header">
		<div class="article__text">
			<div class="article__meta">
				<?php kemroc_posted_on(); ?>
				<div class="article__meta-mediator"></div>
				<!-- /.article__meta-mediator -->
				<div class="article__meta-text">
					<?php esc_html_e( 'Nachricht', 'kemroc' ); ?>
				</div>
				<!-- /.article__meta-text -->
			</div>
			<!-- .article__meta -->
			<h1 class="article__title">
				<?php the_title(); ?>
			</h1>
			<!-- .article__title -->
			<div class="article__to-read">
				<button class="btn btn-rounded btn-border-accent arrow-right article__to-read-btn"></button>
				<!-- /.article__link-to-read -->
				<div class="article__to-read-text">
					<?php esc_html_e( 'Lesen', 'kemroc' ); ?>
				</div>
				<!-- /.article__to-read-text -->
			</div>
			<!-- /.article__to-read -->			
		</div>
		<!-- /.article__text -->
		<div class="article__image">
			<?php kemroc_post_thumbnail( 'article__post-thumbnail' ); ?>
		</div>
		<!-- /.article__image -->
	</header>
	<!-- /.article__header -->
	<div class="container article__inner">
		<section class="article__content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kemroc' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			?>
		</section>
		<!-- .article__content -->
		<div class="article__aside article-aside">
			<nav class="article-aside__navigation" role="list">
				<h5 class="article-aside__title">
					
				</h5>
				<!-- /.article-aside__title -->

				<?php if ( $kemroc_headers_insides ) : ?>
					<ul class="article-aside__nav-list">

						<?php foreach ( $kemroc_headers_insides as $kemroc_header_inside_key => $kemroc_header_inside_value ) : ?>
							<li class="article-aside__nav-item">
								<span class="article-aside__nav-item-number">
									<?php
									$kemroc_nav_item_number = sprintf( '%02d', ++$kemroc_header_inside_key );
                                    echo $kemroc_nav_item_number; //phpcs:ignore 
									?>
								</span>
								<!-- /.article-aside__nav-item-number -->
                                <a href="#title-<?php echo $kemroc_header_inside_key; //phpcs:ignore ?>" class="article-aside__nav-item-link">
									<?php echo wp_kses_post( $kemroc_header_inside_value ); ?>
								</a>
								<!-- /.article-aside__nav-item-link -->
							</li>
							<!-- /.article-aside__nav-item -->
						<?php endforeach; ?>

					</ul>
					<!-- /.article-aside__nav-list -->
				<?php endif; ?>

			</nav>
			<!-- /.article__navigation -->
			<div class="article__share">
				<p class="article__share-text">
					
				</p>
				<!-- /.article__share-text -->
				<ul class="article__share-list">
					<li class="article__share-item">
						<a href="" class="article__share-social-link">
							<img src="" alt="" class="article__share-icon">
						</a>
						<!-- /.article__share-social-link -->
					</li>
					<!-- /.article__share-item -->
				</ul>
				<!-- /.article__share-list -->
			</div>
			<!-- /.article__share -->
		</div>
		<!-- /.article__aside -->
		
	</div>
	<!-- /.container article__inner -->
</article>
<!-- #post-<?php the_ID(); ?> -->
