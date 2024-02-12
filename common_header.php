<div class="row row-cols-1 row-cols-lg-4">
    <div class="col">
        <div class="card radius-10 overflow-hidden bg-gradient-cosmic">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Total Candidates</p>
                        <h5 class="mb-0 text-white">
                            <?php
                            include 'connection.php';
                            $stmt = $mysqli->prepare("Select COUNT(*) as total from candidate where createdby=? order by id");
                            $stmt->bind_param('s',$_SESSION['username']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($mysqli->affected_rows > 0) {
                                while ($row_fetch = $result->fetch_assoc()) {
                                    echo $row_fetch['total'];
                                }
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="ms-auto text-white"><i class='bx bx-user font-30'></i>
                    </div>
                </div>
                <div class="progress bg-white-2 radius-10 mt-4" style="height:4.5px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 46%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 overflow-hidden bg-gradient-burning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Total Positions</p>
                        <h5 class="mb-0 text-white">
                            <?php
                            include 'connection.php';
                            $stmt = $mysqli->prepare("Select COUNT(*) as total1 from positions where createdby=? order by id");
                            $stmt->bind_param('s',$_SESSION['username']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($mysqli->affected_rows > 0) {
                                while ($row_fetch1 = $result->fetch_assoc()) {
                                    echo $row_fetch1['total1'];
                                }
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="ms-auto text-white"><i class='bx bx-chair font-30'></i>
                    </div>
                </div>
                <div class="progress bg-white-2 radius-10 mt-4" style="height:4.5px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 72%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 overflow-hidden bg-gradient-Ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Total Users</p>
                        <h5 class="mb-0 text-white">
                            <?php
                            include 'connection.php';
                            $stmt = $mysqli->prepare("Select COUNT(*) as total2 from users where user_role = 'voter';");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($mysqli->affected_rows > 0) {
                                while ($row_fetch2 = $result->fetch_assoc()) {
                                    echo $row_fetch2['total2'];
                                }
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="ms-auto text-white"><i class='bx bx-street-view font-30'></i>
                    </div>
                </div>
                <div class="progress bg-white-2 radius-10 mt-4" style="height:4.5px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 68%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 overflow-hidden bg-gradient-moonlit">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-white">Total Admin</p>
                        <h5 class="mb-0 text-white">
                            <?php
                            include 'connection.php';
                            $stmt = $mysqli->prepare("Select COUNT(*) as total3 from users where user_role = 'admin';");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($mysqli->affected_rows > 0) {
                                while ($row_fetch3 = $result->fetch_assoc()) {
                                    echo $row_fetch3['total3'];
                                }
                            }
                            ?>
                        </h5>
                    </div>
                    <div class="ms-auto text-white"><i class='bx bx-happy font-30'></i>
                    </div>
                </div>
                <div class="progress  bg-white-2 radius-10 mt-4" style="height:4.5px;">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 66%"></div>
                </div>
            </div>
        </div>
    </div>
</div><!--end row-->