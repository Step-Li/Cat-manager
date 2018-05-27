<?php
    session_start();

    if($_POST['Submit']){
        require_once 'admin/connection.php'; 
        $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link)); 

        $query ="SELECT * FROM users WHERE login='" . $_POST['login'] . "'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        $res = mysqli_fetch_row($result) or die("Ошибка " . mysqli_error($link));

        if(($_POST['login']==$res[0])&&($_POST['password']==$res[1])){
            $_SESSION['logged_user'] = $_POST['login'];
            $_SESSION['users_dir'] = $res[2];
            mysqli_free_result($result);
            mysqli_close($link);
            header("Location: manager.php");
            exit;
        }
    }
?>
<html><body>
    Вы ввели неверный пароль!
</body></html>