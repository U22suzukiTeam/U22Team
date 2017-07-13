

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        //とりまデフォ値(地図の中心点)
        center: {lat: 33.8397463, lng: 132.7566273},
        zoom: 14
    });
    var infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {    //位置情報を取得できたならデフォ値を書き換える的な
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('ボクハフジ');
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
       
    
        $.ajax({
            type: "get",
            url: "ConnectDummyDB.php",
            data: "",
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                
                $.each(data,function(index,val){
                    console.log(data[index].roomID);
                    
                    var point = new google.maps.LatLng(
                        data[index].latitude,
                        data[index].longitude
                    );
                    
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point
                    });
          
                })
                console.log(data[1].roomID);
             }
        });

        
        
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
 
 
}

//ブラウザがGeolocationっていう位置情報的なのに対応してなかったらエラーだすぜみたいな
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

