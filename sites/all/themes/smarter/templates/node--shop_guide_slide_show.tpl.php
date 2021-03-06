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
$coverUrl = file_create_url($content[ SHOP_GUIDE_COVER_FIELD_NAME ][ '#items' ][ 0 ][ 'uri' ]);
$items_info = $content[ SHOP_ITEM_FIELD_NAME ][ SHOP_ITEM_KEY ];
//dpm($content);
?>
<div class="main">
    <div class="maincontent">
	<div class="slidewrapper">
	    <div class="coll">
		<div class="slidebox">
		    <div class="slidebut">
			<a class="prevnone" href="#" ><img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/slide_but.png') ?>" /></a>
			<a class="next" href="#slide-1" ><img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/slide_but.png') ?>" /></a>
		    </div>
		    <h1><?php echo $title ?></h1>
		    <div class="author"><?php echo $submitted ?></div>

		    <div class="productcontent" name="main">
			<div class="intro"><?php echo render($content[ 'body' ]); ?></div>
			<div class="imgbox">
			    <a href="#slide-1" title="<?php echo $title ?>">
				<img src="<?php echo $coverUrl; ?>" alt="<?php echo $title ?>" width="614" />
			    </a>
			</div>
		    </div>
		    <?php $count = 0 ?>
		    <?php foreach ( $items_info as $key => $value ): ?>
			<?php
			$count++;
			$outUrl = $value[ 'outUrl' ];
			$url = $value[ 'url' ];
			$target = $value[ 'target' ];
			$imageSrc = shoppingGuide_transferImageUrl($value[ 'image' ] , 293 , 506);
			if ( !isset($value[ 'product_name' ]) )
			    $value[ 'product_name' ] = '';
			?>
    		    <div class="productcontent disn" name="<?php echo $count ?>">
    			<div class="imgbox">
				<?php if ( $url ): ?>
				    <a href="<?php echo $url ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $target ?>" rel="nofollow">
					<img src="<?php echo $imageSrc ?>" alt="<?php echo $value[ 'product_name' ] ?>"/>
				    </a>
				<?php else: ?>
				    <img src="<?php echo $imageSrc ?>" alt="<?php echo $value[ 'product_name' ] ?>"/>
				<?php endif; ?>
    			</div>
    			<div class="productinfo">
				<?php if ( $url ): ?>
				    <a href="<?php echo $url ?>" title="<?php echo $value[ 'product_name' ] ?>" target="<?php echo $target ?>" rel="nofollow">
					<h3><?php echo $value[ 'product_name' ] ?></h3>
				    </a>
				    <?php if ( $value[ 'price' ] ): ?>
	    			    <a href="<?php echo $url ?>"  target="<?php echo $target ?>" rel="nofollow">
	    				<p class="price"><?php echo $value[ 'price' ] ?></p>
	    			    </a>
				    <?php endif; ?>
				<?php else: ?>
				    <h3><?php echo $value[ 'product_name' ] ?></h3>
				    <?php if ( $value[ 'price' ] ): ?>
	    			    <p class="price"><?php echo $value[ 'price' ] ?></p>
				    <?php endif; ?>
				<?php endif; ?>
    			    <p class="desc"><?php echo $value[ 'body' ] ?></p>
    			</div>
    			<div class="cl"></div>
    		    </div>
		    <?php endforeach; ?>

		    <div class="slideselect">
			<div class="prev"><a href="#"><img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/slideprev.gif') ?>" width="11" height="22" /></a></div>
			<div class="slidecontent">	
			    <ul>
				<li>
				    <a href="#" name="main" class="selected" title="<?php echo $title ?>">
					<img src="<?php echo shoppingGuide_transferImageUrl($coverUrl , 100 , 100) ?>" alt="<?php echo $title ?>" width="108" height="108" />
				    </a>
				</li>
				<?php $count = 0; ?>
				<?php foreach ( $items_info as $key => $value ): ?>
				    <?php
				    $count++;
				    if ( !isset($value[ 'product_name' ]) )
					$value[ 'product_name' ] = '';
				    ?>
    				<li>
    				    <a href="#slide-<?php echo $count ?>" name="<?php echo $count ?>" class="normal" title="<?php echo $value[ 'product_name' ]; ?>">
    					<img src="<?php echo shoppingGuide_transferImageUrl($value[ 'image' ] , 100 , 100) ?>" alt="<?php echo $value[ 'product_name' ] ?>" width="108" height="108" />
    				    </a>
    				</li>
				<?php endforeach; ?>
			    </ul>
			</div>
			<div class="next"><a href="#slide-1"><img src="<?php echo file_create_url(drupal_get_path('theme' , 'smarter') . '/images/special/slidenext.gif') ?>" width="11" height="22" /></a></div>                        
			<div class="cl"></div>
		    </div>

		</div>
	    </div>
	</div>
	<div class="cl"></div>
    </div>	
    <!--end maincontent -->	
</div>
<!-- end main -->