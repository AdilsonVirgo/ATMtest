<script type="text/javascript">
    var map = null;

    function google_maps_geocode_and_map() {
        var LatitudeAndLongitude = new google.maps.LatLng(-2.1894128, -79.8890662);

        var mapOptions = {
            scrollwheel: false,
            disableDefaultUI: false,
            draggable: true,
            zoom: 14,
            center: LatitudeAndLongitude,
            mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
        };

        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        /*var marker = new google.maps.Marker({
            map: map,
            //icon: "",
            title: '<strong>Code</strong>',
            position: map.getCenter()
        });*/
    }

    google_maps_geocode_and_map();
</script>
