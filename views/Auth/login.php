<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <title>Tiendash</title>
</head>
<body>
<div class="login_container">
    <div class="login_top">
        <img class="login_img" src="./images/logo.png">
    </div>
    <?php if(isset($message)): ?>
        <div class="alert alert-primary" role="alert">
            <?= $message; ?>
        </div>
    <?php endif; ?>
    <form class="login_form">
        <input type="text" placeholder="&#128100; username@example.com" required autofocus>
        <input type="password" placeholder="&#X1F512; password" required >
        <input class="btn_submit" type="submit" value="Entrar">
        <a class="form_recover" href="">Olvido su contraseña?</a>
        <p>0</p>
        <a class="form_register" href="/signUp">Crea una cuenta</a>
    </form>
</div>
</body>
</html>
