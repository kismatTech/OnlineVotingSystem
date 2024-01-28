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
	<link rel="icon" href="../assets_1/images/logo.jpg" type="image/x-icon">
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

	<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<title>Online Voting System - Manage Candidate</title>
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
					<h6 class="mb-0 text-uppercase"><br>&emsp;Manage Candidate Table</h6>

					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Candidate Name</th>
											<th>Position Name</th>

										</tr>
									</thead>
									<tbody>
										<?php
										include 'connection.php';
										$stmt = $mysqli->prepare("Select * from candidate order by id");
										$stmt->execute();
										$result = $stmt->get_result();
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
										?>
												<tr>
													<td><?php echo $row['id'] ?></td>
													<td><?php echo $row['candidate_name'] ?></td>
													<td><?php echo $row['position_name'] ?></td>


												</tr>
										<?php
											}
										}
										?>
									</tbody>
									<!-- <tfoot>
									<tr>
										<th>ID</th>
										<th>candidate</th>
										<th>Edit</th>
										<th>Delete</th>
									</tr>
								</tfoot> -->
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
								<h5 class="mb-0 text-danger">Manage Candidate</h5>
							</div>
							<hr>
							<form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Candidate Name</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-user'></i></span>

										<select class="single-select" name="candidate_name">
											<option value="0">Select Available Candidate</option>
											<?php
											include 'connection.php';

											$fetch_candidate_table = "SELECT * FROM candidate ORDER BY id";
											$stmt_fetch = $mysqli->prepare($fetch_candidate_table);
											$stmt_fetch->execute();
											$result_fetch = $stmt_fetch->get_result();

											if ($result_fetch->num_rows > 0) {
												while ($row_fetch = $result_fetch->fetch_assoc()) {
											?>
													<option value="<?php echo $row_fetch['candidate_name']; ?>"><?php echo $row_fetch['candidate_name']; ?></option>
											<?php
												}
											}
											?>

										</select>
									</div>
								</div>
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Position Name</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-chair'></i></span>

										<select class="single-select" name="position_name">
											<option value="0">Select Available Position</option>
											<?php
											include 'connection.php';
											$stmt = $mysqli->prepare("Select * from positions order by id");
											$stmt->execute();
											$result = $stmt->get_result();
											if ($result->num_rows > 0) {
												while ($row_fetch1 = $result->fetch_assoc()) {
											?>
													<option value="<?php echo $row_fetch1['position']; ?>"><?php echo $row_fetch1['position']; ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-12">
									<button type="submit" name="update" class="btn btn-success px-5">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			include 'connection.php';
			$position_name = isset($_POST['position_name']) ? $_POST['position_name'] : '';
			$candidate_name = isset($_POST['candidate_name']) ? $_POST['candidate_name'] : '';
			if (isset($_POST['update'])) {
				if ($position_name == '0' || $candidate_name == '0') {
					echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Warning!</strong> PLEASE SELECT VALID Field ...!
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
				} else {
					include 'connection.php';
					$votes = 0;
					$stmt = $mysqli->prepare("Select * from candidate where candidate_name='$candidate_name' order by id");
					$stmt->execute();
					$result = $stmt->get_result();
					if ($result->num_rows > 0) {
						while ($row_fetch = $result->fetch_assoc()) {
							$votes = $row_fetch['vote'];
						}
					}
					if ($votes == 0) {
						$stmt = $mysqli->prepare("UPDATE `candidate` SET `position_name` = ? WHERE `candidate`.`candidate_name` = ?");
						$stmt->bind_param("ss", $position_name, $candidate_name);
						if ($stmt->execute() == TRUE) {
							echo "<div class='auto-close alert alert-success alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Success!</strong> POSITION ADDED SUCCESSFULLY TO CANDIDATE.
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
						}
					} else {
						echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Warning!</strong> UNABLE TO CHANGE POSITION AS HE/SHE VOTED ALREADY.
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
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

		<script src="../assets/plugins/select2/js/select2.min.js"></script>
		<script>
			$('.single-select').select2({
				theme: 'bootstrap4',
				width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
				placeholder: $(this).data('placeholder'),
				allowClear: Boolean($(this).data('allow-clear')),
			});
			$('.multiple-select').select2({
				theme: 'bootstrap4',
				width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
				placeholder: $(this).data('placeholder'),
				allowClear: Boolean($(this).data('allow-clear')),
			});
		</script>
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
		<script src="../assets/js/app.js"></script>
</body>

</html>