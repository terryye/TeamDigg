<script type="text/javascript">
    function previewImage(file)
    {
        var MAXWIDTH  = 36;
        var MAXHEIGHT = 36;
        var div = document.getElementById('preview');
        if (file.files && file.files[0])
        {
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width = rect.width;
                img.height = rect.height;
                img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
            }
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else
        {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            var src = document.selection.createRange().text;
            div.innerHTML = '<img id=imghead>';
            var img = document.getElementById('imghead');
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
            div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";
        }
    }
    function clacImgZoomParam( maxWidth, maxHeight, width, height ){
        var param = {top:0, left:0, width:width, height:height};
        if( width>maxWidth || height>maxHeight )
        {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if( rateWidth > rateHeight )
            {
                param.width =  maxWidth;
                param.height = Math.round(height / rateWidth);
            }else
            {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }

        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }
</script>
<style>
    #preview{overflow:hidden;margin-right: 10px}
    #imghead {filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image);}
    #team_icon_preview {width:36px;height:36px;}
</style>
    <div class="form-group">
    {!! Form::label('team_name', '团队名称', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('text', 'team_name', old('team_name'), [$disabled, 'class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('team_icon', '团队图标', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div id="preview" class="pull-left" >
            <img src="{{$team->icon}}" id="team_icon_preview" width="36"  />
        </div>
        {!! Form::file('team_icon',['onchange'=>'previewImage(this, "team_icon_preview")',$disabled]) !!}
    </div>
</div>

<div class="form-group">
    <label for="team_intro" class="col-sm-2 control-label">团队介绍</label>
    <div class="col-sm-10">
        {!! Form::textarea('team_intro', old('team_intro'), [$disabled, 'class' => 'form-control','rows'=>3]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" {{$disabled}} onclick="this.disabled=true;this.innerHTML='正在保存中，请稍等。';this.form.submit();;">{{$submitButtonText}}</button>
    </div>
</div>