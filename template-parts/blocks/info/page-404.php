<?php

/**
 * Page 404 Block Template.
 */
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
  echo '<img src="' . esc_url($block['data']['gutenberg_preview_image']) . '" style="max-width:100%; height:auto;">';
}

if (!$is_preview) :
  $kemroc_page_404_id = 'page_404-' . $block['id'];
  if (!empty($block['anchor'])) {
    $kemroc_page_404_id = $block['anchor'];
  }

  $kemroc_page_404_class_name = 'error-404 not-found';
  if (!empty($block['className'])) {
    $kemroc_page_404_class_name .= ' ' . $block['className'];
  }
  if (!empty($block['align'])) {
    $kemroc_page_404_class_name .= ' align' . $block['align'];
  }

  $bild = get_field('bild');
  $text = get_field('text');
  $schaltflachenname = get_field('schaltflachenname');
?>

  <section id="<?php echo esc_attr($kemroc_page_404_id); ?>" class="<?php echo esc_attr($kemroc_page_404_class_name); ?>">
    <div class="page-content page-404">
      <div class="container">
        <div class="page-404__img">
          <img src="<?php echo $bild ?>" alt="icon-404">
        </div>
        <h4 class="page-404__text"><?php _e($text, 'kemroc'); ?></h4>
        <div class="page-404__btn">
          <a href="<?php echo home_url(); ?>" class="page-404__homelink btn btn-accent btn-rounded arrow-right">
            <?php _e($schaltflachenname, 'kemroc'); ?>
          </a>
        </div>
      </div>
    </div>
  </section>
<?php
endif;
