
<h2>发布短期行程</h2>
<div class="has-temp">

	<!--<div class="view">
		<div class="view-shadow"></div>
		<h3>参考模板</h3>
		<h4>行程基本信息</h4>
		<ul class="info-list">
			<li>
				<label class="required">主题：</label>
				<input type="text" disabled="true" value="主题一" class="ipt-sel" />
			</li>
			<li>
				<label class="required">行程类型：</label>
				<input type="text" disabled="true" value="飞机游" class="ipt-sel" />
			</li>
			<li>
				<label class="required">产品名字：</label>
				<input type="text" disabled="true" value="两日四海网独家“Outlet-Camarillo”购物半自助游" class="long" />
			</li>
			<li>
				<label>产品描述：</label>
				<textarea  disabled="true">New York,NY,US  /  Barcelona,Barcelona,ES /  Beltsville,WA,US /  Boston,MA,US /  Brentwood,UK,GB /  Denali,AK,US/  Hilo,HI,US/  Lima,LM,PE/  London,ON,CA/ 
				</textarea>
			</li>
			<li class="place-guise">
                <label>住所外观：</label>
				<div class="upload-img-wrap">
				<a href="javascript:;" class="add-new-album">添加照片</a>
				<span class="warnning">请至少上传3张照片。</span>
				<ul class="upload-img-list">
					<li>
						<img width="250" height="150" src="http://www.toursforfun.com/images/db/products/san-francisco-skyline-pic.jpg">	
						<textarea disabled="disabled">地处市中心比较安静的地段，离宽窄...</textarea>		
						<a href="javascript:;" class="remove-item">删除</a>
					</li>
                    <li>
						<img width="250" height="150" src="http://www.toursforfun.com/images/db/products/san-francisco-skyline-pic.jpg">	
						<textarea disabled="disabled">地处市中心比较安静的地段，离宽窄...</textarea>		
						<a href="javascript:;" class="remove-item">删除</a>
					</li>
                    <li>
						<img width="250" height="150" src="http://www.toursforfun.com/images/db/products/san-francisco-skyline-pic.jpg">	
						<textarea disabled="disabled">地处市中心比较安静的地段，离宽窄...</textarea>		
						<a href="javascript:;" class="remove-item">删除</a>
					</li>
				</ul>
				</div>
			</li>
			<li>
				<label class="required" >起始城市：</label>
				<input type="text"  disabled="true" value="洛杉矶, CA, USA" class="long"  />
			</li>
			<li>
				<label class="required">结束城市：</label>
				<input type="text"  disabled="true" value="洛杉矶, CA, USA" class="long"  />
			</li>
			<li>
				<label>途经城市：</label>
				<textarea  disabled="true">New York,NY,US  /  Barcelona,Barcelona,ES /  Beltsville,WA,US /  Boston,MA,US /  Brentwood,UK,GB /  Denali,AK,US/  Hilo,HI,US/  Lima,LM,PE/  London,ON,CA/ 
				</textarea>
			</li>
			<li>
				<label>沿途景点：</label>	
				<textarea  disabled="true">Boston,MA,US / Breaker's Mansion,RI,US / Havard Square,MA,US / Quincy Market,MA,US / MIT,MA,US / Newport,RI,US / New York,NY,US / New Haven,CT,US / Rhode Island,RI,US
				</textarea>
			</li>
			<li>
				<label class="required" >持续时间：</label>
				<input type="text"  disabled="true" value="2">
				<input class="ipt-sel" type="text" value="天" disabled="true" / >
			</li>
			<li>
				<label class="required">价格：</label>		
				$<input type="text"  disabled="true" maxlength="10" size="10" value="136.00">
				<span>起</span>
			</li>
			
		</ul>
		<h4>行程介绍</h4>
		<div class="product-description">
			<h4>第1天</h4>
			<ul  class="info-list">
				<li>
					<label>行程概述：</label>
					<input type="text"  disabled="true" value=" 洛杉矶机场接机( Airport Transfer)-酒店(Hotel)">
				</li>
				<li class="place-guise">
					<label>住所外观：</label>
					<div class="upload-img-wrap">
						<a href="javascript:;" class="add-new-album">添加照片</a>
						<span class="warnning">请上传1张照片。</span>
						<ul class="upload-img-list">
							<li>
								<img width="250" height="150" src="http://www.toursforfun.com/images/db/products/san-francisco-skyline-pic.jpg">	
								<textarea disabled="disabled">地处市中心比较安静的地段，离宽窄...</textarea>		
								<a href="javascript:;" class="remove-item">删除</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<label>行程详情：</label>
					<textarea  disabled="true">早上9:00am - 晚上9:00pm之间，四海网安排专人在洛杉矶国际机场接应，之后送至我们精心为贵宾特别安排的豪华酒店下榻休息。 我们每个预定单提供一次指定时间内在LAX机场的免费接机服务。 </textarea>
				</li>
			</ul>
		</div>
		<ul class="info-list">
			<li>
				<label></label>
				<span class="btn-line btn-dis"><input type="submit" value="发布" disabled="disabled"></span>
			</li>
		</ul>
	</div>-->
  
	<div class="info-wrap">
		<!--<a href="javascript:;" id="show-temp">隐藏模版</a> -->
		<?php 
			 $this->renderPartial('_new_product_base_form', array( 'model' => $model,
			'mname' => $mname,
			'mscity' => $mscity,
			'mecity' => $mecity,
            'productImages'=>$productImages));		
		?>
	</div>
</div>