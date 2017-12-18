function addRole() {
    layer.open({
        type: 2,
        title: '添加管理员',
        maxmin: true,
        area: ['800px', '600px'],
        content: '/addrole'
    });
}

function editRole(id) {
    layer.open({
        type: 2,
        title: '编辑管理员',
        maxmin: true,
        area: ['800px', '600px'],
        content: '/editrole?id='+id
    });
}

function removeRole(id){
    var index = layer.confirm("删除的角色组不能恢复,请确认是否删除?",{
        title:"系统提示",
        icon:7,
        anim: 0,
        btn:["确定","取消"]
    },function(){
        $.ajax({
            url: "/delrole",
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
                    errorTip(result.msg,2000);
                }
                layer.close(index);
            }
        });
    },function(){
        errorTip("取消删除",2000);
        layer.close(index);
    });
}

function confirmAddRole() {
    var rolegroup = $.trim($("#rolegroup").val());
    var name = $.trim($("#name").val());
    var status = $.trim($("input[name='status']:checked").val());
    var action = $.trim($("#action").val());
    var roleid = $.trim($("#roleid").val());
    var data={};
    var menustr = "";

    if( rolegroup =="" ){
        alertMsg = "所属组别不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.rolegroup = rolegroup;
    if( name ==""){
        alertMsg = "角色名称不能为空";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.name=name;
    $.each($("#myTabContent").find("input[type='checkbox']"), function(index, val) {
        if($(this).prop('checked')){
            menustr += $(this).val()+","
        }
    });
    if(menustr == ""){
        alertMsg = "请选择相关权限菜单";
        showMsg("alerts",failMsg(alertMsg));
        return;
    }
    data.menustr = menustr;
    data.status = status;

    if(action == "add"){
        addRoleAction(data);
    }else if(action =="edit"){
        data.roleid = roleid;
        editRoleAction(data);
    }
}

function addRoleAction(data) {
    $.ajax({
        url: "/addrole",
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
                parent.location.href='/role';
            }else{
                alertMsg = "添加失败";
                showMsg("alerts",failMsg(result.msg))
            }
        }
    });
}
function  editRoleAction(data) {
    $.ajax({
        url: "/editrole",
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
                parent.location.href='/role';
            }else{
                alertMsg = "修改失败";
                showMsg("alerts",failMsg(result.msg))
            }
        }
    });
}

function cancelAddRole() {
    parent.layer.closeAll();
    parent.location.href='/role';
}