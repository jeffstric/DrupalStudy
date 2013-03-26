<div class="imagFactory_goto_list">
    <a href="<?php echo url('admin/imageFactory/list') ?>">go back to list</a>
</div>

<div id = "imgContainer">
    <div id = "imageResize">

    </div>
    <div id = "selectSection" style = "top:0px;left:0px;width:75px;height:75px;">
        <div id = "divReseize" ></div>
    </div>
</div>
<fieldset id="ImSelectWH">
    <div>
        <label>drag area's width</label>
        <input type="text" id="selectWidth"/>
        <label>drag area's height</label>
        <input type="text" id="selectHeight"/>
        <label>apply width and height to drag area</label>
        <input type="button" id="selectCustom" value="apply"/>
    </div>
</fieldset>
<div id="IMresize">
    <input type="button" value="resize image" style="width:150px" class="form-autocomplete zero_mp"/>
</div>


<!-- this is for image text edit-->
<div id="textEditArea" style="display:none">
    <input type="button" value="add another text" id="ImTextAdd"/>
    <fieldset class="singleTextEdit">
        <input type="button" value="remove this  text" class="ImTextRemove"  />
        <label>content</label>
        <input class="imTextContent" name="content" type="text" title="Type the message you'd like displayed on the image"  msg="content must be input" valid="free" size="80"/>
        <label>size</label>
        <input class="imTextSize" name="size" type="text" title="The size of font" msg="size must be numeric" valid="num"/>
        <label>angle</label>
        <input class="imAngle" name="angle" type="text" title="The angle of font"  msg="angle must be numeric" valid="num"/>
        <label>color</label>
        <input class="imColor" name="color" type="text" title="The color of font" msg="color must be string" valid="str" />
        <div id="tipForXy">The coordinates given by x and y will define the basepoint of the first character (roughly the lower-left corner of the character)</div>
        <label>x</label>
        <input class="imPosX" name ="x" type="text" title="The horizontal position of text" msg="position of x must be numeric" valid="num" size="30"/>
        <label>y</label>
        <input class="imPosY" name="y" type="text" title="The   vertical position of text" msg="position of y must be numeric" valid="num" size="30"/>
        <label>shadow</label>
        <select class="imShadow" name="shadow" msg="please select shadow type"  valid="num">
            <option value="0">no</option>
            <option value="1">yes</option>
        </select>
        <label>font family</label>
        <select class="imFont" msg="please select font type" valid="num">
            <option value="0">No fonts file ,please upload ttf!</option>
        </select>
    </fieldset>

    <div id="IMFontEdit">
        <input type="button" value="add text to image" style="width:250px" class="form-autocomplete zero_mp"/>
    </div>
</div>
<!--image text edit area end-->
<div id="ImShowSave" style="display:none">
    <div id="ImImgShow">

    </div>
    <input type="button" value="save" id="ImSave" style="width:100px" class="form-autocomplete zero_mp"/>
    <div class="imagFactory_goto_list">
        <a href="<?php echo url('admin/imageFactory/list') ?>">go back to list</a>
    </div>
</div>




<script type="text/javascript">
    var ImImageSrc = '<?php echo $image ?>';//image src
    var imageWidth = <?php echo $imageInfo[ 0 ]; ?>;//image width
    var imageHeight =<?php echo $imageInfo[ 1 ]; ?>;//image height
    var fonts = <?php echo json_encode($fontsInfo); ?>;
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
        var w = document.getElementById('selectWidth');
        var h = document.getElementById('selectWidth');
        var sc = document.getElementById('selectCustom');
        var sw = document.getElementById('selectWidth');
        var sh = document.getElementById('selectHeight');
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
                height = (height<10) ? 10 : height;
                width = (width<10)? 10 : width;
                width = ( (posSel[0] + width) > imageWidth ) ? (imageWidth - posSel[0]) : width ;
                height = ( (posSel[1] + height ) > imageHeight ) ? (imageHeight - posSel[1]) : height ;
                s.style.width = width + 'px';
                s.style.height = height  + 'px';
                d.style.top = (height - 10) + 'px';
                //set width and height visable
                sw.value = width;
                sh.value = height;
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
	
        addEventListener(sc,'click',function(){
            var w = sw.value;
            var h = sh.value;
            //check valid is ignore for test
            w = ( (parseInt(s.style.left) + parseInt(w)) > imageWidth ) ? (imageWidth - parseInt(s.style.left)) : w ;
            h = ( (parseInt(s.style.top) + parseInt(h) ) > imageHeight ) ? (imageHeight - parseInt(s.style.top)) : h ;
            //set  width and height
            s.style.height = h+'px';
            s.style.width = w+'px';
            d.style.top = h-10 + 'px';
            //set the value back
            sw.value = w;
            sh.value =h ;
            getReseizeResult();
        })
	
        sw.value = parseInt(s.style.width);
        sh.value = parseInt(s.style.height);
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
    function addEventListener(oTarget,sEventType,fnHandler)
    {
        if(oTarget.addEventListener){
            oTarget.addEventListener(sEventType,fnHandler,false);
        } 
        else if(oTarget.attachEvent){
            oTarget.attachEvent('on'+sEventType,fnHandler);
        } else{
            oTarget['on'+sEventType] = fnHandler;
        }
    };
 
</script>

<script type="text/javascript">
    (function ($) {
        //input hint
        $.fn.hint = function (blurClass) {
            if (!blurClass) { 
                blurClass = 'blur';
            }
    
            return this.each(function () {
                // get jQuery version of 'this'
                var $input = $(this),
                // capture the rest of the variable to allow for reuse
                title = $input.attr('title');
                function remove() {
                    if ($input.val() === title && $input.hasClass(blurClass)) {
                        $input.val('').removeClass(blurClass);
                    }
                }

                // only apply logic if the element has the attribute
                if (title) { 
                    // on blur, set value to title attr if text is blank
                    $input.blur(function () {
                        if (this.value === '') {
                            $input.val(title).addClass(blurClass);
                        }
                    }).focus(remove).blur(); // now change all inputs to title
                    // clear the pre-defined text when form is submitted
                }
            });
        };
        
        //usage
        $('input[title!=""]').hint();
        
        //remember to check class blur when submit!
        
        var poHost = window.location.protocol+'//'+window.location.host+'<?php echo $basePath; ?>';
        $('#IMresize input').click(function(){
            ImResult['fid'] = IMfid;
            ImResult['src'] = ImImageSrc;
            $(this).addClass('throbbing');
            $.post(poHost+'admin/imageFactory/resizeAjax/', ImResult, function(data){
                $('#IMresize input').removeClass('throbbing');
                if(data.result!='success'){
                    var error = (data.error)?data.error:'transfer error';
                    alert(error);
                    return false;
                }
		
                $('#imgContainer').after('<div id="newImage"><img src="'+data['src']+'"/></div>').remove();
                document.onmouseup = function(){}// ubbind onmouseup event 
                $('#textEditArea').show();
                //set fonts family
                var fontsHtml = '';
                for(var i in fonts.family){
                    fontsHtml +='<option value="'+i+'">'+fonts.family[i]+'</option>';
                }
                $('.imFont option').replaceWith(fontsHtml);
		
                $('#IMresize input').remove();
                $('#ImSelectWH').remove();
		
                var textEditMap = {
                    T:'imTextContent',
                    S : 'imTextSize',
                    A : 'imAngle',
                    C : 'imColor',
                    F : 'imFont',
                    X:'imPosX',
                    Y:'imPosY',
                    H:'imShadow'
                };
		
                bindColorPick();
                $('#ImTextAdd').unbind('click').click(function(){
                    var te =  $('.singleTextEdit');
                    var teL = $(te[te.length-1]);
                    teL.after( teL.clone() );
                    removeSingleTextEdit();
                    bindColorPick();
                })
                removeSingleTextEdit();
		
                $('#IMFontEdit input').unbind('click').click(function(){
                    $(this).attr('disabled','disabled');
                    var textNum = $('.singleTextEdit').length;
                    if(!textNum){
                        alert('please choose right font');
                        return false;
                    }
                    var showP = {
                        N:textNum,
                        B:data['src']
                    };
                    for(var i = 0 ; i < textNum ; i++){
                        for(var n in textEditMap){
                            var sel = '.'+textEditMap[n];
                            var val =  $(sel).val();
                            var domJq = $(sel)[i];
                            var valid = $(sel).attr('valid');
                            if(!checkValid(val,valid)){
                                alert( $(domJq).attr('msg') );
                                $(this).attr('disabled','');
                                return false;
                            }
                            showP[n+i] = $(domJq).val();
                        }
                    }
		    
                    $(this).addClass('throbbing');
		    
                    $.post(poHost+'admin/imageFactory/addText',showP,function(data){
                        $('#IMFontEdit input').attr('disabled','');
                        $('#ImShowSave').show();
                        $('#IMFontEdit input').removeClass('throbbing');
			
                        if(data.result == 'success'){
                            $('#ImImgShow').empty().append('<img src="'+data.src+'"/>');
                            $('#ImSave').unbind('click').click(function(){
                                var fileCreate ;
                                var time = new Date;
                                var reg = new RegExp('(?:\\W|^$)');
                                do{
                                    fileCreate  = window.prompt("please enter file name, only character is allow.",time.getTime());
                                    if(fileCreate == null){
                                        return false;
                                    }
                                }while(reg.test(fileCreate));
                                $(this).addClass('throbbing');
                                $('#ImSave').attr('disabled',"disabled");
                                $.post(poHost+'admin/imageFactory/save', {'file':data.src,'name':fileCreate}, function(data){
                                    $('#ImSave').removeClass('throbbing').attr('disabled','');
                                    if(data.result == 'success'){
                                        if(confirm('save success, goto list page?')){
                                            window.location = poHost + 'admin/imageFactory/list';
                                        }
                                    }else{
                                        var msg = (data.error)? data.error : 'tranfser info error';
                                        return false;
                                    }
                                },'json');
                            });
                        }else{
                            var msg = (data.error)? data.error : 'tranfser info error';
                            alert(msg);
                            return false;
                        }
                    },'json');
		    
                })
            }, 'json');
        })
    })(jQuery);
    
 
    function removeSingleTextEdit(){
        jQuery('.ImTextRemove').unbind('click').click(function(){
            if(jQuery('.singleTextEdit').length >1){
                jQuery(this).parent().remove();
            }
        })
    }
    
    function bindColorPick(){
        (function($){
            $('.imColor').ColorPicker({
                onSubmit: function(hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                },
                onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            })
        })(jQuery);
    }
    
    function checkValid(str,valid){
        if(str==''){
            return false;
        }
    
        switch(valid){
            case 'str':
                var pattern = new RegExp('\\W+');
                return !pattern.test(str);
                break;
            case 'num':
                var pattern = new RegExp('\\D+');
                return !pattern.test(str);
                break;
            case 'free':
                return true;
                break;
            default:
                return false;
        }
    }
</script>