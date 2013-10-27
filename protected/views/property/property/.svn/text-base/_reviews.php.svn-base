<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/property_review.js"></script>
<script type="text/javascript">
$(function(){
    $('.review_submit').live("click",function(){
        var cmtform = $("#cmt-form");
        var obj = $(this);
        $.post('<?php echo Yii::app()->createUrl('property/AjaxPostQualification'); ?>',{product_id:obj.attr("property_id")},function(data){
            if(data.state == 1){
                cmtform.slideToggle();
            }else{
                msgBoxShow(data.state,data.reason);
            }
        },'json');
     });

	$('.status').click(function(){
	   visitor($(this).attr('id'));
	});

});
function visitor(id){
               $.ajax({
                'url':'<?php echo Yii::app()->createUrl('attraction/arrivedAttraction'); ?>',
                'type':'post',
                'data':'id='+id,
                'success':function(data){
                    if(data == 'success')
                    {
                        $('#is_to').remove();
                        var num = $('.played .orange').text();
                        $('.orange').text(parseInt(num)+1);
                         var played_people_img = $(".played-people a");
                        var played_people = $(".played-people");
                        if(played_people_img.size()<7){
                            played_people.append("<a href=''><img src='/images/avatar_small1.jpg' alt=''></a>");
                        }else{
                            played_people.append("<a href=''><img src='/images/avatar_small1.jpg' alt=''></a>");
                        };
                        $('.played-people');
                    }
                },
                'error':function(){
                    alert('error');
                }
            });
}

</script>

<script type="text/javascript">
function addReviewHelpful()
{
    var csrfToken = $('#csrfToken').val();
    $.ajax({
        'url':'<?php echo Yii::app()->createUrl('property/AjaxPostReviewHelpful'); ?>',
        'type':'post',
        'dataType':'json',
        'data':'property_review_id='+helpful_review_id+'&helpful='+helpful_yes_no+'&YII_CSRF_TOKEN='+csrfToken,
        'success':function(json){
			if ( json.code == 1 )
			{
				var $obj = (helpful_yes_no=='no'?$('#helpful_no_'+helpful_review_id):$('#helpful_yes_'+helpful_review_id));
				$obj.text(parseInt($obj.text(),10)+1);
			}
            $('#helpful_tip_'+helpful_review_id).html(json.msg);
        },
        'error':function(){
            alert('错误：提交失败！');
        }
   });
}


$(".send-comment").live("click",function(){
    var obj = $(this);
    var review_content = $(this).parents().find('.comment-txt').val();
    var csrfToken = $('#csrfToken').val();
    var property_id = $('#submitReviewBtn').attr('property_id');
    var review_id = $(this).data("id");
    if ( review_content == '' ) return msgBoxShow("0",'请输入回复内容！');
    $.post("<?php echo Yii::app()->createUrl('property/AjaxPostReviewReply'); ?>",{parent_review_id:review_id,property_id:property_id,review_title:review_id,review_content:review_content,YII_CSRF_TOKEN:csrfToken},function(json){
        if (json.code == 1){
           msgBoxShow("1",json.msg);
            obj.parents().find('.comment-txt').val("");
           $("#comment_"+review_id).hide();
           window.location.reload();
        }else{
           msgBoxShow("0",json.msg);
        }
    },"json");
})


//function addReviewReply(review_id)
//{
//    var csrfToken = $('#csrfToken').val();
//    var property_id = $('#submitReviewBtn').attr('property_id');
//	var review_content = $(this).parents().find('.comment-txt').val();
//    alert(review_content);
//	if ( review_content == '' ) return alert('请输入回复内容！');
//
//	$.ajax({
//		type:"POST",
//		dataType:"json",
//		data:{"parent_review_id":review_id,"property_id":property_id,"review_title":review_id,"review_content":review_content,"YII_CSRF_TOKEN":csrfToken},
//		url:"<?php //echo Yii::app()->createUrl('property/AjaxPostReviewReply'); ?>",
//		success:function(json){
//		    $("#comment_"+review_id).hide();
//            if (json.code == 1)
//            {
//                if($('#msg-box').length)
//                {
//                    $('#msg-box').removeClass('error').show().html("谢谢，发表评论成功，将在审核后显示！");
//                }else{
//                    $('body').append('<div id="msg-box">谢谢，发表评论成功，将在审核后显示！</div>');
//                }
//                             var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
//            }else{
//                if($('#msg-box').length){
//                    $('#msg-box').addClass('error').show().html(json.msg);
//                }else{
//                    $('body').append($('<div id="msg-box" class="error">'+json.msg+'</div>'))
//                }
//            var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
//            }
//		},
//		error:function(){
//			alert('错误：回复失败！');
//		}
//	});
//}
function toggleReviewForm(){
	$('#cmt-form').toggle();
}
$(function(){
	$('#login-to-cmt-form').click(function(){
		toggleReviewForm();
	});

    function starOver(m,n){
        for(var i=1; i<=n; i++){
            document.getElementById("star"+m+'-'+i).className="";
        }
        for(var i=n+1; i<=5; i++){
            document.getElementById("star"+m+'-'+i).className="no";
        }
        if(n==1){
            document.getElementById("star-tip"+m).innerHTML="\u5F88\u4E0D\u6EE1\u610F";
        }
        if(n==2){
            document.getElementById("star-tip"+m).innerHTML="\u4E0D\u6EE1\u610F";
        }
        if(n==3){
            document.getElementById("star-tip"+m).innerHTML="\u4E00\u822C";
        }
        if(n==4){
            document.getElementById("star-tip"+m).innerHTML="\u6BD4\u8F83\u6EE1\u610F";
        }
        if(n==5){
            document.getElementById("star-tip"+m).innerHTML="\u975E\u5E38\u6EE1\u610F";
        }
        document.getElementById("starsResult"+m).value = n;
    };

    function starInit(n){
        $('[id^=star'+n+']').each(function(i){
            var me = $(this);
            me.click(function(){
                starOver(n,i+1);
            });
        });
    }
    starInit(1);
    starInit(2);
    starInit(3);
    starInit(4);
    starInit(5);
    starInit(6);
});
</script>
<?php // 评论 ?>

                <div id="guest-reviews"  class="detail-list">
                    <div class="zyxbox-tit5">
                        <h3 class="tit-color5">购买者评论</h3>
                        <p class="tit-line"></p>
                    </div>
                    <div class="zyxbox-content">
                        <div class="review-head-wrap">
                            <div class="review-head-left">
                                <p class="favorite">
                                    <span class="favorite-grade"><?php echo($property->ReviewInfo['satisfaction_0']);?>%</span>
                                </p>
                                <p class="landscape">
                                    <span>满意度: </span><?php echo($property->ReviewInfo['satisfaction_img_0']);?>
                                </p>
                            </div>
                            <div class="review-head-right">
                                <ul>
                                    <li>
                                        <p class="landscape">
                                            <span>符合描述: </span><?php echo($property->ReviewInfo['satisfaction_img_1']);?>
                                            <span class="indent20">交流沟通: </span><?php echo($property->ReviewInfo['satisfaction_img_2']);?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="landscape">
                                            <span>环境卫生: </span><?php echo($property->ReviewInfo['satisfaction_img_3']);?>
                                            <span class="indent20">配套设施:</span><?php echo($property->ReviewInfo['satisfaction_img_4']);?>
                                        </p>
                                        <p class="landscape">
                                            <span>地理位置: </span><?php echo($property->ReviewInfo['satisfaction_img_5']);?>
                                            <span class="indent20">性价比:</span><?php echo($property->ReviewInfo['satisfaction_img_6']);?>
                                        </p>
                                        <a href="javascript::void(0)" class="zyxbtn1 review_submit" property_id="<?php echo $property->property_id; ?>">发表评论</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
<!--评论框-->
	<div class="cmt-form" id="cmt-form">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'WriteReviewForm',
			'action' => Yii::app()->createUrl('property/AjaxPostReview'),
			'htmlOptions' => array('name'=>'WriteReviewForm'),
		));
        echo CHtml::hiddenField('csrfToken', Yii::app()->request->csrfToken);
		?>
		<h3><b>评论</b></h3>

		<div class="list">
		  <label>标题: </label>
		  <input type="text" class="zyx-ipt ipt-title" id="review_title" name="review_title" />
		</div>

		<div class="list">
		  <label>内容: </label>
		  <textarea id="review_content" class="zyx-ipt" rows="" cols="" name="review_content"></textarea>
		</div>

		<div class="list">
			<label>评分: </label>
			<div class="vote">
			  <div class="votecon">
				<label>符合描述: </label>
				<div class="star" id="vote-star1">
				  <input type="hidden" value="5" id="starsResult1" name="starsResult1" />
				  <a id="star1-1" href="javascript:;">1</a>
				  <a id="star1-2" href="javascript:;">2</a>
				  <a id="star1-3" href="javascript:;">3</a>
				  <a id="star1-4" href="javascript:;">4</a>
				  <a id="star1-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip1" class="tip">非常满意</div>
			  </div>
			  <div class="votecon">
				<label>交流沟通: </label>
				<div class="star" id="vote-star2">
				  <input type="hidden" value="5" id="starsResult2" name="starsResult2" />
				  <a id="star2-1" href="javascript:;">1</a>
				  <a id="star2-2" href="javascript:;">2</a>
				  <a id="star2-3" href="javascript:;">3</a>
				  <a id="star2-4" href="javascript:;">4</a>
				  <a id="star2-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip2" class="tip">非常满意</div>
			  </div>
			  <div class="votecon">
				<label>卫生环境: </label>
				<div class="star" id="vote-star3">
				  <input type="hidden" value="5" id="starsResult3" name="starsResult3" />
				  <a id="star3-1" href="javascript:;">1</a>
				  <a id="star3-2" href="javascript:;">2</a>
				  <a id="star3-3" href="javascript:;">3</a>
				  <a id="star3-4" href="javascript:;">4</a>
				  <a id="star3-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip3" class="tip">非常满意</div>
			  </div>
			  <div class="votecon">
				<label>配套设施: </label>
				<div class="star" id="vote-star4">
				  <input type="hidden" value="5" id="starsResult4" name="starsResult4" />
				  <a id="star4-1" href="javascript:;">1</a>
				  <a id="star4-2" href="javascript:;">2</a>
				  <a id="star4-3" href="javascript:;">3</a>
				  <a id="star4-4" href="javascript:;">4</a>
				  <a id="star4-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip4" class="tip">非常满意</div>
			  </div>
			  <div class="votecon">
				<label>地理位置: </label>
				<div class="star" id="vote-star5">
				  <input type="hidden" value="5" id="starsResult5" name="starsResult5" />
				  <a id="star5-1" href="javascript:;">1</a>
				  <a id="star5-2" href="javascript:;">2</a>
				  <a id="star5-3" href="javascript:;">3</a>
				  <a id="star5-4" href="javascript:;">4</a>
				  <a id="star5-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip5" class="tip">非常满意</div>
			  </div>
			  <div class="votecon">
				<label>性价比: </label>
				<div class="star" id="vote-star6">
				  <input type="hidden" value="5" id="starsResult6" name="starsResult6" />
				  <a id="star6-1" href="javascript:;">1</a>
				  <a id="star6-2" href="javascript:;">2</a>
				  <a id="star6-3" href="javascript:;">3</a>
				  <a id="star6-4" href="javascript:;">4</a>
				  <a id="star6-5" href="javascript:;">5</a>
				</div>
				<div id="star-tip6" class="tip">非常满意</div>
			  </div>
			</div>
		</div>
		<p class="txtc">
			<script type="text/javascript">
			function submitReview()
			{
				if (!($_t=$('#review_title').val())) return alert('请输入标题!');
				if (!($_r=$('#review_content').val())) return alert('请输入内容!');
                $_p=$('#submitReviewBtn').attr('property_id');
				$s1 = $('#starsResult1').val();
				$s2 = $('#starsResult2').val();
                $s3 = $('#starsResult3').val();
                $s4 = $('#starsResult4').val();
                $s5 = $('#starsResult5').val();
                $s6 = $('#starsResult6').val();
                csrfToken = $('#csrfToken').val();
                $.ajax({
                    'url':'<?php echo Yii::app()->createUrl('property/AjaxPostReview'); ?>',
                    'type':'post',
                    'dataType':'json',
                    'data':'property_id='+$_p+'&review_title='+$_t+'&review_content='+$_r+'&starsResult1='+$s1+'&starsResult2='+$s2+'&starsResult3='+$s3+'&starsResult4='+$s4+'&starsResult5='+$s5+'&starsResult6='+$s6+'&YII_CSRF_TOKEN='+csrfToken,
                    'success':function(json){
                        if (json.code == 1)
			            {
			              msgBoxShow(1,json.msg);
			              window.location.reload();
//                        if($('#msg-box').length){
//							$('#msg-box').removeClass('error').show().html("谢谢，发表评论成功，将在审核后显示！");
//						 }else{
//							$('body').append('<div id="msg-box">谢谢，发表评论成功，将在审核后显示！</div>');
//						 }
//                             var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
			            }
	                    else
                        {
                          msgBoxShow(0,json.msg);
//                            if($('#msg-box').length){
//							$('#msg-box').addClass('error').show().html(json.msg);
//						 }else{
//							$('body').append($('<div id="msg-box" class="error">'+json.msg+'</div>'))
//						 }
//						 var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);

                        }
//                        $('#cmt-form').toggle();
                    },
                    'error':function(){
                        alert('错误：提交失败!');
                    }
                });
			}
			</script>
			<a class="tffbtn2" href="javascript:submitReview();" id="submitReviewBtn" property_id="<?php echo $property->property_id; ?>">发表评论!</a>
		</p>
		<?php $this->endWidget();?>
        <p class="cmt-backtop"><a href="javascript:c(0,0);" class="backtop"></a></p>
  </div>
<!--评论框结束-->
                        <div class="review-content">
                        <?php if ( $property->reviewCount == 0 ) : ?>
                          <div class="no-content">暂时没有游客评论。</div>
                          <?php else : include "_d_review.php"; endif; ?>
                        </div>
                    </div>
                </div>
