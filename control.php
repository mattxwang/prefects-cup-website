<?php
	require("common.php");
	if(empty($_SESSION['user'])){ 
		header("Location: login_page.php"); 
		die("Redirecting to login_page.php"); 
	}
?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="Prefects Cup">
		<meta name="author" content="">
		<title>Control Panel</title>
		<link rel="icon" href="css/favicon.ico" />
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/base.css" rel="stylesheet"  />
		<script src="js/google_analytics.js"></script>
	</head>
	<?php include_once("import_standings.php") ?>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-control">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand page-scroll" href="#page-top">Prefects Cup Control Panel</a>
				</div>


				<div class="collapse navbar-collapse navbar-control">
					<ul class="nav navbar-nav">
						<li class="hidden"><a href="#page-top"></a></li>
						<li><a class="page-scroll" href="#standings">Edit Standings</a></li>
						<li><a class="page-scroll" href="#schedule">Edit Schedule</a></li>
						<li><a class="page-scroll" href="#contact">Contact</a></li>	
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php">Back to Home</a></li>	
					</ul>
				</div>
			</div>
		</nav> 

		<?php include_once("footer.php") ?>

		<!-- Add Points Modal -->
		<div class="modal fade" id="addPoints" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="mainHeader">Add New Set of Points</h4>
					</div>
					<div class="modal-body">
						<form class="form-signin" action="new_standings_function.php" method="post">
							<h4>Add a New Set of Points</h4>
							<p>
							Input values to <b>add to the current set</b> of points for each house. If you to set the new total points, please use the add to total button instead.
							</p>
							<div class="row">
								<div class="col-md-6">
									<h4>Date</h4>
									<h6>Submit in the format YYYY-MM-DD</h6>
									<input type="text" id="date" name="date" class="form-control" required="" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Bremner's</h4>
									<input type="text" id="bremner" name="bremner" class="form-control" required="" value="<?php echo $standings['bremner']; ?>" autofocus="">
								</div>
								<div class="col-md-6">
									<h4>Howard's</h4>
									<input type="text" id="howard" name="howard" class="form-control" required="" value="<?php echo $standings['howard']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Jackson's</h4>
									<input type="text" id="jackson" name="jackson" class="form-control" required="" value="<?php echo $standings['jackson']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Martland's</h4>
									<input type="text" id="martland" name="martland" class="form-control" required="" value="<?php echo $standings['martland']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>McHugh's</h4>
									<input type="text" id="mchugh" name="mchugh" class="form-control" required="" value="<?php echo $standings['mchugh']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Mowbray's</h4>
									<input type="text" id="mowbray" name="mowbray" class="form-control" required="" value="<?php echo $standings['mowbray']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Orr's</h4>
									<input type="text" id="orr" name="orr" class="form-control" required="" value="<?php echo $standings['orr']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Scadding's</h4>
									<input type="text" id="scadding" name="scadding" class="form-control" required="" value="<?php echo $standings['scadding']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Seaton's</h4>
									<input type="text" id="seaton" name="seaton" class="form-control" required="" value="<?php echo $standings['seaton']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Wedd's</h4>
									<input type="text" id="wedd" name="wedd" class="form-control" required="" value="<?php echo $standings['wedd']; ?>">
								</div>
							</div>
							<!--
							<h4>Email (to confirm change)</h4>
							<input type="email" id="email" class="form-control" placeholder="john.doe@ucc.on.ca" name="email" required="">

							<h4>Password (to confirm change)</h4>
							<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
							-->

				
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success" id="submitbutton" value="Login" >Confirm Changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit Points Modal -->
		<div class="modal fade" id="totalPoints" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="mainHeader">Edit Total Points</h4>
					</div>
					<div class="modal-body">
						<form class="form-signin" action="edit_standings_function.php" method="post">
							<h4>Set New Total Points</h4>
							<p>
							Input values for the new <b>total</b> points for each house. If you just want to add points to the current value, please use the add to total button instead.
							</p>
							<div class="row">
								<div class="col-md-6">
									<h4>Bremner's</h4>
									<input type="text" id="bremner" name="bremner" class="form-control" required="" value="<?php echo $standings['bremner']; ?>" autofocus="">
								</div>
								<div class="col-md-6">
									<h4>Howard's</h4>
									<input type="text" id="howard" name="howard" class="form-control" required="" value="<?php echo $standings['howard']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Jackson's</h4>
									<input type="text" id="jackson" name="jackson" class="form-control" required="" value="<?php echo $standings['jackson']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Martland's</h4>
									<input type="text" id="martland" name="martland" class="form-control" required="" value="<?php echo $standings['martland']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>McHugh's</h4>
									<input type="text" id="mchugh" name="mchugh" class="form-control" required="" value="<?php echo $standings['mchugh']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Mowbray's</h4>
									<input type="text" id="mowbray" name="mowbray" class="form-control" required="" value="<?php echo $standings['mowbray']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Orr's</h4>
									<input type="text" id="orr" name="orr" class="form-control" required="" value="<?php echo $standings['orr']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Scadding's</h4>
									<input type="text" id="scadding" name="scadding" class="form-control" required="" value="<?php echo $standings['scadding']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Seaton's</h4>
									<input type="text" id="seaton" name="seaton" class="form-control" required="" value="<?php echo $standings['seaton']; ?>">
								</div>
								<div class="col-md-6">
									<h4>Wedd's</h4>
									<input type="text" id="wedd" name="wedd" class="form-control" required="" value="<?php echo $standings['wedd']; ?>">
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success" id="submitbutton" value="Login" >Confirm Changes</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Event Modal -->
		<div class="modal fade" id="addEvent" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="mainHeader">Add New Event</h4>
					</div>
					<div class="modal-body">
						<form class="form-signin" action="new_event_function.php" method="post">
							<h4>Add a New Event</h4>
							<div class="row">
								<div class="col-md-12">
									<h4>Event Name (ex. House Hockey)</h4>
									<input type="text" id="name" name="name" class="form-control" required="" value="" autofocus="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Competitors (ex. Orr's vs. Bremner's)
									<input type="text" id="competitors" name="competitors" class="form-control" required="" value="">	
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Event Day (ex. Monday)</h4>
									<select class="form-control" id="day" name="day" required="" value="">
										<option value = "NULL">Event Day.</option>
										<option value="mon">Monday</option>
										<option value="tue">Tuesday</option>
										<option value="wed">Wednesday</option>
										<option value="thu">Thursday</option>
										<option value="fri">Friday</option>
									</select>
								</div>
								<div class="col-md-6">
									<h4>Event Date (ex. 2016-02-01) (YYYY-MM-DD)</h4>
									<input type="text" id="date" name="date" class="form-control" required="" value="YYYY-MM-DD">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>General Event Time (ex. Before School, Lunch)</h4>
									<select class="form-control" id="time" name="time" required="" value="">
										<option value = "NULL">General Event Time.</option>
										<option value="before">Before School</option>
										<option value="during">During School</option>
										<option value="lunch">Lunch</option>
										<option value="after">After School</option>
										<option value="special">Special Schedule (other)</option>
									</select>
								</div>
								<div class="col-md-6">
									<h4>Event Start Time (ex. 3:30)</h4>
									<input type="text" id="start" name="start" class="form-control" required="" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h4>Event Location (ex. Field Bubble)</h4>
									<input type="text" id="location" name="location" class="form-control" required="" value="">
								</div>
								<div class="col-md-6">
									<h4>Event Organiser (ex. Mr. Williams)</h4>
									<input type="text" id="organiser" name="organiser" class="form-control" required="" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Event Description (optional)</h4>
									<textarea rows="3" id="about" name="about" value="Leave blank if none needed." class="form-control" >
									</textarea>
								</div>
							</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success" id="submitbutton" value="Login" >Add Event</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<section id="start" class="section-one">
			<div class="center-parent">
				<span class="center-child">
					<b><h1>Prefects Cup Control Panel</h1></b>
					<h2>Hello there!</h2>
				</span>
			</div>
		</section>

		<section id="standings" class="section-two">
			<div class="container">
				<h2>Edit the Total Points</h2>
				<h4>This hard sets the new total points. Useful if there's some incorrect data, or you need to reset the points.</h4>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#totalPoints">Edit Total Points</button>
				</br>
				</br>
				<h1>-- Or --</h1>
				</br>
				<h1><strike>Edit House Standings</strike> <b>Disabled</b></h1>
				<h2>Add a New Set of Points</h2>
				<h4>This adds on to the current values of points! Useful if you have results from a house event.</h4>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPoints" disabled="disabled">Add New Set of Points</button>
			</div>
		</section>

		<section id="schedule" class="section-one">
			<div class="container">
				<h2>Add a new Event</h2>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEvent">Add Event</button>
				</br>
				</br>
				<h1>-- Or --</h1>
				</br>
				<h2>Edit an Event</h2>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editEvent" disabled="disabled">Edit Event</button>
			</div>
		</section>

		<section id="contact" class="section-two">
			<div class="center-parent">
				<span class="center-child">
					<h1>Something going wrong?</h1>
					<h2>Email Matthew Wang at <b><a href="mailto:matthew.wang@ucc.on.ca" style="color:white;">matthew.wang@ucc.on.ca</a></b></h2>
				</span>
			</div>
		</section>

		<!-- JAVASCRIPT; loaded last to load page quicker -->
		<script src="js/jquery.js"></script>
		<script src="js/scrolling-nav.js"></script>
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>

</html>