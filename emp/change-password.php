<?php 
session_start();
error_reporting(E_ALL);
require_once('include/config.php');

// Check if employee is logged in
if (empty($_SESSION["Empid"])) {   
    header('Location: index.php');
    exit;
}

// Initialize messages
$error = $msg = "";

// Change password
if (isset($_POST['submit'])) {

    $oldpassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_SESSION['email'];

    // Confirm password check (backend)
    if ($newpassword !== $confirmpassword) {
        $error = "New Password and Confirm Password do not match.";
    } else {
        // Fetch current password from DB
        $sql = "SELECT password FROM tbladmin WHERE email = :email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if ($result && password_verify($oldpassword, $result->password)) {

            // Update password
            $hashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $update = "UPDATE tbladmin SET password = :newpassword WHERE email = :email";
            $chngpwd = $dbh->prepare($update);
            $chngpwd->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd->bindParam(':newpassword', $hashedPassword, PDO::PARAM_STR);
            $chngpwd->execute();

            $msg = "Your password was successfully changed.";
        } else {
            $error = "Your current password is incorrect.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Management System | Change Password</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="app sidebar-mini rtl">

<?php include 'include/header.php'; ?>
<?php include 'include/sidebar.php'; ?>

<main class="app-content">
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h2 align="center">Change Password</h2>
                <hr>

                <?php if (!empty($error)) { ?>
                    <div class="errorWrap"><strong>ERROR:</strong> <?= htmlentities($error); ?></div>
                <?php } elseif (!empty($msg)) { ?>
                    <div class="succWrap"><strong>SUCCESS:</strong> <?= htmlentities($msg); ?></div>
                <?php } ?>

                <div class="tile-body">
                    <form class="row" method="post" name="chngpwd" onsubmit="return valid();">

                        <div class="form-group col-md-12">
                            <label>Old Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label>New Password</label>
                            <input type="password" name="newpassword" class="form-control" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" class="form-control" required>
                        </div>

                        <div class="form-group col-md-4">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function valid() {
    if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password do not match!");
        return false;
    }
    return true;
}
</script>

</body>
</html>
