<!DOCTYPE html>

<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>芝麻街</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="renderer" content="webkit">
    <meta name="baidu-site-verification" content="R9XA5lWxu2">
    <meta name="author" content="芝麻街">
    <meta name="keywords" content="科技资讯,商业评论,明星公司,动态,宏观,趋势,创业,精选,有料,干货,有用,细节,内幕">
    <meta name="description" content="聚合优质的创新信息与人群，捕获精选|深度|犀利的商业科技资讯。在芝麻街，不错过互联网的每个重要时刻。">
    <link rel="stylesheet" type="text/css" href="/themes/zmj/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/themes/zmj/style/build.css">
    <link rel="stylesheet" type="text/css" href="/themes/zmj/style/activity.css">
    <link href="/themes/zmj/style/login.css" rel="stylesheet" type="text/css">
    <link href="/themes/zmj/style/zzsc.css" rel="stylesheet" type="text/css">
    <link href="/themes/zmj/style/dlzc.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript" src="/themes/zmj/style/jquery-1.11.1.min.js"></script>
    <script language="javascript" type="text/javascript" src="/themes/zmj/style/main.js"></script>
    <script language="javascript" type="text/javascript" src="/themes/zmj/style/popwin.js"></script>
    <link rel="stylesheet" type="text/css" href="/themes/zmj/style/nanoscroller.css">


</head>

<body>

<header id="top" role="banner" class="transition">
    <!--搜索弹窗 开始-->
    <div class="box">
        <div class="box2">
            <div class="icon icon-search-close js-show-search-box"><a class="close"></a></div>
            <div class="search-content overlay-dialog-animate">
                <div class="search-input">
                    <form role="search" method="get" action="" onsubmit="return checkinput()">
                        <button type="submit"></button>
                        <input placeholder="请输入关键字" name="s" id="search-input">
                    </form>
                </div>
                <!-- <div class="search-history  " id="history">
                     <span>我的搜索历史</span>
                     <ul class="transition" id="history_ul">
                         <li class="transition"><a
                                     href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#">数码</a></li>
                         <li class="transition"><a
                                     href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#">科技</a></li>
                         <li class="transition"><a
                                     href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#">科技</a></li>
                         <li class="transition"><a
                                     href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#">互联网</a>
                         </li>
                         <li class="transition"><a
                                     href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#">汽车之家</a>
                         </li>
                     </ul>
                     <div class="pull-right empty-history js-empty-history">清空历史</div>
                 </div>-->
                <div class="search-history search-hot">
                    <strong>热搜词</strong>
                    <ul>


                        <?php if (!empty($catalog) && is_array($catalog)) {
                            foreach ($catalog as $item) { ?>

                                <li class="transition">
                                    <a href="/?catalog=<?php echo $item['id']; ?>">
                                        <?php echo $item['catalog_name']; ?>
                                    </a>
                                </li>
                            <?php }  } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--搜索弹窗 结束-->
    <script>
        function checkinput() {
            var input = $("#search-input").val();
            if (input == null || input == '') {
                return false;
            }
            return true;
        }
    </script>
    <div class="container">
        <div class="navbar-header transition">
            <a href="#" title="首页"><img src="/themes/zmj/style/logo.jpg" alt="芝麻街" title="首页"></a>
        </div>
        <ul class="nav navbar-nav navbar-left" id="jsddm">
            <li class="nav-news js-show-menu">
                <a href="/?type=all">资讯 <span
                            class="caret"></span></a>
                <ul style="visibility: hidden;">
                    <?php if (!empty($catalog) && is_array($catalog)) {
                        foreach ($catalog as $item) { ?>

                            <li  >
                                <a href="/?catalog=<?php echo $item['id']; ?>"  target="_blank">
                                    <?php echo $item['catalog_name']; ?>
                                </a>
                            </li>
                        <?php }  } ?>
                </ul>
            </li>
            <style>
                #jsddm ul {
                    position: absolute;
                    visibility: hidden;
                    background: #fff;
                    width: 250px;
                    top: 60px;
                    left: -50px;
                    z-index: 9999;
                    box-shadow: 0 1px 15px rgba(18, 21, 21, .2);
                    padding: 10px 5px;
                }

                #jsddm ul li {
                    float: left;
                    width: 105px;
                    padding-left: 20px;
                    line-height: 40px;
                }
            </style>
            <li class="nav-news"><a href="/?type=hot" target="_blank">热议<span
                            class="nums-prompt nums-prompt-topic"></span></a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right transition  xiala main_nav">
            <li class="app-guide js-app-guide">
                <div class="app-guide-box">
                    <img src="/themes/zmj/style/1448211685.png">
                    <div class="app-guide-title">
                        <span>微信扫一扫</span><br>
                        <span>下载芝麻街APP</span>
                    </div>
                </div>
                <i class="icon icon-sm-phone"></i>APP下载<em class="guide-prompt"></em>
            </li>
            <li class="search-li js-show-search-box"><a><i class="icon icon-search "></i></a><span>搜索</span></li>
            <li class="login-link-box"><a class="cd-signin">登录</a></li>
            <li><a class="cd-signup">注册</a></li>
            <li><a class="cd-tougao">投稿</a></li>
        </ul>
    </div>
    <div class="cd-user-modal">
        <div class="cd-user-modal-container">
            <div id="cd-login"> <!-- 登录表单 -->
                <div class="modal-alert-title">登录芝麻街</div>
                <div class="register">
                    <div class="register-top" id="reg-top"><i><a id="qrcode"
                                                                 href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#"></a></i>
                    </div>
                    <div class="register-con" id="rc">
                        <div class="login-form username-box " style="margin-top:62px;">

                            <label class="login-label transition">
                                <input id="login_username" class="login-input" placeholder="手机号">
                            </label>
                            <label class="login-label">
                                <input id="login_password" class="login-input password" type="password"
                                       placeholder="输入6～24位密码">
                            </label>
                            <a class="js-label-select label-select-box hide login-label-select text-center"><span
                                        class="js-country-user">+86</span><i class="icon-modal icon-l-caret"></i></a>
                            <div class="login-operation">
                                <label><input id="autologin" type="checkbox">&nbsp;允许自动登录</label>
                                <a href="http://#/user/reset_password" class="js-forget-passward pull-right">忘记密码</a>
                            </div>
                            <button class="js-btn-login btn-login">登&nbsp;录</button>
                        </div>

                    </div>
                </div>
                <div class="saoma" id="sm">
                    <div class="qr-code" style="text-align:center">
                        <div class="title">微信登录</div>
                        <div class="waiting panelContent">
                            <div class="wrp_code"><img class="qrcode lightBorder"
                                                       src="/themes/zmj/style/150943753529.png"></div>
                            <div class="info">
                                <div class="status status_browser js_status" id="wx_default_tip">
                                    <p>请使用微信扫描二维码登录</p>
                                    <p>"芝麻街"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screen-tu" id="screen"></div>
                </div>
            </div>
            <div id="cd-signup"> <!-- 注册表单 -->
                <div class="modal-alert-title">极速注册</div>
                <div class="user-register-box">
                    <div class="login-form sms-box">
                        <label class="login-label col-xs-label transition"><input id="sms_username"
                                                                                  class="login-input username"
                                                                                  placeholder="手机号"></label>
                        <div class="geetest_login_sms_box">
                            <div id="geetest_1496454436837" class="gt_holder gt_float" style="touch-action: none;">
                                <div class="gt_slider">
                                    <div class="gt_guide_tip gt_show">按住左边滑块，拖动完成上方拼图</div>
                                    <div class="gt_slider_knob gt_show" style="left: 0px;"></div>
                                    <div class="gt_curtain_knob gt_hide">移动到此开始验证</div>
                                    <div class="gt_ajax_tip gt_ready"></div>
                                </div>
                            </div>
                        </div>
                        <label class="login-label captcha"><input id="sms_captcha" class="login-input"
                                                                  placeholder="输入6位验证码" maxlength="6">
                            <span class="js-btn-captcha btn-captcha">获取验证码</span></label>
                        <a class="js-label-select label-select-box text-center"><span
                                    class="js-country-sms">+86</span><i class="icon-modal icon-l-caret"></i></a>
                        <button class="js-btn-sms-login btn-login">注&nbsp;册</button>
                    </div>
                    <div class="js-user-login register-text">已有账号，立即登录</div>
                </div>
            </div>
            <a href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#0" class="cd-close-form ">关闭</a>
        </div>
    </div>

    <script src="/themes/zmj/style/d-login.js"></script>
    <div id="cd-signup"> <!-- 注册表单 -->
        <div class="modal-alert-title">极速注册</div>
        <div class="user-register-box">
            <div class="login-form sms-box">
                <label class="login-label col-xs-label transition"><input id="sms_username_2"
                                                                          class="login-input username"
                                                                          placeholder="手机号"></label>
                <div class="geetest_login_sms_box">
                    <div id="geetest_1496454436837" class="gt_holder gt_float" style="touch-action: none;">
                        <div class="gt_slider">
                            <div class="gt_guide_tip gt_show">按住左边滑块，拖动完成上方拼图</div>
                            <div class="gt_slider_knob gt_show" style="left: 0px;"></div>
                            <div class="gt_curtain_knob gt_hide">移动到此开始验证</div>
                            <div class="gt_ajax_tip gt_ready"></div>
                        </div>
                    </div>
                </div>
                <label class="login-label captcha"><input id="sms_captcha_2" class="login-input" placeholder="输入6位验证码"
                                                          maxlength="6">
                    <span class="js-btn-captcha btn-captcha">获取验证码</span></label>
                <a class="js-label-select label-select-box text-center"><span class="js-country-sms">+86</span><i
                            class="icon-modal icon-l-caret"></i></a>
                <button class="js-btn-sms-login btn-login">注&nbsp;册</button>
            </div>
            <div class="js-user-login register-text">已有账号，立即登录</div>
        </div>
    </div>
</header>