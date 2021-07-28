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
    <div class="container mt-5">
        <h1 class="text-center">Pocetna</h1>
    </div>
    <div class="quick-actions mt-3">
        <div class="action" id="addProductAction" data-toggle="modal" data-target="#addProduct">
            Dodaj proizvod
        </div>
        <!-- <div class="action" id = "produc">
            Pregled proizvoda
        </div> -->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dodavanje proizvoda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../controllers/ProductController.php" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="offerName">Naziv proizvoda</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="category">Kategorija</label>
                                <select type="text" name="category" id="category" class="form-control" placeholder=""></select>
                            </div>
                            <div class="form-group">
                                <label for="price">Cena</label>
                                <input type="number" id="price" name="price" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stanje</label>
                                <input type="number" id="stock" name="stock" class="form-control">
                            </div>
                            <div id="imageInputs">
                                <div class="input-group mb-3">
                                    <div class="custom-file cf-1">
                                        <input type="file" class="custom-file-input" name="product_images[]" id="productImage" accept="image/png, image/gif, image/jpeg, image/webp" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="productImage">Odaberi sliku</label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="addImage">Dodaj jos slika</button>
                            <input type="hidden" name="add_product" value=1>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
                </div>
                </form>
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
    <script src="../resources/js/seller.js"></script>

</body>

</html>