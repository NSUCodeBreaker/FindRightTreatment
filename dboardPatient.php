<?php
	require "dbconnect.php";
	if ($_SESSION['login']==0)
		header('Location: index.php');
	else if($_SESSION['login']==2)
		header('Location: dBoardDoctor.php');
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

		<div class="banner-container">
			<div class="headbanner"></div>
		</div>

		<div class="content_wrapper">
			<div class="content_main">
				<div class="welcome_header">
					<?php
						echo "Welcome " .$_SESSION["name"] ;
					?>

					</div>
					<div class="clearance"></div>

					</div>

			</div>
		</div>
	</body>
</html>
