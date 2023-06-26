<?php /* Template Name: Page Termine */

get_header();
?>

<main id="primary" class="site-main">

    <?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
		?>

    <section class="events">
        <div class="container">
            <div class="events-list">
                <!-- Item 1 -->
                <a href="#" class="events-list__item">
                    <div class="item-date">
                        <img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
                            alt="icon-calendar">
                        <span>27. – 29.04.23</span>
                    </div>
                    <h6 class="item-title">27. – 29.04.23 TiefbauLIVE & RecyclingAKTIV – Karlsruhe (DE)</h6>
                </a>
                <!-- Item 2 -->
                <a href="#" class="events-list__item">
                    <div class="item-date">
                        <img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
                            alt="icon-calendar">
                        <span>03. – 07.05.23</span>
                    </div>
                    <h6 class="item-title">SaMoTer – Verona (IT)</h6>
                </a>
                <!-- Item 3 -->
                <a href="#" class="events-list__item">
                    <div class="item-date">
                        <img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
                            alt="icon-calendar">
                        <span>10. – 11.10.23</span>
                    </div>
                    <h6 class="item-title">Construction Equipment Forum – Berlin (DE)</h6>
                </a>
                <!-- Item 4 -->
                <a href="#" class="events-list__item">
                    <div class="item-date">
                        <img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
                            alt="icon-calendar">
                        <span>08. – 09.11.23</span>
                    </div>
                    <h6 class="item-title">STUVA Expo – München (DE)</h6>
                </a>
                <!-- Item 5 -->
                <a href="#" class="events-list__item">
                    <div class="item-date">
                        <img src="<?php echo get_template_directory_uri() . '/images/icon-calendar.svg'; ?>"
                            alt="icon-calendar">
                        <span>10. – 11.10.23</span>
                    </div>
                    <h6 class="item-title">Construction Equipment Forum – Berlin (DE)</h6>
                </a>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php

get_footer();