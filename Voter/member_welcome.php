<?php
require("Votersession.php");
?>

<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor3 color-header headercolor1">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../assets_1/images/black-logo.png" type="image/x-icon">
	<!--plugins-->
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="../assets/plugins/smart-wizard/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
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
	<title>eVote Shield</title>
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
				<?php
				include '../common_header.php'
				?>
				<div class="card radius-10">
					<div class="card-header border-bottom-0 bg-transparent">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="font-weight-bold mb-0">eVote Shield</h5>
							</div>
							<!--<div class="ms-auto">-->
							<!--	<button type="button" class="btn btn-white radius-10">View More</button>-->
							<!--</div>-->
						</div>
					</div>
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
									$candidate_table = "Select * from candidate order by vote DESC";
									$fetch_query_run = mysqli_query($con, $candidate_table);
									if (mysqli_num_rows($fetch_query_run) > 0) {
										while ($row_fetch = mysqli_fetch_array($fetch_query_run)) {
									?>
											<tr>
												<td><?php echo $row_fetch['candidate_name']; ?></td>
												<td><?php echo $row_fetch['position_name']; ?></td>
												<td><?php echo $row_fetch['vote']; ?></td>
												<td>
													<!--<span class="btn btn-sm btn-success radius-30">Delivered</span>-->
												</td>
											</tr>

									<?php
										}
									}
									?>


								</tbody>
							</table>
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
	<script src="../assets/js/index3.js"></script>
	<script src="../assets/plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
	<script>
		$(document).ready(function() {
			// Toolbar extra buttons
			var btnFinish = $('<button></button>').text('Finish').addClass('btn btn-info').on('click', function() {
				alert('Finish Clicked');
			});
			var btnCancel = $('<button></button>').text('Reset').addClass('btn btn-danger').on('click', function() {
				$('#smartwizard').smartWizard("reset");
			});
			// Step show event
			$("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
				$("#prev-btn").removeClass('disabled');
				$("#next-btn").removeClass('disabled');
				if (stepPosition === 'first') {
					$("#prev-btn").addClass('disabled');
				} else if (stepPosition === 'last') {
					$("#next-btn").addClass('disabled');
				} else {
					$("#prev-btn").removeClass('disabled');
					$("#next-btn").removeClass('disabled');
				}
			});
			// Smart Wizard
			$('#smartwizard').smartWizard({
				selected: 0,
				theme: 'dots',
				transition: {
					animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
				},
				toolbarSettings: {
					toolbarPosition: 'top', // both bottom
					toolbarExtraButtons: [btnFinish, btnCancel]
				}
			});
			// External Button Events
			$("#reset-btn").on("click", function() {
				// Reset wizard
				$('#smartwizard').smartWizard("reset");
				return true;
			});
			$("#prev-btn").on("click", function() {
				// Navigate previous
				$('#smartwizard').smartWizard("prev");
				return true;
			});
			$("#next-btn").on("click", function() {
				// Navigate next
				$('#smartwizard').smartWizard("next");
				return true;
			});
			// Demo Button Events
			$("#got_to_step").on("change", function() {
				// Go to step
				var step_index = $(this).val() - 1;
				$('#smartwizard').smartWizard("goToStep", step_index);
				return true;
			});
			$("#is_justified").on("click", function() {
				// Change Justify
				var options = {
					justified: $(this).prop("checked")
				};
				$('#smartwizard').smartWizard("setOptions", options);
				return true;
			});
			$("#animation").on("change", function() {
				// Change theme
				var options = {
					transition: {
						animation: $(this).val()
					},
				};
				$('#smartwizard').smartWizard("setOptions", options);
				return true;
			});
			$("#theme_selector").on("change", function() {
				// Change theme
				var options = {
					theme: $(this).val()
				};
				$('#smartwizard').smartWizard("setOptions", options);
				return true;
			});
		});
	</script>
	<script>
		new PerfectScrollbar('.best-selling-products');
		new PerfectScrollbar('.recent-reviews');
		new PerfectScrollbar('.support-list');
	</script>
	<!--app JS-->
	<script src="../assets/js/app.js"></script>
</body>

</html>