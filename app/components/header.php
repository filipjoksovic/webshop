<header>
    <?php include_once("../controllers/SessionController.php"); ?>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Pocetna</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <?php if($_SERVER['REQUEST_URI'] != '/login.php' && $_SERVER['REQUEST_URI'] != '/register.php'):?>
            <div class="form-inline my-2 my-lg-0">
                <?php if (!isset($_SESSION['user']['uid'])) : ?>
                    <a href="./login.php" class="nav-link">Ulogujte se</a>
                    <a href="./register.php" class="nav-link">Registrujte se</a>
                <?php else : ?>
                    <a href="./account.php" class="nav-link"><?php echo $_SESSION['user']['username'];?> - Moj nalog</a>
                    <a href="./logout.php" class="nav-link">Odjavite se</a>
                <?php endif ?>
            </div>
            <?php endif?>
        </div>
    </nav>
</header>