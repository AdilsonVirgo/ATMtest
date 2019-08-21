<script type="text/javascript">
    var latitude = 0;
    var longitude = 0;

    function show_location(position) {
        latitude = position.coords.latitude;
        longitude = position.coords.longitude;

        show_map();
        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;
        get_google_address(latitude, longitude);
    }

    function get_google_address(lat, lng) {
        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'latLng': latlng
        }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                document.getElementById('google_address').value = results[0].formatted_address;
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });
    }

    function show_geocoding() {
        var geocoder = new google.maps.Geocoder();

        return geocoder.geocode({'address': {!! old('google_address') ? '"' . old('google_address') . '"' : '"Guayaquil"'  !!} }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();

                show_map();
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                get_google_address(latitude, longitude);
            }
        });
    }

    function error_location(error) {
        if (error.code == error.PERMISSION_DENIED) {
            show_geocoding();
        }
        console.warn('ERROR(' + error.code + '): ' + error.message);
    };

    function get_location() {
        if (navigator.geolocation) {
            var options = {
                enableHighAccuracy: true,
                timeout: 50000,
                maximumAge: Infinity
            };

            return navigator.geolocation.getCurrentPosition(show_location, error_location, options);
        } else {
            show_geocoding();
        }
    }

    function show_map() {
        var LatitudeAndLongitude = new google.maps.LatLng(latitude, longitude);

        var mapOptions = {
            scrollwheel: true,
            disableDefaultUI: false,
            draggable: true,
            zoom: 14,
            center: LatitudeAndLongitude,
            mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
        };

        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        var marker = new google.maps.Marker({
            map: map,
            //icon: "",
            title: '<strong>Nueva señal</strong>',
            position: map.getCenter()
        });

        /*google.maps.event.addDomListener(map, 'zoom_changed', function() {
            window.setTimeout(function () {
                alert('zooming');
            }, 100);
        });*/

        google.maps.event.addListener(map, 'center_changed', function () {
            window.setTimeout(function () {
                var center = map.getCenter();
                marker.setPosition(center);

                document.getElementById('latitude').value = center.lat();
                document.getElementById('longitude').value = center.lng();
            }, 100);
        });

        google.maps.event.addListener(map, 'dragend', function () {
            window.setTimeout(function () {
                var center = map.getCenter();
                get_google_address(center.lat(), center.lng());
            }, 100);
        });
    }

    get_location();

</script>
