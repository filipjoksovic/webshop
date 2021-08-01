<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php include("../controllers/MiddlewareController.php"); ?>
</head>

<body>
    <?php include("../components/header.php"); ?>
    <?php include("../controllers/DatabaseController.php"); ?>
    <h1 class="text-center mt-5">Pregled korisnika</h1>

    <?php
    $query = "SELECT * FROM users";
    $result = $database->query($query);
    ?>

    <div class="container mt-5">
        <div class="users-container">
            <?php while ($user = $result->fetch_assoc()) : ?>
                <div class="user">
                    <div class="user-icon">
                        <img src="../resources/icons/user-solid.svg">
                    </div>
                    <div class="user-info">
                        <p class="font-weight-bold"><?php echo $user['first_name'] . " " .  $user['last_name']; ?></p>
                        <p><?php echo $user['username']; ?></p>
                        <p class=>Nalog kreiran: <?php echo $user['created_at']; ?></p>
                    </div>
                    <div class="delete-user">
                        <button class="btn btn-block btn-primary" id="uid-<?php echo $user['user_id'] ?>" data-toggle="modal" data-target="#removeUserModal">Ukloni korisnika</button>
                    </div>
                </div>
                <!-- <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $user['username']; ?></h4>
                    <p class="card-text">Ime: <?php echo $user['first_name'] . " " . $user['last_name']; ?></p>
                    <p class="card-text">Email adresa: <?php echo $user['email']; ?></p>
                    <p class="card-text">Datum registracije: <?php echo $user['created_at']; ?></p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" name="" id="editUser-<?php echo $user['user_id']; ?>" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#editModal" onclick="getUserData()">Izmeni</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" data-toggle="modal" data-target="#removeUserModal" name="" id="removeUser-<?php echo $user['user_id']; ?>" class="btn btn-danger btn-lg btn-block" onclick="removeUser()">Ukloni</button>
                        </div>

                    </div>
                </div>
            </div> -->
            <?php endwhile; ?>
        </div>

    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izmena korisnika</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="alert-placeholder"></div>
                    <div class="form-group">
                        <label for="first_name">Ime</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Prezime</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="username">Korisnicko ime</label>
                        <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="email">Email adresa</label>
                        <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                    </div>
                    <input type="hidden" name="user_id" id="user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Otkazi</button>
                    <button type="button" class="btn btn-success btn-lg" id="editSubmit">Izmeni</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeUserModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Potvrda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="remove-alert-placeholder"></div>
                    <p class="text-center">Brisanjem korisnika onemogucava se njegovo prijavljivanje kao i koriscenje. Svi podaci povezani sa nalogom bice takodje obrisani. Obrisi korisnika?</p>
                    <input type="hidden" name="" id="remove_user_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Otkazi</button>
                    <button type="button" class="btn btn-danger" onclick="confirmRemoveUser()">Potvrdi</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../resources/js/admin.js"></script>
</body>

</html>