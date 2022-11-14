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
    <div class="box1">
        <div class="name">
            <font id="ename">Event Name :</font>
            <input type="text" id="i1" required>
            <font id="desc">Description :</font>
            <input type="text" id="i2" required>
            <font id="org">Orginizer  :</font>
            <input type="text" id="i3" required>
            <font id="st">Start time  :</font>
            <input type="time" id="i4" required>
            <font id="et">End time   :</font>
            <input type="time" id="i5" required>
            <font id="pd">Pick date   :</font>
            <input type="date" id="i6" required>
        </div>
        <div class="tc">
            <font id="tnc">By clicking on this, I agree <a href="tnc" target="_blank" id="tac">"terms and conditions"</a></font>
            <input type="checkbox" id="cb" required>
            <input type="button" value="Submit" id="submit">
        </div>
    </div>
    <div class="box2">
        <div class="box3">
            <marquee behavior="scroll" direction="right" class="ue">UPCOMING EVENTS</marquee>
        </div>
    </div>
    <div class="box4">
        <ul>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
            <li class="el">EVENT NAME (DATE)</li>
        </ul>
    </div>
</body>
<script src="js/booknowval.js"></script>
</html>