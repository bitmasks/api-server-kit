<?php require_once __DIR__ . '/../_include/header.php'; ?>

<div class="placeholder-height"></div>
<div class="container" id="index">
    <div class="wrap-left pull-left">
        <div class="big-pic-box">
            <div class="big-pic">
                <a href="/index.php?r=post/show&id=<?php echo $hot['0']['id'] ?>" target="_blank"
                   class="transition" title="<?php echo $hot['0']['title'] ?>">
                    <div class="back-img"><img src="<?php echo $hot['0']['attach_thumb'] ?>"
                                               style="width: 533px ;height: 400px;"
                                               alt="<?php echo $hot['0']['title'] ?>"></div>
                    <div class="big-pic-content">
                        <h1 class="t-h1"><?php echo $main['0']['title'] ?></h1>
                    </div>
                </a>
            </div>
            <div class="big2-pic big2-pic-index big2-pic-index-top">
                <a href="/index.php?r=post/show&id=<?php echo $main['0']['id'] ?>" class="back-img transition"
                   target="_blank" title="<?php echo $main['0']['title'] ?>">
                    <img class="lazy" src="<?php echo $main['0']['attach_thumb'] ?>"
                         style="width: 257px ;height: 195px;">
                </a>
                <a href="/index.php?r=post/show&id=<?php echo $main['0']['id'] ?>" target="_blank"
                   title="<?php echo $main['0']['title'] ?>">
                    <div class="big2-pic-content">
                        <h2 class="t-h1"><?php echo $main['0']['title'] ?></h2>
                    </div>
                </a>
            </div>
            <div class="big2-pic big2-pic-index big2-pic-index-bottom">
                <a href="/index.php?r=post/show&id=<?php echo $curr['0']['id'] ?>" class="back-img transition"
                   target="_blank" title="<?php echo $curr['0']['title'] ?>">
                    <img class="lazy" src="<?php echo $curr['0']['attach_thumb'] ?>"
                         style="width: 257px ;height: 195px;">
                </a>
                <a href="/index.php?r=post/show&id=<?php echo $curr['0']['id'] ?>" target="_blank">
                    <div class="big2-pic-content">
                        <h2 class="t-h1"><?php echo $curr['0']['title'] ?></h2>
                    </div>
                </a>
            </div>
        </div>
        <div class="mod-info-flow">


            <?php if (!empty($main) && is_array($main)) { ?>
                <?php foreach ($main as $item) { ?>

                    <div class="mod-b mod-art" data-aid="213665">
                        <?php if ($item['view_count'] > 13) { ?>
                            <div class="mod-angle">热</div><?php } ?>
                        <div class="mod-thumb ">
                            <a class="transition" title="<?php echo $item['title'] ?>"
                               href="/index.php?r=post/show&id=<?php echo $item['id'] ?>" target="_blank">
                                <img class="lazy" src="<?php echo $item['attach_thumb'] ?>"
                                     alt="<?php echo $item['title'] ?>">
                            </a>
                        </div>
                        <!-- <div class="column-link-box">
                             <a href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#" class="column-link"
                                target="_blank">娱乐淘金</a>
                         </div>-->
                        <div class="mob-ctt">
                            <h2><a href="/index.php?r=post/show&id=<?php echo $item['id'] ?>"
                                   class="transition msubstr-row2" target="_blank"><?php echo $item['title'] ?></a></h2>
                            <div class="mob-author">
                                <!-- <div class="author-face">
                                     <a href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#" target="_blank"><img
                                                 src="/themes/zmj/style/59_1502432173.jpg"></a>
                                 </div>-->
                                <!--<a href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#" target="_blank">
                            <span class="author-name "><?php /*echo $item['author'] */ ?></span>
                        </a>
                        <a href="http://#/preview/563156/2017-09-30/%E7%BD%91%E9%A1%B5/index.html#" target="_blank"
                           title="购买VIP会员"></a>-->
                                <span class="time"><?php echo intval((time() - $item['create_time']) / (60 * 60 * 20)) ?>
                                    小时前</span>
                                <i class="icon icon-cmt"></i><em><?php echo $item['view_count'] ?></em>
                                <i class="icon icon-fvr"></i><em><?php echo $item['favorite_count'] ?></em>
                            </div>
                            <div class="mob-sub"><?php echo $item['title'] ?></div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
        <div class="get-mod-more js-get-mod-more-list transition" data-cur_page="1" data-last_dateline="1504655833">

            <?php if (isset($_GET['page']) && $_GET['page']) {
                $page = $_GET['page'] + 1;
            } else {
                $page = 2;
            } ?>
            <a href="/?page=<?php echo $page; ?>"> 点击加载更多 </a>
        </div>
    </div>
    <div class="wrap-right pull-right">
        <div class="right-ad-box"></div>

        <link rel="stylesheet" type="text/css" href="/themes/zmj/style/moment.css">
        <div id="moment"></div>
        <div class="box-moder moder-story-list">
            <h3>24小时</h3>
            <span class="pull-right project-more story-more">
                <a href="/?type=curr" class="transition index-24-right js-index-24-right" target="_blank">查看全部</a>
            </span>
            <span class="span-mark"></span>
            <div class="story-box-warp hour-box-warp">
                <div class="nano">
                    <div class="overthrow nano-content description" tabindex="0">
                        <ul class="box-list mt-box-list">
                            <!--公共24小时列表部分-->


                            <?php if (!empty($hot) && is_array($hot)) { ?>
                                <?php foreach ($hot as $item) { ?>
                                    <li>
                                        <div class="story-content">
                                            <div class="mt-story-title js-story-title" story-data-show="true">
                                                <p class="transition hour-arrow">
                                                    <span class="icon icon-caret js-mt-index-icon"></span>
                                                </p>
                                                <ul class="hour-head">
                                                    <li><img class="hour-tx" src="<?php echo $item['attach_thumb'] ?>"
                                                             alt="头像"></li>
                                                    <li>
                                                        <p><?php echo $item['author'] ?></p>
                                                        <p><?php echo intval((time() - $item['create_time']) / (60 * 60 * 20)) ?>
                                                            分钟前</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="mt-index-info-parent">
                                                <div class="story-info mt-story-info">
                                                    <p class="story-detail-hide hour-detail-hide mt-index-cont mt-index-cont2 js-mt-index-cont2">
                                                        #<?php echo $item['intro'] ?><a
                                                                href="/index.php?r=post/show&id=<?php echo $item['id'] ?>"
                                                                target="_blank" class="mt-index-cont2-a">[&nbsp;原文&nbsp;]</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>


                        </ul>
                    </div>
                    <div class="nano-pane">
                        <div class="nano-slider" style="height: 179px; transform: translate(0px, 0px);"></div>
                    </div>
                </div>
            </div>
            <div class="js-more-moment" data-cur_page="0"></div>
        </div>
        <div class="placeholder"></div>
        <!--24小时部分结束1-->
        <!--<div class="ad-wrap">
            <div class="ad-title">广告</div>
        </div>-->
        <div class="placeholder"></div>
        <div class="placeholder"></div>
        <div class="box-moder hot-article">
            <h3>热文</h3>
            <span class="span-mark"></span>
            <ul>


                <?php if (!empty($hot) && is_array($hot)) { ?>
                    <?php foreach ($hot as $item) { ?>
                        <li>
                            <div class="hot-article-img">
                                <a href="/index.php?r=post/show&id=<?php echo $item['id'] ?>" target="_blank"
                                   title="<?php echo $item['title'] ?>">
                                    <img src="<?php echo $item['attach_thumb'] ?>">
                                </a>
                            </div>
                            <a href="/index.php?r=post/show&id=<?php echo $item['id'] ?>" class="transition"
                               target="_blank"><?php echo $item['title'] ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>


            </ul>
        </div>
        <div class="placeholder"></div>
    </div>
</div>


<?php require_once __DIR__ . '/../_include/footer.php'; ?>
