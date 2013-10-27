    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <style type="text/css">
        #map_canvas { height: 100% }
    </style>
    <script>

        //below is map
        var map;
        var markersArray = [];
        var arrInfoWindows = [];
        $(function(){
            var $lng = $("#Property_longitude");
            var $lat = $("#Property_latitude");
        });

        //定义初始化地图，同时定义一些函数，供页面载入之后的事件进行调用。
        function mapInit(position){
            var centerCoord = new google.maps.LatLng(30.65803382948381, 104.08329784870148);
            //var centerCoord = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var mapOptions = {
                zoom: 13,
                center: centerCoord,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
        };

        //放置marker
        function placeMarker(location) {
            var $lng = $("#Property_longitude");
             var $lat = $("#Property_latitude");
            var clickedLocation = new google.maps.LatLng(location);
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markersArray.push(marker);

        //这里根据用户操作，将经纬度取出来，并复制到input中。
            $lng.val(marker.getPosition().lng().toFixed(6));
            $lat.val(marker.getPosition().lat().toFixed(6));

        };

        //清除marker，这个函数需要使用，不然你的鼠标点击之处，都有标记，而你只需要一个。
        function clearMarkersBefore() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
                markersArray.length = 0;
            }
        };



        //这以下是载入页面要做的事情：初始化，同时在地图上增加一个事件；
        $(function(){
            //初始化地图
            // mapInit();
            // google.maps.event.addListener(map, 'click', function(event) {
            //  clearMarkersBefore();
            // placeMarker(event.latLng);
            //});
        });


        function getPositionSuccess(position){
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var mapOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);



            google.maps.event.addListener(map, 'click', function(event) {
                var zoom = map.getZoom();


                clearMarkersBefore();
                placeMarker(event.latLng);
            });
        }
        function getPositionError(error){
            switch (error.code) {
                case error.TIMEOUT:
                    alert(" 连接超时，请重试 ");
                    break;
                case error.PERMISSION_DENIED:
                    alert(" 您拒绝了使用位置共享服务，查询已取消 ");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert(" 非常抱歉，我们暂时无法为您所在的星球提供位置服务 ");
                    break;
            }
        }
        $(function(){
             var $lng = $("#Property_longitude");
             var $lat = $("#Property_latitude");
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError);
            }
            else {

                $lng.attr("value",'104.083297');
                $lat.attr("value",'30.658033');
                 var latlng = new google.maps.LatLng($lat.val(), $lng.val());
            var mapOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
             clearMarkersBefore();

              google.maps.event.addListener(map, 'click', function(event) {

                clearMarkersBefore();
                placeMarker(event.latLng);
            });
            }

        });


        $(function(){
            $("#submit").click(function(){
                var lng = $lng.attr("value");
                var lat = $lat.attr("value");
                var centerCoord = new google.maps.LatLng(lng,lat);
                var mapOptions = {
                    zoom: 13,
                    center: centerCoord,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map"), mapOptions);

                google.maps.event.addListener(map, 'click', function(event) {
                    clearMarkersBefore();
                    placeMarker(event.latLng);
                });

            });



        })



    </script>

    <div id="map" style="width: 660px;height: 400px;"></div>
