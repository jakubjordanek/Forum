<?php
    session_start();

    if (!isset($_SESSION['logged']))
    {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');
    mysqli_report(MYSQLI_REPORT_STRICT);
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
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/default.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="nav">
            <div id="logo">
                <a href="home.php" class="link-header">    
                    FORUM
                </a>
            </div>

            <div id="menu">
                <?php
                    echo '<a href="profile.php?id='.$_SESSION['id'].'" class="link-nav"><img src="img/'.$_SESSION['image'].'"></img></a>';
                ?>

                <a href="logout.php" class="link-nav">
                    <i class="icon-off"></i>
                </a>
            </div>

            <div style="clear: both;"></div>
        </div>

        <div id="content">
            <?php
                try
                {
                    $connect = new mysqli($host, $db_user, $db_password, $db_name);
                    if ($connect->connect_errno != 0)
                    {
                        throw new Exception(mysqli_connect_errno());
                    }
                    else
                    {
                        $query = $connect->query("SELECT * FROM users where id='".(int)$_GET['id']."'");
                        $record = $query->fetch_array();
                        echo '
                            <div id="profile-image">
                                <img src="img/'.$record['image'].'" width="100%">
                            </div>
                            
                            <div id="profile-content">
                                <h2>'.$record['first_name'].' '.$record['last_name'].'</h2>
                                <p><i class="icon-calendar"></i> '.date("d.m.Y", strtotime($record['birthday'])).'</p>
                                <p><i class="icon-user"></i> '.$record['gender'].'</p>';
                        echo '    
                            </div>
                            
                            <div style="clear: both;">
                        ';

                        $query2 = $connect->query("SELECT * FROM posts JOIN users ON users.id=posts.user_id WHERE posts.user_id=".$record['id']." ORDER BY posts.id DESC");
                        while ($record2 = mysqli_fetch_array($query2))
                        {
                            echo '
                                <div class="post">
                                    <a href="profile.php?id='.$record2['id'].'" class="link-white">
                                        <img src="img/'.$record2['image'].'" width="32"><b>'.$record2['first_name'].' '.$record2['last_name'].'</b>
                                    </a> 
                                    
                                    &bull; '.date("d F Y", strtotime($record2['date'])).'
                                    <span>'.$record2['content'].'</span>
                                </div>
                            ';
                        }
                    }
                }
                catch (Exception $e)
                {
                    echo $e;
                }
            ?>
        </div>

        <div id="footer">
            2021 &copy; FORUM
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>