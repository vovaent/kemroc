<?php

/**
 * Columns text Block Template.
 */
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
  echo '<img src="' . esc_url($block['data']['gutenberg_preview_image']) . '" style="max-width:100%; height:auto;">';
}

if (!$is_preview) :
  $kemroc_columns_text_id = 'columns_text-' . $block['id'];
  if (!empty($block['anchor'])) {
    $kemroc_columns_text_id = $block['anchor'];
  }

  $kemroc_columns_text_class_name = 'columns_text_block';
  if (!empty($block['className'])) {
    $kemroc_columns_text_class_name .= ' ' . $block['className'];
  }
  if (!empty($block['align'])) {
    $kemroc_columns_text_class_name .= ' align' . $block['align'];
  }

  $rows = get_field('columns_text_item');
  $postscript_title = get_field('postscript_title');
  $postscript_text = get_field('postscript_text');
?>

  <section id="<?php echo esc_attr($kemroc_columns_text_id); ?>" class="<?php echo esc_attr($kemroc_columns_text_class_name); ?>">
    <div class="container">
      <?php if ($rows) {  ?>
        <?php foreach ($rows as $row) { ?>
          <section class="columns-text">
            <?php if ($row['titel']) : ?>
              <h3><?php echo $row['titel']; ?></h3>
            <?php endif; ?>
            <div class="columns-text__wrap">
              <?php if ($row['text_der_ersten_spalte']) : ?>
                <p><?php echo $row['text_der_ersten_spalte']; ?></p>
              <?php endif; ?>
              <?php if ($row['text_der_zweiten_spalte']) : ?>
                <p><?php echo $row['text_der_zweiten_spalte']; ?></p>
              <?php endif; ?>
            </div>
          </section>
        <?php } ?>
      <?php } ?>
      <section class="columns-text postscript">
        <?php if ($postscript_title) : ?>
          <h6><?php echo $postscript_title; ?></h6>
        <?php endif; ?>
        <?php if ($postscript_text) : ?>
          <div class="columns-text__wrap">
            <p><?php echo $postscript_text; ?></p>
          </div>
        <?php endif; ?>
      </section>
    </div>
  </section>
<?php
endif;
