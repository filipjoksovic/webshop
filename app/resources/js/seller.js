$(document).ready(function () {
    $.ajax({
        url: "../controllers/CategoryController.php",
        type: "GET",
        data: {
            'get_categories': 1
        },
        success: function (response) {
            let categories = JSON.parse(response).response
            console.log(categories)
            categories.forEach(category => {
                console.log(category)
                let element = `<option value = ${category.id}>${category.title}</option>`
                $("#category").append(element);
            });
        },
        error: function (response) {
            console.log(response)
        }
    })
})
$("#addImage").click(function () {
    let inputs = $(".custom-file")
    if (inputs.length >= 5) {
        alert("Dozvoljeno je maksimalno 5 slika po proizvodu")
        return;
    }
    let inputIndex = inputs.length + 1
    console.log(inputIndex)
    let element = `
        <div class="input-group mb-3">
            <div class="custom-file cf-${inputIndex}">
                <input type="file" class="custom-file-input" name = "product_images[]" accept = "image/png, image/gif, image/jpeg, image/webp" id="productImage" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="productImage">Odaberi sliku</label>
            </div>
        </div>
    `
    $("#imageInputs").append(element)
})

function prepareDelete(product_id) {
    $("#delete_id").val(product_id)
}

function confirmDelete() {
    let deleteID = $("#delete_id").val()

    $.ajax({
        url: "../controllers/ProductController.php",
        type: "POST",
        data: {
            'product_id': deleteID,
            'delete_product':1
        },
        success: function (response) {
            let responseData = JSON.parse(response);
            let element = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>${responseData.message}</strong>.
            </div>`
            $("#alertPlaceholder").append(element)
            setTimeout(() => {
                location.reload();
            }, 2500);
        },
        error: function (response) {
            let responseData = JSON.parse(response);
            let element = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>${responseData.message}</strong>.
            </div>`
            $("#alertPlaceholder").append(element)
            setTimeout(() => {
                location.reload();
            }, 2500);
        }
    })
}