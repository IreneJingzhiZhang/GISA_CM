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
		$permissionNeeded = 10;
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
<title>New Event</title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://jquery.com/resources/demos/style.css">
<link rel='shortcut icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<link rel='icon' href='../Resources/Images/favicon.ico' type='image/x-icon' />
<link rel="stylesheet" href="../Resources/CSS/Site.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    overflow-x: hidden;
  }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $('input.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '12:00am',
    maxTime: '11:00pm',
    startTime: '12:00am',
    dynamic: true,
    dropdown: true,
    scrollbar: true});
});

var availableVenues = [
		"test1", "test2"
	];

  $( function() {
    var availableTags = [
      "Eric Ditka",
      "Paul Rud",
      "Paulina Hutch",
      "RuPaul Charles"
    ];
    $( "#Manager" ).autocomplete({
      source: availableTags,
      minLength: 0
    });
  } );

  $( function() {
    $( "#Venue" ).autocomplete({
      source: availableVenues,
      minLength: 0
    });
  } );
  
  $( function() {
    var availableTags = [
      "test3", "test4"
    ];
    $( "#Vendors" ).autocomplete({
      source: availableTags,
      minLength: 0
    });
  } );
  
    $( function() {
    var availableTags = [
      "test3", "test4"
    ];
    $( "#Performers" ).autocomplete({
      source: availableTags,
      minLength: 0
    });
  } );


  $( function() {
    var dateFormat = "mm/dd/yy",
      StartDate = $( "#StartDate" )
        .datepicker({
          minDate: 0,
          changeMonth: true,
          changeYear: true
        })
        .on( "change", function() {
          EndDate.datepicker( "option", "minDate", getDate( this ) );
          EndDate.value=getDate( this );
        }),
      EndDate = $( "#EndDate" ).datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
      })
      .on( "change", function() {
        StartDate.datepicker( "option", "maxDate", getDate( this ) );
        StartDate.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  	
	function DeferedTextInputPrep(elementID,elementValue,width)
		{
		setTimeout(TextInputPrep(elementID,elementValue,width),100);
		}


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

	function NotesClear()
		{
		var element = document.getElementById("Notes");
		if(element.value == "Notes")
			{
			element.value = "";
			element.style = "border: 1px solid #000000; margin: 1px; border-radius: 5 px; text-align: left; height: 80px; width: 304px; color: #000000;";
			}
		}
		
	function NotesPrep()
		{
		var element = document.getElementById("Notes");
		if(element.value == "")
			{
			element.value = "Notes";
			element.style = "border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 80px; width: 304px; color: #C0C0C0;";
			}
		}
		
	function SetPanel()
		{
		var newWidth = document.documentElement.clientWidth-50;
		var newHeight = document.documentElement.clientHeight-50;
		var newStyle = "border-radius: 15px; border-style: solid; border-height: 20px; width: thin; width: "+newWidth+"px; height: "+newHeight+"px; min-height: 20px; width: 500px; min-height: 500px; padding:15px; background-color: #FFFFFF;";
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
				<h1>New Event</h1>
			</span>
			<span>
				<input name="EventName" id="EventName" type="text" value="Event Name" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('EventName','Event Name',308)" onfocusout="TextInputPrep('EventName','Event Name',308)" maxlength="32" tabindex="1" />
				<input name="Manager" id="Manager" type="text" value="Event Manager" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Manager','Event Manager',308)" onfocusout="TextInputPrep('Manager','Event Manager',308)" maxlength="49" tabindex="2" />
			</span>
			<br />
			<br />
			<span>
				<input type="text" id="StartDate" name="StartDate" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('StartDate','Start Date',150)" onfocusout="DeferedTextInputPrep('StartDate','Start Date',150)" tabindex="3" />
				<input type="text" id="EndDate" name="EndDate" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('EndDate','End Date',150)" onfocusout="DeferedTextInputPrep('EndDate','End Date',150)" tabindex="4" />
			</span>
			<br />
			<span>
				<input type="text" class="timepicker" id="StartTime" name="StartTime" value="Start Time" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('StartTime','Start Time',150)" onfocusout="DeferedTextInputPrep('StartTime','Start Time',150)" tabindex="5" />
				<input type="text" class="timepicker" id="EndTime" name="EndTime" value="End Time" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 150px; color: #C0C0C0;" onfocus="TextInputClear('EndTime','End Time',150)" onfocusout="DeferedTextInputPrep('EndTime','End Time',150)" tabindex="6" />
			</span>
			<br />
			<span>
				<input name="Venue" id="Venue" type="text" value="Venue" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 308px; color: #C0C0C0;" onfocus="TextInputClear('Venue','Venue',308)" onfocusout="TextInputPrep('Venue','Venue',308)" maxlength="32" tabindex="7" />
			</span>
			<br />
			<br />
			<span id="SetVendors">
			</span>
			<span>
				<input name="Vendors" id="Vendors" type="text" value="Vendors" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 282px; color: #C0C0C0;" onfocus="TextInputClear('Vendors','Vendors',282)" onfocusout="TextInputPrep('Vendors','Vendors',282)" maxlength="32" tabindex="8" />
				<input name="AddVendor" style="border: 1px solid #C0C0C0; border-radius: 5px; margin: 1px; width: 20px; height: 20px; background-color: #C0C0C0;" type="button" value="+" onclick="AddVendor()" tabindex="9" />
			</span>
			<br />
			<br />
			<span id="SetPerformers">
			</span>
			<span>
				<input name="Performers" id="Performers" type="text" value="Performers" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 282px; color: #C0C0C0;" onfocus="TextInputClear('Performers','Performers',282)" onfocusout="TextInputPrep('Performers','Performers',282)" maxlength="32" tabindex="10" />
				<input name="AddPerformer" style="border: 1px solid #C0C0C0; border-radius: 5px; margin: 1px; width: 20px; height: 20px; background-color: #C0C0C0;" type="button" value="+" onclick="AddPerformer()" tabindex="11" />
			</span>
			<br />
			<br />
			<span>
				<textarea name="Notes" id="Notes" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 80px; width: 304px; color: #C0C0C0;" onfocus="NotesClear()" onfocusout="NotesPrep()">Notes</textarea>
			</span>
			<br />
			<br />
			<span>
				<input name="Cancel" style="border: 1px solid #FF9999; border-radius: 5px; margin: 1px; height: 20px; width: 60px; height: 20px; background-color: #FF9999;" type="button" value="Cancel" onclick="Validate()" tabindex="14" align="top" />
				<input type="text" style="border: 1px solid #000000; margin: 1px; border-radius: 5px; text-align: center; height: 20px; width: 174px; color: #C0C0C0; visibility: hidden" />
				<input name="Create" style="height: 20px; border: 1px solid #C0C0C0; border-radius: 5px; margin: 1px; width: 60px; height: 20px; background-color: #C0C0C0;" type="button" value="Create" onclick="Validate()" tabindex="13" />
			</span>
		</div>
	</div>

</body>

</html>
