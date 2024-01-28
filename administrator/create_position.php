<?php
require("Adminsession.php");
?>

<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor3 color-header headercolor2">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets_1/images/logo.jpg" type="image/x-icon">
	<!--plugins-->
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<link href="../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../assets/css/header-colors.css" />
	<title>Online Voting System - Position</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php include 'sidebar_admin.php' ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php include 'header_admin.php' ?>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="row">
				<div class="col-sm-6">
					<h6 class="mb-0 text-uppercase"><br>&emsp;Position Table</h6>

					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Position</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'connection.php';
										$stmt = $mysqli->prepare("SELECT * FROM positions ORDER BY id");
										$stmt->execute();
										$result = $stmt->get_result();

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
										?>
												<tr>
													<td><?php echo $row['id'] ?></td>
													<td><?php echo $row['position'] ?></td>
													<td>
														<span class="btn btn-sm btn-success radius-30"><?php echo $row['status'] ?></span>
													</td>
													<td>
														<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"><input type="text" name="position_id" style="display:none;" value="<?php echo $row['position'] ?>"><button type="submit" name="delete" class="btn btn-danger px-1">&nbsp;<i class='bx bxs-trash'></i></button></form>
													</td>
												</tr>
										<?php
											}
										}
										?>
									</tbody>
									<!--<tfoot>-->
									<!--	<tr>-->
									<!--		<th>ID</th>-->
									<!--		<th>Position</th>-->
									<!--		<th>Edit</th>-->
									<!--		<th>Delete</th>-->
									<!--	</tr>-->
									<!--</tfoot>-->
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<br>
					<div class="card border-0 border-4 border-danger">
						<div class="card-body p-5">
							<div class="card-title d-flex align-items-center">
								<div><i class="bx bxs-user me-1 font-22 text-danger"></i>
								</div>
								<h5 class="mb-0 text-danger">Add Election</h5>
							</div>
							<hr>
							<form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Position Name</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-chair'></i></span>
										<input type="text" class="form-control border-start-0" id="inputLastName1" name="position_name" placeholder="Position Name" />
									</div>
								</div>
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Starting Date</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-chair'></i></span>
										<input type="date" class="form-control border-start-0" name="starting_date" />
									</div>
								</div>
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Ending Date</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-chair'></i></span>
										<input type="date" class="form-control border-start-0" name="ending_date" />
									</div>
								</div>


								<div class="col-12">
									<button type="submit" name="save" class="btn btn-success px-5">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			include 'connection.php';
			require_once '../admin/inc/function.php';
			$position_name = isset($_POST['position_name']) ? $_POST['position_name'] : '';
			$starting_date = isset($_POST['starting_date']) ? $_POST['starting_date'] : '';
			$ending_date = isset($_POST['ending_date']) ? $_POST['ending_date'] : '';
			$status = getStatus($starting_date, $ending_date);


			if (isset($_POST['save'])) {
				if (validateInput($position_name) == false || $starting_date == NULL || $ending_date == NULL || $status == 'Inactive') {
					echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Warning!</strong> You cannot submit an invalid field.
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
				} else if (validateInput($position_name) == true) {
					$filterdata = mysqli_real_escape_string($mysqli, validateInput($position_name));
					// Check if the position already exists in the database
					$stmt = $mysqli->prepare("SELECT position FROM `positions` WHERE position = ?");
					$stmt->bind_param('s', $filterdata);
					$stmt->execute();
					$result = $stmt->get_result();
					$data = $result->fetch_assoc();

					if ($result) {
						if ($stmt->affected_rows > 0) {
							echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
												<strong>Success!</strong> Position already exists.
												<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
											</div>";
						} else {
							// Position doesn't exist, insert it into the database
							$stmt_insert = $mysqli->prepare("INSERT INTO `positions` (`position`, `starting_date`, `ending_date`, `status`) VALUES (?, ?, ?, ?)");
							$stmt_insert->bind_param('ssss', $filterdata, $starting_date, $ending_date, $status);

							if ($stmt_insert->execute()) {
								echo "<div class='auto-close alert alert-success alert-dismissible fade show col-lg-5 col-md-12'>
													<strong>Success!</strong> Position added successfully.
													<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
												</div>";
							} else {
								echo "Error inserting position: " . $mysqli->error;
							}
						}

						$stmt->free_result();
					} else {
						echo "Error checking position: " . $mysqli->error;
					}
				}
			}



			?>

			<?php

			include 'connection.php';

			$stmt = $mysqli->prepare("SELECT DISTINCT position_name FROM candidate ORDER BY id");
			$stmt->execute();
			$result = $stmt->get_result();
			$existing_positions = [];
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$existing_position[] = $row['position_name'];
				}
			}

			if (isset($_POST['delete'])) {
				$position_id = $_POST['position_id'];

				if (in_array($position_id, $existing_position)) {
			?>
					<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
						<strong>Warning!</strong> POSITION USED FOR CANDIDATE, UNABLE TO DELETE...!
						<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
					</div>
					<?php
				} else {
					$stmt_delete = $mysqli->prepare("DELETE FROM `positions` WHERE `positions`.`position` = ?");
					$stmt_delete->bind_param('i', $position_id);

					if ($stmt_delete->execute()) {
					?>
						<div class='auto-close alert alert-success alert-dismissible fade show col-lg-5 col-md-12'>
							<strong>Success!</strong> POSITION DELETED SUCCESSFULLY.
							<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						</div>
			<?php
					} else {
						echo "Error deleting position: " . $stmt_delete->error;
					}
				}
			}



			?>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<?php
		include("../footer.php");
		?>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<?php

	include("../ThemeCustomizer.php");
	?>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable({
				lengthChange: false,
				buttons: ['copy', 'excel', 'pdf', 'print']
			});

			table.buttons().container()
				.appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
	</script>
	<script src="assets/js/index3.js"></script>
	<script>
		new PerfectScrollbar('.best-selling-products');
		new PerfectScrollbar('.recent-reviews');
		new PerfectScrollbar('.support-list');
	</script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>

</html>