// add to cart 
let quantityInput = document.querySelector("#quantity")
let productname = document.querySelector(".product-name")
let productprice = document.querySelector(".product-price")
let productdesc = document.querySelector(".product-description")
function addToCart(params) {
    alert("mmm")
    var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "../backend/cart.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.onreadystatechange = function () { //Call a function when the state changes.
        if (httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
            alert(httpc.responseText); // some processing here, or whatever you want to do with the response
        }
    };
    httpc.send(params);
}

function decreaseQuantity() {
    var quantityOfProduct = parseInt(quantityInput.value);

    if (quantityOfProduct > 1) {
        quantityOfProduct -= 1;
        quantityInput.value = quantityOfProduct;
    }
    // alert(quantityOfProduct)
}
function increaseQuantity() {
    var quantityOfProduct = parseInt(quantityInput.value);

    if (quantityOfProduct > 1) {
        quantityOfProduct += 1;
        quantityInput.value = quantityOfProduct;
    }
}