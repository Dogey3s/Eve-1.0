<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login Form</title>
    <style>
        .container{
            box-shadow: rgba( 100, 100, 111, 0.2) 0px 7px 29px 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
      }
        
    </style>
</head>
<body>
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users where email= '$email'";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
            if ($user){
                if (password_verify($password,$user["Password"])){
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location:index.php");
                    die();
                }
                else{
                    echo "<div class='alert alert-danger'>Password is incorrect.</div>";
                }

            }
            else{
                echo "<div class='alert alert-danger'>Email does not match </div>";
            }
        }
        ?>
      <div class="conatiner">
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit"  value="login" name="login" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>
</html>