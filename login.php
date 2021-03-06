<?php

    //Get Heroku ClearDB connection information
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['username'], $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usernameQuery = "SELECT username FROM User WHERE username = '$username' ";
        
        // correct username & pass entered
        if(mysqli_num_rows(mysqli_query($conn, $usernameQuery)) > 0){
            setcookie('username', $username, time() + (86400 * 30), "/");
            header("Location: dashboard.php");
        // invalid credentials
        }else{
            setcookie('username', '', time() + (86400 * 30), "/");
            print("<br><br>" . "<h3 style='color:red;'> Incorrect Username/Password </h3>" . "<br>");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Grocery Share | Login</title>
        <link rel="shortcut icon" type="image/png" href="./favicon.png"/>
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&display=swap" rel="stylesheet">
    </head>

    <body style="margin:20px; font-family: 'Kiwi Maru', serif;">

        <!-- NAVBAR powered by bootstrap library -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" style="border: 1px solid #58d68d; border-radius: 4px; padding:4px;" href="#">Grocery Share</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link" href="./index.php">Home </a>
                <a class="nav-item nav-link" href="./about.html">About</a>
                <a class="nav-item nav-link" href="./checklist.html">Checklist</a>
                <a class="nav-item nav-link" href="./description.html">Description</a>
                <a class="nav-item nav-link active" href="#">Login <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>

        
        <div id="veg-header" style="border-radius:5px;">
            <img src="./vegetables-header.jpg" alt="">
        </div>

        <br>
        
        <div style="margin-top: 10px;">
            <h1>Log In</h1>
        </div>

        <div class="card" style="background-color: #58d68d; width=500px; margin:auto; padding:20px; background: #58d68d;">
            <form method="POST">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <br>

        <div class="card" style="background-color: #58d68d; width=500px; margin:auto; padding:20px;">
            <p>If you're new, create an account:</p>
            <a href="./create-acc.php" style="text-align: center;">New Account</a>
        </div>

        
        





        <!-- FOOTER -->
        <nav class="navbar fixed-bottom navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" style="border: 1px solid #58d68d; border-radius: 4px; padding:4px;" href="#">Grocery Share</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./checklist.html">Checklist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./description.html">Description</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Login <span class="sr-only">(current)</span></a>
                </li>
                </ul>
                <span class="navbar-text">I appreciate your visit. -</span>
                <br>
                <span class="navbar-text"><div>- Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div></span>
            </div>
        </nav>


    </body>

    <!-- js for bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>

