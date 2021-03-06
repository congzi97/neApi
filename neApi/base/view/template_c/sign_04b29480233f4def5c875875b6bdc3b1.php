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


<div id="app" class="index">
    <div class="layout" :class="{'layout-hide-text': spanLeft < 5}">
        <Row type="flex">
            <i-col :span="spanLeft" class="layout-menu-left">
                <transition  name="custom-classes-transition"
                            enter-active-class="animated bounceInUp">
                <div v-if="false === loading">    
                        <i-menu active-name="1" width="auto">
                            <div class="layout-logo-left">
                                <div class="layout-left-title">
                                    <a href="/" style="display: inline-block;width: 100%;height: 100%;">
                                    NEApi PHP FrameWork
                                    </a>
                                </div>
                            </div>
                            <Menu-item name="huanjing">
                                <Icon type="ios-pulse" :size="iconSize"></Icon>
                                <span class="layout-text">环境要求</span>
                            </Menu-item>
                            <Menu-item name="huanjing">
                                <Icon type="ios-cog-outline" :size="iconSize"></Icon>
                                <span class="layout-text">安装程序</span>
                            </Menu-item>
                            <Menu-item name="info">
                                <Icon type="ios-information-outline" :size="iconSize"></Icon>
                                <span class="layout-text">配置说明</span>
                            </Menu-item>
                            <Menu-item name="jioacheng">
                                <Icon type="document" :size="iconSize"></Icon>
                                <span class="layout-text">教程/文档</span>
                            </Menu-item>  
                            <Menu-item name="cycle">
                                <Icon type="fork-repo" :size="iconSize"></Icon>
                                <span class="layout-text">生命周期/钩子</span>
                            </Menu-item>  
                            <Menu-item name="log">
                                <Icon type="refresh" :size="iconSize"></Icon>
                                <span class="layout-text">更新日志</span>
                            </Menu-item>      
                        </i-menu>
                        <Collapse accordion v-model="leftCollapse">
                            <Panel v-for="item,key in leftList">
                                {{item.title}}
                                <ul class="collapse-list" slot="content">
                                    <li v-for="li_item in item.list">
                                        <a :href="'/'+li_item.href+'.php'">
                                            <span>{{li_item.text}}</span>
                                            <Icon type="chevron-right"></Icon>
                                        </a>
                                    </li>
                                </ul>
                            </Panel>
                        </Collapse>
                    </div>
                </transition>
            </i-col>
            <i-col :span="spanRight">
                <transition  name="custom-classes-transition"
                            enter-active-class="animated fadeInRight">
                    <div class="layout-header" v-if="false === loading">
                        <i-menu mode="horizontal" theme="primary" active-name="1" on-select="menu_onSelect">
                            <div style="float: left;width: 10%;">
                                <i-button type="text"  @click="toggleClick" style="color: #fff;">
                                    <Icon type="navicon" size="32"></Icon>
                                </i-button>
                            </div>
                            <div style="float:left;width: 60%;text-align: center;color:#fff;font-size: 1.2rem;line-height: 60px;">
                                测试
                            </div>
                            <div class="layout-nav" style="float: right;width: 30%;">
                                <menu-item name="1">
                                    <Icon type="chatboxes" style="font-size: 1.5rem;float: left;padding-top: 18px;"></Icon>
                                    <span>交流</span>
                                </menu-item>
                                <menu-item name="2">
                                    <Icon type="social-github" style="font-size: 2rem;float: left;padding-top: 13px;"></Icon>
                                    开源
                                </menu-item>
                                <submenu name="3">
                                    <template slot="title">更多</template>
                                    <menu-group title="使用">
                                        <menu-item name="3-1">更多内容</menu-item>
                                    </menu-group>
                                    <menu-group title="哈哈">
                                        <menu-item name="3-4">更多内容</menu-item>
                                    </menu-group>
                                </submenu>
                            </div>
                        </i-menu>
                    </div>
                </transition>
                <div class="layout-breadcrumb">
                    <!-- <breadcrumb>
                        <Breadcrumb-item href="#">首页</Breadcrumb-item>
                        <Breadcrumb-item
                                v-for="item in breadcrumb"
                                href=" 'undefined' === typeof item.href ||  '' === item.href ? '#' : item.href "
                                v-html="item.text">
                        </Breadcrumb-item>
                    </breadcrumb> -->
                </div>
                <div class="layout-content">
                    <div class="layout-content-main">
                        <transition  name="custom-classes-transition"
                            enter-active-class="animated flipInY">
                            <div class="index-tip" v-if="true === loading">
                                hello 欢迎你<br/ >
                                正在载入...
                            </div>
                        </transition>
                        <transition  name="custom-classes-transition"
                            enter-active-class="animated flipInY"
                            leave-active-class="animated flipOutY">
                            <div v-if="false === loading"><?php echo NeApi\WebController::$vars['content'];?></div>
                        </transition>
                    </div>
                </div>
                <div class="layout-copy">
                    2017 &copy; NeApi PHP API FRAMEWORK
                </div>
            </i-col>
        </Row>
    </div>
</div>
<script>
    var _vm =  new Vue({
        el :'#app',
        data : {
            /**
             * 检查表单部分
             * [ruleCustom description]
             * @type {Object}
             */
            ruleCustom:{
                passwd: [
                    { required: true, message: '请输入密码', trigger: 'blur' },
                ],
                passwdCheck: [
                    { required: true, message: '请再次输入密码', trigger: 'blur' },
                ],
                email: [
                    { required: true, message: '邮箱不能为空', trigger: 'blur' },
                    { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
                ],
                verifyCheck: [
                    { required: true, message: '请输入验证码', trigger: 'blur' },
                ]
            },
            /**
             * 表单信息
             * [formCustom description]
             * @type {Object}
             */
            formCustom:{
                'email':'',
                'passwd':'',
                'passwdCheck':'',
                'verifyCheck':'',
                'emailVerifyCheck':''
            },
            formButton:{
                'loading':false,
                'text':'提交',
                'getVerify_loading':false,
                'getVerify_text':'获取验证码',
            },
            verify:'',
            total:'<?php echo NeApi\WebController::$vars['total'];?>',
            transitionName:'',
            leftCollapse:'<?php echo NeApi\WebController::$vars['leftCollapse'];?>',
            spanLeft: 5,
            spanRight: 19,
            breadcrumb:[],
            loading:true,
            leftList:[
                {'title':'公共组件','list':[
                    {'text':'数组操作','href':'read/1/1'},
                    {'text':'数据检查','href':'read/1/2'},
                    {'text':'颜色处理','href':'read/1/3'},
                    {'text':'加密数据','href':'read/1/4'},
                    {'text':'获取数据','href':'read/1/5'},
                    {'text':'日志操作','href':'read/1/6'},
                    {'text':'时间操作','href':'read/1/7'},
                    {'text':'XML操作','href':'read/1/8'},
                    {'text':'XXS操作','href':'read/1/9'},
                ]},
                {'title':'缓存组件','list':[
                    {'text':'Redis缓存','href':'read/2/1'},
                    {'text':'Memcached缓存','href':'read/2/2'},
                ]},
                {'title':'数据库组件','list':[
                    {'text':'MySQL PDO','href':'read/3/1'},
                ]},
                {'title':'文件组件','list':[
                    {'text':'文件基本操作','href':'read/4/1'},
                ]},
                {'title':'HTTP资源请求组件','list':[
                    {'text':'Request','href':'read/5/1'},
                    {'text':'Session','href':'read/5/2'},
                    {'text':'Sign','href':'read/5/3'},
                ]},
                {'title':'图片处理','list':[
                    {'text':'验证码','href':'/read/6/1'},
                    {'text':'基本处理','href':'/read/6/2'},
                ]},
            ]
        },
        computed: {
            iconSize :function() {
                return this.spanLeft === 5 ? 14 : 24;
            }
        },
        created:function(){
            var pathname = window.location.pathname;
            pathname = pathname.substring(1,pathname.length);
            var pathnameArr = pathname.split('.');
            if ( 'sign' === pathnameArr[0]) {
                this.onVerify();
            };
            this.$Loading.config({
                color: '#44CC00',
                failedColor: '#ff0000'
            });
            this.$Loading.start();
        },
        mounted : function(){
            this.$Loading.finish();
            var _vm = this;
            setTimeout(function(){
                _vm.loading = false;
                _vm.$Message.info({
                    content: '本次耗时:'+_vm.total+'秒',
                    duration: 5,
                    closable: true
                });
            },500)
        },
        methods: {
            onFetchVerify : function(){
                this.formButton.getVerify_loading = true;
                this.formButton.getVerify_text = '请稍候...';
                if ( '' === this.formCustom.email) {
                    this.$Message.error('请输入邮箱');
                    this.formButton.getVerify_loading = false;
                    this.formButton.getVerify_text = '获取验证码';
                    return;
                };
                if ( '' === this.formCustom.verifyCheck) {
                    this.$Message.error('请输入验证码');
                    this.formButton.getVerify_loading = false;
                    this.formButton.getVerify_text = '获取验证码';
                    return;
                };
                var _vm = this;
                $.ajax({
                    url:'/index/emailVerify',
                    type:'post',
                    data:_vm.formCustom,
                    dataType:'json',
                    success:function(data){
                        if ( 200 === data['code']) {
                            _vm.$Message.success(data['msg']);
                            _vm.formButton.getVerify_loading = true;
                            var time = 60;
                            _vm.formButton.getVerify_text = time;
                            var interval = setInterval(function(){
                                time--;
                                _vm.formButton.getVerify_text = time;
                                if ( 0 === time) {
                                    _vm.formButton.getVerify_loading = false;
                                    clearInterval(interval);
                                };
                            },1000)
                        }else{
                            _vm.$Message.error(data['msg']);
                            _vm.formButton.getVerify_loading = false;
                            _vm.formButton.getVerify_text = '获取验证码';
                        }
                    },
                    error:function(){
                        _vm.$Message.error('网络异常');
                        _vm.formButton.getVerify_loading = false;
                        _vm.formButton.getVerify_text = '获取验证码';
                    }
                })
            },
            onVerify : function(){
                var _vm = this;
                $.ajax({
                    url:'/index/verify',
                    type:'get',
                    dataType:'json',
                    success:function(data){
                        _vm.verify = data['data']['src'];
                    },
                    error:function(){

                    }
                })
            },
            menu_onSelect : function(name){
                console.log(name)
            },
            sign_handleSubmit  : function(name) {
                this.formButton.loading = true;
                this.formButton.text = '请稍候...';
                var _vm = this;
                this.$refs[name].validate(function(valid){
                    if (valid) {
                        //_vm.$Message.success('提交成功!');
                        $.ajax({
                            url:'/index/signPost',
                            type:'post',
                            data:_vm.formCustom,
                            success:function(res){

                            },
                            error:function(){

                            }
                        })
                    } else {
                        _vm.formButton.loading = false;
                        _vm.formButton.text = '提交';
                        _vm.$Message.error('表单验证失败!');
                    }
                })
            },
            sign_handleReset : function(name) {
                this.$refs[name].resetFields();
            },
            toggleClick :function() {
                if (this.spanLeft === 5) {
                    this.spanLeft = 2;
                    this.spanRight = 22;
                } else {
                    this.spanLeft = 5;
                    this.spanRight = 19;
                }
            }
        }
    })
</script>
<link rel="stylesheet" type="text/css" href="/static/css/animate.css">
<style>

    #sign .ivu-input-group-large .ivu-input, .ivu-input-group-large>.ivu-input-group-append, .ivu-input-group-large>.ivu-input-group-prepend{padding : 0px;height: 36px;}

    .sl-text {padding-left: 20px;}
    .sl-text p {font-size: 1.2rem;}

    ul.action-list{margin: 15px;}
    ul.action-list li {border-bottom: 1px solid #efefef;padding: 10px 8px;}
    ul.action-list li h3 {color: #495060;}
    ul.action-list li .explain {padding-left: 20px;padding-top: 10px;color: #5b6270;}
    ul.action-list li i {float: right;font-size: 15px;padding-top: 13px;}
    ul.action-list li a{display: inline-block;width: 100%;height: 100%;}

    .index .ivu-collapse-content-box {padding-top: 0px;padding-bottom: 8px;}
    .index .ivu-collapse-content {padding: 0;}
    ul.collapse-list {position: relative;}
    ul.collapse-list li {height: 40px;line-height: 40px;border-bottom: 1px solid #efefef;padding: 0 10px;}
    ul.collapse-list li span {float: left;}
    ul.collapse-list li i {float: right;font-size: 15px;padding-top: 13px;}
    ul.collapse-list li a{display: inline-block;width: 100%;height: 100%;}
    .index-tip {margin-top: 25%;width: 100%;text-align: center;font-size: 1.3rem;}

    .layout-left-title {text-align: center;font-size: 1.2rem;color: #fff;}
    .layout{
        border: 1px solid #d7dde4;
        background: #f5f7f9;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
    }
    .layout-breadcrumb{
        padding: 10px 15px 0;
    }
    .layout-content{
        height: 780px;
        margin: 15px 2%;width: 96%;
        overflow: auto;
        background: #fff;
        border-radius: 4px;position: relative;
    }
    .layout-content-main{
        padding: 10px;position: relative;
    }
    .layout-copy{
        text-align: center;
        padding: 10px 0 20px;
        color: #9ea7b4;
    }
    .layout-menu-left{
        background: #fff;
    }
    .layout-header{
        height: 60px;
        background: #fff;
        box-shadow: 0 1px 1px rgba(0,0,0,.1);
    }
    .layout-logo-left{
        width: 90%;
        height: 30px;
        border-radius: 3px;
        margin: 15px auto;
    }
    .layout-ceiling-main a{
        color: #9ba7b5;
    }
    .layout-hide-text .layout-text{
        display: none;
    }
    .ivu-col{
        transition: width .2s ease-in-out;
    }
</style>

</body>
</html>