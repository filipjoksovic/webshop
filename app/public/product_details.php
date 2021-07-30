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
    <?php  ?>

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
            <div class="product-actions mb-2">
                <div class=" shadow-custom border-animate-danger " onclick="removeFromCart(<?php echo $product->id; ?>)"><i class="fas fa-trash action-icon"></i>
                    <span class="action-text">Ukloni iz korpe</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>