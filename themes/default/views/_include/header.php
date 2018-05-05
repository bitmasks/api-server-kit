<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $this->_seoTitle ?></title>
    <meta name="keywords" content="<?php echo $this->_seoKeywords ?>">
    <meta name="description" content="<?php echo $this->_seoDescription ?>">
    <link rel="stylesheet" href="<?php echo $this->_theme->baseUrl ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $this->_theme->baseUrl ?>/css/base.css">
    <link rel="stylesheet" href="<?php echo $this->_theme->baseUrl ?>/css/page.css">


    <?php Yii::app()->clientScript->registerCoreScript('jquery', CClientScript::POS_END); ?>
    <script type="text/javascript" src="<?php echo $this->_baseUrl ?>/static/js/jquery.SuperSlide.2.1.js"></script>
</head>
<body>
<div class="container">
    <!--头-->
    <div id="header" class="header">
        <div class="wrap">
            <div class="floatL" style="width: auto;height: 90px;line-height: 90px;color: #ff661e;">
                <a href="/"><h1 style="display: block;font-size: 30px;"><?php echo $this->_conf['site_name'] ?></h1></a>
            </div>
            <div class="nav floatL" style="float: right">
                <div class="clear">
                    <dl class="tnLeft">

                        <?php foreach ($_SESSION['nav'] as $k => $v) { ?>
                            <dd>
                                <h3><a href="<?php echo $v['link'] ?>"><?php echo $v['name'] ?></a></h3>
                            </dd>
                        <?php } ?>
                    </dl>
                </div>
            </div>
            <script type="text/javascript">jQuery(".nav").slide({
                    type: "menu",
                    titCell: "dd",
                    targetCell: "ul",
                    delayTime: 0,
                    defaultPlay: false,
                    returnDefault: true
                });    </script>
        </div>
    </div>
    <!--/头-->



