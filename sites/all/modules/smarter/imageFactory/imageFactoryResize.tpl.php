<div id = "imgContainer">
    <div id = "imageResize">

    </div>
    <div id = "selectSection" style = "top:0px;left:0px;width:75px;height:75px;">
	<div id = "divReseize" ></div>
    </div>
</div>

<div id="textEditArea" style="display:none">
    <h5>content</h5>
    <input id="imTextContent" type="text"/>
    <h5>size</h5>
    <input id="imTextSize" type="text"/>
    <h5>angle</h5>
    <input id="imAngle" type="text"/>
    <h5>color</h5>
    <input id="imColor" type="text" />

    <h5>font family</h5>
    <select id="imFont">
	<option value="0">default</option>
    </select>

    <div id="IMFontEdit">
	<input type="button" value="resize image" style="width:150px" class="form-autocomplete"/>
    </div>
</div>

<div id="IMresize">
    <input type="button" value="resize image" style="width:150px" class="form-autocomplete"/>
</div>


<script type="text/javascript">
    var ImImageSrc = '<?php echo $image ?>';//图像地址
    var ImImageRoute = '<?php echo $imageRoute ?>';
    var imageWidth = <?php echo $imageInfo[ 0 ]; ?>;//图像宽度
    var imageHeight =<?php echo $imageInfo[ 1 ]; ?>;//图像高度
    var IMfid = <?php echo $fid; ?>;
    var imDist = [];
    var imDist2 = [];
    var posSel = [];
    var ImResult = {
	height:75,
	width:75,
	top:0,
	left:0
    };
    //imageResize层是否跟随鼠标移动
    var switchMO = false;
    //selectSection层是否跟随鼠标移动的开关
    var switchMS = false;
    
    window.onload = function(){
	
	var e = document.getElementById('imgContainer');
	var f = document.getElementById('imageResize');
	var s = document.getElementById('selectSection');
	var d = document.getElementById('divReseize');
	f.style.background = 'url('+ ImImageSrc +') no-repeat 0px 0px';
	f.style.width = imageWidth+'px';
	f.style.height=imageHeight+'px';
	s.style.background = 'url('+ ImImageSrc +') no-repeat 0px 0px';
		
	s.onmousedown = function(event){
	    if(!switchMS){
		if(!event) event = window.event;
		imDist = [event.clientX - parseInt(s.style.left) , event.clientY - parseInt(s.style.top) ];
		switchMO = true;
		document.onmouseup = function(){
		    switchMO = false;
		    getReseizeResult();
		} 
	    }
	}
	d.onmousedown = function(event){
	    if(!event) event = window.event;
	    imDist2 = [event.clientX - ( parseInt(s.style.left) + parseInt(s.style.width) ) , 
		event.clientY - ( parseInt(s.style.top) + parseInt(s.style.height) )  
	    ];
	    switchMS = true;
	    document.onmouseup = function(){
		switchMS = false;
		getReseizeResult();
	    }
	    posSel = [parseInt(s.style.left),parseInt(s.style.top)];

	}
	e.onmousemove = function(event){
	    if(!event) event = window.event;
	    if(switchMS){
		var height = event.clientY - imDist2[1] - parseInt(s.style.top);
		var width = event.clientX -imDist2[0] - parseInt(s.style.left);
		width = ( (posSel[0] + width) > imageWidth ) ? (imageWidth - posSel[0]) : width ;
		height = ( (posSel[1] + height ) > imageHeight ) ? (imageHeight - posSel[1]) : height ;
		s.style.width = width + 'px';
		s.style.height = height  + 'px';
		d.style.top = (height - 10) + 'px';
	    }else{
		if(switchMO){
		    var left = event.clientX - imDist[0];
		    var top = event.clientY - imDist[1];
		    var LeftMax = imageWidth - parseInt(s.style.width);
		    var topMax = imageHeight - parseInt(s.style.height);
		    if(left > LeftMax){
			left = LeftMax;
		    }else if(left < 0){
			left = 0;
		    }
		    if(top > topMax){
			top = topMax;
		    }else if(top < 0){
			top = 0;
		    }
		    s.style.left = left + 'px';
		    s.style.top = top  + 'px';
		    s.style.background = 'url('+ ImImageSrc +') no-repeat -'+left+'px -'+top+'px';
		} 
	    }
	}

    }
    function getReseizeResult(){
	var s = document.getElementById('selectSection');
	ImResult = {
	    'width'     : parseInt(s.style.width),
	    'height'    : parseInt(s.style.height),
	    'left'      : parseInt(s.style.left),
	    'top'       : parseInt(s.style.top)
	}
    }
 
</script>

<script>
    (function ($) {
	$('#IMresize input').click(function(){
	    ImResult['fid'] = IMfid;
	    ImResult['src'] = ImImageRoute;
	    $(this).addClass('throbbing');
	    $.post('/admin/imageFactory/resizeAjax/'+IMfid, ImResult, function(data){
		$('#IMresize input').removeClass('throbbing');
		$('#imgContainer').after('<div id="newImage"><img src="'+data['src']+'"/></div>').remove();
		document.onmouseup = function(){}// ubbind onmouseup event 
		$('#textEditArea').show();
		$('#IMresize input').remove();
		
		$('#imColor').ColorPicker({
		    onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		    },
		    onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		    }
		})
		
		
		$('#IMFontEdit input').click(function(){
		    var con = $('#imTextContent').val();
		    var size = $('#imTextSize').val();
		    var ang = $('#imAngle').val();
		    var font = $('#font').val();
		})
	    }, 'json');
	})
    })(jQuery);
 
</script>