<?php

/**
 * Farbiger text Block Template.
 */
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
  echo '<img src="' . esc_url($block['data']['gutenberg_preview_image']) . '" style="max-width:100%; height:auto;">';
}

if (!$is_preview) :
  $kemroc_farbiger_text_id = 'farbiger-text-' . $block['id'];
  if (!empty($block['anchor'])) {
    $kemroc_farbiger_text_id = $block['anchor'];
  }

  $kemroc_farbiger_text_class_name = 'farbiger_text';
  if (!empty($block['className'])) {
    $kemroc_farbiger_text_class_name .= ' ' . $block['className'];
  }
  if (!empty($block['align'])) {
    $kemroc_farbiger_text_class_name .= ' align' . $block['align'];
  }

  $titel_schwarz = get_field('titel_schwarz');
  $farbtitel = get_field('farbtitel');
  $text = get_field('text');
?>

  <section id="<?php echo esc_attr($kemroc_farbiger_text_id); ?>" class="<?php echo esc_attr($kemroc_farbiger_text_class_name); ?>">
    <div class="container">
      <div class="col_1">
      <div class="col_1_wrap">
        <?php if ($titel_schwarz) : ?>
          <span class="black"><?php echo $titel_schwarz; ?></span>
        <?php endif; ?>

        <?php if ($farbtitel) : ?>
          <span class="color"><?php echo $farbtitel; ?></span>
        <?php endif; ?>
      </div>
      </div>
      <div class="col_2">
      <p><?php echo $text; ?></p>
    </div>
    </div>
  </section>
<?php
endif;
