//Theme
var primaryColor = "#294859";
var secondaryColor = "#ffffff";
var backgroundColor = "#eeeeee";
var accentColor1 = "#F0E100";
var accentColor2 = "#EEBA0B";

var themeSrc = "css/style.css";
var camUrl = "http://172.19.20.41:8081/";
//var camUrl = "https://wztxmxwb.p19.rt3.io/"
//var camUrl = "http://192.168.0.123:8081"

//var url = "http://192.168.0.123:8123/api/states"
var url = "http://172.19.20.41:8123/api/states"
//var url = "https://rzyygcpm.p19.rt3.io/api/states"
var firstLoad = 1;
var gotten = 0;

//JQuery 
$(document).ready(function(){


	var temp;
	var tempName;
	var humidity;
	var humidityName;
	var smoke;
	var smokeName;
	var co;
	var coName;
	var door1;
	var door1Name;
	var door2;
	var door2Name;
	var outlet_state;


	window.setInterval(function() {

        $.get(url, function(data, status){

        	for(var i = 0; i <  data.length; i++) {

             if(data[i].attributes.friendly_name == 'Humidity')
             {
               humidityName = data[i].attributes.friendly_name;
               humidity = data[i].state;
             }
              if(data[i].attributes.friendly_name == 'Temperature')
             {
               tempName = data[i].attributes.friendly_name;
               temp = data[i].state;
             }
             if(data[i].attributes.friendly_name == 'Smoke Sensor')
             {
               smokeName = data[i].attributes.friendly_name;
               smoke = data[i].state;
             }
              if(data[i].attributes.friendly_name == 'CO Sensor')
             {
               coName = data[i].attributes.friendly_name;
               co = data[i].state;
             }
              if(data[i].attributes.friendly_name == 'Z-Uno Door')
             {
               door1Name = data[i].attributes.friendly_name;
               door1 = data[i].state;
             }
              if(data[i].attributes.friendly_name == 'Ecolink Door Sensor')
             {
               door2Name = data[i].attributes.friendly_name;
               door2 = data[i].state;
             }
             if(data[i].attributes.friendly_name == 'Outlet Switch')
             {
             	outlet_state = data[i].state;
             }

         	}

        });

        $("#temperature").text(temp);
        $("#humidity").text(humidity);
        $("#smoke").text(smoke);
        $("#co").text(co);
        $("#door1").text(door1);
        $("#door2").text(door2);
        $("#outlet_state").text(outlet_state);

        gotten = 1;







          //1000 = 1 sec
        }, 1000);


	
	setTimeout(function(){ 
		if (gotten) {
		$("#temperatureSign").text("F");
		$("#humiditySign").text("%"); 
		//$("#coSign").text("PPM");
	}
	}, 2000);




function getStates(){
        $.get(url, function(data, status){

        	for(var i = 0; i <  data.length; i++) {

             if(data[i].attributes.friendly_name == 'Z-Uno Humidity')
             {
               humidityName = data[i].attributes.friendly_name;
               humidity = data[i].state;
             }
              if(data[i].attributes.friendly_name == 'Z-Uno Temp')
             {
               tempName = data[i].attributes.friendly_name;
               temp = data[i].state;
             }
             if(data[i].attributes.friendly_name == 'Smoke Detector'){
             	smokeName = data[i].attributes.friendly_name;
             	smoke = data[i].state
             }

         	}

        });

        $("#temperature").text(temp + "F");
        $("#humidity").text(humidity + "%");

}

});


function load(v){
	var child = document.getElementById("stage");



	switch(v) {
		case 1:
			select(1);
			child.src = "sensor_info.html";
			break;
		case 2:
			select(2);
			child.src="livecam.html";
			break;
		case 3:
			select(3);
			child.src="recordings.html";
			break;
		case 4:
			select(4);
			child.src="lights.html";
			break;
		case 5:
			select(5);
			child.src="locks.html";
			break;
		case 6:
			select(6);
			child.src="settings.html";
			break;
	}


}

function setTheme(theme) {

	

	switch(theme) {
		case "default":
			themeSrc = "css/style.css";
			window.parent.postMessage("css/style.css", '*');
			break;
		case "night":
			themeSrc = "css/night.css";
			window.parent.postMessage("css/night.css", '*'); 
			break;
		case "leafgreen":
			themeSrc = "css/leafgreen.css";
			window.parent.postMessage("css/leafgreen.css", '*'); 
			break;

	}



}

function select(op){

	var opString;
	for (i = 1; i < 7; i++) {
		opString = "op" + i;
		document.getElementById(opString).style.color = "";
		document.getElementById(opString).style.background = "";
	}

	opString = "op" + op;

	//var cssArray = document.getElementById("css").href.split('/');
	//var cssFile = cssArray[cssArray.length - 1];

	if (themeSrc == "css/night.css") {
		accentColor1 = "#9A348E";
		accentColor2 = "#DA627D"
		primaryColor = "white";
		document.getElementById("icon").src="img/icon_white.png";
	}
	
	else if (themeSrc == "css/style.css") {
		primaryColor = "#294859";
		accentColor1 = "#F0E100";
		accentColor2 = "#EEBA0B";
		document.getElementById("icon").src="img/icon_blue.png";
	}
	else if (themeSrc == "css/leafgreen.css") {
		primaryColor = "white";
		//accentColor1 = "#3C896D";
		accentColor1 = "#4FB286";
		accentColor2 = "#50FFB1";
		document.getElementById("icon").src="img/icon_white.png";
	

	}

	document.getElementById(opString).style.background = "linear-gradient(to right," + accentColor1 + "," + accentColor2 + ")";
	//document.getElementById(opString).style.color= "#4C212A";
	document.getElementById(opString).style.color= primaryColor;	
}

function getRecordings() {

}

function loadRecording() {

}

function about(){
	var modal = document.getElementById("modal");
	modal.style.display = "block";
}

function closeModal(){
	var modal = document.getElementById("modal");
	modal.style.display = "none";
}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
// Get the modal
var modal2 = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}
