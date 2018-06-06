/* 

Aside from interactions with the database, all other interactivity on the website is controlled with JavaScript functions. These are separated into two groups: the three functions found at the top of the .svg maps control interactions with the map, and the rest of the functions that control the webpage are found in script.js. Below are descriptions of their properties and purposes:
map_to_channel(selection)
This function gets called by lookupChannel(id), a function defined in the .svg maps. lookupChannel(id) passes the name of a sensor on the map to map_to_channel(selection), which then posts the channel name in the search form on the webpage and submits the search. This sends a query to the database, and returns information about the selected channel.

highlight(selection)
This function gets called in index.php every time the search form is submitted (i.e. when the user clicks one of the "Go" buttons or on a sensor on the map). It searches the svg document for an object whose "id" matches the selected channel, then identifies all the path elements of that sensor. It calls color(newElements) on those path elements every 600ms to achieve the flashing effect.

color(newElements)
This function first stores the original colors of the path elements of a sensor, then colors them all yellow. It calls uncolor(newElements) every 300ms so that the sensor flashes yellow at 300ms intervals.

uncolor(newElements)
This function restores the original colors of a sensor. It is called 300ms after color(newElements) is called.

toggle()
This function toggles between hiding and showing the search section of the webpage. By default the search section is shown, but when the search form is submitted, this function is called, which hides the search section and makes room for displaying the channel information. This function is called whenever the hide/show button in the top right corner of the search section is pressed.

loadPage(page)
This loads data into the right hand side of the webpage, into the section the map occupies by default. For example, when a user clicks on the LLO link, this function loads the LLO map into the map section. It can also load text into the map section, e.g. when the user clicks on "Channel Naming", "Sensor Info", or "Contact". 

resetHash() 
This function removes the #LHO or #LLO hash at the end of the url. Hashes arise from index.html, allowing for site-specific links that directly load the requested site's map and channels. These hashes are then immediately removed upon page load of pem.ligo.org so that index.php then functions normally. Note that currently this function is only supported in Chrome 9, Firefox 4, Safari 5, Opera 11.50 and in IE 10.

*/

var defaultColors = new Array();

// Enables clicking on map to search database
function map_to_channel(selection) {
	var form = document.getElementById("pasteform");
	var field = document.getElementById("pastename");
	field.value = selection;
	form.submit();
}

// Highlights sensor on map by calling color() every 600ms
function highlight(selection) {
        var map = document.getElementById("svg2");
        map.addEventListener("load",function(){
			var svgDoc = map.contentDocument;
			var sensor = svgDoc.getElementById(selection);
			if (sensor == null) {
				var l = selection.length;
				var zaxis = selection.substr(0,l-1) + 'Z';
				sensor = svgDoc.getElementById(zaxis);
			}
			var newElements= sensor.getElementsByTagName("path");
			setInterval(function(){color(newElements)},600);
        },false);
}

// color() calls uncolor() ever 300ms to make sensor flash
function color(newElements) {
		for (var i=0; i<newElements.length; i++) {
			defaultColors[i] = newElements[i].style.fill;
			newElements[i].style.setProperty("fill","#FFE303","");
		}
		setTimeout(function(){uncolor(newElements)},300);
}

function uncolor(newElements) {
		for (var i=0; i<newElements.length; i++) {
			newElements[i].style.setProperty("fill", defaultColors[i], "");
		}
}

// Toggles the hide/show button for the search section
function toggle(){
  var p = document.getElementById("search");
  var q = document.getElementById("plus");
  q.innerHTML = p.style.display == "none" ? "hide &#x25B2" : "show &#x25BC";
  p.style.display = p.style.display == "none" ? "inline" : "none";
}

// Loads data into the right-hand side of webpage
function loadPage(page) {
	var object = document.getElementById("svg2");
	var clone=object.cloneNode(true);
	clone.setAttribute("data", page);
	object.parentNode.replaceChild(clone,object)
}


//Resets hash without page refresh
function resetHash() {
	history.pushState("", document.title, window.location.pathname
                                                       + window.location.search);
}
