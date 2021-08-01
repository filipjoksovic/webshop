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
    <div class="container mt-5">
        <h1 class="text-center">Prijavite se na vas nalog</h1>
        <h4 class="text-center">Unesite podatke navedene u formi kako biste se prijavili na vas nalog</h4>
    </div>
    <div class="container mt-5">
        <form action="../controllers/UserController.php" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">Ime</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Prezime</label>
                        <input type="text" class="form-control" name="last_name" id="first_name" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="username">Korisnicko ime</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group">
                <label for="email">Email adresa</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="adresa@provajder.com" aria-describedby="helpId">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Lozinka</label>
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirm_password">Potvrda lozinke</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="helpId" placeholder="">
                    </div>
                </div>
            </div>
            <h5 class="text-center">Registrujem se kao</h5>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="role" id="buyer" value="buyer" checked>
                    Kupac
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="role" id="seller" value="seller">
                    Prodavac
                </label>
            </div>
            <input type="hidden" name="register">
            <p class="form-text text-muted text-center">
                Vec imate nalog? Prijavite se <a href="./login.php">ovde</a>.
            </p>
            <button type="submit" class="btn btn-primary btn-block">Uloguj se</button>
        </form>
    </div>
</body>

</html>