<?php
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
    echo '<img src="' . $block['data']['gutenberg_preview_image'] . '" style="max-width:100%; height:auto;">';
}

/**
 *  Block Template.
 */
if (!$is_preview) {
    $id = 'cta-bg-' . $block['id'];
    if (!empty($block['anchor'])) {
        $id = $block['anchor'];
    }

    $className = 'cta-bg';
    if (!empty($block['className'])) {
        $className .= ' ' . $block['className'];
    }
    if (!empty($block['align'])) {
        $className .= ' align' . $block['align'];
    }

    
    $title = get_field('title');
    $link = get_field('link');
    $info = get_field('info');
    $image = get_field('image');


?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="cta-bg__inner">
            <div class="cta-content">
                <? if($title): ?>
                <h2 class="cta-title"><?= $title; ?></h2>
                <? endif; ?>
                <? if($info): ?>
                <div class="subheadline"><?= $info; ?></div>
                <? endif; ?>
                <? if($link) :?>
                <div class="cta-more">
                    <a href="<?= $link['url']; ?>" class="btn btn-accent btn-border-accent btn-rounded arrow-right"><?= $link['title']; ?></a>
                </div>
                <? endif; ?>
            </div>
            <? if($image): ?>
            <img class="cta-bg" src="<?= $image['url']; ?>" alt="">
            <? endif; ?>

        </div>
    </div>
</section>

<?php } ?>