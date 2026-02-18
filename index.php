<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Premium IoT Loader</title>

<style>
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* ===== BACKGROUND ===== */
.loader-wrap {
    position: fixed;
    inset: 0;
    background: linear-gradient(
        135deg,
        #020024,
        #090979,
        #00d4ff,skyblue
    );
    background-size: 300% 300%;
    animation: gradientMove 10s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    transition: opacity 1s ease, visibility 1s ease;
}

/* ===== GLASS CARD ===== */
.loader-box {
    position: relative;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    backdrop-filter: blur(15px);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 60px rgba(0, 212, 255, 0.35);
    display: flex;
    justify-content: center;
    align-items: center;
    animation: float 3s ease-in-out infinite;
}

/* ===== GLOW RING ===== */
.spinner-ring {
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    border: 4px solid transparent;
    border-top: 4px solid #ffd700;
    border-right: 4px solid #00e5ff;
    animation: spin 1.5s linear infinite;
    filter: drop-shadow(0 0 12px #00e5ff);
}

/* ===== LOGO ===== */
.loader-logo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: pulse 1.8s ease-in-out infinite;
}

.loader-logo img {
    width: 120px;
    border-radius: 50%;
}

/* ===== TEXT ===== */
.loader-text {
    position: absolute;
    bottom: -45px;
    color: #e0f7ff;
    letter-spacing: 2px;
    font-size: 14px;
    width:350px;
    margin-left:35px;
    text-transform: uppercase;
    opacity: 0.85;
}

/* ===== ANIMATIONS ===== */
@keyframes spin {
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0%,100% { transform: scale(1); }
    50% { transform: scale(1.06); }
}

@keyframes float {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== FADE OUT ===== */
.loader-wrap.fade-out {
    opacity: 0;
    visibility: hidden;
}
</style>
</head>

<body>

<div class="loader-wrap" id="loader">
    <div class="loader-box">
        <div class="spinner-ring"></div>

        <div class="loader-logo">
            <img src="logo.jpg" alt="IoT Logo">
        </div>

        <div class="loader-text">Smart Campus Automation System</div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const loader = document.getElementById("loader");

    setTimeout(() => {
        loader.classList.add("fade-out");

        setTimeout(() => {
            window.location.href = "home.php";
        }, 1000);

    }, 3000); //  3 seconds
});
</script>

</body>
</html>
