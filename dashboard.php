<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD']==="POST") {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone_num=$_POST['phone_num'];
    $username=$_POST['username'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);

        $sql=$conn->prepare('insert into user1(name,email,phone_num,username,password) values (?, ?, ?, ?, ?)');
        $sql->bind_param('sssss',$name,$email,$phone_num,$username,$password);

        if ($sql->execute()) {
            header('Location:login.php');
            exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Registration Form</h2>

    <form method="POST">
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="f_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mobile Number</label>
            <input type="text" name="phone_num" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>
</html>