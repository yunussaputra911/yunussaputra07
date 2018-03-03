<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Login-Sistem Management Surat</title>

    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">

    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/metro.js"></script>
 
    <style>
        .login-form {
            width: 25rem;
            height: 18.75rem;
            position: fixed;
            top: 50%;
            margin-top: -9.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
        body {
        	background:url(img/login.jpg);
    		background-repeat: no-repeat;
    		background-size: cover;
        }
    </style>

    <script>

        /*
        * Do not use this is a google analytics fro Metro UI CSS
        * */
        if (window.location.hostname !== 'localhost') {

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-58849249-3', 'auto');
            ga('send', 'pageview');

        }


        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['username'])) { }
else{
header("location:index.php");
}
// define variables and set to empty values
$username = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("koneksi.php");
    $username = test_input($_POST["user_login"]);
    $password = test_input($_POST["user_password"]);
    $sql = "SELECT password, level, username FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 0) {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal Login', content: \"Username/Password Tidak Ada\"});
                    }, 30);
                });
            </script>";
    }
    else{
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $user = $row["username"];
        $level = $row["level"];
        $pswd = $row["password"];
        if($password == $pswd && $username == $user ) {
            $_SESSION['username'] = $user;
            header('location:index.php');
            } 
            else {
                    echo "<script>
                    $(function(){
                    setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal Login', content: \"Username/Password salah\"});
                    }, 30);
                    });
                    </script>";
    }
    }
}
    }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
    <div class="login-form padding20 block-shadow">
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" 
        data-role="validator"
        data-show-required-state="false"
         data-hint-mode="line"
          data-hint-background="bg-red"
           data-hint-color="fg-white"
            data-hide-error="5000">  
            <h1 class="text-light">Login</h1>
            <hr class="thin"/>
            <p id="salah"></p>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="user_login">Username:</label>
                <input type="text" name="user_login" id="user_login"
                data-validate-func="required"
                data-validate-hint="Form ini Tidak Boleh Kosong">
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control password full-size" data-role="input">
                <label for="user_password">Password:</label>
                <input type="password" name="user_password" id="user_password"
                data-validate-func="required"
                data-validate-hint="Form ini Tidak Boleh Kosong">
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
                <button class="button helper-button reveal"><span class="mif-looks"></span></button>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Login</button>
                <button type="button" class="button link">Cancel</button>
            </div>
        </form>
    </div>
<script>
    function notifyOnErrorInput(input){
        var message = input.data('validateHint');
        $.Notify({
            caption: 'Error',
            content: message,
            type: 'alert'
        });
    }
</script>
</body>
</html>