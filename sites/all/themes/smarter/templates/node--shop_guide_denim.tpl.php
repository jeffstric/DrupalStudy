<?php
/**
 * @file
 * Zen theme's implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   - view-mode-[mode]: The view mode, e.g. 'full', 'teaser'...
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 *   The following applies only to viewers who are registered users:
 *   - node-by-viewer: Node is authored by the user currently viewing the page.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $pubdate: Formatted date and time for when the node was published wrapped
 *   in a HTML5 time element.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content. Currently broken; see http://drupal.org/node/823380
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see zen_preprocess_node()
 * @see template_process()
 */
?>
<?php
//map
$coverSrc = file_create_url($content[ SHOP_GUIDE_COVER_FIELD_NAME ][ '#items' ][ 0 ][ 'uri' ]);
$slogon_pre = $content[ 'field_shop_guide_slogon_pre' ][ '#items' ][ 0 ][ 'value' ];
$slogon = $content[ 'field_shop_guide_slogon' ][ '#items' ][ 0 ][ 'value' ];
$items = $content[ SHOP_ITEM_FIELD_NAME ][ SHOP_ITEM_KEY ];
//dpm($content);
?>
<div class="main">
    <div class="maincontent">
        <div class="guidewrapper">
            <div class="topimg">
                <img src="<?php echo $coverSrc ?>" />
                <p><strong><?php echo $slogon_pre ?>&nbsp;►&nbsp;</strong><?php echo $slogon ?></p>
            </div>
            <div class="intro">
                <h1><?php echo $title ?></h1>
                <div class="desc">
                    <?php echo render($content[ 'body' ]) ?>
                </div>
            </div>
            <?php foreach ( $items as $key => $value ): ?>
                <?php if ( $key > 7 ) break; ?>

                <div class="guide<?php echo $key + 1 ?>">
                    <div class="imgbox">
                        <?php if ( $value[ 'url' ] ): ?>
                            <a href="<?php echo $value[ 'url' ] ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $value[ 'target' ] ?>" rel="nofollow"><img src="<?php echo image_style_url(195 . '_' . 217 , $value[ 'image' ]); ?>" alt="<?php echo $value[ 'product_name' ] ?>"/></a>
                        <?php else: ?>
                            <img src="<?php echo image_style_url(195 . '_' . 217 , $value[ 'image' ]); ?>" alt="<?php echo $value[ 'product_name' ] ?>"/>
                        <?php endif; ?>
                    </div>
                    <div class="content">
                        <?php if ( $value[ 'url' ] ): ?>
                            <?php if ( $value[ 'product_name' ] ): ?>
                                <a href="<?php echo $value[ 'url' ] ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $value[ 'target' ] ?>" rel="nofollow"><h3 name="has"><?php echo $value[ 'product_name' ] ?></h3></a>
                            <?php endif; ?>
                            <a href="<?php echo $value[ 'url' ] ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $value[ 'target' ] ?>" class="pprice"><?php echo $value[ 'store' ]; ?>&nbsp;<?php if ( $value[ 'price' ] ) echo '$' . $value[ 'price' ]; ?> </a>
                        <?php else: ?>
                            <?php if ( $value[ 'product_name' ] ): ?>
                                <a href="<?php echo $value[ 'url' ] ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $value[ 'target' ] ?>" rel="nofollow"><h3 name="has"><?php echo $value[ 'product_name' ] ?></h3></a>
                            <?php endif; ?>
                                <?php echo $value[ 'store' ]; ?>&nbsp;<?php if ( $value[ 'price' ] ) echo '$' . $value[ 'price' ]; ?> 
                            <?php endif; ?>
                    </div>
                    <?php if ( $value[ 'body' ] ): ?>
                        <a href="javascript:;" class="linkdot"><img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/denim_linkdot.gif') ?>" /></a>
                        <div class="popup disn">
                            <div class="arrow">
                                <img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/v6/stuffers_pop_arrow.gif') ?>" />
                            </div>
                            <?php echo truncate_utf8($value[ 'body' ] , 440); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="baseinfo">
                <?php echo $date; ?>&nbsp;by&nbsp;
                <?php echo render($content[ 'field_shop_guide_author' ]) ?>
            </div>
        </div>
        <!--end guidewrapper -->
        <div class="cl"></div>
    </div>
    <!--end maincontent -->
</div>
<!-- end main -->  