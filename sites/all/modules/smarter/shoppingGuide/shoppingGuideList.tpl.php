<?php
//dpm($items);
//dpm($pager);
?>
<div class="main">
  <div class="maincontent">
    <div class="allpostwrapper">
      <h1>Smarter Shopping Guides > page <?php echo $page_num; ?></h1>
      <?php $K = 0; ?>
      <?php foreach ($items as $value): ?>
        <?php
        $url = url('node/' . $value->nid, array('absolute' => TRUE));
        $snap_shot = file_create_url($value->field_shop_guide_snapshot['und'][0]['uri']);
        if (isset($value->body)) {
          $desc = drupal_substr(strip_tags($value->body['und'][0]['value']), 0, 150);
        }
        else {
          $desc = drupal_substr($value->metatags['und']['description']['value'], 0, 150);
        }
        $desc = preg_replace('|\w+$|', '', $desc);
        ?>
        <?php if (($K) % 3 == 0): ?>
          <ul>
          <?php endif; ?>
          <li>
            <p class="imgbox">
              <a href="<?php echo $url ?>" title="<?php echo $value->title; ?>"><img src="<?php echo $snap_shot; ?>" alt="<?php echo $value->title; ?>" /></a>
            </p>
            <a href="<?php echo $url ?>" class="posttitle" title="<?php echo $value->title; ?>"><?php echo $value->title; ?></a>
            <p class="desc"><?php echo $desc; ?>&nbsp;...<a href="<?php echo $url ?>">read more</a></p>
          </li>
          <?php if (($K) % 3 == 2): ?>
          </ul>
        <?php endif; ?>
        <?php $K++ ?>
      <?php endforeach; ?>
    </div>
    <div class="cl"></div>
    <div class="pagelist">
      <?php if ($pager && count($pager)): ?>
        <?php if (isset($pager[$page_num - 1])): ?>
          <a rel="nofollow" href="<?php echo $pager[$page_num - 1] ?>">
            <span>Prev</span>
          </a>
        <?php endif; ?>
        <?php foreach ($pager as $key => $value): ?>
          <a href="<?php echo $value; ?>" rel="nofollow">
            <?php if ($key == $page_num): ?>
              <strong><?php echo $key; ?></strong>
            <?php else: ?>
              <span><?php echo $key; ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
        <?php if (isset($pager[$page_num + 1])): ?>
          <a rel="nofollow" href="<?php echo $pager[$page_num + 1] ?>">
            <span>Next</span>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="specdis">
    </div>
  </div>
</div>
<!-- end main -->