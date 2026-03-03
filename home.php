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
    margin:0;
    padding:0;
}

/* Desktop Layout */
.body{
    display:flex;
    justify-content:space-evenly;
    align-items:flex-start;
    margin: 0 auto;
    max-width: 1200px;
    padding:20px;
    gap:20px;
}


@media (max-width: 992px) {
    .body {
        flex-wrap: wrap;
        justify-content:center;
    }
}

@media (max-width: 768px) {
    .body {
        flex-direction: column;
        align-items:center;
        padding:15px;
    }
}

/* Small Phones */
@media (max-width: 480px) {
    .body {
        padding:10px;
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
