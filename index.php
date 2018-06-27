<?php
include ('pem_config.php');
?>
<!DOCTYPE html>
<html style = "height:100%">
	<head>
		<script type="text/javascript" src="script.js"></script>
		<LINK href="style.css" rel="stylesheet" type="text/css">

	</head>
<script>
window.onload = function(){
    var hash = (window.location.hash).replace('#', '');
    if (hash == "LHO") {
        loadPage('LHOPEMMapB.svg')
        resetHash()
    }
    if (hash == "LLO") {
        loadPage('LLOPEMMap.svg')
        resetHash()
    }
}
</script>
	<body style = "height:100%">

		<div id="container">
			<div id="content-container">
				<div id="map" style="height:100%">
					<object data="intro2.html" type="image/svg+xml" id="svg2" width="100%" height="99.5%"></object>
				</div>
				<div id="content" style = "border:2.25px solid black; height:93%;">
					<div id="header">
						<h1>
							&nbsp;ISC Photodiode Channel Info
						</h1>
					</div>
					<div id="navigation">
						<ul>
							<li style="font-size:90%; font-color:red"><a onclick="loadPage('LHOPEMMapB.svg');" href="javascript:void(0);">LHO</a></li>
							<li style="font-size:90%; font-color:red"><a onclick="loadPage('LLOPEMMap.svg');" href="javascript:void(0);">LLO</a></li>
							<li style="font-size:90%"><a href="<?php echo $PEM_db_url; ?>">Database</a></li>
							<li style="font-size:90%; vertical-align: middle;"><a onclick="loadPage('contact.html');" href="javascript:void(0);">Contact</a></li>
							<li style="font-size:90%"><a onclick="loadPage('intro2.html'); resetHash();" href="javascript:void(0);">Sensor Specs</a></li>
							<li style="font-size:90%"><a href="http://pem.ligo.org">PEM Home Page</a></li>
						</ul>
					</div>
					<div id="subcontent" style="width:100%;height:84%;">
							<table align="left" width="100%"><tr><td><h2>Channel Lookup</h2><td align="right"><small><a href="javascript:toggle()" id="plus">hide &#x25B2</a></small></td></tr></table>

						<div id = "search">
							<small>&nbsp;(Sensor for selected channel will flash on map.)</small>
							<p id="desc"><b> &nbsp;Click on a sensor on the map </b><br><input type="text" id="mousechannel" size="45"></p>
							<p><center>OR</center></p>
							<p>
							<form id="pasteform" action="<?php $_PHP_SELF ?>" method="GET">
							&nbsp;Paste a channel name: <br><input type="text" name="channelname" size="45" id="pastename"><input type="submit" value="Go">
							</form>
							<p><center>OR</center></p>
							<form id ="dropdownformH" action="<?php $_PHP_SELF ?>" method="GET">
								&nbsp;Select a channel:
								<br><select id="dropdownH" name="channelname">
								<option></option>
								<?php
								// The following code populates the dropdown list with entries from the LHO channel database
								($link = mysqli_connect($PEM_db_host,$PEM_db_username,$PEM_db_password, $PEM_db_name)) OR die("Unable to select database.");

								$query = "SELECT id FROM channels WHERE id like \"H%\" order by id asc";
								$result = mysqli_query($link, $query);
								if (!$result) die("Cannot execute query.");

								$rows = mysqli_num_rows($result);

								for ($i = 0; $i < $rows; $i++) {
									$row = mysqli_fetch_array($result);
									echo "<option>$row[id]</option>";
								}

								?>
								</select>
								<input type="submit" value="Search LHO" />
							</form>
							<form id ="dropdownformL" action="<?php $_PHP_SELF ?>" method="GET">
								<br><select id="dropdownL" name="channelname">
								<option></option>
								<?php
								// The following code populates the dropdown list with entries from the LLO channel database

								$query = "SELECT id FROM channels WHERE id like \"L%\" order by id asc";
								$result = mysqli_query($link, $query);
								if (!$result) die("Cannot execute query.");

								$rows = mysqli_num_rows($result);

								for ($i = 0; $i < $rows; $i++) {
									$row = mysqli_fetch_array($result);
									echo "<option>$row[id]</option>";
								}

								?>
								</select>
								<input type="submit" value="Search LLO" />
							</form>

							<br>
						</div>

						<hr>

						<?php
							// Hides the search bar when a channel has been selected and loads appropriate map
							if( $_GET["channelname"] ) {
							$channel_es = mysqli_real_escape_string($link, $_GET['channelname']);
							$channel = trim($channel_es);
							$site = substr($channel, 0, 1);
												switch ($site) {
													case "H":
														$map = "LHOPEMMapB.svg";
														break;
													case "L":
														$map = "LLOPEMMap.svg";
														break;
													case "V":
														$map = "vault.svg";
														break;
							}
							echo "<script language=javascript>loadPage(\"" .$map."\")</script>";
							echo "<script language=javascript>highlight(\"".$channel."\")</script>";
							echo "<script language=javascript>toggle()</script>";
						?>

							<div id="channelsection" style = "height:89.5%; border:4px solid white; overflow-y:scroll;">
								<?php
								// Searches selected channel in database and displays information

								$query = "SELECT * FROM channels WHERE id='$channel'";
								$result = mysqli_query($link, $query);
								if (!$result) die("Cannot execute query.");
								if(mysqli_num_rows($result) == 0) {
									echo "Channel \"" . $channel . "\" not found.";
								}

								if ($channel == "VAULT") { ?>
									<h2>
									<?php echo "VAULT"; ?>
									</h2>
									<p><b>STS: </b></p>
									<p><b>Host Box: </b></p>
									<li><i>Auto Zero button</i></li>
									<p><b>STS Breakout Box: </b></p>
									<p><b>MAG: </b></p>
									<li><i>X, Y, Z orthogonally mounted coils</i></li>
									<p><b>Fibox: </b></p>
									<li><i>XLR --> Fiber</i></li>
									<li><i>12 V DC powered</i></li>
									<li><i>Gain:</i></li>
									<p><b>Fibox Patch Panel: </b></p>
									<p><b>DC Patch Panel: </b></p>
								<?php }

								else {

									$row = mysqli_fetch_array($result); ?>
									<?php $current_channel = $row[id]; ?>
									<h2>
										<a href="https://cis.ligo.org/channel/?qq=<?php echo urlencode($row[id]) ?>">
											<?php echo $row[id] ?>
										</a>
									</h2>
										
									<p><b>Photodiode type: </b>
										Si <a href="https://dcc.ligo.org/cgi-bin/private/DocDB/ShowDocument?docid=T1100467&version=">
											(BBPD)
										</a>	
									<p><b>Efficiency: </b> ~<?php 
										echo $row[efficiency]?>%
									<p><b> Quad PD? </b> <?php
										if ($row[qpd] == 1) {
											echo "Yes";
										} else {
											echo "No";
											}?>
									<p><b> RFPD? </b> <?php
										if ($row[rf] == 1) {
											echo "Yes";
										} else {
											echo "No";
											}?>
									<p><b> WFS? </b> <?php
										if ($row[wfs] == 1) {
											echo "Yes";
										} else {
											echo "No";
											}?>
									<p><b>Subsystems: </b>
										<?php
											$subsystem_info_written = False;
											if (array_key_exists('subsys_0', $row) and array_key_exists('subsys_0_name', $row)) {
												$subsystem_info_written = True;
												echo "<br><i>" . $row[subsys_0] . ": </i>" . $row[subsys_0_name];
												if (array_key_exists('subsys_0_desc') {
													echo "<br><i>" . $row[subsys_0_desc] . "</i>";
												}
											}
											if (array_key_exists('subsys_1', $row) and array_key_exists('subsys_1_name', $row)) {
												$subsystem_info_written = True;
												echo "<br><i>" . $row[subsys_1] . ": </i>" . $row[subsys_1_name];
												if (array_key_exists('subsys_1_desc') {
													echo "<br><i>" . $row[subsys_1_desc] . "</i>";
												}
											}
											if (array_key_exists('subsys_2', $row) and array_key_exists('subsys_2_name', $row)) {
												$subsystem_info_written = True;
												echo "<br><i>" . $row[subsys_2] . ": </i>" . $row[subsys_2_name];
												if (array_key_exists('subsys_2_desc') {
													echo "<br><i>" . $row[subsys_2_desc] . "</i>";
												}
											}
											if (array_key_exists('subsys_3', $row) and array_key_exists('subsys_3_name', $row)) {
												$subsystem_info_written = True;
												echo "<br><i>" . $row[subsys_3] . ": </i>" . $row[subsys_3_name];
												if (array_key_exists('subsys_3_desc') {
													echo "<br><i>" . $row[subsys_3_desc] . "</i>";
												}
											}
											if (! $subsystem_info_written) {
												echo "<br><i>No subsystem information available.</i>";
											}
										?>
									<p><b>Notes: </b>
										<br><i><?php echo $row[description] ?>
                                    <!--<p><b>Current Status: </b>
                                       <?php //if(is_null($row[status])) {
                                           // echo "Unknown";
                                         $chan_st = str_replace(":", "_", $current_channel);
                                         $end_str = '_DQ_status.html';
                                         $chan_withdq = $chan_st.$end_str;
                                         $lho_ligocam_status_path = 'https://ldas-jobs.ligo-wa.caltech.edu/~dtalukder/Projects/detchar/LigoCAM/PEM/status/';
                                         $llo_ligocam_status_path = 'https://ldas-jobs.ligo-la.caltech.edu/~dtalukder/Projects/detchar/LigoCAM/PEM/status/';
					 $lho_ligocam_status = $lho_ligocam_status_path.$chan_withdq;
					 $llo_ligocam_status = $llo_ligocam_status_path.$chan_withdq;
                                         if (strpos($current_channel,'H1:PEM') !== false) {
                                             echo '<a href="' . $lho_ligocam_status . '" target="_blank">Check here</a>';
                                        }
                                         else {
                                            //echo $row[status];
                                             echo '<a href="' . $llo_ligocam_status . '" target="_blank">Check here</a>';
                                         }
                                        ?>

                                    <p><b>Coupling Function:</b>
                                        <?php
                                        $coup_func_path = '/couplingfunctions/data/';
                                        $coup_func_data = $coup_func_path.$current_channel.'_composite_coupling_data.txt';
                                        $coup_func_plot = $coup_func_path.$current_channel.'_composite_coupling_plot.png';
                                        echo '<a href="' . $coup_func_data . '" target="_blank">Data</a> &nbsp; <a href="' . $coup_func_plot . '" target="_blank">Plot</a>';
                                        ?>

									<p><b>Calibration:</b><ul>

												<?php
												// Displays calibration information from calibration table
												$sens = substr($row[id], 10, 3);
												switch ($sens) {
													case "MAG":
														$sensor = "mag";
														break;
													case "SEI":
														$sensor = "sei";
														break;
													case "ACC":
														$sensor = "acc";
														break;
													case "MIC":
														$sensor = "mic";
														break;
												}
												$sensorresult = mysqli_query($link, "SELECT * FROM calibration WHERE Sensor='". $sensor . "'");
												$caltable = mysqli_fetch_array($sensorresult);
												echo "<li><i>Factor: </i>" . $row[calibration] . "</li><li><i>Calulation: </i>" . $row[calculation] . "</li><li><i>Range: </i>" . $caltable[range] . "</li><li><i>Amplitude Error: </i>" . $caltable[amplitude_error] . "</li><li><i>Phase Error: </i>" . $caltable[phase_error] . "</li>";
												?>
										</ul>
									<p><b>Sample rate: </b> <?php print_r($row[sample_rate]); ?>
									<p><b>Grid location (X, Y, Z) (mm from vertex on LVEA floor): </b>
										<?php if(is_null($row[grid_location_x])) {
											echo "Coming soon.";
										}
										else {
											echo "(" . $row[grid_location_x] . ", " . $row[grid_location_y] . ", " . $row[grid_location_z] . ")";
										} ?>--!>
                                    <!-- <p><b>AA Chassis Channel: </b>
                                        <?php if(is_null($row[aa_channel])) {
                                            echo "Coming soon.";
                                        }
                                        else {
                                            echo $row[aa_channel];
                                        } ?>
                                    <p><b>Date Tested: </b>
                                        <?php if(is_null($row[date_tested])) {
                                            echo "Coming soon.";
                                        }
                                        else {
                                            echo $row[date_tested];
                                        } ?>
                                    <p><b>Date Calibrated: </b>
                                        <?php if(is_null($row[calibration_date])) {
                                            echo "Coming soon.";
                                        }
                                        else {
                                            echo $row[calibration_date];
                                        } ?> --!>
									<!--<p><b>Sample spectrum:</b> <br>
									<?php if (file_exists("pictures/" . str_replace(":", "-", $row[id]) . "-spec.jpg")) { ?>
									<?php echo "<img src=\"pictures/" . str_replace(":", "-", $row[id]) . "-spec.jpg\" width=\"100%\" />"; ?>
									<?php } else {echo " Not currently available.";} ?>

									<?php
									$url = "https://ldvw.ligo.caltech.edu/ldvw/view?act=doplot&chanName=$row[id]_DQ&strtTime=-300&duration=20&doSpectrum&sp_logx=1&sp_logy=1&doTimeSeries";
									echo "<a href=$url target=\"_blank\">(Click here to open the current time series and spectrum in a new tab. NOTE: Ligo credentials required.)</a>  ";
									?>
									<p><b>Picture:</b> <br>
									<?php if (file_exists("pictures/" . str_replace(":", "-", $row[id]) . ".jpg")) { ?>
									<?php echo "<img src=\"pictures/" . str_replace(":", "-", $row[id]) . ".jpg\" width=\"99.5%\" border=\"1.75\" />"; ?>
									<?php } else {echo "Not currently available.";} ?>
									--!>
								<?php }
								mysqli_close($link); ?></p>
							</div>

						<?php } ?>
					</div>

				</div>
			</div>
			<div id="footer" style="background-color:gainsboro; float:bottom;">
			<table width="100%" height="5%"><tr><td align="left">Created by Rainer Corley and Stefan Countryman</td><td align="center">Last Updated: June 8, 2018</td><td align="right"><a href="documentation/index.html">Instructions for editing website</a></td></tr></table>
			</div>
		</div>
	</body>
</html>
