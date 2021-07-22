$(document).ready(function(){
    $.ajax({
        url:"../controllers/CategoryController.php",
        type:"GET",
        data:{
            'get_categories': 1
        },
        success:function(response){
            let responseData = JSON.parse(response);
            console.log(JSON.parse(response));
            let categories = responseData.response;
            categories.forEach(category => {
                console.log(category)
                let element = `<option value = ${category.id}>${category.category_name}</option>`
                $("#category").append(element);
            });
        },
        error:function(response){
            console.log(response)
        }
    })
})
$("#addImage").click(function(){
    let inputs = $(".custom-file")
    if(inputs.length >= 5){
        alert("Dozvoljeno je maksimalno 5 slika po proizvodu")
        return;
    }
    let inputIndex = inputs.length + 1    
    console.log(inputIndex)
    let element = `
        <div class="input-group mb-3">
            <div class="custom-file cf-${inputIndex}">
                <input type="file" class="custom-file-input" name = "product_images[]" accept = "image/png, image/gif, image/jpeg" id="productImage" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="productImage">Odaberi sliku</label>
            </div>
        </div>
    `
    $("#imageInputs").append(element)
})