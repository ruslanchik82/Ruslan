$(document).ready(function (){
	
	$("#show_content").hide();
	
	$("#select_region").load("app/models/db_select_action.php", { action:"region" }, function(){
		$("#show_content").show(200);
		$(".chosen_0").chosen();
		$("#loader").hide(200);
		$("#intro_text").delay(400).slideDown(400);
		$("#intro_text").delay(8400).slideUp(200);
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
	  
	  var region_value = $(this).val();
	  var region_split = region_value.split(",");
	  
	  if(region_split[0] == 80 || region_split[0] == 85)
	  {
		    var region = region_split[1];
			
			$.ajax({
				type: "POST",
				url: "app/models/db_select_action.php",
				data: { special_region:region, action:"special" }

				}).done(function(response) {
					$("#select_district").html(response);
					$("#registration_button").css({"pointer-events":"all"});
					
					if(response == "empty")
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
			var region = region_split[0];
			
			$.ajax({
				type: "POST",
				url: "app/models/db_select_action.php",
				data: { region:region, action:"city" }

				}).done(function(response) {
					$("#select_city").html(response);
					$("#registration_button").css({"pointer-events":"all"});
					
					if(response == "empty")
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
	   
		$.ajax({
			type: "POST",
			url: "app/models/db_select_action.php",
			data: { city:city, action:"district" }

			}).done(function(response) {
				$("#select_district").html(response);
				$("#registration_button").css({"pointer-events":"all"});
				
				if(response == "empty")
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