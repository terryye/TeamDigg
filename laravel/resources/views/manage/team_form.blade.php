<div class="form-group">
    <label for="team_name" class="col-sm-2 control-label">团队名称</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="team_name" value="{{old('team_name')}}">
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">团队图标</label>
    <div class="col-sm-10">
        <img src="{{asset('img/icon.jpeg')}}" width="36" class="pull-left" style="margin-right: 10px" />
        <input type="file" name="team_icon">
    </div>
</div>
<div class="form-group">
    <label for="team_intro" class="col-sm-2 control-label">团队介绍</label>
    <div class="col-sm-10">
        <textarea name="team_intro" class="form-control" rows="3">{{old('team_intro')}}</textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" onclick="this.disabled=true;this.innerHTML='正在创建，请稍等。';this.form.submit();;">{{$submitButtonText}}</button>
    </div>
</div>