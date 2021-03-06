<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo NeApi\WebController::$vars['title'];?></title>
    <!-- 先引入 Vue -->
    <script type="text/javascript" src="/static/dist/vue.js"></script>
    <link href="/static/dist/styles/iview.css" rel="stylesheet" type="text/css">
    <script src="/static/dist/iview.min.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/jsencrypt.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/crypt.js"></script>
</head>
<body>
<div id="app">
  <div>
    <div class="container demo-1">
      <div class="content">
        <div id="large-header" class="large-header">
          <canvas id="demo-canvas"></canvas>
          <!--<h1 class="main-title">-->
            <!--Connect  <span class="thin" >Server</span>-->
          <!--</h1>-->
        </div>
      </div>
    </div>
    <div v-if="'yes' === login">
        <v-list></v-list>
    </div>
    <!--显示登录界面-->
    <div v-else>
      <v-login :verify="verify" :done="loginDone"></v-login>
    </div>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="/static/index/css/component.css" />
<script src="/static/index/js/TweenLite.min.js"></script>
<script src="/static/index/js/EasePack.min.js"></script>
<script src="/static/index/js/demo-1.js"></script>
<script src="/vueComponent/login.js"></script>
<script src="/vueComponent/list.js"></script>
<script>
    
    new Vue({
        el:'#app',
        data : {
            login:'<?php echo NeApi\WebController::$vars['str_login'];?>',
            verify:'<?php echo NeApi\WebController::$vars['verify'];?>',
            total:'<?php echo NeApi\WebController::$vars['total'];?>',
            spinShow: true,
        },
        created:function(){
            this.$Loading.config({
              color: '#44CC00',
              failedColor: '#ff0000'
            });
            this.$Loading.start();
            this.$Message.info({
                content: '本次执行耗时:'+this.total,
                duration: 10,
                closable: true
            });
            if ('yes' === this.login){
                Vue.component('v-list',component_list);
            }else{
              Vue.component('v-login',component_login);
            }
        },
        mounted : function(){
            // Main
            initHeader();
            initAnimation();
            addListeners();
            this.$Loading.finish();
        },
        methods:{
            loginDone : function(code){
                if ( 200 === code){
                    this.login = 'yes';
                    Vue.component('v-list',component_list);
                }
            }
        }
    });
</script>
<style>

  .index-content {position: absolute;left: 20%;top: 20%;height: 60%;width: 60%;z-index: 99;}
  .index-content .i-c-bg {width: 100%;height: 100%;background: #000000;opacity: .6;position: absolute;z-index: 10;}
  .i-c-head {position: absolute;z-index: 20;width: 100%;text-align: center;background: #2d8cf0;color: #fff;padding: 10px 0;}
  .index-content .i-c-content{position: absolute;z-index: 20;padding: 10px;top: 80px;}


  .verify-from {position: relative;}
  .verify-from .verify-img{position: absolute;right: 0;top: 42px;}
  .verify-from .verify-img img {border-radius: 5px;}

  .login {position: absolute;left: 35%;top: 20%;height: 60%;width: 30%;z-index: 99;}
  .login .login-bg {width: 100%;height: 100%;background: #000000;opacity: .6;position: absolute;z-index: 10;}
  .login .login-content{position: absolute;z-index: 20;color: #fff;padding: 10px 0;width: 80%;left: 10%;right: 10%;}
  .login .login-content input {font-size: 1.2rem;}
  .login .login-content label {font-size: 1.4rem;}
  .login .login-content button {font-size: 1.2rem;}
  .login-head {position: absolute;z-index: 20;width: 100%;text-align: center;background: #2d8cf0;color: #fff;}
  .from {margin-top: 70px;}
  @media screen and (max-width: 727px){
    .login {position: absolute;left: 5%;top: 20%;height: 60%;right:5%;width: 90%;z-index: 99;}
    .login .login-bg {width: 100%;height: 100%;background: #000000;opacity: .6;position: absolute;z-index: 10;}
    .login .login-content{position: absolute;z-index: 20;color: #fff;padding: 10px 0;width: 80%;left: 10%;right: 10%;}
    .login-head {position: absolute;z-index: 20;width: 100%;text-align: center;background: #2d8cf0;color: #fff;}
    .from {margin-top: 70px;}
  }

</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title><?php echo NeApi\WebController::$vars['title'];?></title>
    <!-- 先引入 Vue -->
    <script type="text/javascript" src="/static/dist/vue.js"></script>
    <link href="/static/dist/styles/iview.css" rel="stylesheet" type="text/css">
    <script src="/static/dist/iview.min.js"></script>
    <script src="/static/js/jquery-3.2.1.min.js"></script>
    <script src="/static/js/jsencrypt.js"></script>
    <script src="/static/js/function.js"></script>
    <script src="/static/js/crypt.js"></script>
</head>
<body>
