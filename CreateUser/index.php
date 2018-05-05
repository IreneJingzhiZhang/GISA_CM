<?php
function exception_error_handler($errno, $errstr, $errfile, $errline )
	{
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
	}
set_error_handler("exception_error_handler");
if(!isset($_POST['token']))
	{
//	header('Location: http://students.cs.niu.edu/~z1665668/csci467/GISA_CM/Login/');
	}
else
	{
	try
		{
		$permissionNeeded = 0;
		include_once("../Resources/PHP/validateToken.php");
		}
	catch(ErrorException $e)
		{
		header('Location: http://students.cs.niu.edu/~z1665668/csci467/GISA_CM/Login/');
		}
	}
?>

<!DOCTYPE html>
<html style="width: 100%; height: 90%">

<head>
<title>New User</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://jquery.com/resources/demos/style.css">
<link rel='shortcut icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<link rel='icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

  $( function() {
    var availableTags = [
      "Event Staff",
      "Event Manager",
      "Business Vice President"
    ];
    $( "#Title" ).autocomplete({
      source: availableTags,
      minLength: 0
    });
  } );
  
  $( function() {
    var availableTags = [
      "Alabama",		"Montana",
      "Alaska",			"Nebraska",
      "Arizona",		"Nevada",
      "Arkansas",		"New Hampshire",
      "California",		"New Jersey",
      "Colorado",		"New Mexico",
      "Connecticut",	"New York",
      "Delaware",		"North Carolina",
      "Florida",		"North Dakota",
      "Georgia",		"Ohio",
      "Hawaii",			"Oklahoma",
      "Idaho",			"Oregon",
      "Illinois",		"Pennsylvania",
      "Indiana",		"Rhode Island",
      "Iowa",			"South Carolina",
      "Kansas",			"South Dakota",
      "Kentucky",		"Tennessee",
      "Louisiana",		"Texas",
      "Maine",			"Utah",
      "Maryland",		"Vermont",
      "Massachusetts",	"Virginia",
      "Michigan",		"Washington",
      "Minnesota",		"West Virginia",
      "Mississippi",	"Wisconsin",
      "Missouri",		"Wyoming"
    ];
    $( "#State" ).autocomplete({
      source: availableTags,
      minLength: 0
    });
  } );

	function TextInputClear(elementID,elementValue,width)
		{
		var element = document.getElementById(elementID);
		if(element.value == elementValue)
			{
			element.value = "";
			element.style = "border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: "+width+"px; color: #000000;";
			}
		}
		
	function TextInputPrep(elementID,elementValue,width)
		{
		var element = document.getElementById(elementID);
		if(element.value == "")
			{
			element.value = elementValue;
			element.style = "border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: "+width+"px; color: #C0C0C0;";
			}
		}
		
	function SetPanel()
		{
		var newWidth = document.documentElement.clientWidth-50;
		var newHeight = document.documentElement.clientHeight-50;
		var newStyle = "border-radius: 15px; border-style: solid; border-height: 20px; width: thin; width: "+newWidth+"px; height: "+newHeight+"px; min-height: 20px; width: 500px; min-height: 500px; padding:15px; background-color: #FFFFFF;";
		document.getElementById("CreateUserPanel").style = newStyle;
		}

window.onresize = SetPanel;

</script>
<style type="text/css">
.auto-style1 {
	margin-left: 0px;
}
.auto-style2 {
	margin-left: 0px;
	margin-top: 0px;
}
.ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
}
</style>
</head>

<body style="background-color: #000000; font-family: Arial, Helvetica, sans-serif; width: 95%; height: 100%;" onload="SetPanel()">
	<div align="center" style="width: 100%; height: 100%">      
		<div id="CreateUserPanel" class="auto-style1" style="border-radius: 15px; border-style: solid; border-width: thin; width: 100%; height: 100%; padding:15px; background-color: #FFFFFF;">
			<span>
				<h1>New User</h1>
			</span>
			<span>
				<input id="FirstName" maxlength="24" name="FirstName" onfocus="TextInputClear('FirstName','First Name',140)" onfocusout="TextInputPrep('FirstName','First Name',140)" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 140px; color: #C0C0C0; left: 0px;" tabindex="1" type="text" value="First Name" />
				<input name="LastName" id="LastName" type="text" value="Last Name" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 160px; color: #C0C0C0; right: 0px;" onfocus="TextInputClear('LastName','Last Name',160)" onfocusout="TextInputPrep('LastName','Last Name',160)" maxlength="24" tabindex="2" />
			</span>
			<br />
			<span>
				<input name="Title" id="Title" type="text" value="Job Title" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Title','Job Title',308)" onfocusout="TextInputPrep('Title','Job Title',308)" maxlength="32" tabindex="3" />
			</span>
			<br />
			<br />
			<span>
				<input name="OfficePhone" id="OfficePhone" type="text" value="Office Phone" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('OfficePhone','Office Phone',150)" onfocusout="TextInputPrep('OfficePhone','Office Phone',150)" maxlength="10" tabindex="4" />
				<input name="CellPhone" id="CellPhone" type="text" value="Cell Phone" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('CellPhone','Cell Phone',150)" onfocusout="TextInputPrep('CellPhone','Cell Phone',150)" maxlength="10" tabindex="5" />
			</span>
			<br />
			<span>
				<input name="Email" id="Email" type="email" value="Email" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Email','Email',308)" onfocusout="TextInputPrep('Email','Email',308)" maxlength="255" tabindex="6" />
			</span>
			<br />
			<br />
			<span>
				<input name="Address1" id="Address1" type="text" value="Street Address Line 1" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Address1','Street Address Line 1',308)" onfocusout="TextInputPrep('Address1','Street Address Line 1',308)" maxlength="48" tabindex="7" />
			</span>
			<br />
			<span>
				<input name="Address2" id="Address2" type="text" value="Street Address Line 2" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Address2','Street Address Line 2',308)" onfocusout="TextInputPrep('Address2','Street Address Line 2',308)" maxlength="48" tabindex="8" />
			</span>
			<br />
			<span>
				<input name="City" id="City" type="text" value="City" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 115px; color: #C0C0C0;" onfocus="TextInputClear('City','City',115)" onfocusout="TextInputPrep('City','City',115)" maxlength="24" tabindex="9" />
				<input name="State" id="State" type="text" value="State" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 115px; color: #C0C0C0;" onfocus="TextInputClear('State','State',115)" onfocusout="TextInputPrep('State','State',115)" maxlength="24" tabindex="10" />
				<input name="ZipCode" id="ZipCode" type="text" value="Zip" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 61px; color: #C0C0C0;" onfocus="TextInputClear('ZipCode','Zip',61)" onfocusout="TextInputPrep('ZipCode','Zip',61)" maxlength="5" tabindex="11" />
			</span>
			<br />
			<br />
			<span>
				<input name="Cancel" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; height: 20px; width: 60px; height: 20px; background-color: #FF9999;" type="button" value="Cancel" onclick="Validate()" tabindex="14" align="top" />
				<input name="Username" id="Username" type="text" value="Username" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 174px; color: #C0C0C0;" onfocus="TextInputClear('Username','Username',174)" onfocusout="TextInputPrep('Username','Username',174)" maxlength="24" tabindex="12" align="top" />
				<input name="Create" style="height: 20px; border: 1px solid #C0C0C0; border-radius: 5px; margin: 1px; width: 60px; height: 20px; background-color: #C0C0C0;" type="button" value="Create" onclick="Validate()" tabindex="13" />
			</span>
		</div>
	</div>

</body>

</html>
