<?php 
error_reporting(0);
include 'include/config.php';

if (isset($_POST['submit'])) {
    $DepartmentName = trim($_POST['DepartmentName']);

    // Check if department already exists (case-insensitive)
    $checksql = "SELECT * FROM tbldepartment WHERE LOWER(DepartmentName) = LOWER(:DepartmentName)";
    $checkquery = $dbh->prepare($checksql);
    $checkquery->bindParam(':DepartmentName', $DepartmentName, PDO::PARAM_STR);
    $checkquery->execute();

    if ($checkquery->rowCount() > 0) {
        $errormsg = "Department already exists! Please use another name.";
    } else {
        // Insert new department
        $sql = "INSERT INTO tbldepartment (DepartmentName) VALUES (:DepartmentName)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':DepartmentName', $DepartmentName, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId > 0) {
            $msg = "Department added successfully!";
        } else {
            $errormsg = "Data not inserted successfully.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive">
    <title>Employee Leave Management System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>

    <main class="app-content">
        <div class="row">
            <div class="col-md-6">
                <div class="tile">
                    <h2 align="center">Add Department</h2>
                    <hr />

                    <!-- Success Message -->
                    <?php if ($msg) { ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                    </div>
                    <?php } ?>

                    <!-- Error Message -->
                    <?php if ($errormsg) { ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
                    </div>
                    <?php } ?>

                    <div class="tile-body">
                        <form method="post">
                            <div class="form-group col-md-12">
                                <label class="control-label">Department Name</label>
                                <input class="form-control" name="DepartmentName" id="DepartmentName" type="text" placeholder="Enter Department Name" required>
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Essential javascripts -->
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/plugins/pace.min.js"></script>
</body>
</html>
