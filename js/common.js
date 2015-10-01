/**
 * Created by terryye on 14-5-10.
 */
// JavaScript Document
var CGI = {
    request:function (type, url, pars, callback) {

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

    get : function(ctl,action,pars,callback){
        var url = this.url(ctl,action, pars,"get")
        this.request('GET', url, callback );
    },
    post : function(ctl,action,pars,callback){
        var url = this.url(ctl,action,{},"post");
        this.request('POST', url, pars, callback);
    },
    url : function(ctl,action,pars,method){
        var r = [];
        pars = pars || {};
        method = method || 'get';
        action = action || '';
        pars._ = (new Date).getTime();

        if(method == "get"){
            //pars._c_ = "?";
            for (var k in pars) {
                r.push(k + "=" + pars[k]);
            }
        }

        var url = "./cgi/index.php?_pathinfo_="+ctl+"/"+action+"&"+r.join('&');
        return url;
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

var FORM = {
    //提示输入错误
    dealInputError : function(data){
        //先简单处理，仅提示第一个错误
        for(var k in data){
            MSG.alert(data[k]);
            break;
        }

    }
}
/*
var TPL = {
    toHtml : function(template, data){
        var bt = baidu.template;
        bt.LEFT_DELIMITER='<?';
        bt.RIGHT_DELIMITER='?>';
        bt.ESCAPE = false;
        return bt(template, data);
    },
    _cache:{},
    _getTplObj:function (name) {
        var domname = "using_" + name;
        if (!this._cache[name]) {
            var tplname = "tpl_" + name;
            this._cache[name] = {
                tpl:$("#" + tplname).html()
            }
        }
        return {
            dom : $("#" + domname),
            tpl : this._cache[name].tpl
        }
    },
    render:function (name, data) {
        var tplObj = this._getTplObj(name);
        var html = this.toHtml(tplObj.tpl, data);
        tplObj.dom.html(html);
        return html;
    },
    clearView : function(name){
        var tplObj = this._getTplObj(name);
        tplObj.dom.html("");
    },
    append:function (name, data) {
        var tplObj = this._getTplObj(name);
        var html = this.toHtml(tplObj.tpl, data);
        tplObj.dom.innerHTML+=html;
        return html;
    }
}
*/