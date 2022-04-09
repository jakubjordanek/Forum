<?php
    session_start();

    if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
    {
        header('Location: index.php');
        exit();
    }

    require_once('connect.php');
    $connect = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($connect->connect_errno != 0)
    {
        echo 'Error: '.$connect->connect_errno;
    }
    else
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        if ($result = @$connect->query(sprintf("SELECT * FROM users WHERE email='%s'", mysqli_real_escape_string($connect, $email))))
        {
            if ($result->num_rows > 0)
            {
                $record = $result->fetch_assoc();

                if (password_verify($password, $record['password']))
                {
                    $_SESSION['logged'] = true;

                    $_SESSION['id'] = $record['id'];
                    $_SESSION['first_name'] = $record['first_name'];
                    $_SESSION['last_name'] = $record['last_name'];
                    $_SESSION['birthday'] = $record['birthday'];
                    $_SESSION['gender'] = $record['gender'];
                    $_SESSION['image'] = $record['image'];

                    unset($_SESSION['error']);
                    $result->free_result();

                    header('Location: home.php');
                }
                else
                {
                    $_SESSION['error'] = '<span style="color: red; font-size: 11px;">INVALID EMAIL OR PASSWORD</span>';
                    header('Location: index.php');
                }
            }
            else
            {
                $_SESSION['error'] = '<span style="color: red; font-size: 11px;">INVALID EMAIL OR PASSWORD</span>';
                header('Location: index.php');
            }
        }

        $connect->close();
    }
?>