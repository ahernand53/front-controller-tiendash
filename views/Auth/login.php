<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
          crossorigin="anonymous">
    <title>Tiendash</title>
</head>
<body>
<div class="login_container">
    <div class="login_top">
        <a href="/">
            <img class="login_img" src="../images/logo.png">
        </a>
    </div>
    <form class="login_form" method="post" action="/auth">
        <?php if(isset($_GET['message'])): ?>
            <p class="alert alert-danger" role="alert">
                <?= $_GET['message']; ?>
            </p>
        <?php endif; ?>
        <input type="text" name="email" placeholder="&#128100; username@example.com" required autofocus>
        <input type="password" name="password" placeholder="&#X1F512; password" required >
        <input class="btn_submit" type="submit" value="Entrar">
        <a class="form_recover" href="">Olvido su contraseña?</a>
        <p>O</p>
        <a class="form_register" href="/register">Crea una cuenta</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>
</body>
</html>

