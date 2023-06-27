<?php
/**
 * Current articles Block Template.
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
	$kemroc_ca_id = 'current-articles-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_ca_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_ca_class_name = 'current-articles bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_ca_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_ca_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_ca_articles_categories = get_categories();
	
	$kemroc_ca_posts_per_page = get_option( 'posts_per_page' );
	$kemroc_ca_page_number    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	global $post;
	$kemroc_ca_page_slug = $post->post_name;
	?>

	<script>
		var page_number = "<?php echo esc_html( $kemroc_ca_page_number ); ?>";
		var posts_per_page = "<?php echo esc_html( $kemroc_ca_posts_per_page ); ?>";
		var page_slug = "<?php echo esc_html( $kemroc_ca_page_slug ); ?>";
	</script>

	<section id="<?php echo esc_attr( $kemroc_ca_id ); ?>" class="<?php echo esc_attr( $kemroc_ca_class_name ); ?>">
        <div class="current-articles__content">

            <?php if ( $kemroc_ca_articles_categories ) : ?>
                <div class="scroll-list-wrapper current-articles__categories-wrapper">
                    <div class="container current-articles__categories-container">
                        <ul class="filter-btns current-articles__categories-list">
                            <li 
                                class="current-articles__categories-item"
                                data-term-id="all"
                            >
                                <button class="filter-btn filter-btn--active">
                                    <?php esc_html_e( 'Alle Artikel', 'kemroc' ); ?>
                                </button>
                            </li>
                            <!-- /.current-articles__categories-item -->
                            
                            <?php foreach ( $kemroc_ca_articles_categories as $kemroc_ca_articles_category ) : ?>
                                <li 
                                    class="current-articles__categories-item"
                                    data-term-id="<?php echo esc_attr( $kemroc_ca_articles_category->term_id ); ?>"
                                >
                                    <button class="filter-btn">
                                        <?php echo esc_html( $kemroc_ca_articles_category->name ); ?>
                                    </button>
                                </li>
                                <!-- /.current-articles__categories-item -->
                            <?php endforeach; ?>
                            
                        </ul>
                        <!-- /.filter-btns current-articles__categories-list -->        
                    </div>
                    <!-- /.container current-articles__categories-container -->        
                </div>
                <!-- /.current-articles__categories-wrapper -->        
            <?php endif; ?>

            <div class="container current-articles__list-container">
                <div class="current-articles__list">				
                    <div class="current-articles__list-skeleton">

                        <?php 
                        $kemroc_ca_i = 1;
                            
                        while ( $kemroc_ca_i++ <= $kemroc_ca_posts_per_page ) :  
                            ?>
                            <div class="current-articles__item">
                                <?php	                      
                                kemroc_the_template_part_content( 
                                    'template-parts/cards/article-skeleton', 
                                    'skeleton'
                                );
                                ?>
                            </div>
                            <!-- /.current-articles__item -->   
                            <?php
                        endwhile; 
                        wp_reset_postdata();
                        ?>

                    </div>
                    <!-- /.current-articles__list-skeleton -->
                    <div class="current-articles__list-original"></div>
                    <!-- /.current-articles__list-original -->
                </div>
                <!-- /.current-articles__list -->                

                <div class="current-articles__navigation"></div>
                <!-- /.current-articles__navigation -->
            </div>
            <!-- /.container current-articles__list-container -->
		</div>
		<!-- /.current-articles__content -->
	</section>
	<!-- /.current-articles -->

	<?php 
endif;
