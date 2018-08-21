<?php
session_start();
$host    = '127.0.0.1';
$db      = 'newdhl';
$user    = 'root';
$pass    = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
// $stmt = $pdo->query('SELECT * FROM orders');
function auth($login1, $password1)
{
    global $pdo;
    $login = $login1;
    $pass  = $password1;
    $query = 'SELECT `id` FROM `operators` WHERE login = ' . "'" . $login . "' && passwd = '" . $pass . "'";
    echo $query . "<br/>";
    $id2 = $pdo->query($query);
    print_r($id2);
    echo "<br/>Дальше идёт вывод обьекта<br/>";
    $id = $id2->fetch();
    print_r($id);
    echo $id;
    return $id["id"];
}
function isAuth()
{
    if (!isset($_SESSION['user'])) {
        header("Location: auth_error.html");
        exit;
    }
}
function logout()
{

    session_destroy();

    header("Location: index.html");
}
function addCourier($array)
{
    global $pdo;
    foreach ($array as $key => $value) {
        $allowed[] = $key;
        $values[]  = $value;
    }
    $query = "INSERT INTO `couriers` SET " . pdoSet($allowed, $values);
    $stm   = $pdo->prepare($query);
    $stm->execute($values);

    header("Location: list_couriers.php");
}
function addOrder($array)
{
    global $pdo;
    foreach ($array as $key => $value) {
        $allowed[] = $key;
        $values[]  = $value;
    }
    $query = "INSERT INTO `orders` SET " . pdoSet($allowed, $values);
    $stm   = $pdo->prepare($query);
    $stm->execute($values);

    header("Location: list_orders.php");
}
function pdoSet($allowed, $values, $source = array())
{
    $set    = '';
    $values = array();
    if (!$source) {
        $source = $_POST;
    }

    foreach ($allowed as $field) {
        if (isset($source[$field])) {
            $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
            $values[$field] = $source[$field];
        }
    }
    return substr($set, 0, -2);
}
function getListEnumsCourier()
{
    global $pdo;

    $type   = $pdo->query("SELECT name FROM `couriers`");
    $type1  = $type->fetchAll();
    $arrout = array();
    foreach ($type1 as $subArr) {
        foreach ($subArr as $key => $value) {

            $arrout[] = $value;
        }
    }
    return $arrout;
}
function getListEnumsStatus()
{
    global $pdo;

    $type  = $pdo->query("SHOW COLUMNS FROM `orders` WHERE Field = 'status'");
    $type1 = $type->fetch();
    $type  = $type1['Type'];
    $type  = substr($type, 0, -2);
    $type  = substr($type, 6);
    $enum  = explode("','", $type);
    return $enum;
}
function toSecondsFull($value)
{
    // $value = "2018-08-06 19:30:21";
    // int mktime(int hour, int minute, int second, int month, int day, int year);
    $value      = split(" ", $value);
    $date       = split("-", $value[0]);
    $timeInDate = split(":", $value[1]);
    $value      = array_merge($date, $timeInDate);
    // 2018, 08, 06,19, 30, 21
    // 0     1   2  3   4   5
    $seconds = mktime($value[3], $value[4], $value[5], $value[1], $value[2], $value[0]);

    return $seconds;
}
function toSeconds($value)
{
    $arr  = split(':', $value);
    $time = $arr[0] * 60 * 60 + $arr[1] * 60;
    return $time;
}

function getFreeCourier()
{

    global $pdo;

    $type       = $pdo->query("SELECT `name`,`monday_start`,`monday_stop`,`tuesday_start`,`tuesday_stop`,`wednesday_start`,`wednesday_stop`,`thuesday_start`,`thuesday_stop`,`friday_start`,`friday_stop`,`saturday_start`,`saturday_stop`,`sunday_start`,`sunday_stop`,`date`,`duedate` FROM `couriers`LEFT OUTER JOIN `orders` ON `couriers`.`name`=`orders`.`courier`");
    $type1      = $type->fetchAll();
    $arrout     = array();
    $arroutMain = array();
    ini_set('display_errors', 'Off');
    error_reporting('E_ALL');

    foreach ($type1 as $subArr) {
        // print_r($subArr);
        // echo "<br/>";

        foreach ($subArr as $key => $value) {
            // echo "<br/>1<br/>";
            // echo toSeconds($value);
            // echo "<br/>2<br/>";
            // echo toSecondsFull($value);
            switch ($key) {
                case 'name':
                    $arrout['name'] = $subArr['name'];
                    break;
                case 'duedate':
                    $arrout['tasktime'] += toSecondsFull($value);
                    break;
                case '$date':
                    // $arrout['tasktime'] -= toSecondsFull($value);
                    $arrout['tasktime'] -= time();//оставшееся на текущую дату время выполнения задачи

                    break;
                case (preg_match('/_start$/', $key) ? true : false):
                    $arrout['worktime'] -= toSeconds($value);
                    break;
                case (preg_match('/_stop$/', $key) ? true : false):
                    $arrout['worktime'] += toSeconds($value);
                    break;
                default:break;
            }

        }

        // суммарное время доставки
        $arroutMain[] = $arrout;
        unset($arrout);
    }
    $freeTimeArr = array();
    foreach ($arroutMain as $value) {
        //вычитаем из всей рабочей недели время курьера на задачу и время прошедшее с конца недели ( 8-часовой рабочий день).
        //отрицательное значение означает что курьер будет заниматься всю текущую неделю. 
        // Курьер с Наибольшим остатком - самый свободный.
        $freeTimeArr[$value['name']] += $value['worktime'] - $value['tasktime']-(8*60*60*strftime('%w'));
    }
    // print_r($freeTimeArr);
    //находим курьера 

    foreach ($freeTimeArr as $key => $value) {
        if ($value == max($freeTimeArr)) {
            $freeCourier = $key;
        }
    }

    ini_set('display_errors', 'On');

    // $type      = $pdo->query("SELECT `name` FROM `couriers`");
    // $couriers  = $type->fetchAll();
    // $couriers1 = array();

    // foreach ($couriers as $value) {
    //     foreach ($value as $key => $val) {
    //         $couriers1[] = $val;
    //     }
    // }
    // $couriers = $couriers1;
    // // print_r($couriers); // получили массив имён курьеров
    // $setCouriersWithTime = array();
    // foreach ($couriers as $key => $value) {
    //     $setCouriersWithTime[$value] = 0;
    // }
    // echo "<br/>";
    // // print_r($arroutMain);
    // foreach ($arroutMain as $key => $value) {
    //     $setCouriersWithTime[$key] += $value;
    // }
    // echo "<br/>";
    // print_r($setCouriersWithTime);
    // далее ещё один цикл, в котором  затраты по часам заказов  вычитаем из  суммарного рабочего времени.
    // 

    // foreach ($arroutMain as $subArr) {
    //     foreach ($couriers as $subCourier) {
    //         if (!array_key_exists($subArr['name'], $arraySet)) {
    //             $arraySet[$subArr['name']] = $subArr['worktime'] - $subArr['tasktime'];
    //         } else {
    //             $arraySet[$subArr['name']] -= $subArr['tasktime'];

    //         }
    //     }
    // }
    // $arrayRsult[] = array_keys($arraySet, max($arraySet)); //array_keys возвращает массив
    // print time();
    return $freeCourier;

}

function editCourier($array)
{
    global $pdo;
    $id = $array['id'];
    unset($array['id']);

    foreach ($array as $key => $value) {
        if ($value == '') {
            unset($array[$key]);
        }
        $value = "'" . $value . "'";
    }

    print_r($array);
    echo "<br/>";

    foreach ($array as $kay => $vale) {
        $query = "UPDATE `couriers` SET  `" . $kay . "` = :val11 WHERE `id` = :id1";
        echo "$query" . "<br/>";
        $stm = $pdo->prepare($query);
        $stm->execute(array(':val11' => $vale, ':id1' => $id));
        // $pdo->exec($query);`:key`
    }
    header("Location: list_couriers.php");
}
function getCouriers()
{
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM couriers');
    $row  = $stmt->fetch();
    echo "<table>";
    echo "<tr>";
    echo "<tr><td>" .
        'id' . "</td><td>" .
        'name' . "</td><td>" .
        'telephone' . "</td><td>" .
        'email' . "</td><td>" .
        'monday_start' . "</td><td>" .
        'monday_stop' . "</td><td>" .
        'tuesday_start' . "</td><td>" .
        'tuesday_stop' . "</td><td>" .
        'wednesday_start' . "</td><td>" .
        'wednesday_stop' . "</td><td>" .
        'thuesday_start' . "</td><td>" .
        'thuesday_stop' . "</td><td>" .
        'friday_start' . "</td><td>" .
        'friday_stop' . "</td><td>" .
        'saturday_start' . "</td><td>" .
        'saturday_stop' . "</td><td>" .
        'sunday_start' . "</td><td>" .
        'sunday_stop' . "</td></tr>";
    echo "</tr>";
    // print_r($row);
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" .
            $row['id'] . "</td><td>" .
            $row['name'] . "</td><td>" .
            $row['telephone'] . "</td><td>" .
            $row['email'] . "</td><td>" .
            $row['monday_start'] . "</td><td>" .
            $row['monday_stop'] . "</td><td>" .
            $row['tuesday_start'] . "</td><td>" .
            $row['tuesday_stop'] . "</td><td>" .
            $row['wednesday_start'] . "</td><td>" .
            $row['wednesday_stop'] . "</td><td>" .
            $row['thuesday_start'] . "</td><td>" .
            $row['thuesday_stop'] . "</td><td>" .
            $row['friday_start'] . "</td><td>" .
            $row['friday_stop'] . "</td><td>" .
            $row['saturday_start'] . "</td><td>" .
            $row['saturday_stop'] . "</td><td>" .
            $row['sunday_start'] . "</td><td>" .
            $row['sunday_stop'] . "</td></tr>";
    }

    echo "</table>";

}
function getOrders()
{
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM orders ORDER BY `date`');
    echo "<table>";
    echo "<tr >";
    $row = $stmt->fetch();
    foreach ($row as $key => $value) {
        echo "<td style:background:Teal>" . $key . "</td>";
    }
    echo "</tr>";
    while ($row = $stmt->fetch()) {
        echo "<tr><td>" .
            $row['number'] . "</td><td>" .
            $row['courier'] . "</td><td>" .
            $row['date'] . "</td><td>" .
            $row['duedate'] . "</td><td>" .
            $row['cost'] . "</td><td>" .
            $row['adress'] . "</td><td>" .
            $row['status'] . "</td><td>" .
            $row['label'] . "</td><td>" .
            $row['owner'] . "</td></tr>";
    }
    echo "</table>";
}
function setEnumCouriers()
{
    global $pdo;
    $stmt  = $pdo->query('SELECT `name` FROM couriers');
    $row   = $stmt->fetch();
    $query = "ALTER TABLE `orders` ADD `role`
ENUM('guest', 'boutique', 'admin')
DEFAULT 'guest' NOT NULL;";
}
