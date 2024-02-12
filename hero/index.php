<?php
require("SuAdminsession.php");
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor1">

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
    <link href="../assets/plugins/smart-wizard/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

    <!-- SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
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
    <title>eVoting Shield</title>
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
            <div class="page-content">
                <?php
                include '../common_header.php'
                ?>

                <div class="card radius-10">
                    <div class="card-header border-bottom-0 bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="font-weight-bold mb-0">Admin Request</h5>
                            </div>
                            <!--<div class="ms-auto">-->
                            <!--	<button type="button" class="btn btn-white radius-10">View More</button>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connection.php';
                                    require_once '../admin/inc/function.php';

                                    if (isset($_GET['delete'])) {

                                        $idToDelete = $_GET['delete'];
                                        // Perform deletion here using the $idToDelete
                                        // Example:
                                        $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
                                        $stmt->bind_param("i", $idToDelete);
                                        $stmt->execute();
                                        if ($stmt->affected_rows > 0) {
                                            // Deletion successful
                                            echo '<script>
                                                    Swal.fire({
                                                        title: "Deleted!",
                                                        text: "The user has been deleted.",
                                                        icon: "success"
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname; // Reload page after deletion
                                                    });
                                                  </script>';
                                        }
                                    }
                                    if (isset($_GET['add'])) {

                                        $idToAdd = $_GET['add'];
                                        // Perform deletion here using the $idToAdd
                                        // Example:
                                        $stmt = $mysqli->prepare("UPDATE `users` SET `user_role` = 'admin' WHERE `users`.`id` = ?;");
                                        $stmt->bind_param("i", $idToAdd);
                                        $stmt->execute();
                                        if ($stmt->affected_rows > 0) {
                                            // Deletion successful
                                            echo '<script>
                                                    Swal.fire({
                                                        title: "Added!",
                                                        text: "The user has been added.",
                                                        icon: "success"
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname; // Reload page after deletion
                                                    });
                                                  </script>';
                                        }
                                    }

                                    $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_role = 'cadmin';");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row_fetch = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row_fetch['username']; ?></td>
                                                <td><?php echo $row_fetch['contact']; ?></td>
                                                <td><?php echo $row_fetch['email']; ?></td>
                                                <td>
                                                    <a href="?add=<?php echo $row_fetch['id']; ?>" class="btn btn-sm btn-success radius-30"> Add </a>
                                                    <a href="?delete=<?php echo $row_fetch['id']; ?>" class="btn btn-sm btn-danger radius-30"> Delete </a>
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
                <div class="card radius-10">
                    <div class="card-header border-bottom-0 bg-transparent">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="font-weight-bold mb-0">Admin Lists</h5>
                            </div>
                            <!--<div class="ms-auto">-->
                            <!--	<button type="button" class="btn btn-white radius-10">View More</button>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'connection.php';
                                    require_once '../admin/inc/function.php';

                                    if (isset($_GET['delete'])) {

                                        $idToDelete = $_GET['delete'];
                                        // Perform deletion here using the $idToDelete
                                        // Example:
                                        $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
                                        $stmt->bind_param("i", $idToDelete);
                                        $stmt->execute();
                                        if ($stmt->affected_rows > 0) {
                                            // Deletion successful
                                            echo '<script>
                                                    Swal.fire({
                                                        title: "Deleted!",
                                                        text: "The user has been deleted.",
                                                        icon: "success"
                                                    }).then(() => {
                                                        window.location.href = window.location.pathname; // Reload page after deletion
                                                    });
                                                  </script>';
                                        }
                                    }

                                    $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_role = 'admin';");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row_fetch = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row_fetch['username']; ?></td>
                                                <td><?php echo $row_fetch['contact']; ?></td>
                                                <td><?php echo $row_fetch['email']; ?></td>
                                                <td>
                                                    <a href="?delete=<?php echo $row_fetch['id']; ?>" class="btn btn-sm btn-danger radius-30"> Delete </a>
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
        var options = {
            series: [75],
            chart: {
                height: 350,
                type: 'radialBar',
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 225,
                    hollow: {
                        margin: 0,
                        size: '70%',
                        background: '#fff',
                        image: undefined,
                        imageOffsetX: 0,
                        imageOffsetY: 0,
                        position: 'front',
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 0,
                            blur: 4,
                            opacity: 0.24
                        }
                    },
                    track: {
                        background: '#fff',
                        strokeWidth: '67%',
                        margin: 0, // margin is in pixels
                        dropShadow: {
                            enabled: true,
                            top: -3,
                            left: 0,
                            blur: 4,
                            opacity: 0.35
                        }
                    },

                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            color: '#888',
                            fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val);
                            },
                            color: '#111',
                            fontSize: '36px',
                            show: true,
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#ABE5A1'],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: 'round'
            },
            labels: ['Percent'],
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    <script>
        var options = {
            series: [{
                name: 'PRODUCT A',
                data: dataSet[0]
            }, {
                name: 'PRODUCT B',
                data: dataSet[1]
            }, {
                name: 'PRODUCT C',
                data: dataSet[2]
            }],
            chart: {
                type: 'area',
                stacked: false,
                height: 350,
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    inverseColors: false,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [20, 100, 100, 100]
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#8e8da4',
                    },
                    offsetX: 0,
                    formatter: function(val) {
                        return (val / 1000000).toFixed(2);
                    },
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                }
            },
            xaxis: {
                type: 'datetime',
                tickAmount: 8,
                min: new Date("01/01/2014").getTime(),
                max: new Date("01/20/2014").getTime(),
                labels: {
                    rotate: -15,
                    rotateAlways: true,
                    formatter: function(val, timestamp) {
                        return moment(new Date(timestamp)).format("DD MMM YYYY")
                    }
                }
            },
            title: {
                text: 'Irregular Data in Time Series',
                align: 'left',
                offsetX: 14
            },
            tooltip: {
                shared: true
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetX: -10
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
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