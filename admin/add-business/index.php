<?php
ob_start();
	session_start();
	
	if(empty($_COOKIE['adminLogin'])){
        
		header("location:../login/");
		
	}
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/admin.php');
	include('../../class/businesses.php');
	include('../../class/customer.php');
	include('../../class/products.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$admin = new Admin($database);
	$business = new Business($database);
	$product = new Product($database);
	$customer = new Customer($database);
	
	$session_id = session_id();
	


	$path = "../../";




$page = 'add-business';

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
		<title>Add Business :: EcoFriendly</title>
		<!-- Bootstrap CSS -->
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		
	</head>

	<body>

		<?php include($path."nav/side_nav.php"); ?>

		

		<div class="untree_co-section">
		    <div class="container">
			
			  <form class="col-md-12" method="post" id="add_business" enctype="multipart/form-data">
		      <div class="row" style="margin-top:40px;">
		        <div class="col-md-12 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Add Business</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            <div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="c_fname" class="text-black">Business Logo <span class="text-danger">*</span></label>
		                <input type="file" class="form-control" id="image_url" name="image_url" value="" required >
		              </div>
		            </div>
		            <div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="c_fname" class="text-black">Business Name<span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="business_name" name="business_name" value="" required >
		              </div>
		            </div>
					<div class="form-group row mb-3">
					<label for="addresss" class="text-black">Address <span class="text-danger">*</span></label>
		                 <input type="text" class="form-control" id="addresss" name="addresss" value="" required >
						 
					</div>
					<div class="form-group row mb-3">
                              <div class="map" id="map" style="width: 100%; height: 300px;"></div>
                              <input type="hidden" id="business_latitude" class="form-control" name="business_latitude" readonly />
                              <input type="hidden" id="business_longitude" class="form-control" name="business_longitude" readonly />
                              <input type="hidden" id="businessAddress" class="form-control" name="businessAddress" readonly />
                        </div>
					<div class="form-group row mb-3">
					<div class="col-md-12">
					  
					  <label for="description" class="text-black">Description <span class="text-danger">*</span></label>
		                <textarea class="form-control" id="description" name="description"  required style="height:200px"></textarea>
		                
		              </div>
		          </div>
					<span id="message"></span>
					<div class="form-group">
		                 <input type="submit" class="btn btn-success btn-sm py-3 btn-block" id="btn_checkout" value="Add Deal" />
		                </div>
		          </div>
		        </div>
		        </div>
		      </form>
		    </div>
		  </div>
		  </div>
    </div>

  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
	<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js'></script>
	<script  src="<?php echo $path; ?>js/script.js"></script>
	<script src="<?php echo $path; ?>js/jquery.min.js"></script>
	<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $path; ?>js/custom.js"></script>
	<script  src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCPBqSTfQAmJphaAuuBNFf9iNAvpEmjuOc&amp;libraries=places'></script>
	<script>
	window.onload = initMap;

function initMap() {
   var currgeocoder;

   //Set geo location lat and long
   navigator.geolocation.getCurrentPosition(function (position, html5Error) {
      geo_loc = processGeolocationResult(position);
      currLatLong = geo_loc.split(",");
      initializeCurrent(currLatLong[0], currLatLong[1]);
   });

   //Get geo location result
   function processGeolocationResult(position) {
      html5Lat = position.coords.latitude; //Get latitude
      html5Lon = position.coords.longitude; //Get longitude
      html5TimeStamp = position.timestamp; //Get timestamp
      html5Accuracy = position.coords.accuracy; //Get accuracy in meters
		//alert(html5Lon);
      document.getElementById('business_latitude').value = html5Lat.toFixed(4);
      document.getElementById('business_longitude').value = html5Lon.toFixed(4);
	  
	  
      return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
   }

   //Check value is present or
   function initializeCurrent(latcurr, longcurr) {
		 
      var latlng = new google.maps.LatLng(latcurr, longcurr);
      var map = new google.maps.Map(document.getElementById('map'), {
         center: latlng,
         zoom: 13
      });
      var image = {
         url: '../../images/marker.png',
         // This marker is 20 pixels wide by 32 pixels high.
         size: new google.maps.Size(40, 42),
         // The origin for this image is (0, 0).
         origin: new google.maps.Point(0, 0),
         // The anchor for this image is the base of the flagpole at (0, 32).
         anchor: new google.maps.Point(0, 32)
      };

      var shape = {
         coords: [1, 1, 1, 40, 38, 40, 38, 1],
         type: 'poly'
      };

      var marker = new google.maps.Marker({
         map: map,
         position: latlng,
         draggable: true,
         icon: image,
         shape: shape
      });
      var input = document.getElementById('addresss');

      var geocoder = new google.maps.Geocoder();
	  
	  getCurrentOtherDetails(geocoder,marker);
	  
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);
      var infowindow = new google.maps.InfoWindow();
      autocomplete.addListener('place_changed', function () {
		
		 
         infowindow.close();
         marker.setVisible(false);
         var place = autocomplete.getPlace();
         if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
         }

         // If the place has a geometry, then present it on a map.
         if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);

         } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
         }

         marker.setPosition(place.geometry.location);
         marker.setVisible(true);
		getCurrentOtherDetails(geocoder,marker);	
         bindDataToForm(place.formatted_address, place.geometry.location.lat(), place.geometry.location.lng());
         infowindow.setContent(place.formatted_address);
         infowindow.open(map, marker);

      });
      // this function will work on marker move event into map 
      google.maps.event.addListener(marker, 'dragend', function () {
		  
         getCurrentOtherDetails(geocoder,marker);
	  });
	  
   }

   function bindDataToForm(address, lat, lng) {
	   

      //document.getElementById('txtHome').value = address;
	  document.getElementById('businessAddress').value = address;
      document.getElementById('business_latitude').value = lat.toFixed(4);
      document.getElementById('business_longitude').value = lng.toFixed(4);

   }
   //Get current address
   function getCurrentOtherDetails(geocoder,marker) {
	  var geocoder = new google.maps.Geocoder(); 
      geocoder.geocode({
            'latLng': marker.getPosition()
         }, function (results, status) {
			 
            if (status == google.maps.GeocoderStatus.OK) {
               if (results[0]) {
				   //alert(results[0].address_components);
				   var address_components = results[0].address_components;
				   var components={};
                        jQuery.each(address_components, function(k,v1) {jQuery.each(v1.types, function(k2, v2){components[v2]=v1.long_name});});
                        var city;
                        var state;
                        var country;

                        if(components.locality) {
                            city = components.locality;
                        }

                        if(!city) {
                            city = components.administrative_area_level_1;
                        }
                        if(components.administrative_area_level_1) {
                            state = components.administrative_area_level_1;
                        }

                        if(components.country) {
                            country = components.country;
                        }
                        
                       
						//$('#input-country').val(country);
                        $('#county').val(state);
                        $('#city').val(city);
				   

                  bindDataToForm(results[0].formatted_address, marker.getPosition().lat(), marker.getPosition().lng());
                  infowindow.setContent(results[0].formatted_address);
                  infowindow.open(map, marker);
               }
            }
         });
   }
}
   </script>
</body>
</html>