<?php
require_once 'module.php';
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
                        <li>

                        </li>
                    </li>
                </ul>
                <div class="clear">
                </div>
            </div>

        <hr/>
        <div class="content">
            <div class="get_field">
            <?php
echo "<hr/>";
getCouriers();
?>
      </div>

        <h2>Правка курьера</h2>
        <div class="add_form">
                <form id="edit_courier_form" action="edit_courier.php" name="edit_courier" method="post">
                    <table>
                    <tr><td></td><td colspan="7"><label>График работы</label></td></tr>
                    <tr><td>
                        <table>
                            <tr><td colspan="2"><label>   </label></td></tr>
                            <tr><td><label>Id изменяемого курьера</label></td>
                            <td><input type="text" name="id"></td></tr>
                            <tr><td><label>ФИО</label></td>
                            <td><input type="text" name="name"></td>
                            <tr><td><label>Телефон</label></td>
                            <td><input type="telephone" name="telephone"></td>
                            <tr><td><label>Email</label></td>
                            <td><input type="email" name="email"></td></tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr><td colspan="2"><label>Пн</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="monday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="monday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Вт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="tuesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="tuesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Ср</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="wednesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="wednesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Чт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="thuesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="thuesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Пт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="friday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="friday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Сб</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="saturday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="saturday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Вс</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="sunday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="sunday_stop"></td></tr>
                        </table>
                    </td></tr>

                    </table>
                    <input class="add_button" type="submit" name="" value="Сохранить">
                </form>
            </div>
            <h2>Добавление курьера</h2>
           <div class="add_form">
                <form id="add_courier_form" action="add_courier.php" name="add_courier" method="post">
                    <table>
                    <tr><td></td><td colspan="7"><label>График работы</label></td></tr>
                    <tr>
                     <td>
                        <table>
                            <tr><td colspan="2"><label>   </label></td></tr>
                            <tr><td><label>ФИО</label></td>
                            <td><input type="text" name="name"></td></tr>
                            <tr><td><label>Телефон</label></td>
                            <td><input type="telephone" name="telephone"></td></tr>
                            <tr><td><label>Email</label></td>
                            <td><input type="email" name="email"></td></tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr><td colspan="2"><label>Пн</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="monday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="monday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Вт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="tuesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="tuesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Ср</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="wednesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="wednesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Чт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="thuesday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="thuesday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Пт</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="friday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="friday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Сб</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="saturday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="saturday_stop"></td></tr>
                        </table>
                    </td>

                    <td>
                        <table>
                            <tr><td colspan="2"><label>Вс</label></td></tr>
                            <tr><td><label>Нач</label></td>
                            <td><input type="text" name="sunday_start"></td>
                            <tr><td><label>Конец</label></td>
                            <td><input type="text" name="sunday_stop"></td></tr>
                        </table>
                    </td></tr>

                    </table>
                    <input class="add_button" type="submit" name="" value="Добавить">
                </form>
            </div>
                    </div></div>
        <div align="center" id="footer">
            ©
        </div>
    </div>
</body>
</html>
