

var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        //デフォ値(地図の中心点)
        center: {lat: 33.8397463, lng: 132.7566273},
        zoom: 14
    });
    var infoWindow = new google.maps.InfoWindow({map: map});

    var cnt = 0;
    var myplace;
    var mylocation = function (){
        if (navigator.geolocation) {    //現在地が取得できるか判定します
            navigator.geolocation.getCurrentPosition(function(position) {
                
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                
                if(cnt === 0){  //初回のみ現在地マーカの削除を行わない
                    ++cnt;
                    console.log("初回");
                }else{
                    myplace.setMap(null);
                    console.log('更新');
                }
                
                //現在地にマーカを置きます
                myplace = new google.maps.Marker({
                    //map: map,
                    position: pos,
                    icon: {
                        path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                        scale: 6
                    }
                });
                

                //地図の中心を現在地に書き換えます
                map.setCenter(pos);
                myplace.setMap(map);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });  
        } else {
            // 現在地が取得できなかったらエラーを表示する
            handleLocationError(false, infoWindow, map.getCenter());
        }
    };
    
    
    var getOtherPoint  = function (){
        //目的地を地図に表示するための処理   
        $.ajax({
            type: "get",
            url: "ConnectDummyDB.php",
            data: "",
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {

                $.each(data,function(index,val){

                    var point = new google.maps.LatLng(
                        data[index].latitude,
                        data[index].longitude
                    );

                    var marker = new google.maps.Marker({
                        map: map,
                        position: point
                    });

                });
             }
        });
    };
    
    setInterval(mylocation, 1000);
    setInterval(getOtherPoint, 5000);
    
 
 
}

//ブラウザがGeolocationっていう位置情報的なのに対応してなかったら出すエラーの中身
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

