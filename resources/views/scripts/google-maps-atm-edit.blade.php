<script type="text/javascript">

    function google_maps_geocode_and_map() {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({'address': {!! $google_address ? '"' . $google_address . '"' : '"Guayaquil"'  !!} }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = {{ $latitude ? $latitude : 'results[0].geometry.location.lat()' }};
                var longitude = {{ $longitude ? $longitude : 'results[0].geometry.location.lng()' }};

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                document.getElementById('google_address').value = results[0].formatted_address;

                if (document.getElementById('map-canvas')) {
                    function getMap() {
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
                                geocoder.geocode({
                                    'latLng': center
                                }, function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            document.getElementById('google_address').value = results[0].formatted_address;
                                        }
                                    }
                                });
                            }, 100);
                        });
                    }

                    google.maps.event.addDomListener(window, 'load', getMap);
                }

            }

        });
    }

    google_maps_geocode_and_map();

</script>
