<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $sql=$conn->prepare("select username,password from user1 where email=?");
    $sql->bind_param('s',$email);
    $sql->execute();
    $sql->store_result();
    $sql->bind_result($username,$password);

        if (password_verify($pass,$password)) {
            $_SESSION['username']=$username;
            header('Location:dashboard.php');
            exit;
        } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Login Form</h2>

    <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>