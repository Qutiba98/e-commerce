

function increaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);

}

function decreaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;

    }
}