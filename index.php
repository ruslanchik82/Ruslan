<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>  
<script src="js/test.js" type="text/javascript"></script>
<script src="plugins/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="plugins/chosen/chosen.css" type="text/css"/>
<link rel="stylesheet" href="css/style.css" type="text/css"/>

<div id ="show_content">

<div id ="header_text">Форма реєстрації</div>

	<form method="post" action="php/register.php" id ="register_form">
	
	<ul>

		<li>
			<input type="text" name ="name" autocomplete="off" class ="input"  placeholder ="ПІБ" maxlength="36" onkeyup="this.value=this.value.replace(/[^A-Za-zА-Яа-яЁёІіЇїЄє\s]/g,'');" value ="" autofocus>
		</li>
		<li>
			<input type="text" name ="email" autocomplete="off" class ="input" placeholder ="Email" maxlength="36"  value ="">
		</li>
		<li>
			<select data-placeholder="Оберіть область" style="width:200px;" name ="select_region" id ="select_region" class="chosen_0">
				
			</select>
		</li>
		<li id ="li_select_city" style ="display:none;">
			<select data-placeholder="Оберіть місто" style="width:200px;" name="select_city" id="select_city" class="chosen_1">	
			
			</select>
		</li>
		<li id ="li_select_district" style ="display:none;">
			<select data-placeholder="Оберіть район" style="width:200px;" name="select_district" id="select_district" class="chosen_2">	

			</select>
		</li>
		
	</ul>
	
	<button type="submit" id ="registration_button" title ="Записати в базу">Записати в базу</button>
	
	</form> 
	
<div id ="server-results"></div>

</div>

<div id ="loader" style ="text-align:center;"><img style ="width:177.777px;" src ="images/brain.gif"></div>