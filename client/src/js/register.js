require(["config"],function(){
    require(["jquery","idcode","validate","methods","md5"],function(){
        $(function(){
            //加载底部
            $(".foot").load("foot.html")
            $bflage=false;
            $.idcode.setCode();
            $("input").eq(2).bind("change",function(){
                if($.idcode.validateCode()){
                    $(this).next().text("输入正确") ;
                    $bflage=true;
                }else{
                    $(this).next().text("验证码不正确") ;
                    $bflage=false;
                }
            })
            $("#myform").validate({
                submitHandler : function(){
                    // console.log($(".checkbox").is(':checked'))
                    if($bflage) {
                        if ($(".checkbox").is(':checked')) {
                            $.ajax({
                                url: "../../server/register.php",
                                type: "post",
                                data: {
                                    uname: $("input").eq(0).val(),
                                    uphone: $("input").eq(1).val(),
                                    upwd: $.md5($("input").eq(3).val()),
                                },
                                dataType: "json",
                            }).then(function (result) {
                                if (result.status == 1) {
                                    alert("注册成功")
                                    window.location.href = "http://10.41.151.3/mecoxlane/client/src/login.html"
                                } else {
                                    console.log("注册失败")
                                }
                            })
                            return false;
                        } else {
                            alert("请阅读并同意注册协议")
                        }
                    }else{
                        alert("验证码错误")
                    }
                },
                rules : {
                    uname : {
                        'required' : true,
                        'rangelength' : [6, 18],
                        'checkUser' : true,
                        remote : {
                            type :"get",
                            url :"../../server/vicarifition.php",
                        }
                    },
                    uphone : {
                        'required' : true,
                        'rangelength' : [11, 11],
                        remote : {
                            type :"get",
                            url :"../../server/vicarifition.php",
                        }
                    },
                    upwd : {
                        'required' : true,
                        'rangelength' : [6, 18]
                    },
                    urpwd : {
                        equalTo : "#upwd"
                    },
                },
                messages : {
                    uname : {
                        required : "用户名必填",
                        rangelength : "用户名长度必须6-18之间",
                        remote : "该用户名已经被注册"
                    },
                    uphone : {
                        required : "手机号必填",
                        rangelength : "手机号码不合法",
                        remote : "该手机号已被注册"
                    },
                    upwd : {
                        required : "密码必填",
                        rangelength : "密码长度必须6-18之间"
                    },
                    urpwd : {
                        equalTo : '两次输入密码不一致'
                    },
                }
            })
            $.validator.addMethod("checkUser", function(val){
                return /^[a-zA-Z]+\w/.test(val);
            }, "用户名只能是数字,字母");
        })
    })
})