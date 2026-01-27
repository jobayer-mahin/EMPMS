<?php 
session_start();
error_reporting(0);
require_once('include/config.php');

if (strlen($_SESSION["Empid"]) == 0) {   
    header('location:index.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Employee Leave History">
    <title>Employee Management System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar -->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>

    <main class="app-content">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <h2 align="center">Leave History</h2>
                        <hr />

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Description</th>
                                    <th>Applied Date</th>
                                    <th>Admin Remark</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $EmpID = $_SESSION["Empid"];
                                $sql = "SELECT 
                                            tblleave.id, 
                                            userID, 
                                            EmpID, 
                                            tblleave.LeaveType, 
                                            FromDate, 
                                            Todate, 
                                            Description, 
                                            status, 
                                            adminremarks, 
                                            tblleave.Create_date, 
                                            tblleavetype.leaveType AS leavetypss 
                                        FROM tblleave
                                        JOIN tblleavetype ON tblleave.LeaveType = tblleavetype.id 
                                        WHERE EmpID = :EmpID 
                                        ORDER BY tblleave.id DESC";

                                $query = $dbh->prepare($sql);
                                $query->bindParam(':EmpID', $EmpID, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->leavetypss); ?></td>
                                    <td><?php echo htmlentities($result->FromDate); ?></td>
                                    <td><?php echo htmlentities($result->Todate); ?></td>
                                    <td><?php echo htmlentities($result->Description); ?></td>
                                    <td><?php echo htmlentities($result->Create_date); ?></td>
                                    <td><?php echo htmlentities($result->adminremarks); ?></td>
                                    <td>
                                        <?php 
                                            $statuss = $result->status;
                                            if ($statuss == "Pending") {
                                                echo '<span class="btn btn-warning btn-sm">Pending</span>';
                                            } elseif ($statuss == "Approved") {
                                                echo '<span class="btn btn-success btn-sm">Approved</span>';
                                            } elseif ($statuss == "Reject") {
                                                echo '<span class="btn btn-danger btn-sm">Rejected</span>';
                                            } else {
                                                echo '<span class="btn btn-secondary btn-sm">Unknown</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php $cnt++; } 
                                } else { ?>
                                <tr>
                                    <td colspan="8" align="center"><strong>No leave records found</strong></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/plugins/pace.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sampleTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [5, 10, 25, 50, 100],
                "ordering": true,
                "searching": true
            });
        });
    </script>
</body>
</html>
<?php } ?>

