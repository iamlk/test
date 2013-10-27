<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/uploader.js'); ?>
<?php  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/uploader/uploader.css'); ?>
<div class="issue" id="journey">
	<h2>发布短期行程</h2>
	<div class="info-wrap">
			

		<h3>1.行程基本信息</h3>
		<form method="post" action="/product/create" id="product-form" enctype="multipart/form-data" class="ajax-submit ajax-valid-form" novalidate="novalidate">
			<ul class="info-list">
				<li>
					<label>行程类型：<span>*</span></label>
					<span><select id="Product_product_type_id" name="Product[product_type_id]" required="required">
					<option value="1">一日游</option>
					<option value="2">半日游</option>
					<option value="3">船票</option>
					<option value="11">门票</option>
					<option value="12">小时游</option>
					<option value="13">游轮</option>
					<option value="14">中国游</option>
					<option value="16">浮潜</option>
					<option value="17">漂流</option>
					<option value="19">千里行</option>
					<option value="28">餐饮</option>
					</select></span>
				</li>

				<li>
					<label>产品名字：<span>*</span></label>
					<input type="text" maxlength="125" id="ProductAddendum_title" name="ProductAddendum[title]" data-messages="required:&lt;i&gt;&lt;/i&gt;产品名字不能为空" required="required" class="long">		<span class="side-text">还能输入 <em>30</em> 个字</span>
				</li>

				
				<li class="place-guise">
					<label>产品图片：<span>*</span></label>
					<div class="upload-img-wrap">
					<span class="btn-line btn-white">
						<a data-tempid="li-template" data-for="review_result_photo" class="add-new-album" id="add-new-album" href="javascript:;">添加照片</a>
					</span>	
						<span class="warnning">请先上传3张以上图片（后续可随时更新/增加），建议尺寸640*385，图片描述&lt; 30字</span>
						<ul id="review_result_photo" class="upload-img-list clearfix">
							<li>
								<img width="155" height="105" src="/assets/product/20130923/310a13a33e69560df58b50598c39dfd1.jpg">
								<input type="hidden" id="product/20130923/310a13a33e69560df58b50598c39dfd1.jpg" class="include" value="product/20130923/310a13a33e69560df58b50598c39dfd1.jpg" name="ProductImages[path][]">
								<textarea class="include" name="ProductImages[title][]"></textarea>
								<a href="javascript:;" class="remove-item">删除</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<label>行程详情：<span>*</span></label>
					<?php $this->widget('KindEditor',array('name'=>'PropertyAddendum[description]','value'=>$propertyAddendum->description,'width'=>'560px','config'=>array('minWidth'=>700,'items'=>"['source','preview', 'cut', 'copy', 'paste',
					'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
					'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
					</li>
				<li>
					<label>注意事项：<span>*</span></label>
					<?php $this->widget('KindEditor',array('name'=>'PropertyAddendum[dd]','value'=>$propertyAddendum->description,'width'=>'560px','config'=>array('minWidth'=>700,'items'=>"['source','preview', 'cut', 'copy', 'paste',
					'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
					'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
				</li>
			</ul>

			<h3>2.产品价格及库存维护</h3>
			<ul>
				<li>
					<label>产品上架区段：</label>
					<input type="text" class="setup-calendar" value="1970-01-01" name="ProductOneDayPrice[start_date]" id="ProductOneDayPrice_start_date">	至	<input type="text" class="setup-calendar" value="1970-01-01" name="ProductOneDayPrice[end_date]" id="ProductOneDayPrice_end_date">		
					<span class="warnning">提示：默认设置价格为1年以内</span>
				</li>
			</ul>
			<div class="info-list product-price-setup">
				<div class="price-box-wrap">
					<div class="price-box">
						<a href="javascript:;" id="esc-price-setup">退出</a>
						<div>
							<p class="title">价格设置<span class="warnning">设置后会覆盖已录入的价格信息</span></p>
							<p class="text-line">时间区段：<span class="time">2013-10-01</span>至<span class="time">2013-10-31</span></p>
							<p class="text-line">一般价格：<span class="red-warnning">*成人、儿童至少必填一项。</span></p>
							<div class="table-wrap">
								<table>
									<tr>
										<th></th>
										<th>价格</th>
										<th>名额</th>
									</tr>
									<tr>
										<td class="name">成人</td>
										<td>
											<p><input type="text">元</p>
										</td>
										<td>
											<p><input type="text">人</p>
										</td>
									</tr>
									<tr>
										<td class="name">儿童</td>
										<td>
											<p><input type="text">元</p>
										</td>
										<td>
											<p><input type="text">人</p>
										</td>
									</tr>
								</table>
							</div>
							<p class="text-line">特殊价格：<span class="warnning">展开可设置特殊价格</span></p>
							<div class="table-wrap">
								<div>
									<ul>
										<li><label><input type="radio" name="a">仅单日</label></li>
										<li><label><input type="radio" name="a">仅单日</label></li>
										<li><label><input type="radio" name="a">按星期</label></li>
									</ul>
									<div>
										<ul class="week">
										<li><label><input type="checkbox" name="b">全选</label></li>
										<li><label><input type="checkbox" name="b">每周一</label></li>
										<li><label><input type="checkbox" name="b">每周二</label></li>
										<li><label><input type="checkbox" name="b">每周三</label></li>
										<li><label><input type="checkbox" name="b">每周四</label></li>
										<li><label><input type="checkbox" name="b">每周五</label></li>
										<li><label><input type="checkbox" name="b">每周六</label></li>
										<li><label><input type="checkbox" name="b">每周日</label></li>
									</ul>
									</div>
								</div>
								<table>
									<tr>
										<th></th>
										<th>价格</th>
										<th>名额</th>
									</tr>
									<tr>
										<td class="name">成人</td>
										<td>
											<p><input type="text">元</p>
										</td>
										<td>
											<p><input type="text">人</p>
										</td>
									</tr>
									<tr>
										<td class="name">儿童</td>
										<td>
											<p><input type="text">元</p>
										</td>
										<td>
											<p><input type="text">人</p>
										</td>
									</tr>
								</table>
							</div>
							<p class="btn-column">
								<span class="btn-line btn-small-blue"><a href="javascript:;">确定</a></span>
							</p>
						</div>
					</div>
				</div>
				<div class="price-setup-wrap">
					<p class="name-space">
						<a href="javascript:;" class="cur">套餐/名称1</a>
						<a href="javascript:;">套餐/名称2</a>
						<a href="javascript:;" class="add-new-proname">添加新产品</a>
						<span class="side-text">还能添加 <em>4</em> 个</span>
					</p>
					<div class="price-column">
						<div class="all-setup-column">
							<label>套餐/名称：<span>*</span></label><input type="text" />
							<span class="side-text">还能输入 <em>10</em> 个字</span>
							<div class="all-operate">
								<a href="javascript:;" class="operate">批量操作</a>
								<p>
									<a href="javascript:;">批量设置</a>
									<a href="javascript:;">全部清空</a>
								</p>
							</div>
						</div>
						<!--一个月-->
						<p class="operate-line">
							<span class="month">十月</span>
							<span class="btn-line btn-white set"><a href="javascript:;">价格设置</a></span>
							<span class="btn-line btn-white reset"><a href="javascript:;">清空</a></span>
						</p>
						<table>
							<tr>
							<th>星期日</th>
							<th>星期一</th>
							<th>星期二</th>
							<th>星期三</th>
							<th>星期四</th>
							<th>星期五</th>
							<th>星期六</th>
						</tr>
							<tr>
							<td>
								
							</td>
							<td>
								<p class="data">1</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">2</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">3</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">4</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">5</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">6</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">7</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">8</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">9</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">10</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">11</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">12</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">13</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">14</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">15</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">16</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">17</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">18</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">19</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">20</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">21</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">22</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">23</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">24</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">25</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">26</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">27</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">28</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">29</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">30</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
						</table>
						<p class="save-line">
							<span class="btn-line btn-small-blue save-price"><a href="javascript:;">保存</a></span>
						</p>
						<!--一个月结束-->
						<!--又一个月-->
						<p class="operate-line">
							<span class="month">十一月</span>
							<span class="btn-line btn-white set"><a href="javascript:;">价格设置</a></span>
							<span class="btn-line btn-white reset"><a href="javascript:;">清空</a></span>
						</p>
						<table>
							<tr>
								<th>星期日</th>
								<th>星期一</th>
								<th>星期二</th>
								<th>星期三</th>
								<th>星期四</th>
								<th>星期五</th>
								<th>星期六</th>
							</tr>
							<tr>
								<td>
									
								</td>
								<td>
									<p class="data">1</p>
									<div>
										<ul class="clearfix specil">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
								<td>
									<p class="data">2</p>
									<div>
										<ul class="clearfix">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
								<td>
									<p class="data">3</p>
									<div>
										<ul class="clearfix">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
								<td>
									<p class="data">4</p>
									<div>
										<ul class="clearfix">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
								<td>
									<p class="data">5</p>
									<div>
										<ul class="clearfix">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
								<td>
									<p class="data">6</p>
									<div>
										<ul class="clearfix">
											<li class="adult-price">
												<input type="text" placeholder="成人价格">元
											</li>
											<li class="adult-num num">
												<input type="text" placeholder="名额">人
											</li>
											<li class="kid-price">
											<input type="text" placeholder="儿童价格">元
											</li>
											<li class="kid-num num">
											<input type="text" placeholder="名额">人
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<tr>
							<td>
								<p class="data">7</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">8</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">9</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">10</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">11</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">12</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">13</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">14</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">15</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">16</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">17</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">18</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">19</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">20</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">21</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">22</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">23</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">24</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">25</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">26</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">27</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
						</tr>
							<tr>
							<td>
								<p class="data">28</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">29</p>
								<div>
									<ul class="clearfix specil">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								<p class="data">30</p>
								<div>
									<ul class="clearfix">
										<li class="adult-price">
											<input type="text" placeholder="成人价格">元
										</li>
										<li class="adult-num num">
											<input type="text" placeholder="名额">人
										</li>
										<li class="kid-price">
										<input type="text" placeholder="儿童价格">元
										</li>
										<li class="kid-num num">
										<input type="text" placeholder="名额">人
										</li>
									</ul>
								</div>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
						</table>
						<p class="save-line">
							<span class="btn-line btn-small-blue save-price"><a href="javascript:;">保存</a></span>
						</p>
					</div>
				</div>
			</div>
			<h3>3.其他信息 <span class="text">(以下为非必填项，填写后您的产品信息会更加丰富，也可以不填写或后续补充。)</span></h3>
			<ul class="info-list last">
				<li>
					<label>行程所在地：</label>
					<input type="text" value=""> 
				</li>
				<li>
					<label>产品关键字：</label>
					<input type="text" class="long" value="">
					<span class="side-text">还能添加 <em>5</em> 个关键字</span><br>
					<label></label>
					<span class="warnning">您可以添加与当前产品相关的关键字，如沿途景点、相关目的地等，使用空格或其他符号分隔，最多5个。</span>
				</li>
				<li>
					<label></label>
					<span class="btn-line property-btn">
						<input type="submit" value="预览" name="yt0">		
					</span>
					<span class="btn-line property-btn">
						<input type="submit" value="发布" name="yt0">		
					</span>
				</li>
			</ul>
		</form><!-- form -->


	</div>
</div>   