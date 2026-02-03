<?php 
error_reporting(0);
session_start();
include 'include/config.php';

$msg = "";
$errormsg = "";

if (isset($_POST['Submit'])) {

    $Department = $_POST['Department'];
    $empid = $_POST['name']; // empid comes from name dropdown
    $salary = $_POST['salary'];
    $AllowanceSalary = $_POST['AllowanceSalary'];
    $totalsalary = $salary + $AllowanceSalary;

    /* ===============================
       CHECK DUPLICATE EMP ID
       =============================== */
    $checkSql = "SELECT id FROM tbladdsalary WHERE empid = :empid";
    $checkQuery = $dbh->prepare($checkSql);
    $checkQuery->bindParam(':empid', $empid, PDO::PARAM_STR);
    $checkQuery->execute();

    if ($checkQuery->rowCount() > 0) {

        $errormsg = "Salary already added for this Employee ID";

    } else {

        /* ===============================
           INSERT SALARY
           =============================== */
        $sql = "INSERT INTO tbladdsalary 
                (Department, empid, salary, allowancesalary, total) 
                VALUES 
                (:Department, :empid, :salary, :AllowanceSalary, :totalsalary)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':Department', $Department, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':salary', $salary, PDO::PARAM_STR);
        $query->bindParam(':AllowanceSalary', $AllowanceSalary, PDO::PARAM_STR);
        $query->bindParam(':totalsalary', $totalsalary, PDO::PARAM_STR);

        if ($query->execute()) {
            $msg = "Salary Added Successfully";
        } else {
            $errormsg = "Data not inserted successfully";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Employee Management System">
    <title>Add Salary</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">

<?php include 'include/header.php'; ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<?php include 'include/sidebar.php'; ?>

<main class="app-content">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h2 align="center">Add Salary</h2>
                <hr>

                <!-- SUCCESS MESSAGE -->
                <?php if ($msg) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo htmlentities($msg); ?>
                    </div>
                <?php } ?>

                <!-- ERROR MESSAGE -->
                <?php if ($errormsg) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo htmlentities($errormsg); ?>
                    </div>
                <?php } ?>

                <div class="tile-body">
                    <form class="row" method="post">

                        <div class="form-group col-md-6">
                            <label>Department</label>
                            <select name="Department" id="Department" class="form-control"
                                    onchange="getdistrict(this.value);" required>
                                <option value="">--Select--</option>
                                <?php 
                                $stmt = $dbh->prepare("SELECT * FROM tbldepartment ORDER BY DepartmentName");
                                $stmt->execute();
                                $departList = $stmt->fetchAll();
                                foreach ($departList as $departname) {
                                    echo "<option value='{$departname['id']}'>{$departname['DepartmentName']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Employee</label>
                            <select name="name" id="name" class="form-control" required>
                                <option value="">--Select--</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Basic Salary</label>
                            <input type="number" name="salary" id="salary"
                                   class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Allowance Salary</label>
                            <input type="number" name="AllowanceSalary" id="AllowanceSalary"
                                   class="form-control" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Total Salary</label>
                            <input type="text" name="totalsalary" id="totalsalary"
                                   class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-4 align-self-end">
                            <input type="submit" name="Submit"
                                   class="btn btn-primary" value="Submit">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</main>

<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

<!-- AJAX EMPLOYEE LOAD -->
<script>
function getdistrict(val) {
    $.ajax({
        type: "POST",
        url: "ajaxfile.php",
        data: 'Department=' + val,
        success: function (data) {
            $("#name").html(data);
        }
    });
}
</script>

<!-- AUTO TOTAL -->
<script>
$(function () {
    $('#salary, #AllowanceSalary').keyup(function () {
        var s = parseFloat($('#salary').val()) || 0;
        var a = parseFloat($('#AllowanceSalary').val()) || 0;
        $('#totalsalary').val(s + a);
    });
});
</script>

</body>
</html>
