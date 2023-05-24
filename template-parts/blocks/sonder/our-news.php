<?php
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
}

/**
 *  Block Template.
 */
if (!$is_preview) {
    $id = 'our-news-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    $className = 'our-news';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    
    $title = get_field('title');
    $info = get_field('info');
    $link = get_field('link');
    $ppp = get_field('ppp');


?>
<section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="section-header">
            <div class="section-header__title">
                <? if($title): ?>
                <h2 class="title"><?= $title; ?></h2>
                <? endif; ?>
                <? if($link): ?>
                <div class="readmore desktop">
                    <a href="<?= $link['url']; ?>" class="btn btn-arrow-rounded"><?= $link['title']; ?> <span><svg width="6" height="10"
                                viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000"></path>
                            </svg>
                        </span></a>
                </div>
                <? endif; ?>
            </div>
            <? if($info): ?>
                <div class="section-header__info subheadline"><?= $info; ?></div>
            <? endif; ?>
                <? if($link): ?>
                <div class="readmore mobile">
                    <a href="<?= $link['url']; ?>" class="btn btn-arrow-rounded"><?= $link['title']; ?> <span><svg width="6" height="10"
                                viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
                                    fill="#FF6000"></path>
                            </svg>
                        </span></a>
                </div>
                <? endif; ?>
        </div>
        <? if($ppp): ?>
        <div class="our-news__inner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <? $args = [
                        'post_type' => 'post',
                        'posts_per_page' => $ppp,
                        'post_status' => 'publish'
                    ];
                    $news = new WP_Query($args);
                    if( $news->have_posts() ) : 
                        while( $news->have_posts() ): $news->the_post(); ?>
                    <div class="swiper-slide article-item">
                        <a href="<? the_permalink(); ?>" class="article-image">
                            <? the_post_thumbnail( 'home-news' ); ?>
                        </a>
                        <div class="article-date"><?= get_the_date('d. F Y'); ?></div>
                        <a class="article-title" href="<? the_permalink(); ?>">
                            <h6><? the_title(); ?></h6>
                        </a>
                        <a class="more-link"><?= __('Mehr', 'kemroc'); ?></a>
                    </div>
                    <? endwhile; ?>
                    <? endif; ?>
                    <? wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <? endif; ?>
    </div>
</section>

<? 
}