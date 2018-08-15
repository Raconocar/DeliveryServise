<?php session_start();
require_once "module.php"; //подкл БД
global $pdo;
print_r($_POST);
if ($_POST['submit']) {
    if (!$_POST['login'] == "" && !$_POST['pass'] == "") {

        $login = $_POST['login'];
        $login = htmlspecialchars($login); //превращаем весь html код в        строку
        $login = trim($login); //удаляем пробелы
        $login = stripslashes($login); //удаляем обратный слэш

        $pass = $_POST['pass'];
        $pass = htmlspecialchars($pass);
        $pass = trim($pass);
        $pass = stripslashes($pass);

        $pass = md5($pass); //шифруем пароль
        // $pass = strrev($pass); // для надежности добавим реверс

        //проверяем, на существование такого же логина в бд
        $id = auth($login, $pass);
        //елси пользун есть...
        if (is_numeric($id)) {
            $_SESSION['user'] = $login; //создаем сессию
            header("Location: list_couriers.php"); //отправляем назад
        } else {
            header("Location: auth_error.html");
        }

    } else {
        header("Location: index.html");
    }
} else {
    header("Location: index.html");
}
