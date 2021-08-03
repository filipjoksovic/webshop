<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalji proizvoda</title>
    <?php include "../components/bootstrap.php"; ?>
</head>

<body>
    <?php include "../components/header.php"; ?>
    <?php include "../components/message.php"; ?>
    <div id="alertPlaceholder"></div>
    <?php
    require "../models/ProductModel.php";
    require "../models/ProductImageModel.php";
    $product_id = $_GET['product_id'];
    $product = ProductModel::getProductDetails($product_id);
    $product->main_image = ProductImageModel::getMainImage($product->id);
    $product->images = ProductImageModel::getProductImages($product->id);

    ?>
    <div class="product-showcase">
        <div class="product-images">
            <div class="main-image">
                <img src="<?php echo $product->main_image; ?>" id="mainImage">
            </div>
            <div class="thumbnails">
                <?php foreach ($product->images as $image) : ?>
                    <img class="thumbnail" src="<?php echo $image->path; ?>">
                <?php endforeach ?>
            </div>
        </div>
        <div class="product-details shadow-custom">
            <span class="product-title"><?php echo $product->product_name; ?></span>
            <?php if (isset($product->product_description)) : ?>
                <span class="product-description"><?php echo $product->product_description; ?></span>
            <?php endif; ?>
            <span class="product-price"><?php echo $product->price . ".00 rsd"; ?></span>
            <span class="product-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </span>
        </div>
        <div class="showcase-actions shadow-custom">
            <div class="showcase-action shadow-custom border-animate-primary " onclick="addToCart(<?php echo $product->id; ?>)"><i class="fas fa-shopping-cart action-icon"></i>
                <span class="action-text">Dodaj u korpu</span>
            </div>
            <div class="showcase-action shadow-custom border-animate-warning " onclick="addToWishlist(<?php echo $product->id; ?>)"><i class="fas fa-bookmark action-icon"></i>
                <span class="action-text">Dodaj u listu zelja</span>
            </div>
        </div>
        <div class="personal-review m-5">
            <?php if (isset($_SESSION['user']['uid'])) : ?>
                <form class="neumorphic-form" action="../controllers/CheckoutController.php" method="POST">
                    <div id="contact-form" class="neumorphic-form">

                        <div class="neumorphic-input-container">
                            <div class="showcase">
                                <h3 class="rating-text mb-3">Ocena proizvoda</h3>
                                <div class="rating-system3">
                                    <input class="rating-input" type="radio" name='rate3' id="star5_3" />
                                    <label class="rating-label" for="star5_3"></label>

                                    <input class="rating-input" type="radio" name='rate3' id="star4_3" />
                                    <label class="rating-label" for="star4_3"></label>

                                    <input class="rating-input" type="radio" name='rate3' id="star3_3" />
                                    <label class="rating-label" for="star3_3"></label>

                                    <input class="rating-input" type="radio" name='rate3' id="star2_3" />
                                    <label class="rating-label" for="star2_3"></label>

                                    <input class="rating-input" type="radio" name='rate3' id="star1_3" />
                                    <label class="rating-label" for="star1_3"></label>

                                    <div class="text"></div>
                                </div>
                            </div>
                            <label class="neumorphic-label">Komentar</label><br>
                            <textarea id="fname" type="text" class="neumorphic-input" name="first_name" required="required"></textarea>
                        </div>

                        <input type="hidden" name="leave_review">
                        <button type="submit" class="neumorphic-button">Sacuvaj</button>
                </form>
            <?php else : ?>
                <div class = "">
                    <h4 class="text-center">Morate biti ulogovani da biste ostavili ocenu na proizvod. Ulogujte se i pokusajte ponovo.</h4>
                    <a href="./login.php" class="d-block text-center">Uloguj me.</a>
                </div>

            <?php endif; ?>
        </div>
        <div class="product-reviews"></div>
    </div>

    <script src="../resources/js/details.js"></script>
</body>

</html>