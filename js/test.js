$(document).ready(function (){
	
	$("#show_content").hide();
	
	$("#select_region").load("php/select_region.php",function(){
		$("#show_content").show(200);
		$(".chosen_0").chosen();
		$("#loader").hide(200);
	});
	
	$("input").keypress(function (event) {
		if (event.keyCode === 10 || event.keyCode === 13) {
			event.preventDefault();
		}
	});
	
	$("#select_region").change(function(){

	  $("#select_city, #select_district").val("none");
	  $("#li_select_district, #li_select_city").hide(200);
	  $(".chosen_1, .chosen_2").chosen("destroy");
	  $("#registration_button").css({"pointer-events":"none"});
	  
	  var region = $(this).val();
	  
	  if(region == 80 || region == 85)
	  {
			$.ajax({
				type: "POST",
				url: "php/select_special.php",
				data: { special_region:region }

				}).done(function(response) {
					$("#select_district").html(response);
					$("#registration_button").css({"pointer-events":"all"});
					
					if(response.trim() == "<option value='none'></option>")
					{
						$("#li_select_district").hide(200);
					}
					else
					{
						$("#li_select_district").show(200);
						$(".chosen_2").chosen();
					}
				});
	  }
	  else
	  {
			$.ajax({
				type: "POST",
				url: "php/select_city.php",
				data: { region:region }

				}).done(function(response) {
					$("#select_city").html(response);
					$("#registration_button").css({"pointer-events":"all"});
					
					if(response.trim() == "<option value='none'></option>")
					{
						$("#li_select_city").hide(200);
					}
					else
					{
						$("#li_select_city").show(200);
						$(".chosen_1").chosen();
					}
				});
	  }

	  return false;
	   
	});
	
	$("#select_city").change(function(){

	$("#select_district").val("none");
	$("#li_select_district").hide(200);
    $(".chosen_2").chosen("destroy");
	$("#registration_button").css({"pointer-events":"none"});
	  
     var city = $(this).val();
	 var region = $("#select_region").val();
	   
		$.ajax({
			type: "POST",
			url: "php/select_district.php",
			data: { region:region, city:city }

			}).done(function(response) {
				$("#select_district").html(response);
				$("#registration_button").css({"pointer-events":"all"});
				
				if(response.trim() == "<option value='none'></option>")
				{
					$("#li_select_district").hide(200);
				}
				else
				{
					$("#li_select_district").show(200);
					$(".chosen_2").chosen();
				}
			});

	  return false;
	   
	});
	
	$("#register_form").submit(function(event){

		event.preventDefault();
		$("#server-results").empty();
		
		//Для валидации
		var name = $('input[name ="name"]').val();
		var email = $('input[name ="email"]').val();
		var region = $("#select_region").val();
		var city = $("#select_city").val();
		var district = $("#select_district").val();
	 
		//Валидатор ПІБ 
		var detect_pib = name.split(" ");
		if(detect_pib[0].length == 0 || detect_pib[1].length == 0 || detect_pib[2].length == 0 || typeof detect_pib[0] === "undefined"  || typeof detect_pib[1] === "undefined" || typeof detect_pib[2] === "undefined")
		{  
			alert('Некоректне ПІБ.'); 
		} 
		//Валидатор Email
		else if ((email.match(/.+?\@.+/g) || []).length !== 1) 
	    {
			alert('Некоректна адреса електронної пошти.');
		}
		//Валидатор Область
		else if(region == "none")
		{
			alert('Необхідно обрати область.');
		}
		//Валидатор Місто
		else if(city == "none" && $("#li_select_city").is(':visible'))
		{
			alert('Необхідно обрати місто.');
		}
		//Валидатор Район
		else if(district == "none" && $("#li_select_district").is(':visible'))
		{
			alert('Необхідно обрати район.');
		}
		else
		{
			var post_url = $(this).attr("action");
			var request_method = $(this).attr("method");
			var form_data = new FormData(this);
			$.ajax({
				type: request_method,
				url : post_url,
				data : form_data,
				contentType: false,
				cache: false,
				processData:false
				
			}).done(function(response){ 
				$("#server-results").html(response);
			});
		}
		
	});
	
})