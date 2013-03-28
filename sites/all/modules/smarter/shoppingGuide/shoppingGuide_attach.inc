<?php
/*
 * @file  This file is for collect info and show view for shop guide.
 */

/**
 *  Show shop guide list
 * 
 * @param int $page
 *    The page of shop guide.
 * @return str 
 *    The view of shop guide .
 */
function shoppingGuide_list($page) {
  //get count from cache
  $count = cache_get('smarter_shop_guide_count');
  if (!$count) {
    $count = shoppingGuide_count();
    //set count to cache,will exist for a day.
    cache_set('smarter_shop_guide_count', $count, 'cache', strtotime("+1 day"));
  }
  else {
    $count = $count->data;
  }

  //prepare pager info
  $link = url('shopping-guides', array('absolute' => TRUE));
  $pager = shoppingGuide_pager($page, $count, 12, 10, $link);

  $shopGuides = array(
    '#theme' => 'shopguide_list',
    '#items' => shoppingGuide_get_guide($page),
    '#page_num' => $page,
    '#pager' => $pager,
  );
  drupal_add_css(drupal_get_path('module', 'shoppingGuide') . '/css/allposts.css');
  $shopGuidesHtml = drupal_render($shopGuides);
  return $shopGuidesHtml;
}

/**
 *  Get count of shop guide.
 * 
 * @return int
 *    The count of shop guide.
 */
function shoppingGuide_count() {
  $sqlCount = shoppingGuide_select_sql();
  return db_query($sqlCount)->fetchField();
}

/**
 *  Get shopguide conplete info from db.
 * 
 * @param int $pageNum
 * @return array
 *    The nodes of shop guide.
 */
function shoppingGuide_get_guide($pageNum) {
  $sqlNid = shoppingGuide_select_sql(FALSE);
  $query = db_query_range($sqlNid, ($pageNum - 1) * 12, 12);
  $nidsArray = $query->fetchAllAssoc('nid', PDO::FETCH_ASSOC);
  $shopGuideIds = array();
  foreach ($nidsArray as $idArray) {
    $shopGuideIds[] = $idArray['nid'];
  }
  return node_load_multiple($shopGuideIds);
}

/**
 *  Return the sql to query.
 * 
 * @param boolean $count
 *    If only to count , use TRUE,or  False.
 * @return string
 *    The sql to query.
 */
function shoppingGuide_select_sql($count = TRUE) {
  $sql = ($count) ? 'select count(*) as count ' : 'select nid ';
  $sql .= " from node where 
        type = 'shop_guide_chic_geek' or type='shop_guide_denim' or
        type='shop_guide_eco_friendly' or type='shop_guide_fall_fashion' or
        type='shop_guide_get_look' or type='shop_guide_man_tripping' or
        type='shop_guide_sale_module_b' or type='shop_guide_slide_show' or 
        type='shop_guide_ten_stuffer' or type='shop_guide_thanksgiving' or 
        type='shop_guide_want_it_now' or type='shop_guide_women_essential'
        and status = 1 ";
  if (!$count) {
    $sql .=' order by created desc';
  }
  return $sql;
}

/**
 *  Get the page html for shop guide.
 * 
 * @param int $page
 *    page num
 * @param int $count
 *    all items sum num
 * @param int $contain_size
 *    count of item per page 
 * @param int $page_sum
 *    how many page you want to show
 * @param str $link
 *    link pre url 
 * 
 * @return array $pager
 *    pager info
 */
function shoppingGuide_pager($page, $count, $contain_size, $page_sum, $link) {
  $count = (int) $count;
  if ($count) {
    $page_max = ceil($count / $contain_size);
  }

  $pages_left = floor($page_sum / 2);
  $page_begin = $page - $pages_left;
  if ($page_begin < 1) {
    $page_begin = 1;
  }
  $pager = array();
  for ($i = $page_begin; $i < $page_begin + $page_sum; $i++) {
    if ($i > $page_max)
      break;
    $pager[$i] = $link . '/' . $i;
  }
  return $pager;
}
