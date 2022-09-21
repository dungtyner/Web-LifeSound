<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lift Sound</title>
    <link rel="icon" href="../images/owl.png">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php
    include_once "../models/loginModel.php";
    ?>
    <div class="wrapper">
        <img src="../images/dancer.gif"></img>
        <section class="section__form">
            <h1>Hi, welcome back</h1>
            <?php if (isset($_COOKIE['msg'])) { ?>
              <div class="show__note">
                 <strong>Note: </strong> <?= $_COOKIE['msg'] ?>
                  </div>
			<?php } ?>
            <form action="" method="post" id="form1">
                <div class="field input__text">
                    <input type="text" name="username" id="name" placeholder="Enter username"
                        value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" required />      
                </div>
               
                <div class="field input__text">
                    <input type="password" name="password" id="pass" placeholder="Enter new password"
                        value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" required />
                 <button class="btn__show__password" type="button" id="btnPassword">
                    <i class="material-icons">remove_red_eye</i>
                </button>                      
                </div>
                <input type="checkbox" name="remember" <?php echo isset($checkRemember)?"Checked":"" ?> />
                <span>Remember password</span>
                <div class="field button">
                    <input type="submit" name="submit" value="login" form="form1" required />
                </div>
            </form>
            <div class="link">Create new account? <a href="./register.php">Register</a></div>
        </section>
    </div>
</body>
<script src="../js/login.js"></script>
</html>