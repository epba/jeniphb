<!DOCTYPE html>
<html>
<head>
  <title>Geolocation</title>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <style>
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -34.397, lng: 150.644},
              zoom: 15
            });
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow({
              content: "contentString"
            });

            map.setCenter(pos);

            var marker = new google.maps.Marker({
              position: pos,
              map: map,
              draggable:true
            });
            marker.addListener('click', function() {
              geocodeLatLng(geocoder, map, infowindow, pos);
            });


          });
        } else {
          // Browser doesn't support Geolocation
          alert("Browser doesn't support Geolocation");
        }
      }

      function geocodeLatLng(geocoder, map, infowindow,pos) {
        var latlng = {lat:pos['lat'], lng:pos['lng']};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[1]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[1].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4DAilAz4q0yI_Br9423rHZSjvL1Gz8WY&callback=initMap">
  </script>
</body>
</html>