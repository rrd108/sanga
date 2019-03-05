function initMap() {
    var map = new google.maps.Map(
        document.getElementById('map'),
        {
            center: new google.maps.LatLng(47.162494, 19.50330400000007),
            zoom: 7,
        }
    );

    var markers = contacts.map(function (location, i) {
        return new google.maps.Marker({
            position: location,
        });
    });

    var markerCluster = new MarkerClusterer(
        map,
        markers,
        { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m' });
}