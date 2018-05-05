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
		$permissionNeeded = 5;
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
<title>Detailed Reports</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://jquery.com/resources/demos/style.css">
<link rel='shortcut icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<link rel='icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<link rel="stylesheet" href="../Resources/CSS/Site.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
		
	function SetPanel()
		{
		var newWidth = document.documentElement.clientWidth-50;
		var newHeight = document.documentElement.clientHeight-50;
		var newStyle = "border-radius: 15px; border-style: solid; border-height: 20px; width: thin; width: "+newWidth+"px; height: "+newHeight+"px; width: 500px; min-height: 500px; padding:15px; background-color: #FFFFFF;";
		document.getElementById("CreateEventPanel").style = newStyle;
		}

window.onresize = SetPanel;
window.onload = function()
		{
		DeferedTextInputPrep('StartDate','Start Date',150);
		DeferedTextInputPrep('EndDate','End Date',150);
		}

</script>

</head>

<body style="background-color: #000000; font-family: Arial, Helvetica, sans-serif; width: 95%; height: 100%;" onload="SetPanel()">
	<div align="center" style="width: 100%; height: 100%">      
		<div id="CreateEventPanel" class="auto-style1" style="border-radius: 15px; border-style: solid; border-width: thin; width: 100%; height: 100%; padding:15px; background-color: #FFFFFF;">
			<span>
				<h1>Generate Report</h1>
			</span>
			<span>
				<input name="Event1" id="Event1" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; background-color: #C0C0C0;" type="radio" value="1" align="bottom" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 230px; color: #000000; padding-left: 2px;" disabled="disabled" value="Holiday Concert" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 70px; color: #000000; padding-left: 2px;" disabled="disabled" value="Created" />
			</span>
			<br />
			<span>
				<input name="Event1" id="Event1" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; background-color: #C0C0C0;" type="radio" value="2" align="bottom" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 230px; color: #000000; padding-left: 2px;" disabled="disabled" value="New Years Bash" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 70px; color: #000000; padding-left: 2px;" disabled="disabled" value="Created" />
			</span>
			<br />
			<span>
				<input name="Event1" id="Event1" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; background-color: #C0C0C0;" type="radio" value="2" align="bottom" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 230px; color: #000000; padding-left: 2px;" disabled="disabled" value="Octoberfest" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: left; height: 20px; width: 70px; color: #000000; padding-left: 2px;" disabled="disabled" value="Approved" />
			</span>
			<br />
			<br />
				<fieldset style="width: 308px;" align="left">
					<legend>General:</legend>
					<input type="checkbox" checked>End Date &amp; Time<br />
					<input type="checkbox" checked style="margin-left: 25px">End Date Only If Different<br />
					<input type="checkbox">Show Vendors First<br />
				</fieldset>
				<fieldset style="width: 308px;" align="left">
					<legend>Performers:</legend>
					<input type="checkbox" >Artist/Band Leader Name<br />
					<input type="checkbox" disabled="disabled" style="margin-left: 25px">Artist/Band Leader Details<br />
					<input type="checkbox">List All Members (Bands)<br />
					<input type="checkbox" checked>Agent Name<br />
					<input type="checkbox" style="margin-left: 25px">Agent Details<br />
					<input type="checkbox">Logo<br />
					<input type="checkbox">Rate
				</fieldset>
				<fieldset style="width: 308px;" align="left">
					<legend>Vendors:</legend>
					<input type="checkbox">Vendor Details<br />
					<input type="checkbox" checked>Vendor Type<br />
					<input type="checkbox" checked>Contact Name<br />
					<input type="checkbox" checked style="margin-left: 25px">Contact Details
				</fieldset>
			<span>
				<input name="Cancel" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; height: 20px; width: 60px; height: 20px; background-color: #FF9999;" type="button" value="Cancel" onclick="Validate()" tabindex="4" align="top" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 174px; color: #C0C0C0; visibility: hidden" />
				<input name="Produce" style="height: 20px; border: 1px solid #C0C0C0; border-radius: 5px; margin: 1px; width: 60px; height: 20px; background-color: #C0C0C0;" type="button" value="View" onclick="Validate()" tabindex="3" />
			</span>
		</div>
	</div>

</body>

</html>
