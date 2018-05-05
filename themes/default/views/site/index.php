<?php $this->renderPartial('/_include/header')?>

<!--广告-->
<?php $indexAd = Bagecms::getList('ad','index_ad',array('where'=>"status_is='Y' AND title_alias='index_banner'", 'order'=>'sort_order DESC'))?>
<div class="banner">
  <div class="bd">
    <ul>
	<?php foreach((array)$indexAd as $ad):?>
	<?php if($ad['link_url']):?>
     <li _src="url(<?php if($ad['image_url']):?><?php echo $ad['image_url']?><?php else:?><?php echo $this->_baseUrl?>/<?php echo $ad['attach_file']?><?php endif?>)" style="background:#DED5A1 center 0 no-repeat;"><a target="_blank" href="<?php echo $ad['link_url']?>"></a></li>
	 <?php else:?>
	 <li _src="url(<?php if($ad['image_url']):?><?php echo $ad['image_url']?><?php else:?><?php echo $this->_baseUrl?>/<?php echo $ad['attach_file']?><?php endif?>)" style="background:#DED5A1 center 0 no-repeat;"></li>
	<?php endif?>
	<?php endforeach?>
    </ul>
  </div>
  <div class="hd">
    <ul>
    </ul>
  </div>
  <span class="prev"></span><span class="next"></span></div>
<script type="text/javascript">
jQuery(".banner").hover(function(){jQuery(this).find(".prev,.next").stop(true,true).fadeTo(4000,0.5)},function(){jQuery(this).find(".prev,.next").fadeOut()});jQuery(".banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",autoPlay:true,autoPage:true,trigger:"click",startFun:function(i){var curLi=jQuery(".banner .bd li").eq(i);if(!!curLi.attr("_src")){curLi.css("background-image",curLi.attr("_src")).removeAttr("_src")}}});
</script>
<!--/广告-->



<div class="boxbg">
    <div class="index_box item-zq">
        <h1>
            全国范围接单，可个性化定制，只需您的一个电话，其他全部交给我们！ 　
        </h1>
        <div class="item-zq-scrm">
            <h5>
                <img src="<?php echo $this->_theme->baseUrl?>/images/gongzi.png">代办工资流水
            </h5>
            <p>
               代办全国工资流水，招商银行工资流水，建设银行工资流水，工商银行工资流水。
            </p>
        </div>
        <div class="item-zq-scrm">
            <h5>
                <img src="<?php echo $this->_theme->baseUrl?>/images/liushui.png">代办银行流水
            </h5>
            <p>
                代办全国银行流水，招商银行流水，建设银行流水，工商银行流水等半年或一年内的交易明细。
            </p>
        </div>
        <div class="item-zq-scrm">
            <h5>
                <img src="<?php echo $this->_theme->baseUrl?>/images/dingzhi.png">定制银行流水
            </h5>
            <p>
                全国银行流水定制，只有你想不到，没有办不到，欢迎咨询。
            </p>
        </div>
        <div class="item-zq-scrm">
            <h5>
                <img src="<?php echo $this->_theme->baseUrl?>/images/shouru.png">办理收入证明
            </h5>
            <p>
                代开收入证明、工资证明等，服务好，速度快，收费标准
            </p>
        </div>
    </div>
    <div class="btn-tf">
        <a  target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $this->_conf['_qq']?>&site=qq&menu=yes">我要办理</a>
    </div>
</div>



<div class="index">
<div class="module clear">
    <div class="wrap">
    <div class="moduleBox post">
        <div class="col">
            <h2>银行流水<em>NEWS</em></h2>
             </div>
        <div class="con">
            <ul>
                <?php foreach((array)Bagecms::getList('post','bank-statement',array('where'=>"status_is='Y' AND catalog_id=3",'order'=>'id DESC', 'limit'=>10)) as $newsKey=>$newsRow):?>
                    <li><em class="date"><?php echo date('m-d',$newsRow['create_time'])?></em><a href="<?php if($newsRow['redirect_url']):?><?php echo XUtils::convertHttp($newsRow['redirect_url'])?><?php else:?><?php echo $this->createUrl('post/show',array('id'=>$newsRow['id']))?><?php endif?>" target="_blank"><?php echo $newsRow['title']?></a></li>
                <?php endforeach?>
            </ul>
        </div>
    </div>

        <div class="moduleBox post">
            <div class="col">
                <h2>收入证明<em>NEWS</em></h2>
                </div>
            <div class="con">
                <ul>
                    <?php foreach((array)Bagecms::getList('post','income-certificate',array('where'=>"status_is='Y' AND catalog_id=2",'order'=>'id DESC', 'limit'=>10)) as $newsKey=>$newsRow):?>
                        <li><em class="date"><?php echo date('m-d',$newsRow['create_time'])?></em><a href="<?php if($newsRow['redirect_url']):?><?php echo XUtils::convertHttp($newsRow['redirect_url'])?><?php else:?><?php echo $this->createUrl('post/show',array('id'=>$newsRow['id']))?><?php endif?>" target="_blank"><?php echo $newsRow['title']?></a></li>
                    <?php endforeach?>
                </ul>
            </div>
        </div>


        <div class="moduleBox post">
            <div class="col">
                <h2>最新发布<em>NEWS</em></h2>
                <a href="<?php echo $this->createUrl('post/index')?>" class="move" target="_blank">更多</a> </div>
            <div class="con">
                <ul>
                    <?php foreach((array)Bagecms::getList('post','index_news',array('where'=>"status_is='Y' AND catalog_id=2",'order'=>'id DESC', 'limit'=>10)) as $newsKey=>$newsRow):?>
                        <li><em class="date"><?php echo date('m-d',$newsRow['create_time'])?></em><a href="<?php if($newsRow['redirect_url']):?><?php echo XUtils::convertHttp($newsRow['redirect_url'])?><?php else:?><?php echo $this->createUrl('post/show',array('id'=>$newsRow['id']))?><?php endif?>" target="_blank"><?php echo $newsRow['title']?></a></li>
                    <?php endforeach?>
                </ul>
            </div>
        </div>


    </div>
</div>
</div>




<!--/首页模块--> 
<!--商品-->

<div style="clear:both; margin-top: 50px"></div>
<div class="wrap clear ">
  <div class="indexGoods">
    <div class="col">
      <h2>案例展示<em>PRODUCT</em></h2>
      <a href="<?php echo $this->createUrl('post/index',array('catalog'=>'bank-water-picture'))?>" class="move" target="_blank">更多</a> </div>
    <div class="scrollBox">
      <div class="goodsImage">
        <ul class="list" >
          <?php foreach((array)Bagecms::getList('post','index_goods',array('where'=>"status_is='Y' AND catalog_id=6",'order'=>'id DESC', 'limit'=>8)) as $goodsKey=>$goodsRow):?>
          <li style="float: left; width: 162px; "><a href="<?php echo $this->createUrl('post/show',array('id'=>$goodsRow['id']))?>" target="_blank" title="<?php echo $goodsRow['title']?>"><img src="<?php echo $this->_baseUrl ?>/<?php echo $goodsRow['attach_thumb']?>" width="162" height="120" alt="<?php echo $goodsRow['title']?>"><span><?php echo $goodsRow['title']?></span></a></li>
          <?php endforeach?>
        </ul>
         </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(".indexGoods").slide({ mainCell:"ul", effect:"leftMarquee", vis:5, autoPlay:true, interTime:50, switchLoad:"_src" });	</script> 
<?php $this->renderPartial('/_include/footer')?>