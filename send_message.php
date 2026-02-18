<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['classroom']) && !empty($_POST['message'])) {

        $classrooms = $_POST['classroom']; 
        $message = trim($_POST['message']);

        $stmt = $conn->prepare(
            "INSERT INTO announcements (classroom, message) VALUES (?, ?)"
        );

        foreach ($classrooms as $classroom) {
            $classroom = trim($classroom);
            $stmt->bind_param("ss", $classroom, $message);
            $stmt->execute();
        }

        $stmt->close();

  }       
}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>


.cls2{
    border:none;
    width:450px;
    margin:40px auto;
    border-radius:5px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.4);
    padding:15px;
    text-align:center;
    background:white;
}

.p2{
    font-weight:bold;
    margin-bottom:15px;
    margin-top:5px;
    font-size:30px;
    padding:5px;
    transition:0.3s;
    list-style: none;
}

input{
    width:90%;
    padding:8px;
    margin-bottom:25px;
    font-size:16px;
    background-color:skyblue;
    border:none;
margin-left:0;
}

.textarea1{
    width:86%;
    padding:8px;
    margin-bottom:15px;
    font-size:16px;
}


.send_btn{
    width:90%;
    padding:8px;
    font-size:16px;
    background:#64B5F6;
    border:none;
    color:white;
    cursor:pointer;
    border-radius:4px;
}

.send_btn:hover{
    background:#42a5f5;
}

.result_box{
    width:85%;
    margin-top:20px;
    margin-left:20px;
    padding:12px;
    border-radius:4px;
    background:#f1f8ff;
    text-align:left;
    font-size:16px;
}
.p3{
    color:purple;
    font-size:22px;
    margin-left:15px;
    text-align:left;
}
.classroom-grid{
    display:grid;
    grid-template-columns: repeat(1, 1fr);
    gap:12px;
    margin:15px 0;
}

.classroom-card{
    width:90%;
    margin-left:15px;
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    border-radius:8px;
    border:1px solid #e0e0e0;
    cursor:pointer;
    transition:0.3s;
    font-size:16px;
    background:#f9fbff;
}

.classroom-card:hover{
    border-color:#64B5F6;
    background:#eef6ff;
}

.classroom-card input{
    width:auto;
    margin:0;
    transform:scale(1.2);
    cursor:pointer;
}


.classroom-card input:checked + span{
    font-weight:600;
}

.classroom-card.checked{
    border-color:#42a5f5;
    background:#e3f2fd;
}

    /* =======================
   MOBILE RESPONSIVE FIX
   ======================= */
@media (max-width: 768px){

    .cls2{
        width:90%;
        margin:20px auto;
        padding:12px;
    }

    .p2{
        font-size:24px;
        text-align:center;
    }

    .p3{
        font-size:18px;
        margin-left:10px;
    }

    input{
        width:95%;
        font-size:15px;
    }

    .textarea1{
        width:95%;
        font-size:15px;
    }

    .send_btn{
        width:95%;
        font-size:15px;
        padding:10px;
    }

    .classroom-grid{
        grid-template-columns:1fr;
        gap:10px;
    }

    .classroom-card{
        width:90%;
        margin-left:10px;
        font-size:15px;
        padding:10px;
    }

    .classroom-card input{
        transform:scale(1.3);
    }
}

/* EXTRA SMALL DEVICES */
@media (max-width: 480px){
    .cls2{
        width:90%;
        margin:20px auto;
        padding:12px;
    }
    .p2{
        font-size:20px;
    }

    .p3{
        font-size:16px;
    }

    .classroom-card{
        font-size:14px;
        width:90%;
    }
    .textarea1{
        font-size:13px;
        width:90%;
    }

}

</style>



<div class="cls2">
       
      <p class="p2"><i class="fa-solid fa-bell"></i> Broadcast Announcement</p>

      <p class="p3">Message</p>
  <form method="post" action=" ">
      <textarea class="textarea1" name="message" placeholder="Enter your announcement message here.." required></textarea><br>

  <p class="p3">Target Classrooms</p>

<div class="classroom-grid">

    <label class="classroom-card">
        <input type="checkbox" name="classroom[]" value="BCA 1st year">
        <span>BCA 1st year</span>
    </label>

    <label class="classroom-card">
        <input type="checkbox" name="classroom[]" value="BCA 2nd year">
        <span>BCA 2nd year</span>
    </label>

    <label class="classroom-card">
        <input type="checkbox" name="classroom[]" value="BCA 3rd year">
        <span>BCA 3rd year</span>
    </label>

    <label class="classroom-card">
        <input type="checkbox" name="classroom[]" value="MCA 1st year">
        <span>MCA 1st year</span>
    </label>

    <label class="classroom-card">
        <input type="checkbox" name="classroom[]" value="MCA 2nd year">
        <span>MCA 2nd year</span>
    </label>

</div>              

                <button type="submit" class="send_btn"><i class="fa-solid fa-paper-plane"></i> Send</button>
            </form>
                         
    </div>



