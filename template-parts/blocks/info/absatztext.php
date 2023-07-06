<?php

/**
 * Absatztext Block Template.
 */
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
  echo '<img src="' . esc_url($block['data']['gutenberg_preview_image']) . '" style="max-width:100%; height:auto;">';
}

if (!$is_preview) :
  $kemroc_absatztext_id = 'absatztext-' . $block['id'];
  if (!empty($block['anchor'])) {
    $kemroc_faq_id = $block['anchor'];
  }

  $kemroc_absatztext_class_name = 'absatztext';
  if (!empty($block['className'])) {
    $kemroc_absatztext_class_name .= ' ' . $block['className'];
  }
  if (!empty($block['align'])) {
    $kemroc_absatztext_class_name .= ' align' . $block['align'];
  }

  $title = get_field('title');
  $rows = get_field('absatztext_item');
?>

  <section id="<?php echo esc_attr($kemroc_absatztext_id); ?>" class="<?php echo esc_attr($kemroc_absatztext_class_name); ?>">
    <div class="container">
      <h2><?php echo $title; ?></h2>
      <div class="grayplate-text">
        <?php if ($rows) {
        ?>
          <div class="grayplate-text__wrap">
            <?php foreach ($rows as $row) { ?>
              <?php if ($row['untertitel_1']) : ?>
                <h3><?php echo $row['untertitel_1']; ?></h3>
              <?php endif; ?>
              <?php if ($row['untertitel_2']) : ?>
                <h5><?php echo $row['untertitel_2']; ?></h5>
              <?php endif; ?>
              <?php if ($row['text']) : ?>
                <p><?php echo $row['text']; ?></p>
              <?php endif; ?>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
<?php
endif;
