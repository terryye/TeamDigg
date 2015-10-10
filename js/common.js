/**
 * Created by terryye on 14-5-10.
 */
// JavaScript Document
var CGI = {
    request:function (type, url, pars, callback) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            dataType : "json",
            async:true,
            type:type,
            data:pars,
            timeout:10*1000, //10s超时
            success:function(json){
                //-20000 ~ -10000为系统自动处理的错误码; CGI层的公共错误码。
                //-30000 表单验证错误
                console.log(json);
                if( (json.CODE <= -10000 && json.CODE >= -20000) || json.CODE == -99999){
                    MSG.alert(json.MSG);
                }else{
                    callback(json);
                }
            },
            error : function(){
                MSG.alert("请求出错，请稍后再试 ：）");
            }
        });
    },

    get : function(url, callback){
        this.request('GET', url, callback );
    },

    post : function(url,pars,callback){
        this.request('POST', url, pars, callback);
    }

};


//URL相关函数
var URL = {
    _v : function(_name,_string){
        var reg = new RegExp("(^|&)"+ _name +"=([^&]*)(&|$)");
        var r = _string.match(reg);
        return  (r!=null) ?  decodeURI(r[2]) : null;
    },
    getQueryParam : function (name)
    {
        return this._v(name, location.search.substr(1));
    },
    getHashParam : function (name)
    {
        return this._v(name, location.hash.substr(1));
    }
};

var MSG = {
    SYS_ERR_UNKNOW : "出现未知错误，请您稍后再试，或联系我们的管理员。",
    show:function (obj,cbaftershow) {
        obj.title = obj.title || "温馨提示";
        cbaftershow = cbaftershow || function(dlg){};
        seajs.use(['./js/artDlg/src/dialog'], function (dialog) {
            (function (_obj,_cbafershow) {

                /*
                 var d = dialog({
                 title: '消息',
                 content: '风吹起的青色衣衫，夕阳里的温暖容颜，你比以前更加美丽，像盛开的花<br>——许巍《难忘的一天》',
                 okValue: '确 定',
                 ok: function () {
                 var that = this;
                 setTimeout(function () {
                 that.title('提交中..');
                 }, 2000);
                 return false;
                 },
                 cancelValue: '取消',
                 cancel: function () {}
                 });
                 */
                var d = dialog(_obj);
                d.show();
                _cbafershow(d);

            })(obj, cbaftershow);
        });



    },
    alert:function(content){
        this.show({
            title:"温馨提示",
            content:content,
            okValue:'我知道了',
            ok : function(){}
        })
    },
    tips:function(content, callback, seconds){
        seconds = seconds || 2;
        seajs.use(['./js/artDlg/src/dialog'], function (dialog) {
            var d = dialog({
                content:content
            });
            d.show();
            setTimeout(function () {
                d.close().remove();
                if(typeof callback == "function") {
                    callback();
                }
            }, seconds * 1000);

        });
    }
};
