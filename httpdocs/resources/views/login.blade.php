$servername = 'localhost';
$username = 'ellis2';
$password = 'bellis';
$db = 'cust_tracker';

// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $db = 'technixu_elis';
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
mysqli_set_charset($conn,"utf8");
// header('Content-Type: text/html; charset=utf-8');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set("Europe/London");
?>
root@wt2:/home/wt2/public_html/zeepup/inc# 
root@wt2:/home/wt2/public_html/zeepup/inc# cd ..
root@wt2:/home/wt2/public_html/zeepup# clear

root@wt2:/home/wt2/public_html/zeepup# cat login.php 
<?php
include_once 'inc/session.php';
include_once 'inc/dbs.php';
$email = '';
if(isset($_POST['log_in_btn'])){

    $email = mysqli_real_escape_string($conn, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $runQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($runQuery) > 0){


        $row = mysqli_fetch_array($runQuery);

        $db_user_id = $row['id'];
        $db_email = $row['email'];
        $db_password = $row['password'];
        $db_role = $row['role'];
        $password = md5($password);

        if($db_email == $email  && $password == $db_password){
                header("Location: index.php");
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['email'] = $db_email;
                $_SESSION['role'] = $db_role;
                $_SESSION['is_login'] = 1;
        }
        else{
            $msg = "Incorrect password";
            // echo '<script>alert("'.$error.'")</script>';

        }

    }
    else{
        $msg = "Account not found";
        // echo '<script>alert("'.$error.'")</script>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#e2e8f0;">
  <div class="account-pages my-5 pt-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card overflow-hidden">
            <div class="card-body pt-0">
                 
              <h3 class="text-center mt-5 mb-4">
                <a href="#" class="d-block auth-logo">
                  <img src="images/elis.png" alt="" height="50">
                </a>
              </h3>

              <div class="p-3">
                <h4 class="text-muted font-size-18 mb-1 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Log in to continue.</p>
                <?php if($msg != ''){?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong><?=$msg?></strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      <?php
                        }?>
                <form class="form-horizontal mt-4" method="post" action="">
                  <div class="mb-3">
                    <label for="username">Username</label>
                    <input type="email" name="username" class="form-control" placeholder="Powered by estatecoordinator.co.uk" value="<?=$email?>" required="">
                  </div>
                  <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                  </div>
                  <div class="mb-3 row mt-4">
                    <div class="col-6">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customControlInline">
                        <label class="form-check-label" for="customControlInline">Remember me
                        </label>
                      </div>
                    </div>
                    <div class="col-6 text-end">
                      <button class="btn btn-primary w-md waves-effect waves-light" name="log_in_btn" value="login"
                        type="submit">Log In</button>
                    </div>
                  </div>
                  <div class="my-3">
    <h6 class="text-center">Powered by estatecoordinator.co.uk</h6></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
</body>




</html>
root@wt2:/home/wt2/public_html/zeepup# 
