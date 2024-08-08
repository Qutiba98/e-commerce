

function increaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value) || 0;
    quantityInput.value = currentQuantity + 1;

}

function decreaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value) || 0;
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}