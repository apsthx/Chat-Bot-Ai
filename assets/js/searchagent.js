var service_base_url = $('#service_base_url').val();

function run_map() {
    map = new GMaps({
        div: '#map',
        zoom: 8,
        center: {lat: 13.7624146, lng: 100.3554352}
    });
}

function add_marker(lat, lng, title, content) {
    map.addMarker({
        lat: lat,
        lng: lng,
        title: title,
        icon: {
            url: service_base_url + 'assets/img/marker-shop.png'
        },
        infoWindow: {
            content: content
        }
    });
}

function remove_marker() {
    setMapOnAll(null);
}

function current() {
    GMaps.geolocate({
        success: function (position) {
            map.setCenter(position.coords.latitude, position.coords.longitude);
            map.addMarker({
                position: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                },
                title: 'ตำแหน่งของคุณ',
                infoWindow: {
                    content: 'ตำแหน่งของคุณ'
                },
                draggable: true,
                animation: google.maps.Animation.DROP,
                dragend: function (event) {
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();
                    map.setCenter(lat, lng);
                }
            });
        },
        error: function (error) {
            console.log(error);
        },
        not_supported: function () {
            alert("Your browser does not support geolocation");
        }
    });
}