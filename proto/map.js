function initMap() {
    var opts = {
        zoom: 15,
        center: new google.maps.LatLng(35.1253694,136.9073667)
    };
    var map = new google.maps.Map(document.getElementById("map"), opts);
}