function getUserData() {
    let userID = event.target.id.split('-')[1];
    $.ajax({
        url: '../controllers/UserController.php',
        dataType: 'json',
        data: {
            "user_id": userID,
            "find_user": 1
        },
        success: function (response) {
            console.log(response);
            let user = response.user;
            $("#first_name").val(user.first_name)
            $("#last_name").val(user.last_name)
            $("#username").val(user.username)
            $("#email").val(user.email)
            $("#user_id").val(user.uid)

        },
        error: function (response) {
            console.log(response)
        }
    })
}

$("#editSubmit").click(function(){
    let fname = $("#first_name").val()
    let lname = $("#last_name").val();
    let uname = $("#username").val();
    let email = $("#email").val();
    let user_id = $("#user_id").val();
    console.log(user_id)

    $.ajax({
        url: "../Controllers/UserController.php",
        type: "POST",
        dataType: "json",
        data: {
            'username': uname,
            'first_name': fname,
            'last_name': lname,
            'email': email,
            'user_id': user_id,
            'edit_user':1
        },
        success: function (response) {
            console.log(response)
            let alertClass;
            let headerText;
            if(response.status.status == 200){
                alertClass = "alert-success"
                headerText = "Uspeh!";
            }
            else{
                alertClass = "alert-danger"
                headerText = "Greska!";
            }
            let element =
                `<div class="alert text-center ${alertClass} alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>${headerText}</strong><br>
              <p>${response.status.message}</p>
            </div>`
            $("#alert-placeholder").append(element)
            setTimeout(() => {
                location.reload();
            }, 2000);
        },
        error: function (response) {
            console.log(response)
            let element =
                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Greska!</strong><br>
              <p>${response.message}</p>
            </div>`
            $("#alert-placeholder").append(element)
        }
    })
})
function removeUser(){
    let user_id = event.target.id.split('-')[1]
    $("#remove_user_id").val(user_id)
}
function confirmRemoveUser(){
    let user_id = $("#remove_user_id").val()
    $.ajax({
        url:"../controllers/UserController.php",
        type: "POST",
        dataType:"json",
        data:{
            'user_id' : user_id,
            'remove_user': 1
        },
        success:function(response){
            console.log('success')
            console.log(response);

            let element =
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Uspeh!</strong><br>
              <p>${response.message}</p>
            </div>`
            $("#remove-alert-placeholder").append(element)
            setTimeout(() => {
                location.reload();
                
            },2000);
        },
        error:function(response){
            console.log(response);
             let element =
                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Greska!</strong><br>
              <p>${response.message}</p>
            </div>`
            $("#remove-alert-placeholder").append(element)
        }
    })
}