<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodavac</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php include("../controllers/MiddlewareController.php"); ?>
</head>

<body>
    <?php include("../components/header.php"); ?>
    <?php include("../components/message.php"); ?>
    <div id="alertPlaceholder"></div>
    <div class="container mt-5">
        <h1 class="text-center">Pocetna</h1>
    </div>
    <div class="quick-actions mt-3">
        <div class="action shadow-custom" id="addProductAction" data-toggle="modal" data-target="#addProduct">
            Dodaj proizvod
        </div>
        <!-- <div class="action" id = "produc">
            Pregled proizvoda
        </div> -->

    </div>
    <div class="container mt-5">
        <h3 class="text-center">Pregled proizvoda</h3>
        <?php require "../models/ProductModel.php";
        $products = ProductModel::getProductsFromSeller($_SESSION['user']['uid']);
        ?>
        <div class="products-container">
            <?php foreach ($products as $product) : ?>
                <div class="seller product shadow-custom">
                    <div class="product-image">
                        <img src="<?php echo $product->main_image; ?>">
                    </div>
                    <div class="product-info">
                        <div class="product-title">
                            <span><?php echo $product->id; ?></span>
                            <span><?php echo $product->product_name; ?></span>
                        </div>
                        <div class="product-details">
                            <div class="product-data">
                                <span class="product-stock">Stanje: <?php echo $product->stock; ?></span>
                                <span class="product-price">Cena: <?php echo $product->price; ?></span>
                                <span class="product-orders">Broj porudzbina: <?php echo $product->stock; ?></span>
                            </div>
                            <div class="product-actions">
                                <div class="product-action shadow-custom border-animate-warning"><i class="fas fa-edit  action-icon"></i>
                                    <span class="action-text">Izmeni proizvod</span>
                                </div>
                                <div class="product-action shadow-custom border-animate-danger" data-toggle="modal" data-target="#deleteConfirm" onclick="prepareDelete(<?php echo $product->id; ?>)"><i class="fas fa-trash  action-icon"></i>
                                    <span class="action-text">Ukloni proizvod</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-default px-5 py-3 br-2">
                <div class="modal-header">
                    <h5 class="modal-title">Potvrda uklanjanja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid text-center">
                        Uklanjanjem proizvoda iz baze podataka brisu se svi tragovi postojanja proizvoda u prodavnici, ukljucujuci statistiku prodaje. <br>
                        Nastavi dalje?
                    </div>
                    <input type="hidden" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="neumorphic-button px-5 py-3 border-animate-warning" data-dismiss="modal">Otkazi</button>
                    <button type="button" class="neumorphic-button px-5 py-3 border-animate-danger" onclick="confirmDelete()">Nastavi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content  bg-default px-5 py-3 br-2">
                <div class="modal-header">
                    <h5 class="modal-title">Dodavanje proizvoda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="neumorphic-form" method="POST" action="../controllers/ProductController.php" enctype="multipart/form-data">
                        <div class="neumorphic-input-container my-2">
                            <input class="neumorphic-input p-3" required="required" type="text" name="product_name" id="product_name" class="form-control" placeholder="">
                            <label class="neumorphic-label" for="offerName">Naziv proizvoda</label>
                        </div>
                        <div class="neumorphic-input-container my-1">
                            <select class="neumorphic-input p-3" type="text" name="category" id="category" required="required" placeholder=""></select>
                            <label class="neumorphic-label" for="category">Kategorija</label>
                        </div>
                        <div class="neumorphic-input-container my-1">
                            <input class="neumorphic-input p-3" required="required" type="number" id="price" name="price" class="form-control" placeholder="">
                            <label class="neumorphic-label" for="price">Cena</label>
                        </div>
                        <div class="neumorphic-input-container my-1">
                            <input class="neumorphic-input p-3" required="required" type="number" id="stock" name="stock" class="form-control">
                            <label class="neumorphic-label" for="stock">Stanje</label>
                        </div>
                        <div class="neumorphic-input-container my-1">
                            <textarea class="neumorphic-input p-3" required="required" name="product_description" id="description"></textarea>
                            <label class="neumorphic-label" for="description">Opis</label>
                        </div>
                        <div id="imageInputs">
                            <div class="image-input m-1">
                                <input class="d-none finput" onchange="changeFileLabel()" required="required" type="file" name="product_images[]" id="image-input-1" accept="image/png, image/gif, image/jpeg, image/webp" aria-describedby="inputGroupFileAddon01">
                                <label class="neumorphic-file-label" for="image-input-1">Odaberi sliku</label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="addImage">Dodaj jos slika</button>
                        <input type="hidden" name="add_product" value=1>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
                </div>
                </form>
            </div>
        </div>

    </div>
        
    <script src="../resources/js/seller.js"></script>

</body>

</html>