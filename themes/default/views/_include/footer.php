<div class="siteInfo clear">
  <div class="wrap">
    <div class="box">
      <h2 class="title">联系我们</h2>
      <div class="action">
        <p class="home"><?php echo $this->_conf['_address']?></p>
        <p class="mobile"><?php echo $this->_conf['_mobile']?></p>
        <p class="email"><?php echo $this->_conf['admin_email']?></p>
      </div>
    </div>
    <div class="box paddLeft">
      <h2 class="title">快速导航</h2>
      <div class="action">   <a href="<?php echo $this->createUrl('page/show',array('name'=>'about'))?>">代办银行流水</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'cultural'))?>">代开收入证明</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'team'))?>">代办工资流水</a> <a href="<?php echo $this->createUrl('page/show',array('name'=>'contact'))?>">联系我们</a> </div> 
      <div class="clear"></div>
    </div>
    <div class="box paddLeft">
      <h2 class="title">微信二维码</h2>
      <div class="action"> <img src="<?php echo $this->_baseUrl?>/static/images/ma.png" width="100" height="100" /></div>
    </div>
    <div class="clear"></div>
    
        </p>
    </div>
  </div>
</div>
</div>
</body>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?b04fe068a40baad05137f45db7dfc9fc";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</html>
      <div class="clear"></div>
    </div>
  </div>
</div>
</div>
<div id="footer">
  <div class="wrap clear">
    <div class="act"><p>&nbsp;</p>
      <p><?php echo $this->_conf['site_copyright']?>&nbsp;&nbsp;&nbsp;<?php if($this->_conf['site_icp']):?>( <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $this->_conf['site_icp']?></a> ) <?php endif?><?php echo $this->_conf['site_stats']?></p>
        <p>  友情链接:  <?php foreach((array)Bagecms::getList('link','_link',array('where'=>"status_is='Y' ",'order'=>'id DESC', 'limit'=>100)) as $link):?> <a href="<?php echo $link['site_url']?>" title="<?php echo $link['site_name']?>">  <?php echo $link['site_name']?></a>  <?php endforeach?>
        </p>
    </div>
  </div>
</div>
</div>
</body>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?b04fe068a40baad05137f45db7dfc9fc";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</html>