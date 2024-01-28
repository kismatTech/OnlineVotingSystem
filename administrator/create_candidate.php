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
	<link rel="icon" href="./assets_1/images/logo.jpg" type="image/x-icon">
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
	<title>Online Voting System - Candidate</title>
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
					<h6 class="mb-0 text-uppercase"><br>&emsp;Candidate Table</h6>

					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example2" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Candidate</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'connection.php';
										$stmt = $mysqli->prepare("Select * from candidate order by id");
										$stmt->execute();
										$query_run = $stmt->get_result();
										if ($mysqli->affected_rows > 0) {
											while ($row = $query_run->fetch_assoc()) {
										?>
												<tr>
													<td><?php echo $row['id'] ?></td>
													<td><?php echo $row['candidate_name'] ?></td>
													<td>
														<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"><input type="text" name="candidate_id" style="display:none;" value="<?php echo $row['id'] ?>"><input type="text" name="vote" style="display:none;" value="<?php echo $row['vote'] ?>"><button type="submit" name="delete" class="btn btn-danger px-1">&nbsp;<i class='bx bxs-trash'></i></button></form>
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
									<!--		<th>candidate</th>-->
									<!--		<th>Edit</th>-->
									<!--		<th>Delete</th>-->
									<!--	</tr>-->
									<!--</tfoot>-->
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<br>
					<div class="card border-0 border-4 border-danger">
						<div class="card-body p-5">
							<div class="card-title d-flex align-items-center">
								<div><i class="bx bxs-user me-1 font-22 text-danger"></i>
								</div>
								<h5 class="mb-0 text-danger">Add Candidate</h5>
							</div>
							<hr>
							<form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Candidate Name</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-user'></i></span>
										<input type="text" class="form-control border-start-0" id="inputLastName1" name="candidate_name" placeholder="Candidate Name" />
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
			ob_start(); // Start output buffering
			include 'connection.php';
			require_once '../admin/inc/function.php';

			$candidate_name = isset($_POST['candidate_name']) ? $_POST['candidate_name'] : '';

			if (isset($_POST['save'])) {
				if (validateInput($candidate_name) == NULL) {
					echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
									<strong>Warning!</strong> You cannot submit an invalid field.
									<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
								</div>";
				} else if (validateInput($candidate_name) == true) {
					$data = mysqli_real_escape_string($mysqli, validateInput($candidate_name));
					$stmt_insert = $mysqli->prepare("INSERT INTO `candidate` (`candidate_name`) VALUES (?)");
					$stmt_insert->bind_param('s', $data);

					if ($stmt_insert->execute()) {
						echo "<div class='auto-close alert alert-success alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Success!</strong> CANDIDATE ADDED SUCCESSFULLY.
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
					} else {

						echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
										<strong>Warning!</strong> Error inserting candidate:.
										<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
									</div>";
					}
				} else {
					echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
									<strong>Warning!</strong> Validation failed.
									<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
								</div>";
				}
			}




			if (isset($_POST['delete'])) {
				$candidate_id = isset($_POST['candidate_id']) ? $_POST['candidate_id'] : '';
				$vote_count = isset($_POST['vote']) ? $_POST['vote'] : '';

				if ($vote_count == 0) {
					$stmt_delete = $mysqli->prepare("DELETE FROM `candidate` WHERE `candidate`.`id` = ?");
					$stmt_delete->bind_param('i', $candidate_id);

					if ($stmt_delete->execute()) {
						echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
						                <strong>Success!</strong> CANDIDATE DELETED SUCCESSFULLY.
						                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						            </div>";
					} else {
						echo "Error deleting candidate: " . $stmt_delete->error;
					}
				} else {
					echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
						            <strong>Success!</strong> UNABLE TO DELETE CANDIDATE AS HE/SHE VOTED ALREADY.
						            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
						        </div>";
				}
			}

			ob_end_flush(); // Flush the output buffer
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
	<script src="../assets/js/index3.js"></script>
	<script>
		new PerfectScrollbar('.best-selling-products');
		new PerfectScrollbar('.recent-reviews');
		new PerfectScrollbar('.support-list');
	</script>
	<!--app JS-->
	<script src="../assets/js/app.js"></script>
</body>

</html>