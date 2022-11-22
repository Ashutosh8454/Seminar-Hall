<?php
    session_start();

    include 'connection.php';

    $teacher_id = $password = "";
    $err = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if(empty(trim($_POST["teacher_id"])) || empty(trim($_POST["password"])))
        {
            $err = "Please Enter Teacher Id and password";
        }
        else{
            $teacher_id = trim($_POST["teacher_id"]);
            $password = trim($_POST["password"]);
        }

        if(empty($err))
        {
            $sql = "SELECT teacher_id,teacher_name 
                    FROM teacher_table 
                    WHERE teacher_id = '$teacher_id' AND `password` = '$password' AND `Status` = 'Active'";
            $result = mysqli_query($con,$sql);
            $rowcount = mysqli_num_rows($result);

            if($rowcount > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $teacher_id = $_SESSION["teacher_id"] = $row["teacher_id"];
                    $teacher_name = $_SESSION["teacher_name"] = $row["teacher_name"];
                }

                header("location: book_now.php");
            }
            else{
                // header("location: Login.php");
                echo '<script> alert("Invalid User Details!")</script>';
                
                echo mysqli_error($con);
            }

        }
    }
?>
<!Doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="Css/signup.css">
        
        

    </head>
    <body> 

        <div class="content">
           <!----<img src="mit.jpg">-->
            <div class="page">
            <div class="title">--Login--</div>
            <form action="#" method="post">
               <span> <i class="fa-solid fa-user"></i>
                <input type="text" name="teacher_id" placeholder="Teacher's Id" Id="teacher_id">
                </span>
                <span><i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Password" Id="password">
                </span>
                <div class="fid">
                        <a href="forgot_page.php">Forget Password</a>
                    </div>
                <!-- <button type="submit">Login</button> -->
                <input type="submit" name="login" id="login" value="Login">
            </form>
           <!-- <div class="fid">
                <a href="#">Forget Password</a>
            </div>-->
            <div class="signup">
                <p>Don't have an account?<a href="signup.php">sign up</a></p>
            </div>

    </body>
</html>