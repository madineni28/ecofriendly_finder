(function() {
	'use strict';



	


	var sitePlusMinus = function() {

		var value,
    		quantity = document.getElementsByClassName('quantity-container');
			
			

		function createBindings(quantityContainer) {
	      var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
	      var increase = quantityContainer.getElementsByClassName('increase')[0];
	      var decrease = quantityContainer.getElementsByClassName('decrease')[0];
	      increase.addEventListener('click', function (e) { increaseValue(e, quantityAmount); });
	      decrease.addEventListener('click', function (e) { decreaseValue(e, quantityAmount); });
	    }

	    function init() {
	        for (var i = 0; i < quantity.length; i++ ) {
						createBindings(quantity[i]);
	        }
	    };

	    function increaseValue(event, quantityAmount) {
	        value = parseInt(quantityAmount.value, 10);

	        console.log(quantityAmount, quantityAmount.value);

	        value = isNaN(value) ? 0 : value;
	        value++;
	        quantityAmount.value = value;
	    }

	    function decreaseValue(event, quantityAmount) {
	        value = parseInt(quantityAmount.value, 10);

	        value = isNaN(value) ? 0 : value;
	        if (value > 0) value--;

	        quantityAmount.value = value;
	    }
	    
	    init();
		
	};
	sitePlusMinus();


})()

function add_to_cart(product_id){

	$.ajax({
	url:"cart/add_to_cart.php",
		method:"POST",
		data:{'product_id': product_id},
		dataType:"json",
		success:function(data) {
			$('#number_of_products').html(data.number_of_products);
		}
	});  
}
function add_to_cart_shop(product_id){

	$.ajax({
	url:"../cart/add_to_cart.php",
		method:"POST",
		data:{'product_id': product_id},
		dataType:"json",
		success:function(data) {
			$('#number_of_products').html(data.number_of_products);
		}
	});  
}
function remove_from_cart(product_id){

	$.ajax({
	url:"../cart/remove_from_cart.php",
		method:"POST",
		data:{'product_id': product_id},
		dataType:"json",
		success:function(data) {
			$('#number_of_products').html(data.number_of_products);
			$('#sub_total').html(data.sub_total);
			$('#sub_total2').html(data.sub_total);
			$('#response').html(data.message);
			document.getElementById("img_id"+img_id).style.display = "none"
		}
	});  
}

jQuery(document).ready(function ($) {
		 
 $(document).on('submit', '#update_cart', function(event){


  event.preventDefault();
  
  var form_data = $(this).serialize();

  $.ajax({
   url:"update_cart.php",
   method:"POST",
   data:form_data,
   dataType:"json",
   success:function(data) { 
   
		$('#number_of_products').html(data.number_of_products);
		$('#sub_total').html(data.sub_total);
		$('#sub_total2').html(data.sub_total);
		$('#response').html(data.message);
	
   }
  });  
 });
 
 $(document).on('submit', '#checkout_frm', function(event){


  event.preventDefault();
  
  var form_data = $(this).serialize();

  $.ajax({
   url:"checkout.php",
   method:"POST",
   data:form_data,
   dataType:"json",
   success:function(data) { 
   
		if(data.f_error != '' || data.l_error != '' || data.a_error != '' || data.e_error != '' || data.p_error != '' || data.mail_error != '' || data.pass_error != '' || data.cart_error != '') {
				
			 $('#f_error').html(data.f_error);
			 $('#l_error').html(data.l_error);
			 $('#a_error').html(data.a_error);
			 $('#e_error').html(data.e_error);
			 $('#p_error').html(data.p_error);
			 
			 $('#mail_error').html(data.mail_error);
			 $('#pass_error').html(data.pass_error);
			 $('#cart_error').html(data.cart_error);
			
		} else {
				$('#f_error').html("");
				$('#l_error').html("");
				$('#a_error').html("");
				$('#no_error').html("");
				$('#p_error').html("");
				$('#mail_error').html("");
				$('#pass_error').html("");
				$('#cart_error').html("");
				
				$('#message').html(data.message);
				
				
				$('#checkout_frm')[0].reset();
			}
	
   }
  });  
 });
 
  $(document).on('submit', '#login', function(event){

	
  event.preventDefault();
  
  var form_data = $(this).serialize();

  $.ajax({
   url:"login.php",
   method:"POST",
   data:form_data,
   dataType:"json",
   success:function(data) { 
		if(data.error != '') {

			$('#response').html(data.error);


		} else {


			$('#response').html(data.message);


			window.location = "../download/";
		}
	
   }
  });  
 });
 
});		