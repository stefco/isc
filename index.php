<!DOCTYPE html>
<!-- saved from url=(0041)http://pem.ligo.org/channelinfo/index.php -->
<html style="height:100%"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script type="text/javascript" src="./index.php_files/script.js"></script>
		<link href="./index.php_files/style.css" rel="stylesheet" type="text/css">

	<script>
window.onload = function(){
    var hash = (window.location.hash).replace('#', '');
    if (hash == "LHO") {
        loadPage('LHOPEMMap2.svg')
        resetHash()
    }
    if (hash == "LLO") {
        loadPage('LLOPEMMap.svg')
        resetHash()
    }
}
</script></head>

	<body style="height:100%">

		<div id="container">
			<div id="content-container">
				<div id="map" style="height:100%">
					<object data="./index.php_files/LLOPEMMap.svg" type="image/svg+xml" id="svg2" width="100%" height="99.5%"></object>
				</div>
				<div id="content" style="border:2.25px solid black; height:93%;">
					<div id="header">
						<h1>
							&nbsp;Photodiode Channel Info
						</h1>
					</div>
					<div id="navigation">
						<ul>
							<li style="font-size:90%; font-color:red"><a onclick="loadPage(&#39;LHOPEMMapB.svg&#39;);" href="javascript:void(0);">LHO</a></li>
							<li style="font-size:90%; font-color:red"><a onclick="loadPage(&#39;LLOPEMMap.svg&#39;);" href="javascript:void(0);">LLO</a></li>
							<li style="font-size:90%"><a href="https://redoubt.ligo-wa.caltech.edu/websvn/filedetails.php?repname=pem&amp;path=%2Ftrunk%2Fpem.sql">Database</a></li>
							<li style="font-size:90%; vertical-align: middle;"><a onclick="loadPage(&#39;contact.html&#39;);" href="javascript:void(0);">Contact</a></li>
							<li style="font-size:90%"><a onclick="loadPage(&#39;intro2.html&#39;); resetHash();" href="javascript:void(0);">Sensor Specs</a></li>
							<li style="font-size:90%"><a href="http://pem.ligo.org/">PEM Home Page</a></li>
						</ul>
					</div>
					<div id="subcontent" style="width:100%;height:84%;">
							<table align="left" width="100%"><tbody><tr><td><h2>Channel Lookup</h2></td><td align="right"><small><a href="javascript:toggle()" id="plus">hide ▲</a></small></td></tr></tbody></table>

						<div id="search">
							<small>&nbsp;(Sensor for selected channel will flash on map.)</small>
							<p id="desc"><b> &nbsp;Click on a sensor on the map </b><br><input type="text" id="mousechannel" size="45"></p>
							<p></p><center>OR</center><p></p>
							<p>
							</p><form id="pasteform" action="http://pem.ligo.org/channelinfo/index.php" method="GET">
							&nbsp;Paste a channel name: <br><input type="text" name="channelname" size="45" id="pastename"><input type="submit" value="Go">
							</form>
							<p></p><center>OR</center><p></p>
							<form id="dropdownformH" action="http://pem.ligo.org/channelinfo/index.php" method="GET">
								&nbsp;Select a channel:
								<br><select id="dropdownH" name="channelname">
								<option></option>
								<option>H1:ASC-AS_A</option><option>H1:ASC-AS_B</option><option>H1:ASC-AS_C</option><option>H1:ASC-OMC_A</option><option>H1:ASC-OMC_B</option><option>H1:ASC-OMCR_A</option><option>H1:ASC-OMCR_B</option><option>H1:ASC-POP_A</option><option>H1:ASC-POP_B</option><option>H1:ASC-REFL_A</option><option>H1:ASC-REFL_B</option><option>H1:ASC-X_TR_A</option><option>H1:ASC-X_TR_B</option><option>H1:ASC-Y_TR_A</option><option>H1:ASC-Y_TR_B</option><option>H1:IMC-IM4_TRANS</option><option>H1:IMC-MC2_TRANS</option><option>H1:IMC-REFL</option><option>H1:IMC-TRANS</option><option>H1:IMC-WFS_A</option><option>H1:IMC-WFS_B</option><option>H1:LSC-ASAIR_A</option><option>H1:LSC-ASAIR_B</option><option>H1:LSC-POP_A</option><option>H1:LSC-POPAIR_A</option><option>H1:LSC-POPAIR_B</option><option>H1:LSC-REFL_A</option><option>H1:LSC-REFLAIR_A</option><option>H1:LSC-REFLAIR_B</option><option>H1:OMC-DCPD_A</option><option>H1:OMC-DCPD_B</option><option>H1:POP_X_WFS</option><option>H1:PSL-ISS_SECONDLOOP_PD_14</option><option>H1:PSL-ISS_SECONDLOOP_PD_58</option><option>H1:PSL-ISS_SECONDLOOP_QPD</option> </select>
								<input type="submit" value="Search LHO">
							</form>
							<form id="dropdownformL" action="http://pem.ligo.org/channelinfo/index.php" method="GET">
								<br><select id="dropdownL" name="channelname">
								<option></option>
								<option>L1:ASC-AS_A</option><option>L1:ASC-AS_B</option><option>L1:ASC-AS_C</option><option>L1:ASC-OMC_A</option><option>L1:ASC-OMC_B</option><option>L1:ASC-OMCR_A</option><option>L1:ASC-OMCR_B</option><option>L1:ASC-POP_A</option><option>L1:ASC-POP_B</option><option>L1:ASC-REFL_A</option><option>L1:ASC-REFL_B</option><option>L1:ASC-X_TR_A</option><option>L1:ASC-X_TR_B</option><option>L1:ASC-Y_TR_A</option><option>L1:ASC-Y_TR_B</option><option>L1:IMC-IM4_TRANS</option><option>L1:IMC-MC2_TRANS</option><option>L1:IMC-REFL</option><option>L1:IMC-TRANS</option><option>L1:IMC-WFS_A</option><option>L1:IMC-WFS_B</option><option>L1:LSC-ASAIR_A</option><option>L1:LSC-ASAIR_B</option><option>L1:LSC-POP_A</option><option>L1:LSC-POPAIR_A</option><option>L1:LSC-POPAIR_B</option><option>L1:LSC-REFL_A</option><option>L1:LSC-REFLAIR_A</option><option>L1:LSC-REFLAIR_B</option><option>L1:OMC-DCPD_A</option><option>L1:OMC-DCPD_B</option><option>L1:POP_X_WFS</option><option>L1:PSL-ISS_SECONDLOOP_PD_14</option><option>L1:PSL-ISS_SECONDLOOP_PD_58</option><option>L1:PSL-ISS_SECONDLOOP_QPD</option> </select>
								<input type="submit" value="Search LLO">
							</form>

							<br>
						</div>

						<hr>

											</div>

				</div>
			</div>
			<div id="footer" style="background-color:gainsboro; float:bottom;">
			<table width="100%" height="5%"><tbody><tr><td align="left">Created by:</td><td align="center">Last Updated:</td><td align="right"><a href="http://pem.ligo.org/channelinfo/documentation/index.html">Instructions for editing PEM website</a></td></tr></tbody></table>
			</div>
		</div>
	

</body></html>
