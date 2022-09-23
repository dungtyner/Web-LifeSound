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


<?php
 include_once "../models/registerModel.php";
?>
<div class="wrapper">
    <img src="../images/dancer.gif"></img>
    <section class="section__form">
        <h1>Hi, welcome back</h1>

        <form action="" method="post" id="form2">
            <div class="name-details">
                <div class="field input__text">
                    <input type="text" name="fname" placeholder="First name" required />
                    <div class="has-err">
                        <span><?php echo (isset($err['fname'])) ?$err['fname']:''  ?></span>
                    </div>
                </div>
                <div class="field input__text">

                    <input type="text" name="lname" placeholder="Last name" required />
                    <div class="has-err">
                        <span><?php echo (isset($err['lname'])) ?$err['lname']:''  ?></span>
                    </div>
                </div>
            </div>
            <!-- <div class="checkbox">
                    <input type="radio"id="female" name="check" />
                    <p>Female</p>
                    <input type="radio"id="male" name="check" />
                    <p>Male</p>
                </div>
                <div class="date">
                    <p>Birth day</p>
                    <select name="" id="">
                        <option value="">01</option>
                    </select>
                    <select name="" id="">
                        <option value="">Month 1</option>
                    </select>
                    <select name="" id="">
                        <option value="">2003</option>
                        <option value="">2004</option>
                        <option value="">2005</option>
                        <option value="">2006</option>
                        <option value="">2007</option>
                    </select>
                </div> -->

            <div class="field input__text">
                <input type="text" name="number" placeholder="Enter mobile number" required />
                <div class="has-err">
                    <span><?php echo (isset($err['number'])) ?$err['number']:''  ?></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="text" name="email" placeholder="Enter email address" required />
                <div class="has-err">
                    <span><?php echo (isset($err['email'])) ?$err['email']:''  ?></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="text" name="username" placeholder="Enter username" required />
                <div class="has-err">
                    <span><?php echo (isset($err['username'])) ?$err['username']:''  ?></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="password" name="password" placeholder="Enter new password" id="pass" required />
                <button class="btn__show__password" type="button" id="btnPassword">
                    <i class="material-icons">remove_red_eye</i>
                </button>
                <div class="has-err">
                    <span><?php echo (isset($err['password'])) ?$err['password']:''  ?></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="password" name="check_password" placeholder="Enter password again" id="pass2" required />
                <button class="btn__show__password" type="button" id="btnPassword2">
                    <i class="material-icons">remove_red_eye</i>
                </button>
                <div class="has-err">
                    <span><?php echo (isset($err['check_password'])) ?$err['check_password']:''  ?></span>
                </div>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Create account" form="form2" />
            </div>
        </form>
        <div class="link">Already signed up? <a href="./login.php">Login now</a></div>
    </section>
</div>
</body>
<script src="../js/login.js"></script>
</html>