


function initMap() {
    //愛媛県庁
    var myLatLng = {lat: 33.8416643, lng: 132.7631729};

    //map本体
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: myLatLng
    });

    //マーカーの設定
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map
    });

    //マーカーを独自のアイコンにする
    //画像のサイズに注意
    var imagePath = './img/TWCP_icon106.jpg';
    var originmarker = new google.maps.Marker({
        //道後温泉
        position: {lat: 33.8520404, lng: 132.7863193},
        map: map,
        icon: imagePath
    });



    
}
initMap();
