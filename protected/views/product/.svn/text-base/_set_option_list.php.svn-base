
<table style="width: 100%;">
<tr >
<th>&nbsp;<?php echo CHtml::checkBox('selId','',array('value'=>0)) ?></th></th><th>增值服</th><th>服务项明细</th><th>须加$费用</th><th>Done</th>
</tr>
<?php  if($newmodel_attr){

    foreach($newmodel_attr as $k){
    ?>
<tr id="option_leo_<?php echo $k->product_attribute_id;?>" >
<td>&nbsp;<?php echo CHtml::checkBox('selId','',array('value'=>$k->product_attribute_id)) ?></td>
<td><?php  echo $k->productOption->productOptionDescription->name;?></td>


<td><?php  echo $k->productOptionValue->value;?></td>
<td><?php  echo $k->value_price;?></td>
<td>
<a href="javascript:void(0);" onclick="update_option_detail(<?php echo $k->product_attribute_id; ?>,<?php echo $k->product_id; ?>)">编辑</a>
----<a href="javascript:void(0);" onclick="add_option_detail(<?php echo $k->product_option_id; ?>,<?php echo $k->product_id; ?>)">添加服务明细</a>
----<a href="javascript:void(0);" onclick="option_del(<?php echo $k->product_attribute_id ?>)">删除</a>
</td>


</tr>
<?php } }?>
</table>
<script>
var i = 1;
$('#selId').bind('click',function()
{
    if(i%2==0)
    {
       $("input[name='selId']").removeAttr("checked"); 
    }
    else
    {
         $("input[name='selId']").attr("checked","true"); 
    }
   i++;
});

function ck_muti_detail(url)
{
    var ids = '';
    $("input[name='selId']:checkbox:checked").each(function(){
        if($(this).val() && $(this).val()!='0')
        {
             ids = $(this).val()+"_"+ids;
        }
       
    }); 

    if(/^\d/.test(ids) == false)
    {
       alert('请选择要添加的增值服务');
       return ;
    }
    var new_ids = ids.substring(0,ids.length-1)
    
    var t_url = url+"&aid="+new_ids;
    //alert(t_url); 
    window.location.href = t_url;
    
}

</script>


