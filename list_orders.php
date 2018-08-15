<?php
require_once 'module.php';
// session_start();
isAuth();
?>


<!DOCTYPE html>
<html>
    <meta charset="utf-8">
        <title>
            New DHL
        </title>
        <link href="css/main.css" rel="stylesheet" type="text/css">
        </link>
    </meta>
<body>
    <div class="body">
        <div align="center" id="logo">
            <span id="logo_slogan">
                New DHL. Новый. Лучше.
            </span>
        </div>
        <div align="center" id="content">
            <div id="topmenu">
                <ul>
                    <li>
                        <a href="list_couriers.php">
                            Курьеры
                        </a>
                    </li>
                    <li>
                        <a href="list_orders.php">
                            Заказы
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <?php echo "Завершить сессию " . $_SESSION['user']; ?>
                        </a>
                    </li>
                </ul>
                <div class="clear">
                </div>
        </div>

        <hr/>
        <div class="content">
            <H2>Самый свободный курьер:</H2><br>;
            <?php
echo getFreeCourier();
?>

            <div class="get_field">
            <?php
echo "<hr/>";
getOrders();
?>
        </div>
        <h2>Добавление заказа</h2>

            <div class="add_form">
                <form id="order_add_form" action="add_order.php" method="post" name="add_order">
                    <table class="content-table">
                    <td>
                    <table>
                    <tr>
                        <td>
                            <label>Курьер</label>
                        </td>
                        <td>
                           <select type="text" name="courier">
                                <?php

foreach (getListEnumsCourier() as $value) {
    echo "<option>$value</option>";
}
?>

                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Дата обращения</label>
                        </td>
                        <td>
                            <input type="date" name="date" placeholder="21.12.1999" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Дата завершения доставки</label>
                        </td>
                        <td>
                            <input type="date" name="duedate" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Стоимость доставки</label>
                        </td>
                        <td>
                            <input type="text" name="cost"/>
                        </td>
                    </tr>
                    </table>
                    </td>
                    <td>
                    <table>
                    <tr>
                        <td>
                            <label>Адрес</label>
                        </td>
                        <td>
                            <input type="text" name="adress"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Статус доставки</label>
                        </td>
                        <td>
                            <select type="text" name="status">
                                <?php

foreach (getListEnumsStatus() as $value) {
    echo "<option>$value</option>";
}
?>

                            </select>
                            <!-- <input /> -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Описание</label>
                        </td>
                        <td>
                            <input type="text" name="label"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Заказчик</label>
                        </td>
                        <td>
                            <input type="text" name="owner"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit">Добавить</button>
                            <!-- <input  name="submit" /> -->
                        </td>
                    </tr>
                    </table>
                    </td>
                    </table>
                </form>
            </div>
    </div>
        </div>


        <div align="center" id="footer">
            ©
        </div>
    </div>
</body>
</html>
