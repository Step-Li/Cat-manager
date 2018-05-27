<?php
require_once 'admin/connection.php'; // подключаем скрипт
 
if(isset($_POST['login']) && isset($_POST['password'])){

    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
    
    $login = htmlentities(mysqli_real_escape_string($link, $_POST['login']));
    $password = htmlentities(mysqli_real_escape_string($link, $_POST['password']));

    $query = "SELECT * FROM Users WHERE login='$login'";

    if(mysqli_num_rows(mysqli_query($link, $query))) {
        echo 'Такой пользователь уже существует';
    } else {
        $query ="INSERT INTO Users VALUES('$login', '$password','./users/$login')";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
        if($result){
            $path ='users/' . $_POST['login'];
            mkdir($path, 0755, true);
            require_once('copy-folder.php');
            copy_folder('Examples', $path);
        }
        mysqli_close($link);
        @header("Location: ". "index.php");
    }
     
    
}
?>
    <h2>Добавить нового пользователя</h2>
    <form method="POST">
        <p>Введите login:
            <br>
            <input type="text" name="login" />
        </p>
        <p>Введите пароль:
            <br>
            <input type="password" name="password" />
        </p>
        <input type="submit" value="Добавить">
    </form>
    </body>

    </html>