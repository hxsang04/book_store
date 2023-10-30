$(document).ready(function() {
    $('#product-img').change(function(e) {
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
        
    });

    $("#initial_price, #discount").on("keypress", function(e) {
        const keysAllowed = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        const keyPressed = e.key;
        if (!keysAllowed.includes(keyPressed)) {
            e.preventDefault()
        }

    });
    
    $("#initial_price, #discount").on("input", function() {
        if($('#discount').val() > 100){
            $('#discount').val(100)
        }
        updateFinalPrice();
    });

});

function updateFinalPrice() {
    const price = $("#initial_price").val();
    const discount = $("#discount").val();

    const discountedPrice = price - (price * (discount / 100));

    $("#price").val(discountedPrice);
}
