/* ====== Index ======

1. BASIC MAP
2. MAP WITH MARKER
3. POLYGONAL MAP
4. POLYLINE MAP
5. MULTIPLE MARKER
6. STYLED MAP

====== End ======*/

$(function() {
  "use strict";

  /*======== 1. BASIC MAP ========*/
  function basicMap() {
    var denver = new google.maps.LatLng(39.5501, -105.7821);
    var map = new google.maps.Map(document.getElementById("basicMap"), {
      zoom: 8,
      center: denver
    });
  }

  /*======== 2. MAP WITH MARKER ========*/
  function markerMap() {
    var colorado = new google.maps.LatLng(38.82505, -104.821752);
    var map = new google.maps.Map(document.getElementById("mapMarker"), {
      zoom: 8,
      center: colorado
    });

    var contentString =
      '<div id="content">' +
      '<h4 id="infoTitle" class="info-title">Colorado</h4>' +
      "</div>";

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    var marker = new google.maps.Marker({
      position: colorado,
      map: map
    });
    infowindow.open(map, marker);
    marker.addListener("click", function() {
      infowindow.open(map, marker);
    });
  }

  /*======== 3. POLYGONAL MAP ========*/
  function polyMap() {
    var center = new google.maps.LatLng(37.347442, -91.242551);
    var map = new google.maps.Map(document.getElementById("polygonalMap"), {
      zoom: 5,
      center: center,
      mapTypeId: "terrain"
    });

    // Define the LatLng coordinates for the polygon's path.
    var ractangleCoords = [
      { lat: 39.086254, lng: -94.567509 },
      { lat: 35.293261, lng: -97.210534 },
      { lat: 36.058717, lng: -86.863566 },
      { lat: 38.498833, lng: -90.133947 },
      { lat: 39.086254, lng: -94.567509 }
    ];

    // Construct the polygon.
    var kansasRact = new google.maps.Polygon({
      paths: ractangleCoords,
      strokeColor: "#4c84ff",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#4c84ff",
      fillOpacity: 0.35
    });
    kansasRact.setMap(map);
  }

  /*======== 4. POLYLINE MAP ========*/
  function polylineMap() {
    var center = new google.maps.LatLng(39.399273, -86.151248);
    var map = new google.maps.Map(document.getElementById("polylineMap"), {
      zoom: 5,
      center: center,
      mapTypeId: "terrain"
    });

    var flightPlanCoordinates = [
      { lat: 39.08199, lng: -94.568882 },
      { lat: 38.538338, lng: -90.220769 },
      { lat: 39.399273, lng: -86.151248 },
      { lat: 38.830073, lng: -77.098642 }
    ];
    var flightPath = new google.maps.Polyline({
      path: flightPlanCoordinates,
      geodesic: true,
      strokeColor: "#4c84ff",
      strokeOpacity: 1.0,
      strokeWeight: 3
    });

    flightPath.setMap(map);
  }

  /*======== 5. MULTIPLE MARKER ========*/
  function multiMarkerMap() {
    var locations = [
      ["Bondi Beach", -33.890542, 151.274856, 4],
      ["Coogee Beach", -33.923036, 151.259052, 5],
      ["Cronulla Beach", -34.028249, 151.157507, 3],
      ["Manly Beach", -33.80010128657071, 151.28747820854187, 2],
      ["Maroubra Beach", -33.950198, 151.259302, 1]
    ];

    var center = new google.maps.LatLng(-33.92, 151.25);
    var map = new google.maps.Map(document.getElementById("multiMarkerMap"), {
      zoom: 10,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(
        marker,
        "click",
        (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          };
        })(marker, i)
      );
    }
  }

  /*======== 6. STYLED MAP ========*/
  function styleMap() {
    var style = [
      {
        stylers: [
          {
            hue: "#2c3e50"
          },
          {
            saturation: 250
          }
        ]
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [
          {
            lightness: 50
          },
          {
            visibility: "simplified"
          }
        ]
      },
      {
        featureType: "road",
        elementType: "labels",
        stylers: [
          {
            visibility: "off"
          }
        ]
      }
    ];

    var dakota = new google.maps.LatLng(44.3341, -100.305);
    var map = new google.maps.Map(document.getElementById("styleMap"), {
      zoom: 7,
      center: dakota,
      mapTypeId: "roadmap",
      styles: style
    });
  }

  if (document.getElementById("google-map")) {
    google.maps.event.addDomListener(window, "load", basicMap);

    google.maps.event.addDomListener(window, "load", markerMap);

    google.maps.event.addDomListener(window, "load", polyMap);

    google.maps.event.addDomListener(window, "load", polylineMap);

    google.maps.event.addDomListener(window, "load", multiMarkerMap);

    google.maps.event.addDomListener(window, "load", styleMap);
  }
});
