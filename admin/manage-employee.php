<?php 
include 'include/config.php';

// Handle delete request with confirmation
if (isset($_REQUEST['del'])) {
    $uid = intval($_GET['del']);
    $sql = "DELETE FROM tblemployee WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $uid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>alert('Employee record deleted successfully!');</script>";
    echo "<script>window.location.href='manage-employee.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive">
    <title>Employee Management System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css -->
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
                        <h2 align="center">Manage Employee</h2>
                        <hr />

                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Emp Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Country</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT tblemployee.id, EmpId, fname, lname, department_name, email, mobile, country, 
                                               tbldepartment.DepartmentName 
                                        FROM tblemployee
                                        LEFT JOIN tbldepartment ON tblemployee.department_name = tbldepartment.id
                                        ORDER BY tblemployee.id DESC";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;

                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->EmpId); ?></td>
                                    <td><?php echo htmlentities($result->fname . ' ' . $result->lname); ?></td>
                                    <td><?php echo htmlentities($result->email); ?></td>
                                    <td><?php echo htmlentities($result->mobile); ?></td>
                                    <td><?php echo htmlentities($result->country); ?></td>
                                    <td><?php echo htmlentities($result->DepartmentName); ?></td>
                                    <td>
                                        <a href="emp-details.php?empid=<?php echo htmlentities($result->id); ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="edit-employee.php?empid=<?php echo htmlentities($result->id); ?>" class="btn btn-success btn-sm">Edit</a>
                                        <a href="emp-salary-history.php?empid=<?php echo htmlentities($result->EmpId); ?>&empname=<?php echo htmlentities($result->fname); ?>" class="btn btn-warning btn-sm">Salary</a>
                                        <a href="emp-leave-history.php?empid=<?php echo htmlentities($result->EmpId); ?>&empname=<?php echo htmlentities($result->fname); ?>" class="btn btn-primary btn-sm">Leave</a>
                                        <a href="manage-employee.php?del=<?php echo htmlentities($result->id); ?>" 
                                           onclick="return confirm('Are you sure you want to delete this employee record?');"
                                           class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                                <?php $cnt++; } } ?>
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
                "ordering": true
            });
        });
    </script>
</body>
</html>

