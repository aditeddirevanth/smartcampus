
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>

header {
   background-image: linear-gradient(to right, #0acffe 0%, #495aff 100%);
  color: #fff;
  position: relative;
  padding: 15px 0;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between; 
  padding: 0 20px;
}


.logo-title {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  flex-wrap: wrap;
}

.logo-title h1 {
  font-size: 68px;
  font-family: Cambria;
  color: #E3F2FD;
  margin: 0;
  text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
}

.login-icon-logo {
  display: flex;
  flex-direction: column;   
  align-items: center;      
  gap: 0;                 
}

details {
  position: relative;
  display: inline-block;
}

details summary {
  list-style: none;
  cursor: pointer;
  font-size: 50px;
  user-select: none;
  display: flex;
  align-items: center;
  padding: 5px 10px;
  color: #E3F2FD;
  transition: color 0.3s ease, transform 0.3s ease;
}

details summary:hover {
  transform: scale(1.1);
}

details summary::-webkit-details-marker { display: none; }

.dropdown {
  display: flex;
  flex-direction: column;
  background: #ffffff;
  position: absolute;
  top: 100%;
  right: 0;
  width: 170px;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 6px 15px rgba(0,0,0,0.2);
  z-index: 2000;
}

.dropdown a {
  padding: 12px 18px;
  color: #003366;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.3s ease, color 0.3s ease;
  display: flex;
  align-items: center;
}

.dropdown a i {
  margin-right: 8px;
}

.dropdown a:hover {
  background: #0acffe;
  color: #000;
}

@media (max-width: 768px) {

    body {
        padding: 0;
        align-items: flex-start;
    }
    .logo-title h1 {
        font-size: 30px;
    }
    details summary {
        font-size: 30px;
    }
    .dropdown{
        width: 150px;
        font-size:14px;
    }

}

@media (max-width: 480px) {

    body {
        padding: 0;
        align-items: flex-start;
    }
    .logo-title h1 {
        font-size: 20px;
    }
    details summary {
        font-size: 20px;
    }
    .dropdown{
        width: 150px;
        font-size:14px;
    }

}


</style>


<header>
  <div class="header-container">

    <div class="logo-title">
      <h1>Smart Campus Automation System</h1>
    </div>

<div class="login-icon-logo">
  <details>
        <summary><i class="fa-solid fa-bars"></i></summary>
        <div class="dropdown">

            <a href="home.php"><i class="fa-solid fa-house"></i> Home</a>

            <a href="message_history.php"><i class="fa-solid fa-clock-rotate-left"></i> Recent Announcements</a>

            <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');" id="user_login" style="color:#fc0818;">
                 <i class="fa-solid fa-right-from-bracket"></i> Logout</a>

        </div>
      </details>

</div>

</div>
</header>






