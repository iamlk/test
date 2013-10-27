    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {

  var myInfo = eval(<?php echo json_encode($addressName); ?>);
  var myLongitude = eval(<?php echo json_encode($longitude); ?>);
  var myLatitude = eval(<?php echo json_encode($latitude); ?>);
  var myInfos = [];
  var marker;

  for(var i=0;i<myInfo.length;i++)
  {
    var myContainer = new google.maps.LatLng(myLatitude[i], myLongitude[i]);
//    alert(myLatitude[i]);
//    alert(myLongitude[i]);
    myInfos.push(myContainer);
  }

  var mapOptions = {
    zoom: 10,
    center: myInfos[0],
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

   for (var i = 0; i < myInfos.length; i++) {
		   marker = new google.maps.Marker({
			position: myInfos[i],
			map: map,
			title: myInfo[i]
		});

        }




}

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<div class="zyxbox">
  <div class="zyxbox-tit3">
    <h3 class="tit-color3" attractionName="<?php echo $attractionName; ?>"><?php echo Yii::t('info', '景点所在位置'); ?></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
  <div id="map-canvas" style="width: 100%; height: 300px"></div>
  </div>
</div>
