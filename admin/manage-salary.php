<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['Empid']) == 0) {
    header('location:index.php');
    exit();
}

/* DELETE SALARY RECORD */
if (isset($_GET['delete'])) {
    $sid = intval($_GET['delete']);

    $sql = "DELETE FROM tbladdsalary WHERE id = :sid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $sid, PDO::PARAM_INT);
    $query->execute();

    echo "<script>alert('Salary record deleted successfully');</script>";
    echo "<script>window.location.href='manage-salary.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Employee Management System">
    <title>Manage Salary</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
</head>

<body class="app sidebar-mini rtl">

<?php include 'include/header.php'; ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<?php include 'include/sidebar.php'; ?>

<main class="app-content">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <h2 align="center">Manage Salary</h2>
                    <hr>

                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Emp ID</th>
                            <th>Department</th>
                            <th>Basic Salary</th>
                            <th>Allowance</th>
                            <th>Total Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $sql = "SELECT 
                                    tbladdsalary.id AS sid,
                                    tbladdsalary.empid,
                                    tbladdsalary.salary,
                                    tbladdsalary.allowancesalary,
                                    tbladdsalary.total,
                                    tbldepartment.DepartmentName
                                FROM tbladdsalary
                                JOIN tbldepartment 
                                ON tbladdsalary.Department = tbldepartment.id
                                ORDER BY tbladdsalary.id DESC";

                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;

                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($row->empid); ?></td>
                                    <td><?php echo htmlentities($row->DepartmentName); ?></td>
                                    <td><?php echo htmlentities($row->salary); ?></td>
                                    <td><?php echo htmlentities($row->allowancesalary); ?></td>
                                    <td><?php echo htmlentities($row->total); ?></td>
                                    <td>
                                        <a href="edit-salary.php?id=<?php echo htmlentities($row->sid); ?>"
                                           class="btn btn-success btn-sm">Edit</a>

                                        <a href="salary-details.php?id=<?php echo htmlentities($row->sid); ?>"
                                           class="btn btn-primary btn-sm">View</a>

                                        <a href="manage-salary.php?delete=<?php echo htmlentities($row->sid); ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this salary record?');">
                                           Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $cnt++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" align="center">
                                    <strong>No salary records found</strong>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#sampleTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: true,
            searching: true
        });
    });
</script>

</body>
</html>
