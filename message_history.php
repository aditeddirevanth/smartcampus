<?php
include "db_connect.php";

if (!isset($_COOKIE['role'])) {
    header("Location: login.php");
    exit;
}

$query = " SELECT id,classroom,message,created_at from announcements; ";

$result = mysqli_query($conn, $query);
?>


<html>
<head>
    
<title>Recent Announcements</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

.cls3{
    width:440px;
    border:none;
    margin:40px auto;
    border-radius:5px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.4);
    padding:20px;
    text-align:center;
    background:white;
}

.p3{
    font-weight:bold;
    margin-bottom:20px;
    margin-top:5px;
    font-size:30px;
    padding:5px;
    transition:0.3s;
    list-style: none;
    font-family:Cambria;
}


.message_card{
    background:#ffffff;
    border-radius:14px;
    padding:20px;
    border:1px solid #e6e8ee;
    width:340px;
    margin-bottom:20px;
    margin-left:25px;
}

.message_name{
    font-size:18px;
    font-weight:700;
    margin:0;
    font-family:Calibri;
    text-align:left;
    margin-bottom:15px;
}

.classroom{            
    background:#f1f3f7;
    padding:4px 12px;              
    border-radius:999px;            
    font-size:13px;
    font-weight:bold;
    
    margin-bottom:15px;
    width: fit-content;            
    max-width: 100%;
    font-family:calibri;
    text-align:left;
}
.inform{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.last_seen{
    text-align:left;
    margin-left:5px;
}

.status{
    border:1px solid green;
    color:white;
    font-weight:700;
    background:green;
    padding:2px 6px;
    border-radius:20px;
    align-items:center;
    font-size:13px;
}

/* =========================
   MOBILE RESPONSIVE FIX
   ========================= */
@media (max-width: 768px){

    .cls3{
        width:95%;
        margin:20px auto;
        padding:15px;
    }

    .p3{
        font-size:24px;
    }

    .message_card{
        width:92%;
        margin-left:auto;
        margin-right:auto;
        padding:15px;
    }

    .message_name{
        font-size:16px;
    }

    .classroom{
        font-size:12px;
        padding:4px 10px;
    }

    .inform{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
}


    .last_seen{
        font-size:14px;
        margin-left:0;
    }

    .status{
        font-size:12px;
        padding:3px 8px;
    }
}

/* EXTRA SMALL DEVICES */
@media (max-width: 480px){

    .cls3{
        width:90%;
        margin:10px auto;
        padding:15px;
    }

    .p3{
        font-size:20px;
    }

    .message_name{
        font-size:15px;
    }

    .message_card{
        padding:12px;
    }

    .last_seen{
        font-size:13px;
    }

    .status{
        font-size:11px;
        padding:4px 10px;
    }

    /* FORCE ONE-BY-ONE (VERTICAL) */
    .inform{
        justify-content:space-between;
    }
}


</style>
</head>
<body>
<?php include "header.php"; ?>

<div class="cls3">
 
<p class="p3"><i class="fa-regular fa-clock" style="color:blue;"></i> Recent Announcements</p>

<?php while ($row = mysqli_fetch_assoc($result)): ?>


<div class="message_card">

    <div class="message_name"><i class="fa-solid fa-circle-check" style="color:white;border-radius:50%; border:3px solid green;background:green;"></i>

        <?php echo htmlspecialchars($row['message']); ?>
    </div>

    <div class="classroom">
        <?php echo $row['classroom']; ?>
    </div>
<div class="inform">
    <div class="last_seen">
        <i class="fa-regular fa-clock"></i> <b>Time:</b> <?php echo $row['created_at'] ?? '—'; ?>
    </div>

    <div class="status">Delivered</div>

</div>
    


</div>

<?php endwhile; ?>

</div>
</body>
</html>

