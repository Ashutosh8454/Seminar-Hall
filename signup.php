<?php
session_start();

include 'connection.php';

if(isset($_POST['submit']))
{
  $id=$_POST['id'];

  $fname= $_POST['fname'];
  $femail= $_POST['femail'];
  $fphone= $_POST['fphone'];
  $fpass= $_POST['fpass'];
  $fcpass=$_POST['fcpass'];
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {  

//username must be unique
      $act="Active";
     $stmt="SELECT teacher_id FROM teacher_table WHERE teacher_id='$id'";
     $result=mysqli_query($con,$stmt);
     if(mysqli_num_rows($result)>0)

    
     {
        echo "Opps Id exists already. Try Another !! <br>";
          
     }
     elseif($id!="" && $fname!="" && $femail!="" && $fphone!="" && $fpass!="" && $fcpass!="")
          {
            $query= "insert into teacher_table(teacher_id,teacher_name,status,password,email,phone_no) VALUES ('$id','$fname','$act','$fpass','$femail','$fphone')";
            $data=mysqli_query($con, $query);
             if($data)
             {
              header("location: login.php");
             }
            }
            else
            {
             $main_err="Something is missing .All things are necessary";
            }
          }
      }
      ?>
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
            <form action="" name="registration" onsubmit="return validateForm()" method="POST">

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

                <button type="submit" name="submit" value="submit">Sign up</button>

            </form>
            <!-- <div class="fid">
                <a href="#">Forget Password</a>
            </div>-->
            <div class="already">
                <p>Already have an account?<a href="login.php">login</a></p>
            </div>
            
</body>

</html>