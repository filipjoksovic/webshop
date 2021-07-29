function removeFromCart(product_id){
    $.ajax({
        url:"../controllers/CartController.php",
        type:"POST",
        data:{
            "product_id":product_id,
            'remove_from_cart': 1
        },
        success:function(response){
            let responseData = JSON.parse(response);
            alert(responseData.message);
            location.reload();
        },
        error:function(response){
            location.reload();
        }
    })
}
function emptyCart(){
    $.ajax({
        url:"../controllers/CartController.php",
        type:"POST",
        data:{
            'empty_cart': 1
        },
        success:function(response){
            let responseData = JSON.parse(response);
            alert(responseData.message);
            location.reload();
        },
        error:function(response){
            location.reload();
        }
    })
}