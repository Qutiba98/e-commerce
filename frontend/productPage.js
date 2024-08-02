// async function addToCart() {
//     // Retrieve quantity from input
//     var quantityInput = document.getElementById("quantity");
//     var currentQuantity = parseInt(quantityInput.value);

//     // Store quantity in session storage
//     sessionStorage.setItem("quantity", encodeURIComponent(currentQuantity));

//     // // Check if quantity is valid
//     // if (currentQuantity !== null) {
//     //     fetch(`http://127.0.0.1/brief%203/e-commerce/backend/productpage.php?quantity=${currentQuantity}`)
//     // // Create AJAX request
//     // const xhr = new XMLHttpRequest();
//     // xhr.open('POST', '../backend/productpage.php', true);
//     // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

//     // // Define what to do on request completion
//     // xhr.onreadystatechange = function () {
//     //     if (xhr.readyState === 4 && xhr.status === 200) {

//     //         console.log(xhr.responseText);
//     //     }
//     // };


//     // xhr.send('quantity=' + encodeURIComponent(currentQuantity));
// }

function increaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value) || 0;
    quantityInput.value = currentQuantity + 1;
    // addToCart()
}

function decreaseQuantity() {
    var quantityInput = document.getElementById("quantity");
    var currentQuantity = parseInt(quantityInput.value) || 0;
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
        // addToCart()
    }
}