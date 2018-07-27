require(["config"],function() {
    require(["jquery","cookie"], function () {
        $(function () {
            //回到首页
            $(".backs").on("click",function(){
                if($(this).css("top")=="0px"){
                    window.location.href="http://10.41.151.3/mecoxlane/client/src/mecoxlane.html"
                }
            })
            //导航效果
            $(".nav li").on("mouseenter", function () {
                $(".backs").show().css("top", $(this).index() * 56)
            })
            $(".nav ").on("mouseleave", function () {
                $(".backs").hide()
            })
            //回到顶部
            $("#gotop").on("click", function () {
                $("html,body").animate({scrollTop: 0}, 500);
                $("#gotop").fadeTo(500, 0)
            })
            //滚轮事件
            $(document).on("mousewheel DOMMouseScroll", function (e) {
                // console.log($("html,body").scrollTop())
                if ($("html,body").scrollTop() < 1) {
                    $("#gotop").fadeTo(200, 0)
                } else {
                    $("#gotop").fadeTo(200, 1)
                }
            })
            //头部移入移出效果
            $(".header div a").hover(function () {
                $(this).css("color", "gray")
            }, function () {
                $(this).css("color", "black")
            })
            //获取当前地址
            str=window.location.href
            console.log(str)
            $("#logins").attr("href",`http://10.41.151.3/mecoxlane/client/src/login.html?url=${str}`)
            // $("#logins").on("click",function(){
            //     window.location.href=`http://10.41.151.3/mecoxlane/client/src/login.html?url=${str}`
            // })
            //加载是否登录
            var users = JSON.parse(sessionStorage.getItem("users") || '{}');
            if(users.uname){
                $("#logins").text(`欢迎${users.uname}`).attr("href","javascript:void(0);").css("color","black")
                $("#logins").next().text("退出").attr("href","javascript:location.reload()").css("color","black").on("click",function(){
                    sessionStorage.removeItem("users");
                })
            }
            var users = JSON.parse(sessionStorage.getItem("users") || '{}');
            //登陆以后cookie和数据库同步
            if(users.uname) {
                var cartArr=JSON.parse($.cookie("carts")||"[]");
                for(var i in cartArr){
                    cartArr[i].uname=users.uname;
                    $.ajax({
                        "type":"post",
                        "url":"../../server/addCart.php",
                        "data":cartArr[i],
                        "dataType":"json",
                    })
                }
                $.cookie("carts","[]")
            //购物车数量信息
                $.ajax({
                    type:"post",
                    url:"../../server/carts.php",
                    data:{
                        "uname":users.uname,
                    },
                    dataType:"json",
                }).then(function(back){
                    if(back.status){
                        $n=0;
                        for(var key in back.data){
                            $n=back.data[key].g_nums-0+$n;
                        }
                        $("#nums").text($n)
                    }
                })
            }else{
                var cartList=JSON.parse($.cookie("carts")||"[]")
                var nums=0;
                for(var i in cartList){
                    nums+=(cartList[i].nums-0)
                }
                $("#nums").text(nums)
            }
            //去购物车结算
            $(".gotocarts").on("click",function(){
                window.location.href="http://10.41.151.3/mecoxlane/client/src/shoppingCart.html"
            })

        })
    })
})