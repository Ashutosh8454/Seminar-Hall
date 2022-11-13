<!Doctype html>
<html>

<head>
    <title>Sign up</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">-->
   <!-- <link rel="stylesheet" href="Css/style2.css">-->
    <link rel="stylesheet" href="Css/signup.css"> 
    <script src="js/new.js"></script>

</head>

<body>

    <div class="content">

        <div class="page">
            <div class="title">--Sign up--</div>
            <form action="regis.php" name="registration" onsubmit="return validateForm()" method="post">

                <div class="formdesign" id="name">
                    <input type="text" name="fname" placeholder="Enter full name*" required>
                    <b><span class="formerror"></span></b>
                </div>

                <input type="text" name="id" placeholder="Enter teacher Id*" Id="id" required>

                <div class="formdesign" id="email">
                    <input type="text" name="femail" placeholder="Enter email*"  required>
                    <b><span class="formerror"></span></b>
                </div>
                <div class="formdesign" id="phone">
                    <input type="text" name="fphone" placeholder="Enter phone number*" required>
                    <b><span class="formerror"></span></b>
                </div>
                <div class="formdesign" id="pass">
                    <input type="password" name="fpass" placeholder="Enter password*"  required>
                    <b><span class="formerror"></span></b>
                </div>
                <div class="formdesign" id="cpass">
                <input type="password" name="fcpass" placeholder="Confirm password*"  required>
                <b><span class="formerror"></span></b>
                </div>

                <button type="submit" value="submit">Sign up</button>

            </form>
            <!-- <div class="fid">
                <a href="#">Forget Password</a>
            </div>-->
            <div class="already">
                <p>Already have an account?<a href="login.php">login</a></p>
            </div>

</body>

</html>