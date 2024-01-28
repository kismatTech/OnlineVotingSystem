<?php
require("Votersession.php");
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
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../assets/css/header-colors.css" />
	<title>Online Voting System</title>
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
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Online Voting System</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Result</li>
							</ol>
						</nav>
					</div>
					<!--<div class="ms-auto">-->
					<!--	<div class="btn-group">-->
					<!--		<button type="button" class="btn btn-primary">Settings</button>-->
					<!--		<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>-->
					<!--		</button>-->
					<!--		<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Another action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Something else here</a>-->
					<!--			<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<!--end breadcrumb-->
				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="../assets/images/avatars/user-admin.jpg" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
											<div class="mt-3">
												<?php
												include 'connection.php';
												$candidate_table = "Select * from candidate order by vote DESC LIMIT 1";
												$fetch_query_run = mysqli_query($con, $candidate_table);
												if (mysqli_num_rows($fetch_query_run) > 0) {
													while ($row_fetch = mysqli_fetch_array($fetch_query_run)) {
												?>
														<h4>Online Voting System</h4>
														<p class="text-secondary mb-1"><?php echo $row_fetch['position_name']; ?></p>
														<!-- <p class="text-muted font-size-sm">Winner</p><br> -->
														<button class="btn btn-primary">Vote</button>
														<button class="btn btn-outline-primary"><?php echo $row_fetch['vote']; ?></button>
												<?php
													}
												}
												?>
											</div>
										</div>
										<hr class="my-4" />
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
														<circle cx="12" cy="12" r="10"></circle>
														<line x1="2" y1="12" x2="22" y2="12"></line>
														<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
													</svg>Website</h6>
												<span class="text-secondary">https://kismatduwadi.com.np</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline">
														<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
													</svg>Github</h6>
												<span class="text-secondary">Mr.Kismatduwadi</span>
											</li>
											<!--<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">-->
											<!--	<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>-->
											<!--	<span class="text-secondary">@kismatduwadi</span>-->
											<!--</li>-->
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
														<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
														<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
														<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
													</svg>Instagram</h6>
												<span class="text-secondary">Mr.Kismatduwadi</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
														<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
													</svg>Facebook</h6>
												<span class="text-secondary">Mr.Kismatduwadi</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-sm-8">
								<div class="card border-0 border-4 border-danger">
									<div class="card-body p-5">
										<div class="card-title d-flex align-items-center">
											<div><i class="bx bxs-user me-1 font-22 text-danger"></i>
											</div>
											<h5 class="mb-0 text-danger">Select the Election</h5>
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
														$fetch_position_table = "Select * from positions order by id";
														$fetch_query_run1 = mysqli_query($con, $fetch_position_table);

														if (mysqli_num_rows($fetch_query_run1) > 0) {
															while ($row_fetch1 = mysqli_fetch_array($fetch_query_run1)) {
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

														$status = $row_fetch2['status'];
													}
												}

												if ($status == 'Inactive') { ?>

													<div class="col-lg-12">
														<div class="card">
															<div class="card radius-10">
																<div class="card-header border-bottom-0 bg-transparent">
																	<div class="d-flex align-items-center">
																		<div>
																			<h5 class="font-weight-bold mb-0">Online Voting Result</h5>
																		</div>
																	</div>
																</div>

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
																?>

																<div class="card-body">
																	<div class="table-responsive">
																		<table class="table mb-0 align-middle">
																			<thead>
																				<tr>
																					<th>Candidate Name</th>
																					<th>Position</th>
																					<th>Vote</th>
																					<th>Result</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				include 'connection.php';
																				$candidate_table = "Select * from candidate where position_name='$position_name' order by vote DESC";
																				$fetch_query_run = mysqli_query($con, $candidate_table);
																				if (mysqli_num_rows($fetch_query_run) > 0) {
																					while ($row_fetch = mysqli_fetch_array($fetch_query_run)) {
																				?>
																						<tr>
																							<td><?php echo $row_fetch['candidate_name']; ?></td>
																							<td><?php echo $row_fetch['position_name']; ?></td>
																							<td><?php echo $row_fetch['vote']; ?></td>
																							<td>
																								<?php
																								require_once('admin/inc/function.php');
																								$data = winner();
																								if ($data == $row_fetch['vote']) {
																									echo "<span class='btn btn-sm btn-success radius-30'>Winner</span>";
																								} else {

																									echo '<span class="btn btn-sm btn-success radius-30">Delivered</span>';
																								}
																								?>
																							</td>
																						</tr>

																				<?php
																					}
																				}
																				?>
																			</tbody>
																		</table>
																	</div>
																<?php
															} elseif ($status == 'Active') {
																echo "<h5 class='mb-0 text-danger'>Elections are currently running..</h5>";
															} elseif ($status == 'Pending') {
																echo "<h5 class='mb-0 text-warning'>Elections are currently pending..</h5>";
															}
																?>

																</div>
															</div>
														</div>
													</div>
											</div>
									</div>
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
	<!--app JS-->
	<script src="../assets/js/app.js"></script>
</body>

</html>