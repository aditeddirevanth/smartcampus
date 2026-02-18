<?php
include "db_connect.php";
if (!isset($_COOKIE['role'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>GVP College</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    font-family: Cambria;
    background-image: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
    background-repeat: no-repeat;
    background-attachment: fixed; 
    padding:0;
}

.body{
    display:flex;
    justify-content:space-evenly;
    margin-left:200px;
    margin-right:200px;
}

@media (max-width: 768px) {

    .body {
        display:inline;
        justify-content:none;;

    }
}
    
@media (max-width: 480px) {

    .body {
        display:inline;
        justify-content:none;;
        padding:0;
    }
}


</style>
</head>

<body>

<?php include "header.php"; ?> 
<div class="body">
<?php 
if ($_COOKIE['role'] === 'admin') {
    include "send_message.php";
}
?>
<?php include "faculty_tracking.php"; ?>

    


</div>

</body>
</html>
