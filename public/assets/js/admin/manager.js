function addManager() {
    layer.open({
        type: 2,
        title: '添加管理员',
        maxmin: true,
        area: ['700px', '500px'],
        content: '/addmanager'
    });
}

function confirmAddManager(){
    var rolegroup = $.trim($("#rolegroup").val());
    var username = $.trim($("#username").val());
    var email =$.trim($("#email").val());
    var nickname=$.trim($("#nickname").val());
    var password = $.trim($("#password").val());
    var action = $.trim($("#action").val());
    var mangerid = $.trim($("#mangerid").val());
    var status = $.trim($("input[name='status']:checked").val());
    var data ={};
    var alertMsg = "";

    if( rolegroup =="" || rolegroup == 0){
        alertMsg = "所属组别不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.rolegroup = rolegroup;
    if( username ==""){
        alertMsg = "用户名不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.username = username;
    var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    if(!myreg.test(email)){
        alertMsg = "邮箱格式错误";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.email = email;
    if( nickname ==""){
        alertMsg = "昵称不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.nickname = nickname;
/*    if( password ==""){
        alertMsg = "密码不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }

    data.password = password;*/
    data.status=status

    if(action == "add"){
        addManagerAction(data);
    }else if(action == "edit"){
        if(mangerid !=""){
            data.mangerid=mangerid;
        }
        editManagerAction(data);
    }

}

function cancelManager() {
    parent.layer.closeAll();
    parent.location.href='/manager';
}

function addManagerAction(data){
    $.ajax({
        url: "/addmanager",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        ContentType: "application/json; charset=utf-8",
        data: data,
        success:function(result){
            if(result.code==0){
                parent.layer.closeAll();
                parent.location.href='/manager';
            }else{
                alertMsg = "添加失败";
                showMsg("alerts",failMsg(result.msg))
            }
        }
    });
}

function editManagerAction(data) {
    $.ajax({
        url: "/editmanager",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        ContentType: "application/json; charset=utf-8",
        data: data,
        success:function(result){
            if(result.code==0){
                parent.layer.closeAll();
                parent.location.href='/manager';
            }else{
                alertMsg = "添加失败";
                showMsg("alerts",failMsg(result.msg))
            }
        }
    });
}

function removeManager(id){
    var index = layer.confirm("删除的管理员不能恢复,请确认是否删除?",{
        title:"系统提示",
        icon:7,
        anim: 0,
        btn:["确定","取消"]
    },function(){
        $.ajax({
            url: "/delmanager",
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            ContentType: "application/json; charset=utf-8",
            data: {"id":id},
            success:function(result){
                if(result.code==0){
                    successTip("操作成功",1000);
                }else{
                    errorTip("删除失败",2000);
                }
                layer.close(index);
            }
        });
    },function(){
        errorTip("取消删除",2000);
        layer.close(index);
    });
}


function resetPassword(id) {
    var index = layer.confirm("是否初始化该用户密码为:123456",{
        title:"系统提示",
        icon:7,
        anim: 0,
        btn:["确定","取消"]
    },function(){
        $.ajax({
            url: "/resetpassword",
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            ContentType: "application/json; charset=utf-8",
            data: {"id":id},
            success:function(result){
                if(result.code==0){
                    successTip("操作成功",1000);
                }else{
                    errorTip("删除失败",2000);
                }
                layer.close(index);
            }
        });
    },function(){
        errorTip("重置密码取消",2000);
        layer.close(index);
    });
}

function editManager(id) {
    layer.open({
        type: 2,
        title: '编辑管理员',
        maxmin: true,
        area: ['700px', '500px'],
        content: '/editmanager?id='+id
    });
}

function confirmEditPassword() {
    var oldpassword = $.trim($("#oldpassword").val());
    var newpassword = $.trim($("#newpassword").val());
    var repeatpassword = $.trim($("#repeatpassword").val());
    var alertMsg = "";
    var data = {};

    if(oldpassword == ""){
        alertMsg = "旧密码不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.oldpassword = oldpassword;
    if(newpassword == ""){
        alertMsg = "新密码不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.newpassword=newpassword;
    if(repeatpassword == ""){
        alertMsg = "重复新密码不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.repeatpassword=repeatpassword;
    if(newpassword != repeatpassword ){
        alertMsg = "两次输入的新密码不相同";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }

    $.ajax({
        url: "/editpassword",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        ContentType: "application/json; charset=utf-8",
        data: data,
        success:function(result){
            if(result.code==0){
                parent.layer.closeAll();
            }else{
                alertMsg = "修改密码";
                showMsg("alerts",failMsg(result.msg))
            }
        }
    });


}

function cancelEditPassword() {
    parent.layer.closeAll();
}