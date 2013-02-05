<?php
$name = $element[ '#field_name' ] . '[' . $element[ '#language' ] . '][' . $element[ '#weight' ] . '][' . $element[ '#columns' ][ 0 ] . ']';
$id = $element[ '#id' ];
$default = ($element[ SHOP_ITEM_ID_SUFFIX ][ '#default_value' ][ 0 ]) ? $element[ SHOP_ITEM_ID_SUFFIX ][ '#default_value' ][ 0 ] : 0;
?>
<ol id= "<?php echo $id  ?>" >
    <?php foreach ( $element[ SHOP_ITEM_ID_SUFFIX ][ '#options' ] as $key => $value ) : ?>
    <li>
	<input type="radio" name="<?php echo $name ?>" value="<?php echo  $key ?>"  <?php if($default == $key) echo 'checked="checked"'?>   />
	<?php echo $value ?>
    </li>
    <?php endforeach;?>
    <input type="button" value="change"  style="display:none"/>
</ol>
<script type="text/javascript">
    
    if( typeof(radioLiHide)=='undefined' ){
	function radioLiHide(weight,e){
	    jQuery('#'+radioLiIds[weight]+' li').removeClass(radioLiClass);
	    jQuery(e).parent().addClass(radioLiClass);
	    jQuery('#'+radioLiIds[weight]+' li[class!="'+radioLiClass+'"]').hide();
	    jQuery('#'+radioLiIds[weight]+' input[type=button]').show();
	}
    }
    
    if( typeof(radioLiIds)=='undefined' ){
	var radioLiIds = [];
    }
    radioLiIds[<?php echo $element[ '#weight' ]?>] ='<?php echo $id;?>' ;
    var radioLiClass = 'radio_selecte';
    jQuery('#'+radioLiIds[<?php echo $element[ '#weight' ]?>]+' input[type=radio]')
    .click(function(){radioLiHide(<?php echo $element[ '#weight' ]?>,this);});
    jQuery('#'+radioLiIds[<?php echo $element[ '#weight' ]?>]+' input[type=button]').click(function(){
	jQuery('#'+radioLiIds[<?php echo $element[ '#weight' ]?>]+' li').show();
	jQuery(this).hide();
    });
    radioLiHide(<?php echo $element[ '#weight' ]?>,jQuery('#'+radioLiIds[<?php echo $element[ '#weight' ]?>]+' input[type=radio][checked=checked]') );
    
</script>