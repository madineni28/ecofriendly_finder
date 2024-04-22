/*Location array for the styles of windows*/
/*const locations = [
  {lat: -24.363, lng: 131.044, content: "<div class='top-header'><div class='marker-name'>Double Glazed uPVC Windows</div><div class='lmorebtn'><a class='btn' href='javascript:void(0);'>Learn More..</a></div></div><div class='win-img'><img src='https://static.tildacdn.com/tild6562-6261-4365-b233-323331366439/Double-Glazed-Toorak.jpg'></div>"},
  {lat: -25.363, lng: 130.044, content:  "<div class='top-header'><div class='marker-name'>Double Glazed uPVC Windows</div><div class='lmorebtn'><a class='btn' href='javascript:void(0);'>Learn More..</a></div></div><div class='win-img'><img src='https://static.tildacdn.com/tild6562-6261-4365-b233-323331366439/Double-Glazed-Toorak.jpg'></div>"},
  {lat: -28.363, lng: 132.044, content:  "<div class='top-header'><div class='marker-name'>Double Glazed uPVC Windows</div><div class='lmorebtn'><a class='btn' href='javascript:void(0);'>Learn More..</a></div></div><div class='win-img'><img src='https://static.tildacdn.com/tild6562-6261-4365-b233-323331366439/Double-Glazed-Toorak.jpg'></div>"},
];*/

$(document).ready(function() {
        $.ajax({
            url: 'map/fetch_business.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
				initGoogleMap(data);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    });

function initGoogleMap(locations) {
    const map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 7,
        center: new google.maps.LatLng(50.9305598, 0.0308688,) // Adjust as necessary
    });

    const iconBase = 'https://1.bp.blogspot.com/-TjlLNlQb7bc/Xe9HsY1ZfDI/AAAAAAAAFfA/4viP4xOsN18s6FjV-tBmj_pnvnJ_3hbWACLcBGAsYHQ/s1600/mapmarker.png';
    
    const infowindow = new google.maps.InfoWindow(); // Only one InfoWindow
    
    function placeMarker(loc) {
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(loc.lat, loc.lng),
            map: map,
            icon: iconBase
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.close(); // Close previously opened infowindow
            infowindow.setContent(`<div id="infowindow">${loc.content}</div>`);
            infowindow.open(map, marker);
        });
    }
    
    // Iterate all locations and pass every location to placeMarker
    locations.forEach(placeMarker);
}

google.maps.event.addDomListener(window, 'load', function() {
    // Do nothing here; map initialization will be triggered by successful data fetch
});