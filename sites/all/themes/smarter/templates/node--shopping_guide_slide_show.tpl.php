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
<div class="slidebox">
    <div class="slidebut">
	<a class="prev" href="#slide-1"><img src="http://files.smarter.com/images/v6/special/slide_but.png"></a>
	<a class="next" href="#slide-3"><img src="http://files.smarter.com/images/v6/special/slide_but.png"></a>
    </div>
    <div class="date">Aug 1, 2012</div> <h1><?php $title ?></h1>
    <div class="author">By Belinda Romano</div> 

    <div class="productcontent " name="main" style="display: none;">
	<div class="intro"><p>Comfortable, casual and always in style, there's no denying that the boat shoe is a summer time classic. Whether you're sunset sailing with friends, or lakeside relaxing with the family, these shoes add the perfect summer-cool vibe to any outfit. What's even better? Boat shoes are a great summer-to-fall transitional accessory. Just trade your bermudas for some khakis and your chambray button-downs for some cozy sweaters and you'll be ready for fall! From classic and sophisticated designs for mom and dad, to fun and contemporary trends for the kids, there is a boat shoe out there for everyone in the family.</p></div>
	<div class="imgbox">
	    <a href="#slide-1" title="Boat Shoes for the Entire Family">
		<img src="http://files.smarter.com/images/special/special_0_20120801191638.jpg" alt="Boat Shoes for the Entire Family" width="614">
	    </a>
	</div>
    </div>

    <div class="slideselect">
	<div class="prev"><a href="#slide-1"><img src="http://files.smarter.com/images/v6/special/slideprev.gif" width="11" height="22"></a></div>
	<div class="slidecontent"> 
	    <ul style="margin-left: 0px;">
		<li><a href="#" name="main" class="normal" title="Boat Shoes for the Entire Family"><img src="http://files.smarter.com/images/special/special_thumb_0_20120801191639.jpg" alt="Boat Shoes for the Entire Family" width="108" height="108"></a></li>
		<li><a href="#slide-1" name="1" class="normal" title="Dad"><img src="http://files.smarter.com/images/special/special_thumb_1_20120801182801.jpg" alt="Dad" width="108" height="108"></a></li>
		<li><a href="#slide-2" name="2" class="selected" title="Mom"><img src="http://files.smarter.com/images/special/special_thumb_2_20120801182801.jpg" alt="Mom" width="108" height="108"></a></li>
		<li><a href="#slide-3" name="3" class="normal" title="Big Sister"><img src="http://files.smarter.com/images/special/special_thumb_3_20120801182801.jpg" alt="Big Sister" width="108" height="108"></a></li>
		<li><a href="#slide-4" name="4" class="normal" title="Little Sister"><img src="http://files.smarter.com/images/special/special_thumb_4_20120801182801.jpg" alt="Little Sister" width="108" height="108"></a></li>
		<li><a href="#slide-5" name="5" class="normal" title="Big Brother"><img src="http://files.smarter.com/images/special/special_thumb_5_20120801182802.jpg" alt="Big Brother" width="108" height="108"></a></li>
		<li><a href="#slide-6" name="6" class="normal" title="Little Brother"><img src="http://files.smarter.com/images/special/special_thumb_6_20120801182802.jpg" alt="Little Brother" width="108" height="108"></a></li>
	    </ul>
	</div>
	<div class="next"><a href="#slide-3"><img src="http://files.smarter.com/images/v6/special/slidenext.gif" width="11" height="22"></a></div> 
	<div class="cl"></div>
    </div>

</div>

<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <?php if ( $title_prefix || $title_suffix || $display_submitted || $unpublished || !$page && $title ): ?>
        <header>
	    <?php print render($title_prefix); ?>
	    <?php if ( !$page && $title ): ?>
	        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
	    <?php endif; ?>
	    <?php print render($title_suffix); ?>

	    <?php if ( $display_submitted ): ?>
	        <p class="submitted">
		    <?php print $user_picture; ?>
		    <?php print $submitted; ?>
	        </p>
	    <?php endif; ?>

	    <?php if ( $unpublished ): ?>
	        <p class="unpublished"><?php print t('Unpublished'); ?></p>
	    <?php endif; ?>
        </header>
    <?php endif; ?>

    <?php
    // We hide the comments and links now so that we can render them later.
    hide($content[ 'comments' ]);
    hide($content[ 'links' ]);
    print render($content);
    ?>

    <?php print render($content[ 'links' ]); ?>

    <?php print render($content[ 'comments' ]); ?>

</article><!-- /.node -->
