<?php  $propertyPictures = $property->propertyPictures;?>
<?php if($propertyPictures):?>
<div class="picShow show-photo">
	<div class="bigImg">
		<div class="imgWrap">
			<img class="showImg"  src="" alt=""/>
		</div>
		<div class="title"><p></p></div>
		<a href="javascript:;" class="prev">上一张</a>
		<a href="javascript:;" class="next">下一张</a>
	</div>
	<div class="listWrap">
		<a href="javascript:;" class="prev">上一张</a>
		<a href="javascript:;" class="next">下一张</a>
		<div class="imgListWrap">
			<ul class="imgList clearfix">
				 <?php $i=1; foreach ($propertyPictures as $propertyPicture) : ?>
					<li <?php if($i==1): ?> class="cur" <?php else: ?> <?php endif; ?> >
						<a href="/thumb/auto/640_385/<?php echo $propertyPicture->path; ?>" title="<?php echo CHtml::encode($propertyPicture->note) ?>" >
							<img src="/thumb/46_46/<?php echo $propertyPicture->path; ?>" alt="<?php echo CHtml::encode($propertyPicture->note) ?>">
						</a>
					</li>
				<?php $i++; endforeach;?>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>