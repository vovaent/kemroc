<?php

/**
 * Cookies-table Block Template.
 */
if (isset($block['data']['gutenberg_preview_image']) && $is_preview) {
  echo '<img src="' . esc_url($block['data']['gutenberg_preview_image']) . '" style="max-width:100%; height:auto;">';
}

if (!$is_preview) :
  $kemroc_cookies_table_id = 'cookies-table-' . $block['id'];
  if (!empty($block['anchor'])) {
    $kemroc_cookies_table_id = $block['anchor'];
  }

  $kemroc_cookies_table_class_name = 'cookies-table';
  if (!empty($block['className'])) {
    $kemroc_cookies_table_class_name .= ' ' . $block['className'];
  }
  if (!empty($block['align'])) {
    $kemroc_cookies_table_class_name .= ' align' . $block['align'];
  }

  $rows = get_field('cookies_table_items');
?>

  <section id="<?php echo esc_attr($kemroc_cookies_table_id); ?>" class="<?php echo esc_attr($kemroc_cookies_table_class_name); ?>">
    <div class="container">
      <div class="grayplate-text">
        <?php if ($rows) {
        ?>
          <table style="width:100%" cellspacing="0" cellpadding="0">
            <tr>
              <th>NAME</th>
              <th>ANBIETER</th>
              <th>ZWECK</th>
              <th>ABLAUF</th>
              <th>TYP</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><a href="<?php echo $row['anbieter']['url']; ?>"><?php echo $row['anbieter']['title']; ?></a></td>
                <td><?php echo $row['zweck']; ?></td>
                <td><?php echo $row['ablauf']; ?></td>
                <td><?php echo $row['typ']; ?></td>
              </tr>
            <?php } ?>
          </table>
      </div>
    <?php } ?>
    </div>
    </div>
  </section>
<?php
endif;
