<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijavite se</title>
    <?php include("../components/bootstrap.php"); ?>
</head>

<body>
    <?php include("../components/header.php"); ?>
    <?php include("../components/message.php");?>
    <div class="container mt-5">
        <h1 class="text-center">Prijavite se na vas nalog</h1>
        <h4 class="text-center">Unesite podatke navedene u formi kako biste se prijavili na vas nalog</h4>
    </div>
    <div class="container mt-5">
        <form action="../controllers/UserController.php" method="post">
            <div class="form-group">
                <label for="username">Korisnicko ime ili email adresa</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Lozinka</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
            </div>
            <input type="hidden" name="login">
            <p class="form-text text-muted text-center">
                Nemate nalog? Registrujte se <a href = "./register.php">ovde</a>.
            </p>
            <button type="submit" class="btn btn-primary btn-block">Uloguj se</button>
        </form>
    </div>
</body>

</html>