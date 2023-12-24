<?php
    require_once("Connet.php");

    // Proses dari form login
    $message = "";

    if (isset($_POST['login']) && $_POST['login'] == "Login") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM admin WHERE username = ? AND password = SHA2(?, 0)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $valid_user = $result->fetch_assoc();

        if ($valid_user) {
            session_start();
            $_SESSION["admin"] = $username;
            header("Location: index");
        } else {
            $message = "Username atau Password Salah";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/logo_bireuen.jpeg">
    <title>Login | Dinas Kependudukan dan Pencatatan Sipil Bireuen</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/admin.css" rel="stylesheet">
    <script src="js/gradient.js"></script>
</head>

<body id="gradient">
    <div class="container">
        <div class="card container card-login mx-auto mt-5">
            <h3 class="text-center" style="padding-top:8px; font-family: monospace;">Login Admin</h3>
            <hr class="custom">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input class="form-control" id="username" type="text" name="username" aria-describedby="userlHelp" placeholder="Enter Username" required>
                        <label>admin</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                        <label>admin</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox"> Remember Password
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block card-shadow-2" name="login" value="Login">
                </form>
            </div>
            <p class="text-center text-danger"><small><?php echo @$message; ?></small></p>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
