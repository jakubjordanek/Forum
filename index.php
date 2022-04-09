<?php
    session_start();

    if (isset($_SESSION['logged']))
    {
        header('Location: home.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>FORUM</title>

        <meta name="author" content="Jakub Jordanek">
		<meta name="description" content="">
		<meta name="keywords" content="">

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/default.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="login-header">
            <a href="index.php" class="link-header">FORUM</a>
        </div>

        <div id="login-panel">
            <h3>LOG IN</h3>

            <form method="POST" action="login.php">
                <input type="text" placeholder="EMAIL" name="email">
                <input type="password" placeholder="PASSWORD" name="password">

                <?php
                    if (isset($_SESSION['error']))
                    {
                        echo $_SESSION['error'];
                    }
                ?>

                <input type="submit" value="LOG IN">
                <a href="#" class="link-white">...OR CREATE A NEW ACCOUNT!</a>
            </form>
        </div>

        <div id="footer">
            2022 &copy; FORUM
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>