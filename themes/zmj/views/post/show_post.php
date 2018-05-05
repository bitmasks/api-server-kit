<?php require_once __DIR__ . '/../_include/header.php'; ?>

<div class="placeholder-height"></div>
<div class="container" id="index">
    <div class="wrap-left pull-left">

        <div class="mod-info-flow">




            <div class="mod-b mod-art" data-aid="213665">

                    <h2> <?php  print_r($bagecmsShow->title); ?> d</h2>
                    <div class="mob-author">

                        <span class="">70时前</span>
                        <i class="icon icon-cmt"></i><em>14</em>
                        <i class="icon icon-fvr"></i><em>0</em>
                    </div>
                    <div class="mob-sub"><?php  print_r($bagecmsShow->content); ?></div>

            </div>



        </div>

    </div>
    <div class="wrap-right pull-right">
        <div class="right-ad-box"></div>

        <link rel="stylesheet" type="text/css" href="/themes/zmj/style/moment.css">
        <div id="moment"></div>
        <div class="box-moder moder-story-list">
            <h3>24小时</h3>
            <span class="pull-right project-more story-more">
                <a href="/?type=curr"  class="transition index-24-right js-index-24-right" target="_blank">查看全部</a>
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


