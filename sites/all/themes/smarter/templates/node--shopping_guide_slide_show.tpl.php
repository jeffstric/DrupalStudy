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
<!--
<div class="slidebox">
    <div class="slidebut">
	<a class="prevnone" href="#" ><img src="{$fileRoot}images/v6/special/slide_but.png" /></a>
	<a class="next" href="#slide-1" ><img src="{$fileRoot}images/v6/special/slide_but.png" /></a>
    </div>

    {if $baseInfo.addDate}<div class="date">{$baseInfo.addDate|date_format:"%b %e, %Y"}</div>{/if}
    {if $headerImg}
    <h1><img src="{$fileRoot}{$headerImg}" alt="{$h1}" width="614" height="45"></h1>
    {else}
    <h1>{$h1}</h1>
    {/if}
    {if $baseInfo.author}<div class="author">By {$baseInfo.author}</div>{/if}

    {foreach from=$list item=lsitem key=lskey name=lsname}
    {if $lsitem.image}
    <div class="productcontent  {if !$smarty.foreach.lsname.first}disn{/if}" {if !$smarty.foreach.lsname.first}name="{$lskey}"{else}name="main"{/if}>
	 {if $smarty.foreach.lsname.first}
	 <div class="intro">{$pageIntro}</div>
	{/if}
	<div class="imgbox">
	    {if $lsitem.NoLink=='No' && !$smarty.foreach.lsname.first}
	    <a {if $lsitem.trackingProdLink=='YES'}href="{$lsitem.trackingLink}"{else}href="{$lsitem.productLink}"{/if} title="{$lsitem.productName}" {if $lsitem.trackingProdLink=='YES'}target="_blank" rel="nofollow"{/if}>
		<img src="{$fileRoot}{$lsitem.image}" alt="{$lsitem.productName}"/>
	    </a>
	    {elseif $smarty.foreach.lsname.first}
	    <a href="#slide-1" title="{$lsitem.productName}">
		<img src="{$fileRoot}{$lsitem.image}" alt="{$lsitem.productName}" width="614" />
	    </a>
	    {else}
	    <img src="{$fileRoot}{$lsitem.image}" alt="{$lsitem.productName}"/>
	    {/if}
	</div>
	{if !$smarty.foreach.lsname.first}
	<div class="productinfo">
	    {if $lsitem.NoLink=='No'}
	    <a {if $lsitem.trackingProdLink=='YES'}href="{$lsitem.trackingLink}"{else}href="{$lsitem.productLink}"{/if} title="{$lsitem.productName}" {if $lsitem.trackingProdLink=='YES'}target="_blank" rel="nofollow"{/if}>
		<h3>{$lsitem.productName}</h3>
	    </a>
	    <a href="{$lsitem.trackingLink}"  {if $lsitem.trackingProdLink=='YES'}target="_blank" rel="nofollow"{/if}>
	       <p class="price">{if $lsitem.productPrice}${$lsitem.productPrice}{/if}</p>
	    </a>
	    {else}
	    <h3>{$lsitem.productName}</h3>
	    <p class="price">{if $lsitem.productPrice}${$lsitem.productPrice}{/if}</p>
	    {/if}
	    <p class="desc">{$lsitem.productDesc}</p>
	</div>
	<div class="cl"></div>
	{/if}
    </div>
    {/if}
    {/foreach}
    <div class="slideselect">
	<div class="prev"><a href="#"><img src="{$fileRoot}images/v6/special/slideprev.gif" width="11" height="22" /></a></div>
	<div class="slidecontent">	
	    <ul>
		{foreach from=$list item=lsitem key=lskey name=lsname}
		{if $lsitem.productName}
		<li><a {if !$smarty.foreach.lsname.first}href="#slide-{$lskey}" name="{$lskey}"{else}href="#" name="main"{/if} class="{if $smarty.foreach.lsname.first}selected{else}normal{/if}" title="{$lsitem.productName}"><img src="{$fileRoot}{$lsitem.thumbImage}" alt="{$lsitem.productName}" width="108" height="108" /></a></li>
		{/if}
		{/foreach}
	    </ul>
	</div>
	<div class="next"><a href="#slide-1"><img src="{$fileRoot}images/v6/special/slidenext.gif" width="11" height="22" /></a></div>                        
	<div class="cl"></div>
    </div>
</div>
-->

<div class="slidebox">
    <div class="slidebut">
	<a class="prev" href="#slide-1"><img src="http://files.smarter.com/images/v6/special/slide_but.png"></a>
	<a class="next" href="#slide-3"><img src="http://files.smarter.com/images/v6/special/slide_but.png"></a>
    </div>

    <h1><?php print $title ?></h1>
    <?php print $submitted ?>
    <!--
    <div class="date">Aug 1, 2012</div> 
    <div class="author">By Belinda Romano</div> 
    -->
    <?php dpm($content); ?>
    <?php foreach ( $content[ 'field_shop_guide_slide_content' ][ '#items' ] as $key => $value ) : ?>
        <div class="productcontent " name="main" style="display: none;">
    	<div class="intro">
    	    <p>
		    <?php print $value[ 'value' ] ?>
    	    </p>
    	</div>
    	<div class="imgbox">
    	    <a href="#slide-1" title="Boat Shoes for the Entire Family">
		    <?php print render($content[ 'field_shop_guide_slide_image' ][ $key ]); ?>
    	    </a>
    	</div>
        </div>	
    <?php endforeach; ?>
    <div class="slideselect">
	<div class="prev"><a href="#slide-1"><img src="http://files.smarter.com/images/v6/special/slideprev.gif" width="11" height="22"></a></div>
	<div class="slidecontent"> 
	    <ul style="margin-left: 0px;">
		<?php foreach ( $content[ 'field_shop_guide_slide_content' ][ '#items' ] as $key => $value ): ?>
    		<li>
    		    <a href="#" name="main" class="normal">
    			<img src="<?php print image_style_url('thumbnail' , $content[ 'field_shop_guide_slide_image' ][ $key ][ '#item' ][ 'uri' ]); ?>"  width="108" height="108">
    		    </a>
    		</li>
		<?php endforeach; ?>
		<!--
		<li><a href="#slide-1" name="1" class="normal" title="Dad"><img src="http://files.smarter.com/images/special/special_thumb_1_20120801182801.jpg" alt="Dad" width="108" height="108"></a></li>
		-->
	    </ul>
	</div>
	<div class="next"><a href="#slide-3"><img src="http://files.smarter.com/images/v6/special/slidenext.gif" width="11" height="22"></a></div> 
	<div class="cl"></div>
    </div>

</div>

<!-- /.node -->