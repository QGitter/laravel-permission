function successMsg(str){
    return "<div class ='alert alert-success alert-block'><i class='fa fa-check-circle'></i>&nbsp;&nbsp;"+str+"</div>";
}

function failMsg(str){
    return"<div class ='alert alert-block alert-danger'><i class='fa fa-minus-circle'></i>&nbsp;&nbsp;"+str+"</div>";
}
function showMsg(id,string){
    if($("#"+id).css('display') == "none"){
        $("#"+id).html(string)
        $("#"+id).show()
    }else{
        $("#"+id).html(string)
    }
}
function hideMsg(id){
    if($("#"+id).css('display') == "block"){
        $("#"+id).hide()
    }
}
function successTip(str,time){
    var index = layer.msg('操作成功！', {time:time,icon: 1},function(){
        window.location.reload();
    });
};

function errorTip(str,time){
    var index = layer.msg(str, {time:time,icon: 7},function(){
        window.location.reload();
    });
};
