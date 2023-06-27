<?php /* Template Name: Page Jobs */

get_header();
?>

<main id="primary" class="site-main">

    <?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
		?>

    <section class="jobs">
        <div class="container">
            <div class="jobs-list">
                <!-- Item 1 -->
                <a href="#" class="jobs-list__item">
                    <div class="item-subtitle">Bereichern Sie unser Team als</div>
                    <h5 class="item-title">Marktsegment Manager Spezialtiefbau/ Bodenstabilisierung (m/w/d)</h5>
                    <div class="item-bottom">
                        <div class="job-category">ab sofort</div>
                        <div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000" />
                            </svg>
                        </div>
                    </div>
                </a>
                <!-- Item 2 -->
                <a href="#" class="jobs-list__item">
                    <div class="item-subtitle">Bereichern Sie unser Team als</div>
                    <h5 class="item-title">Monteur (m/w/d)</h5>
                    <div class="item-bottom">
                        <div class="job-category">ab sofort</div>
                        <div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000" />
                            </svg>
                        </div>
                    </div>
                </a>
                <!-- Item 3 -->
                <a href="#" class="jobs-list__item">
                    <div class="item-subtitle">Bereichern Sie unser Team als</div>
                    <h5 class="item-title">Schweißer (m/w/d)</h5>
                    <div class="item-bottom">
                        <div class="job-category">ab sofort</div>
                        <div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000" />
                            </svg>
                        </div>
                    </div>
                </a>
                <!-- Item 4 -->
                <a href="#" class="jobs-list__item">
                    <div class="item-subtitle">Bereichern Sie unser Team als</div>
                    <h5 class="item-title">Produkt Manager Diamantschneidtechnik(m/w)</h5>
                    <div class="item-bottom">
                        <div class="job-category">ab sofort</div>
                        <div class="job-link"><svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php

get_footer();