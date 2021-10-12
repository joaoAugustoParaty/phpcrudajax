$(document).ready(function(){
    // add/edit user

    $(document).on("submit", "#addform", function(event){
        event.preventDefault();
        $.ajax({
            url:"/phpcrudajax/ajax.php",
            type: "POST",
            dataType:"json",
            data: new FormData(this),
            processData: false,
            contentType:false,
            beforeSend: function(){
                $('#overlay').fadeIn();
            },
            success:function(response){
                console.log(response);
                if(response) {
                    $("#userModal").modal("hide");
                    $("#addform")[0].reset();
                    $("#overlay").fadeOut();
                }
            },
            error: function(){
                //console.log("Oops! Algo de errado aconteceu!");
            }
        });
    });
});