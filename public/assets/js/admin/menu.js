function addMenu() {
    layer.open({
        type: 2,
        title: '添加菜单',
        maxmin: true,
        area: ['700px', '550px'],
        content: '/addmenu'
    });
}

function editMenu(id) {
    layer.open({
        type: 2,
        title: '编辑菜单',
        maxmin: true,
        area: ['700px', '550px'],
        content: '/editmenu?id=' + id
    });
}

function removeMenu(id) {
    var index = layer.confirm("删除的菜单栏不能恢复,请确认是否删除?", {
        title: "系统提示",
        icon: 7,
        anim: 0,
        btn: ["确定", "取消"]
    }, function () {
        $.ajax({
            url: "/delmenu",
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            ContentType: "application/json; charset=utf-8",
            data: {"id": id},
            success: function (result) {
                if (result.code == 0) {
                    successTip("操作成功", 1000);
                } else {
                    errorTip(result.msg, 2000);
                }
                layer.close(index);
            }
        });
    }, function () {
        errorTip("取消删除", 2000);
        layer.close(index);
    });
}

function confirmAddMenu() {
    var ismenu = $("input[name='ismenu']:checked").val();
    var parentmenu = $.trim($("#parentmenu").val());
    var url = $.trim($("#url").val());
    var name = $.trim($("#name").val());
    var icon = $.trim($("#icon").val());
    var weigh = $.trim($("#weigh").val());

    var status = $.trim($("input[name='status']:checked").val());
    var action = $.trim($("#action").val());

    var data = {};
    var alertMsg = "";
    var buttonstr = "";

    if (parentmenu == "") {
        alertMsg = "请选择一级菜单";
        showMsg("alerts", failMsg(alertMsg));
        return;
    }

    if(ismenu == 1){
        if (name == "") {
            alertMsg = "请填写菜单或按钮名称";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.name = name;
        if (icon == "") {
            alertMsg = "请选择图标";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.icon = icon;

    } else if (ismenu == 2) {
        if (name == "") {
            alertMsg = "请填写菜单或按钮名称";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.name = name;
        if (url == "") {
            alertMsg = "请填写url";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.url = url;

        if (icon == "") {
            alertMsg = "请选择图标";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.icon = icon;

    } else if (ismenu == 3) {
        $.each($("#selectmenu").find('.btn'), function (index, val) {
            if ($(this).hasClass('btn-success')) {
                buttonstr += $(this).attr('data')+"#"+$(this).children('.text').html()+"#"+$(this).children("i").prop('class')+ ",";
            }
        });
        if(buttonstr == ""){
            alertMsg = "请选择按钮";
            showMsg("alerts", failMsg(alertMsg));
            return;
        }
        data.buttonstr=buttonstr;
    }

    data.parentmenu = parentmenu;
    data.ismenu = ismenu;
    data.weigh = weigh;
    data.status = status;

    if (action == "add") {
        addMenuAction(data)
    } else if (action == "edit") {
        data.id = $.trim($("#menuid").val());
        editMenuAction(data)
    }
}

function addMenuAction(data) {
    $.ajax({
        url: "/addmenu",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        ContentType: "application/json; charset=utf-8",
        data: data,
        success: function (result) {
            if (result.code == 0) {
                parent.layer.closeAll();
                parent.location.href = '/menu';
            } else {
                alertMsg = "添加失败";
                showMsg("alerts", failMsg(result.msg))
            }
        }
    });
}

function editMenuAction(data) {
    $.ajax({
        url: "/editmenu",
        type: 'POST',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        ContentType: "application/json; charset=utf-8",
        data: data,
        success: function (result) {
            if (result.code == 0) {
                parent.layer.closeAll();
                parent.location.href = '/menu';
            } else {
                alertMsg = "编辑失败";
                showMsg("alerts", failMsg(result.msg))
            }
        }
    });
}

function cancelAddMenu() {
    parent.layer.closeAll();
    parent.location.href = '/menu';
}

function searchIcon() {
    layer.open({
        type: 2,
        title: '搜索图标',
        maxmin: false,
        area: ['500px', '400px'],
        content: '/searchicon'
    });
}

function openButton(id) {
    $.each($(".table > tbody > tr"),function(index,val){
        if($(this).attr('item') == id){
            if($(this).hasClass('hidetr')){
                $(this).removeClass('hidetr')
            }else{
                $(this).addClass('hidetr')
            }
        }
    })

}


function filterDir(){
    if($("#dir").prop("checked")){
        $("#expectButton,#selecticon").show();
        $.each($(".form-group"), function(index, val) {
            if($(this).hasClass('dirmenu')){
                $(this).hide()
            }
            if($(this).hasClass('dir')){
                $(this).show()
            }
            if($(this).hasClass('menubutton')){
                $(this).hide()
            }
        });
    }
}

function filterMenu(){
    if($("#dirmenu").prop("checked")){
        $("#expectButton,#selecticon").show();
        $.each($(".form-group"), function(index, val) {
            if($(this).hasClass('dirmenu')){
                $(this).show()
            }
            if($(this).hasClass('dir')){
                $(this).hide()
            }
            if($(this).hasClass('menubutton')){
                $(this).hide()
            }
        });
    }
}


function filterButton(){
    if($("#menubutton").prop("checked")){
        $("#expectButton,#selecticon").hide();
        $.each($(".form-group"), function(index, val) {
            if($(this).hasClass('dirmenu')){
                $(this).hide()
            }
            if($(this).hasClass('dir')){
                $(this).hide()
            }
            if($(this).hasClass('menubutton')){
                $(this).show()
            }
        });
    }
}