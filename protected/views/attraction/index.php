<?php
/* @var $this AttractionController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');

$this->breadcrumbs = array($relations['name']=>array($relations->tableName().'/index', 'cid'=>$dataProvider['parent_id']),
                           $dataProvider['name']);
?>
<script type="text/html" id="new-photo-li">
    <li class="summary-list-first">
		<a title="" href=""><img border="0" alt="" src="{web_file}" style="width: 100px;height: 70px;"></a>
		<h3><a title="" href=""></a></h3>
	</li>
</script>
<script type="text/javascript">
$(function(){
	$('.arrived').click(function(){
 	  //alert($(this).attr('id'));
 	  visitor($(this).attr('id'));
	});

});
function visitor(id){
               $.ajax({
                'url':'<?php echo Yii::app()->createUrl('attraction/arrivedAttraction'); ?>',
                'type':'post',
                'data':'id='+id,
                'dataType':'json',
                'success':function(data){
                    if(data.status == 'success')
                    {
                        $('#is_to').remove();
                        var num = $('.played .orange').text();
                        $('.orange').text(parseInt(num)+1);
                         var played_people_img = $(".played-people a");
                        var played_people = $(".played-people");
                        if(played_people_img.size()<6){
                            played_people.append(data.msg);
                        }
                    }
                },
                'error':function(){
                    alert('error');
                }
            });
}

</script>
<script type="text/javascript">
$(function(){
     $(".add-new-photo").ZYXlightbox({
        width:600,
        height:'auto',
		type:'click',
        title:'',
        contentId:'new-edition',
        boxClass:'lightBox new-photo',
        contentType:'inline',
    	onShow:function($stage, element, box){
    	$("#uploader-close").click(function(){
                    box.close();
                })
		$stage.find('#test').uploader({
			serverUrl:'/up.php',
			//serverUrl:'http://www.sgc.zyx.com/up.php',
			myClickDown:function(data){

				$('#'+element.data('for')).append($.extendObj(data,$('#new-photo-li').html()));
			}
		});
	}
    });
})

$(function(){
	$('#content-1').click(function(){
        var content = $('#comment-txt-9').val();
        var attraction_id = $(this).attr("attraction-id");
		addAttraction(0, content, attraction_id);
		return false;
	});

	$('.send-comment-4').click(function(){
	    var parent_id = $(this).attr("data-id");
        var content = $('#comment-txt-4').val();
        var attraction_id = $(this).attr("attraction-id");
		addAttraction(parent_id, content, attraction_id);
		return false;
	});

    $(".reply-comment").each(function(i){
        $(this).click(function(){
            var id = $(this).attr("id");
            var comment = $(".comment-form-wrap .send-comment-4");
            comment.attr("data-id",id);
            // alert(comment.attr("data-id"));
            $.popwin.show({content:'#comment-form-2'});
        })
    });
});
function addAttraction(parent_id, content, attraction_id){
               var csrfToken = $('#csrfToken').val() ;
               $.ajax({
                'url':'<?php echo Yii::app()->createUrl('attraction/addAttraction'); ?>',
                'type':'post',
                'dataType':"json",
                'data':'parent_id='+parent_id+'&content='+content+'&attraction_id='+attraction_id+'&YII_CSRF_TOKEN='+csrfToken,
                'success':function(json){
                    if(json.code == 1)
                    {
                        $("#comment-txt-9").val("");
                        $("#comment-txt-4").val("");
                        msgBoxShow(1, json.msg);
                        window.location.reload();
                    }else{
                        msgBoxShow(0, json.msg);
                    }
                },
                'error':function(){
                    alert('error');
                }
            });
}
</script>

<div class="undis" id="comment-form-2" style="width: 650px;height: 300px;">
  <div class="comment-form-wrap">
    <form>
      <textarea id="comment-txt-4"></textarea>
      <a class="btn send-comment-4" href="javascript:void(0)" data-id="" attraction-id="<?php echo $model['attraction_id']; ?>">评论</a>
    </form>
  </div>
</div>
<div class="summary box">
  <div class="summary-wrap"> <img src="<?php echo '/thumb/250_180/'.$dataProvider['image']; ?>" alt="<?php echo $dataProvider['name']; ?>"  class="city-img"/>
    <div class="details" style="height: 230px;">
      <div class="summary-title"><span class="yahei"><?php echo $dataProvider['name']; ?></span><a href="<?php echo $this->createUrl('attraction/view',array('cid'=>$_GET['cid'],'id'=>$dataProvider->attraction_id)); ?>"><?php echo Yii::t('info', '更多详情'); ?>>></a></div>
      <p><?php echo mb_substr($dataProvider['description'], 0, 150).'...'; ?></p>
      <div class="play-wrap">
        <p class="rank">在<span><?php echo $others['parentName']; ?></span>的<span><?php echo $others['allAttractions']; ?>个景点中</span>排名第<span class="orange"><?php echo $others['currentOrder']; ?></span></p>
        <p class="played">已经有<span class="orange"><?php echo $dataProvider->visitorCount; ?></span>人去玩过了： <span id="is_to">
          <?php if(U_ID){ ?>
          <?php if(!$dataProvider->visitor){ ?>
          <a class="arrived btn" id="<?php echo $dataProvider['attraction_id']; ?>">我去过了</a>
          <?php }} ?>
          </span> </p>
        <p class="played-people">
          <?php foreach($others['customer'] as $item){ ?>
          <a href="<?php echo Dynamic::goUrl($item->customer['customer_id'],'center'); ?>"><img src="<?php echo '/thumb/22_22/'.$item->customer['avator']; ?>" alt="" /></a>
          <?php }if($others['sum'] == 6){ ?>
          <a><img src="/images/destination_more_small_2.jpg'; ?>" alt="" class="last" /></a>
          <?php } ?>
        </p>
      </div>
    </div>
  </div>
  <div class="summary-attractions zyxbox mt0 bd0">
    <h2 class="summary-tit tit-color2">更多<?php echo $dataProvider['name']; ?>图片浏览
      <!--<a href="javascript:;" id="add-new-album" class="add-new-photo" data-for="summary-list">添加照片</a>-->
    </h2>
    <div id="new-edition" class="undis">
      <div id="zyx-upload-wrap"><a href="javascript:;" class="add-new-album"><span id="test"></span></a></div>
      <div id="zyx-upload-to-edit">
        <p class="zyxbtn-wrap"><a href="javascript:;" id="uploader-close"  class="zyxbtn3 indent20">现在就去编辑图片说明</a></p>
      </div>
      <div id="zyx-photo-upload">
        <div id="zyx-upload-head"> <span class="name">照片名</span> <span class="status">状态</span> <span class="size">大小</span> </div>
      </div>
      <div id="zyx-upload-info"> 总计<span id="zyx-photo-count">0</span> 张照片，共<span id="zyx-photo-sizes">0KB</span> <span id="zyx-upload-append"></span> <a class="blue" href="javascript:;" id="zyx-upload-again">继续上传</a> <span id="zyx-upload-tip"></span> <a id="zyx-upload-start" class="zyxbtn3 disabled" href="javascript:;"> 上传</a> </div>
    </div>
    <ul class="summary-list" id="summary-list">
      <?php
                $matches = array();
                $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                preg_match_all($pattern, $dataProvider['content'], $matches);
                foreach($matches[1] as $item){ ?>
      <li class="summary-list-first"> <a title="" href=""><img border="0" alt="" src="<?php echo '/thumb/102_72/'.str_replace('/assets/','',$item); ?>" /></a>
        <h3><a title="" href=""></a></h3>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php if($propertys){ ?>
<div class="zyxbox">
  <div class="zyxbox-tit4">
    <h3 class="tit-color3"><?php echo Yii::t('info', '推荐度假公寓'); ?>
      <?php if($propertys){ ?>
      <a href=""><?php echo Yii::t('info', '更多'); ?>
      <?php } ?>
      </a></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content pad0">
    <ul class="flats-list">
      <?php foreach($propertys as $item){ ?>
      <li>
        <div class="flasts-wrap">
          <p class="flasts-tit"><a href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><?php echo $item->propertyAddendum['title']; ?></a></p>
          <p class="flasts-grade"><img src="/images/banner_grade5.png" alt="" /></p>
          <ul class="flats-img">
            <?php $i = 1;
                    foreach($item->propertyPictures as $picture){
                      if($i++>4)break;
                      if(!isset($a))
                      {
                        $a = true;
                        echo '<li class="flats-img-first"><a href="'.Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])).'"><img src="/thumb/118_106/'.$picture['path'].'" alt="'.$item->propertyAddendum['title'].'" /></a></li>';
                      }else{
                        echo '<li><a href="'.Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])).'"><img src="/thumb/75_50/'.$picture['path'].'" alt="'.$item->propertyAddendum['title'].'" /></a></li>';
                      }
                    }
                      unset($a);
             ?>
            <li class="flats-img-more"><a href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>">...</a></li>
          </ul>
        </div>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<?php if($products){ ?>
<div class="zyxbox">
  <div class="zyxbox-tit1">
    <h3 class="tit-color1"><?php echo $city['name'].Yii::t('info', '短期行程'); ?><a href="<?php echo Yii::app()->createUrl('productList/index',array('city'=>$city['city_id'])); ?>"><?php echo $products?Yii::t('info', '更多'):''; ?></a></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
    <ul class="stroke-list">
      <?php foreach($products as $item){ ?>
      <li><a class="stroke-pic" title="<?php echo $item['title'] ?>" href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><img border="0" alt="<?php echo $item['title']; ?>" src="<?php echo '/thumb/73_47/'.$item['path']; ?>" /></a>
        <p class="stroke-info"> <a title="<?php echo $item['title']; ?>" href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><?php echo $item['title']; ?></a><span>￥<?php echo $item['price']; ?></span></p>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php } ?>
<a name="review"></a>
<div class="zyxbox">
  <div class="zyxbox-tit1">
    <h3 class="tit-color1"><?php echo Yii::t('info', '游客评论'); ?></h3>
    <p class="tit-line"></p>
  </div>
  <div class="reply-box-show reply-box-new mt10">
    <div class="comment-form">
      <textarea id="comment-txt-9"></textarea>
      <a class="btn send-comment" id="content-1" href="javascript::void(0)" attraction-id="<?php echo $model['attraction_id']; ?>">留言</a> </div>
    <?php include('reviews.php'); ?>
  </div>
</div>
