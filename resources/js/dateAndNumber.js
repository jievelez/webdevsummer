var i = 0;
var j = 0;
var data = "";

var dateNow = new Date();
var Currentday = dateNow.getDate();
var Currentmonth = dateNow.getMonth();
var Currentyear = dateNow.getFullYear();

var monthNames = ["January","February","March","April","May","June","July","August","September","October","November", "December"];
var dayPerMonth = [31, 0, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

function firstload()
{
    dayPerMonth[1] = ((Currentyear % 4) == 0) ? 29 : 28;
    openDate()
}

function openDate()
{
    var year = document.getElementById("birthYear").value;
  	var month = document.getElementById("birthMonth").value;
  	var day = document.getElementById("birthDay").value;

  	year = (typeof year !== 'undefined' && year > 0) ? year : Currentyear;
  	month = (typeof month !== 'undefined' && month > 0) ? month : Currentmonth;
  	day = (typeof day !== 'undefined' && day > 0) ? day : Currentday;

  	data = "";
  	for (i = Currentyear; i >= 1001; i--)
        data += "<option>" + i + "</option>";

  	document.getElementById("birthYear").innerHTML = data;

  	data = "<option selected>" + monthNames[month] + "</option>";
  	for (i = 0; i < 12; i++)
        if (i != month)
            data += "<option>" + monthNames[i] + "</option>";

    document.getElementById("birthMonth").innerHTML = data;

    data = "<option selected>" + day + "</option>";
  	for (i = 0; i < dayPerMonth[month]; i++)
        if ((i + 1) != day)
            data += "<option>" + (i + 1) + "</option>";

    document.getElementById("birthDay").innerHTML = data;
}

function fixDaysPerMonth()
{
    var year = document.getElementById("birthYear").value;

    if (typeof year !== 'undefined' && year > 0)
	  {
        dayPerMonth[1] = ((year % 4) == 0) ? 29 : 28;

        var month = document.getElementById("birthMonth").value;

        for (i = 0; i < 12; i++)
            if (month == monthNames[i])
                month = i;

        if (typeof month !== 'undefined' && month > 0)
        {
            data = "";

            for (i = 0; i < dayPerMonth[month]; i++)
                data += "<option>" + (i + 1) + "</option>";

            document.getElementById("birthDay").innerHTML = data;
        }
	  }
}

function validateNumber(evt)
{
    var theEvent = evt || window.event;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    }
    else
    {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }

    var regex = /[0-9]/;

    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
