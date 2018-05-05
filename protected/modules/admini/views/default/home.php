<?php $this->renderPartial('/_include/header');?>

<table class="content_list">
 <thead>  <tr >
    <td >备忘录(记录未完成或待办事宜)<span id="notebookMessage"></span></td>
  </tr>
   </thead>
  <tr>
    <td><textarea name="notebook" cols="80" rows="6" id="notebook" onblur="updateNotebook()" > <?php echo $notebook->notebook?></textarea></td>
  </tr>
</table>
<table class="content_list">
  <thead>
    <tr >
      <td colspan="2" class="tbTitle">系统信息</td>
    </tr>
  </thead>
   
   
  <tr>
    <td >常用工具</td>
    <td ><a href="http://tongji.baidu.com/web/welcome/ico?s=b04fe068a40baad05137f45db7dfc9fc" target="_blank">百度统计 </a><a href="http://seo.chinaz.com/www.dblszd.com" target="_blank">站长工具</a></td>
  </tr>
  
  <tr>
    <td >数据库及大小</td>
    <td ><?php echo $server['mysqlVersion']?> (<?php echo $server['dbsize']?>)</td>
  </tr>
  <tr>
    <td >上传许可</td>
    <td ><?php echo $server['fileupload']?></td>
  </tr>
  
  <tr>
    <td >当前使用内存</td>
    <td ><?php echo $server['excuteUseMemory']?></td>
  </tr>
 
</table>
<script language="javascript"> 
<!-- 
function updateNotebook()
{
  $("#notebookMessage").fadeIn(2000);
  $("#notebookMessage").html('<span style="color:#FF0000"><img src="<?php echo $this->_baseUrl?>/static/admin/images/loading.gif" align="absmiddle">正在更新数据...</span>'); 
  $.post("<?php echo $this->createUrl('notebookUpdate')?>",{notebook:$('#notebook').val()},function(response){
      if(response.state == 'success'){
          $("#notebookMessage").html('<span style="color:#FF0000">'+response.message+'</span>'); 
      }else{
          alert(response.message);
      }
      $("#notebookMessage").fadeOut(2000);  
  }, 'json');

}
//--> 
</script>
<!--检测系统最新版本及安全补丁-->
<script language="javascript" src="http://www.bagesoft.cn/upgrade/version?text=<?php echo $env?>" charset="UTF-8"></script>
<?php $this->renderPartial('/_include/footer');?>
