<?php
	require "dbconnect.php";
	include('time_checker.php');

	if ($_SESSION['login']==0) header('Location: login_page.php');
?>

<html>
	<head>
		<title>Find Right Treatment</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>
	<body>
		<div id = "menu_container">
			<div id="menu_wrapper">
				<ul class = "main_menu_left">
					<li><a class="top_menu" href = "dboardPatient.php">Dashboard</a></li>
					<li><a class="top_menu" href = "patient_profile.php">Profile</a></li>
					<li><a class="top_menu" href = "appointments_patient.php">Appointment</a></li>

				</ul>

				<ul class = "main_menu_right">

						<li>
							<form name='searchdoctor' action='search_patient.php' method='post'>
							Search by:
							<select name="searchtype" id = "option">
								<option name="specialty">Specialty</option>
								<option name="name">Name</option>
								<option name="hospital">Hospital</option>
							</select>
							<input class='search_bar' type='text' name='searchinput'> </a>
							</form>
						</li>

					<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
				</ul>
			</div>
		</div>
		<div class="clearance"></div>
		<div class="content_wrapper">
			<div class="content_main">

			<?php

				$username = $_SESSION['username'];
				$query = "SELECT app_patientname, app_number, app_date, app_time, app_doctorname, h.name as hname, app_status FROM appointment a,hospitalinfo h WHERE h.hospitalID=app_hospital and  app_patientusername='$username' ORDER BY app_date";

				$result = mysqli_query($conn,$query);

				echo '<table><tr>
						<tr>
							<th>App #</th>
							<th>Date</th>
							<th>Time</th>
							<th>Doctor</th>
							<th>Hospital</th>
							<th>Status</th>
							<th>Manage</th>
						</tr>';

				$x = 1;
				while ($row = mysqli_fetch_row($result)) {
					echo '<tr>';

					$count = count($row);
					for ($datacounter=0; $datacounter<$count; $datacounter++) {
						$c_row = current($row);
						if($datacounter > 0) {
							echo '<td style="width:150px;text-align:center;">' . $c_row . '</td>';
						}
						if($datacounter == 1) {
							$tableID = $c_row;
						}
						next($row);
					}

					echo '<td>
							<form action="cancel_apprequest.php" method="post">';

					$timestamp_query = mysqli_query($conn,"SELECT app_date, app_time FROM appointment WHERE app_number='$tableID'");
					$timestamp_array = mysqli_fetch_array($timestamp_query);
					$time_difference = check_time($timestamp_array[0], $timestamp_array[1]);
					
					if($time_difference <= 1440) {
						echo '<button type="button" onclick="alert(\'Cannot cancel appointment!\');">Cancel</button>';
					}
					else {
						echo '<input type="hidden" name="cancelid" value="' . $tableID . '">
							<button type="submit" onclick="return confirm(\'Cancel appointment?\');">Cancel</button>';
					}

					echo '</form></td></tr>';
				}

				echo '</table>';

				mysqli_close($conn);
			?>
			<a href="request_patient.php">Request Appointment</a>
			</div>
			</div>
		</div>
	</body>
</html>