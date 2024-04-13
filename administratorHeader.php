<title>TeknoEvents - Admin</title>
<link rel="icon" type="image/x-icon" href="images/TeknoLogo4.png">
<link rel="stylesheet" type="text/css" href="css/teknoStyles.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>

<style>
    body{
        /* background-image: url('images/background/metroevent2.png'); */
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-position: center;
        background-attachment: fixed;
        color:black;
    }

    .nav a{
        color: black;
        text-decoration: none;
        background-color: white;
        border-radius: 5px
        
    }

    .nav a:hover{
        color: white;
        background-color: rgb(54, 79, 82);
        transition: 0.1s ease-in;
    }
    hr{
        margin:0;
    }
</style>

<div class="header-container">
    <div class="nav-container">
        <div class="row" style="display: flex; justify-content: center; align-items: center;">
            <img src="images/TeknoLogo3.png", height = 40 width = 200/>
        </div>
        <span class="nav">
            <a href="administratorDashboard.php" class="nav-link" >
                Events
            </a>
        </span>

        <span class="nav">
            <a href="eventsCreator.php" class="nav-link" >
                Create Events
            </a>
        </span>

        <span class="nav">
            <a href="notification.php" class="nav-link" >
                Notification
            </a>
        </span>

        <span class="nav">
            <a href="administratorLogin.php">
                Log Out
            </a>
        </span>
    </div>
</div>
