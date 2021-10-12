$(document).ready(function(){
    // add/edit user

    $(document).on("submit", "addform", function(event){
        event.preventDefault();
        $.ajax({
            url:"/phpcrudajax/ajax.php",
            type: "POST",
            dataType:"json",
            data: new FormData(this),
            processData: false,
        });
    });
});