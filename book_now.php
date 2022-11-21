<?php
session_start();

$fetch_details = false;

if (!isset($_SESSION['teacher_id']) ||  $_SESSION['teacher_id'] != true) {
    header("location: Login.php");
    exit;
}

include 'connection.php';

if (isset($_POST["submit"])) {
    if (isset($_POST["i1"])) {
        $event_name = $_POST["i1"];
    }
    if (isset($_POST["i2"])) {
        $description = $_POST["i2"];
    }
    if (isset($_POST["i4"])) {
        $temp_start = $_POST["i4"];
    }
    if (isset($_POST["i5"])) {
        $temp_end = $_POST["i5"];
    }
    if (isset($_POST["i6"])) {
        $pick_date = $_POST["i6"];
    }

    $teacher_id = $_SESSION["teacher_id"];
    $organizer = $_SESSION["teacher_name"];


    $sql = "SELECT * FROM `main_table` 
            WHERE pick_date = '$pick_date' AND teacher_id = $teacher_id";
    $result = mysqli_query($con, $sql);

    $flag = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $start_time = $row["start_time"];
        $end_time = $row["end_time"];
        if (($temp_start > $start_time && $temp_start < $end_time) ||
            ($temp_end > $start_time && $temp_end < $end_time)
        ) {
            $flag = 1;
            break;
        }
    }
    if ($flag == 1) {
        echo "<script> alert(' This time slot has been booked already! ') </script>";
    } else {
        $sql = "INSERT INTO main_table VALUES ('$event_name','$description','$organizer','$temp_start','$temp_end','$pick_date','$teacher_id')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script> alert('Record successfully inserted into the database!')</script>";
        } else {
            echo mysqli_error($con);
        }
    }
}

// Fetch Details
if (isset($_POST['fetch_details']) && ($_POST['select_date'])) {
    // echo "Fetch button clicked";
    $_SESSION['select_date'] = $_POST['select_date'];
    $_SESSION['fetch_details'] = $_POST['fetch_details'];
}


//Logout
if (isset($_POST['logout'])) {
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
    <link rel="stylesheet" href="Css/book_now.css">


</head>

<body>
    <nav id="nav">
        <h1 class="header">Booking Form :</h1>


        <form action="#" method="post">

            <a href="signup.php" target="_blank">

                <input type="submit" value="Logout" class="logout" name="logout">
            </a>
        </form>
    </nav>
    <hr class="hr">

    <div class="hero-text">

        <p>Check Booked Slot<i class="fa-thin fa-lock"></i></p>
    </div>
    <div class="main">
        <div id="box2">

            <div class="box3">
                <marquee behavior="scroll" direction="right" class="ue">UPCOMING EVENTS</marquee>
            </div>


            <div class="box4">


                <form id="datefetch" action="#" method="post">
                    <label id="pselectdate" for="l_select_date">Select date :</label>
                    <input type="date" id="select_date" name="select_date">

                    <!-- <h1>This is just for testing purpose </h1> -->
                    <input class="logout" type="submit" id="fetch_details" name="fetch_details" value="Fetch Details">
                </form>

                <table style="border:1;" class="table">
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
                        if (isset($_SESSION["fetch_details"])) {
                            // echo "you have clicked fetch button";
                            if (isset($_SESSION['select_date'])) {
                                $date = $_POST["select_date"];

                                $sql = "SELECT DISTINCT main_table.event_name,main_table.organizer,main_table.start_time,main_table.end_time,teacher_table.phone_no
                                      from main_table,teacher_table
                                      where teacher_table.teacher_id = main_table.teacher_id AND pick_date = '$date' Order by start_time ASC";
                                $result = mysqli_query($con, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                            <td class="el">' . $row["event_name"] . '</td>
                                            <td class="el">' . $row["start_time"] . '</td>
                                            <td class="el">' . $row["end_time"] . '</td>
                                            <td class="el">' . $row["organizer"] . '</td>
                                            <td class="el">' . $row["phone_no"] . '</td>

                                        </tr>';
                                }
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                     if (isset($_SESSION["select_date"])) {
                        echo '<script>
                         document.getElementById("select_date").value = "' . $_SESSION["select_date"] . '";
                       </script>';
                     }
                    ?>




            </div>
        </div>


        <div class="box1">
            <div id="bokslot">
                <p id="p1">Book Seminar Hall</p>
                <p id="p2">A seminar is a group meeting led by an expert that focuses on a specific topic or discipline,
                    such as business, job searches or a university field such as literature.
                </p>
            </div>
            <form action="#" method="post" id="bookform">

                <div>
                    <label id="org">Orginizer :</label><input style="width:60%" type="text" id="i3" name="i3"
                        value="<?php echo $_SESSION["teacher_name"] ?>" readonly>
                </div>

                <label id="pd">Pick date :</label>
                <input type="date" id="i6" name="i6" required><br>

                <div id="time">
                    <label id="st">Start time :</label>
                    <input type="time" id="i4" name="i4" required><br>

                    <label id="et">End time :</label>
                    <input type="time" id="i5" name="i5" required><br>
                </div>


                <label id="ename">Event Name :</label>
                <input type="text" id="i1" name="i1" required><br>

                <label id="desc">Description :</label>
                <input type="text" name="paragraph_text" id='i2'></input>


                <div class="tc">
                    <font id="tnc">By clicking on this, I agree <a href="docs/learnmorepage.pdf" target="_blank" id="tac">"terms and
                            conditions"</a></font>
                    <input type="checkbox" id="cb" required>
                </div>
                <div class="subbtn">
                    <input type="submit" value="Book Now" id="submit" class="submit" name="submit">
                </div>

            </form>

        </div>
    </div>


</body>
<script src="js/booknowval.js"></script>

</html>