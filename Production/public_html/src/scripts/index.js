$(document).ready(function() {

    $("#delete-product-btn").click(function(){
        var selected_skus = $('.delete-checkbox:checked').map(function(){
            return $(this).val();
        }).get();

         $.ajax({
            url: "delete-selected.php",
            method: "POST",
            data: {skus: selected_skus},
            success: function(response){
                location.reload();
            }
        })
    })
   
        
})