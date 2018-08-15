<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" content="text/html" http-equiv="Content-type"/>
        <meta content="Описание" name="description"/>
        <meta content="SEOkeys" name="keywords"/>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <title>
            New DHL
        </title>
        <link href="style.css" rel="stylesheet" type="text/css"/>

    </head>
</html>
<body>
    <div class="body">
        <div align="center" id="logo">
            <span id="logo_slogan">
                New DHL. Новый. Лучше.
            </span>
        </div>
        <div align="center" id="content">
            <div id="topmenu">
                <div class="clear">
                </div>
            </div>
            <div>
                <h1>
                    Войдите
                </h1>
                <p>
                или зарегистрируйтесь . Для восстановления пароля обратитесь к администратору.
                </p>
            </div>
            <div align="center" id="form_container">
                <form action="auth_model.php" id="form" method="post" >
                    <table>
                        <tr>
                            <td>
                                <label>
                                    Логин
                                </label>
                            </td>
                            <td>
                                <input name="login" type="text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Пароль
                                </label>
                            </td>
                            <td>
                                <input name="pass" type="password"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button name="submit" type="submit">Войти</button>
                                <input name="Refresh" type="reset"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div align="center" id="footer">
        <p>
            © 2018
        </p>
    </div>
</body>
