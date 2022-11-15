<?php
    session_start();

    if(!isset($_SESSION['teacher_id']) ||  $_SESSION['teacher_id'] != true)
    {
        header("location: Login.php");
        exit;
    }

    include 'connection.php';


    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        if(isset($_POST["i1"])){
            $event_name = $_POST["i1"];
        }
        if(isset($_POST["i2"])){
            $description = $_POST["i2"];
        }
        
        
        if(isset($_POST["i4"])){
            $temp_start = $_POST["i4"];
        }
        if(isset($_POST["i5"])){
            $temp_end = $_POST["i5"];
        }
        if(isset($_POST["i6"])){
            $pick_date = $_POST["i6"];
        }
        $teacher_id = $_SESSION["teacher_id"];
        $organizer = $_SESSION["teacher_name"];
        
        
        $sql="SELECT * FROM `main_table` 
              WHERE pick_date = '$pick_date' AND teacher_id = $teacher_id";
        $result = mysqli_query($con,$sql);
        
        $flag = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            $start_time = $row["start_time"];
            $end_time = $row["end_time"];
            if(($temp_start > $start_time && $temp_start < $end_time) || 
                ($temp_end > $start_time && $temp_end < $end_time))
            {
                $flag = 1;
                break;
            }
        }
        if($flag == 1)
        {
            echo "<script> alert(' This time slot has been booked already! ') </script>";
        }
        else{
            $sql = "INSERT INTO main_table VALUES ('$event_name','$description','$organizer','$temp_start','$temp_end','$pick_date','$teacher_id')";
            $result = mysqli_query($con,$sql);
            if($result){
                echo "<script> alert('Record successfully inserted into the database!')</script>";
            }
            else{
                echo mysqli_error($con);
            }
        }

        
    }

    //Logout
    if(isset($_POST['logout'])){
        header("location: logout.php");
    }   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking | Page</title>
    <link rel="stylesheet" href="Css/style.css">
</head>

<body>
    <h1 class="header">Booking Form :</h1>
    <hr class="hr">
    <form action="logout.php" method="post">
        <nav>
            <a href="signup.php" target="_blank">
                <input type="submit" value="Logout" class="logout" name="logout">
            </a>
        </nav>
    </form>
    <form action="#" method="post">
        <div class="box1">
            <div class="name">
                <font id="ename">Event Name :</font>
                <input type="text" id="i1" name="i1" required>
                <font id="desc">Description :</font>
                <input type="text" id="i2" name="i2" required>
                <font id="org">Orginizer  :</font>
                <input type="text" id="i3" name="i3" value="<?php echo $_SESSION["teacher_name"]  ?>" readonly>
                <font id="st">Start time  :</font>
                <input type="time" id="i4" name="i4" required>
                <font id="et">End time   :</font>
                <input type="time" id="i5" name="i5" required>
                <font id="pd">Pick date   :</font>
                <input type="date" id="i6" name="i6" required>
            </div>
            <div class="tc">
                <font id="tnc">By clicking on this, I agree <a href="tnc" target="_blank" id="tac">"terms and conditions"</a></font>
                <input type="checkbox" id="cb" required>
                <input type="submit" value="Submit" id="submit">
            </div>
        </div>
    </form>
    <div class="box2">
        <div class="box3">
            <marquee behavior="scroll" direction="right" class="ue">UPCOMING EVENTS</marquee>
        </div>
    </div>
    <div class="box4">
        
      
            <table border="1">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Organizer</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $temp_date = date("Y/m/d");
                        $date = str_replace("/","-",$temp_date);
                        // echo $date;
                        $sql="SELECT main_table.event_name,main_table.organizer,main_table.start_time,main_table.end_time,teacher_table.phone_no 
                              from main_table,teacher_table
                              where pick_date = '$date' Order by start_time ASC";
                        $result = mysqli_query($con,$sql);
                        
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<tr>
                                    <td class="el">'.$row["event_name"].'</td>
                                    <td class="el">'.$row["start_time"].'</td>
                                    <td class="el">'.$row["end_time"].'</td>
                                    <td class="el">'.$row["organizer"].'</td>
                                    <td class="el">'.$row["phone_no"].'</td>

                                  </tr>';
                        }
                    ?>
                    
                </tbody>
            <table>
            <!-- <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li> -->
        
    </div>
</body>
<script src="js/booknowval.js"></script>
</html>