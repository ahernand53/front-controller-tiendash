<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h2>Hello admin</h2>
        </div>
        <div class="col">
            <a class="btn btn-danger" href="/admin/logout">Cerrar Session</a>
        </div>
    </div>

    <div class="row">

        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">Usuarios</a>
            <a class="btn btn-primary" data-toggle="collapse" href="#admins" role="button" aria-expanded="false" aria-controls="users">Administradores</a>
        </p>
        
    </div>
    
    <div class="row">
        <div class="collapse" id="users">
            <div class="card card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user->id; ?></th>
                            <td><?= $user->name; ?></td>
                            <td><?= $user->lastName; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->phone; ?></td>
                            <td><?= $user->address; ?></td>
                            <td><a class="btn btn-outline-warning" href="/admin/user/edit?<?= $user->id; ?>">&#x0270D</a></td>
                            <td><a class="btn btn-outline-danger" href="/admin/user/delete?<?= $user->id; ?>">&#10060</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="collapse" id="admins">
            <div class="card card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <th scope="row"><?= $admin->id; ?></th>
                            <td><?= $admin->name; ?></td>
                            <td><?= $admin->lastName; ?></td>
                            <td><?= $admin->email; ?></td>
                            <td><?= $admin->rol; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
            crossorigin="anonymous"></script>
</body>
</html>