<?php
require("Votersession.php");
?>

<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor5 color-header headercolor2">

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
	<!-- SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

	<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<title>Online Voting System - Vote Online</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<?php include 'member_sidebar.php' ?>
		<!--end sidebar wrapper -->
		<!--start header -->
		<?php include 'member_header.php' ?>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="row">

				<div class="col-sm-12">
					<br>
					<div class="card border-0 border-4 border-success">
						<div class="card-body p-5">
							<div class="card-title d-flex align-items-center">
								<div><i class="bx bxs-user me-1 font-22 text-success"></i>
								</div>
								<h5 class="mb-0 text-success">Vote Your Candidate</h5>
							</div>

							<hr>
							<form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

								<div class="col-md-8">
									<label for="inputLastName1" class="form-label">Position Name</label>
									<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-chair'></i></span>

										<select class="single-select" name="position_name" onchange="this.form.submit()">
											<option value="0">Select Available Position</option>
											<?php
											include 'connection.php';
											$stmt = $mysqli->prepare("Select team from users where username=?");
											$stmt->bind_param("s", $_SESSION['username']);
											$stmt->execute();
											$result1 = $stmt->get_result();
											if ($result1->num_rows > 0) {
												while ($row_fetch2 = $result1->fetch_assoc()) {
													$team=$row_fetch2['team'];
												}
											}
											$stmt = $mysqli->prepare("Select * from positions where createdby=? order by id");
											$stmt->bind_param("s", $team);
											$stmt->execute();
											$result = $stmt->get_result();
											if ($result->num_rows > 0) {
												while ($row_fetch1 = $result->fetch_assoc()) {
											?>
													<option <?php echo (isset($_POST['position_name']) && $_POST['position_name'] == $row_fetch1['position']) ? 'selected="selected"' : ''; ?> value="<?php echo $row_fetch1['position']; ?>"><?php echo $row_fetch1['position']; ?></option>
											<?php

												}
											}

											?>
										</select>
									</div>
								</div>

								<div class="col-md-8">
									<?php
									include 'connection.php';
									// $position_name=$_POST['position_name'];
									$position_name = isset($_POST['position_name']) ? $_POST['position_name'] : '';
									$fetch_position_table2 = "Select * from positions where position='$position_name'";
									$fetch_query_run2 = mysqli_query($con, $fetch_position_table2);
									$str_arr = []; // Initialize $str_arr as an empty array
									$status = '';
									if (mysqli_num_rows($fetch_query_run2) > 0) {
										while ($row_fetch2 = mysqli_fetch_array($fetch_query_run2)) {
											$voted_users = $row_fetch2['users'];
											$str_arr = explode(",", $voted_users);
											$status = $row_fetch2['status'];
										}
									}

									if (in_array($logname, $str_arr, TRUE)) {
										echo '<script>
										Swal.fire({
											title: "Oops!",
											text: "You have voted for this position already!",
											icon: "error"
										}).then(() => {
											window.location.href = window.location.pathname; // Reload page after deletion
										});
									  </script>';
										
									} elseif ($status == 'Active') {
										$fetch_position_table = "Select * from candidate where position_name='$position_name'";
										$fetch_query_run1 = mysqli_query($con, $fetch_position_table);
										if (mysqli_num_rows($fetch_query_run1) > 0) {
											while ($row_fetch1 = mysqli_fetch_array($fetch_query_run1)) {
									?>
												<div class="input-group">
													<div class="input-group-text">
														<input class="form-check-input" type="radio" name="selected_candidate" value="<?php echo $row_fetch1['candidate_name']; ?>" aria-label="Radio button for following text input">
													</div>
													<input type="text" class="form-control" aria-label="Text input with radio button" value="<?php echo $row_fetch1['candidate_name']; ?>" readonly>
												</div><br>
											<?php
											}
											?>
											<div class="col-12">
												<button type="submit" name="update" class="btn btn-success px-5">Submit</button>
											</div>
							</form>

					<?php
										}
									} elseif ($status == 'Inactive') {
										echo "<h5 class='mb-0 text-danger'>Elections are currently inactive. You cannot vote.</h5>";
									} elseif ($status == 'Pending') {
										echo "<h5 class='mb-0 text-warning'>Elections are currently pending. You cannot vote.</h5>";
									}
					?>
					</form>

						</div>


						<?php
						include 'connection.php';

						$position_name = isset($_POST['position_name']) ? $_POST['position_name'] : '';
						$selected_candidate = isset($_POST['selected_candidate']) ? $_POST['selected_candidate'] : '';
						// echo $position_name;
						if (isset($_POST['update'])) {

							if ($position_name === NULL || $position_name === '') {
								echo '<script>
                                                    Swal.fire({
                                                        title: "Oops!",
                                                        text: "PLEASE SELECT VALID POSITION NAME ...!",
                                                        icon: "error"
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname; // Reload page after deletion
                                                    });
                                                  </script>';
						
								exit; // Exit to prevent further execution of the code
							}

							// Check if the user has already voted for the selected position
							$fetch_position_table2 = "SELECT * FROM positions WHERE position='$position_name'";
							$fetch_query_run2 = mysqli_query($con, $fetch_position_table2);

							if (mysqli_num_rows($fetch_query_run2) > 0) {
								$row_fetch2 = mysqli_fetch_array($fetch_query_run2);
								$voted_users = $row_fetch2['users'];
								$str_arr = explode(",", $voted_users);

								if (in_array($logname, $str_arr, TRUE)) {
									// echo "<h5 class='mb-0 text-success'>You have voted for this position already...!</h5>";
								} else {
									// Process the vote only if a candidate is selected
									if (!empty($selected_candidate)) {
										// Update positions table with the user's vote
										$all_users = $voted_users . ',' . $logname;
										$sql_update = "UPDATE `positions` SET `users` = '$all_users' WHERE `positions`.`position` = '$position_name'";

										if ($con->query($sql_update) === TRUE) {
											// Update candidate table with the vote count
											$fetch_vote_count = "SELECT * FROM candidate WHERE candidate_name='$selected_candidate'";
											$fetch_query_run2 = mysqli_query($con, $fetch_vote_count);

											if (mysqli_num_rows($fetch_query_run2) > 0) {
												$row_vote_fetch = mysqli_fetch_array($fetch_query_run2);
												$get_vote_count = $row_vote_fetch['vote'];
												$final_votes = 1 + $get_vote_count;

												$sql_update1 = "UPDATE `candidate` SET `vote` = '$final_votes' WHERE `candidate`.`candidate_name` = '$selected_candidate'";

												if ($con->query($sql_update1) === TRUE) {
													echo '<script>
                                                    Swal.fire({
                                                        title: "Vote Submitted!",
                                                        text: "YOUR VOTE HAS BEEN SUBMITTED SUCCESSFULLY!",
                                                        icon: "success"
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname; // Reload page after deletion
                                                    });
                                                  </script>';
								
													// echo "<h5 class='mb-0 text-success'>YOUR VOTE HAS BEEN SUBMITTED SUCCESSFULLY...!</h5>";
												}
											}
										}
									}
								}
							}
						}
						?>
					</div>
				</div>
			</div>
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
	<script src="assets/js/app.js"></script>
</body>

</html>