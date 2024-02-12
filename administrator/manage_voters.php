<?php
require("Adminsession.php");
?>

<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor1">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets_1/images/logo.jpg" type="image/x-icon">
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
	<!-- SweetAlert-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="sweetalert2.min.js"></script>
	<link rel="stylesheet" href="sweetalert2.min.css">
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
										if (isset($_POST['delete'])) {
											$candidate_id = isset($_POST['candidate_id']) ? $_POST['candidate_id'] : '';
											//"If $_POST['position_name'] is set, assign its value to $position_name; otherwise, assign an empty string to $position_name."
											$vote_count = isset($_POST['vote']) ? $_POST['vote'] : '';

											if ($vote_count == 0) {
												$sql_delete = "DELETE FROM `candidate` WHERE `candidate`.`id` = '$candidate_id'";

												if ($con->query($sql_delete) === TRUE) {
													echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
												<strong>Success!</strong> CANDIDATE DELETED SUCCESSFULLY.
												<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
											</div>";
												} else {
													echo "Error deleting candidate: " . $con->error;
												}
											} else {
												echo "<div class='auto-close alert alert-danger alert-dismissible fade show col-lg-5 col-md-12'>
											<strong>Success!</strong> UNABLE TO DELETE CANDIDATE AS HE/SHE VOTED ALREADY.
											<button type='button' class='btn-close' data-bs-dismiss='alert'></button>
										</div>";
											}
										}

										if (isset($_POST['delete'])) {
											$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
											$vote_status = isset($_POST['vote']) ? $_POST['vote'] : '';

											// Check if the user is eligible for deletion (e.g., not voted yet)
											if ($vote_status == 0) {
												$delete_query = "DELETE FROM users WHERE id = '$user_id'";
												$delete_result = mysqli_query($con, $delete_query);

												if ($delete_result) {
													echo "<div class='alert alert-success'>User deleted successfully.</div>";
												} else {
													echo "<div class='alert alert-danger'>Error deleting user: " . mysqli_error($con) . "</div>";
												}
											} else {
												echo "<div class='alert alert-warning'>Unable to delete user as they have voted already.</div>";
											}
										}

										// Fetch Voters
										$get_voters_table = "SELECT * FROM users WHERE user_role='voter'";
										$query_run = mysqli_query($con, $get_voters_table);

										if (mysqli_num_rows($query_run) > 0) {
											while ($row = mysqli_fetch_array($query_run)) {
										?>
												<tr>
													<td><?php echo $row['id'] ?></td>
													<td><?php echo $row['username'] ?></td>
													<td>
														<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
															<input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
															<input type="hidden" name="vote" value="<?php echo $row['vote'] ?>">
															<button type="submit" name="delete" class="btn btn-danger px-1">&nbsp;<i class='bx bxs-trash'></i></button>
														</form>
													</td>
												</tr>
										<?php
											}
										} else {
											echo "<div class='alert alert-warning'>No Voters found</div>";
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

				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>
				<!--end overlay-->
				<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
				<!--End Back To Top Button-->
				<?php
				include("footer.php");
				?>
			</div>
			<!--end wrapper-->
			<!--start switcher-->
			<?php
			include("ThemeCustomizer.php");
			?>
			<!--end switcher-->
			<!-- Bootstrap JS -->
			<script src="assets/js/bootstrap.bundle.min.js"></script>
			<!--plugins-->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
			<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
			<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
			<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
			<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
			<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
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