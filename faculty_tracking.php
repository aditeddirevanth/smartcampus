<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



<?php
include "db_connect.php";

$query = "
SELECT 
    f.username,
    f.beacon_uuid,
    t.esp_id,
    t.rssi,
    t.last_seen
FROM faculty_login f
LEFT JOIN faculty_tracking t 
ON f.id = t.faculty_id
AND t.last_seen = (
    SELECT MAX(last_seen)
    FROM faculty_tracking
    WHERE faculty_id = f.id
)
ORDER BY f.username
";

$result = mysqli_query($conn, $query);
?>



<style>

.cls1{
    width:440px;
    border:none;
    margin:40px auto;
    border-radius:5px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.4);
    padding:20px;
    text-align:center;
    background:white;
}

.p1{
    font-weight:bold;
    margin-bottom:20px;
    margin-top:5px;
    font-size:30px;
    padding:5px;
    transition:0.3s;
    list-style: none;
    font-family:Cambria;
}


.faculty_card{
    background:#ffffff;
    border-radius:14px;
    padding:20px;
    border:1px solid #e6e8ee;
    width:340px;
    margin-bottom:20px;
    margin-left:25px;
}

.faculty_header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.faculty_name{
    font-size:24px;
    font-weight:700;
    margin:0;
    width:50%;
    font-family:Cambria;
    text-align:left;
}

.status_badge{
    padding:4px 10px;
    font-size:14px;
    border-radius:20px;
    font-weight:600;
}

.status_active{
    background:#7c4dff;
    color:white;
}

.status_idle{
    background:#e0e0e0;
    color:#555;
}

.ble_row{
    display:flex;
    align-items:center;
    justify-content:flex-end;   
    gap:10px;
    flex-wrap:wrap;
    margin-right:5px;
    width:50%;
}

.ble_id{
    background:#f1f3f7;
    padding:1px 8px;
    border-radius:20px;
    font-size:11px;
    font-weight:600;
    border:1px solid #e0e0e0;
}

.rssi{
    font-size:14px;
    color:#555;
}

.faculty_details{
    margin-top:14px;
    margin-left:10px;
    display:flex;
    flex-direction:column;
    gap:6px;
    color:#666;
    font-size:15px;
    font-family:Calibri;
    text-align:left;
}

.weak_cls{
    color:red;
    font-size:14px;
}

.strong_cls{
    color:#4caf50;
    font-size:16px;
}

    /* =========================
   MOBILE RESPONSIVE FIX
   ========================= */
@media (max-width: 768px){

    .cls1{
        width:95%;
        margin:20px auto;
        padding:15px;
    }

    .p1{
        font-size:24px;
    }

    .faculty_card{
        width:92%;
        margin-left:auto;
        margin-right:auto;
        padding:15px;
    }

    .faculty_name{
        font-size:20px;
        width:55%;
    }

    .ble_row{
        width:45%;
        justify-content:flex-end;
        gap:8px;
    }

    .status_badge{
        font-size:12px;
        padding:3px 8px;
    }

    .rssi{
        font-size:13px;
    }

    .ble_id{
        font-size:10px;
    }

    .faculty_details{
        font-size:14px;
        margin-left:5px;
    }
}

/* EXTRA SMALL DEVICES */
@media (max-width: 480px){

    .cls1{
        width:90%;
        margin:10px auto;
        padding:15px;
    }

    .p1{
        font-size:20px;
    }

    .faculty_card{
        padding:12px;
    }

    /* KEEP HEADER SIDE BY SIDE */
    .faculty_header{
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .faculty_name{
        font-size:18px;
        width:50%;
    }

    .ble_row{
        width:50%;
        justify-content:flex-end;
        gap:6px;
    }

    .rssi{
        font-size:12px;
    }

    .ble_id{
        font-size:9px;
    }

    .faculty_details{
        font-size:13px;
    }

    .weak_cls,
    .strong_cls{
        font-size:12px;
    }
}


</style>
<div class="cls1">
 
<p class="p1"><i class="fa-solid fa-location-dot" style="color:green;"></i> Faculty Live Tracking</p>

<?php while ($row = mysqli_fetch_assoc($result)): ?>

    <?php
    $status = "Idle";
    $signal= "● Weak Signal";
    $signal_class= "weak_cls";
    $status_class = "status_idle";

    if (!empty($row['last_seen'])) {
        $diff = time() - strtotime($row['last_seen']);
        if ($diff <= 30) { 
            $status = "Active";
            $signal = "● Excellent Signal";
            $status_class = "status_active";
            $signal_class = "strong_cls";
        }
    }
    ?>

<div class="faculty_card">

<div class="faculty_header">

    <div class="faculty_name">
        <?php echo htmlspecialchars($row['username']); ?>
    </div>

    <div class="ble_row">
        <div class="status_badge <?php echo $status_class; ?>">
                    <?php echo $status; ?>
        </div>

        <div class="rssi">
            <i class="fa-solid fa-signal signal-animate"></i> RSSI: <?php echo $row['rssi'] ?? '--'; ?> dBm
        </div>

        <div class="ble_id">
            BLE-<?php echo $row['beacon_uuid'] ?? 'NA'; ?>
        </div>
    </div>

</div>

    <div class="faculty_details">
        <div><i class="fa-solid fa-location-dot"></i> Location: <?php echo $row['esp_id'] ?? 'Unknown'; ?></div>

        <div>
            <i class="fa-regular fa-clock"></i> Last seen: <?php echo $row['last_seen'] ?? '—'; ?>
        </div>

        <div class="status_badge <?php echo $signal_class; ?>">
            <?php echo $signal; ?>
        </div>

     </div>

</div>

<?php endwhile; ?>

</div>

