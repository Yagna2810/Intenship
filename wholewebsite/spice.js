function addToCart(name, price, imageSrc) {
    const quantity = parseInt(document.getElementById("quantity").value);
    if (!isNaN(quantity) && quantity > 0) {
      const item = { name, price, imageSrc, quantity };
      let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
      cartItems.push(item);
      sessionStorage.setItem('cart', JSON.stringify(cartItems));
      alert('Item added to cart!');
    } else {
      alert('Please enter minimum 1 quantity.');
    }
  }

  // Get all the sub-images
const subImages = document.querySelectorAll('.subImg');

// Function to change main image source
function changeMainImage(event) {
    const clickedImageSrc = event.target.src;
    document.getElementById('mainImg').src = clickedImageSrc;
}

// Attach click event listener to each sub-image
subImages.forEach(subImage => {
    subImage.addEventListener('click', changeMainImage);
});



document.addEventListener("DOMContentLoaded", function () {
    // Get elements
    var basePriceElement = document.getElementById("baseprice");
    var quantityInput = document.getElementById("quantity");
    var totalPriceElement = document.getElementById("totalPrice");

    // Ensure base price is a valid number
    var basePrice = parseFloat(basePriceElement.value) || 0;

    // Function to calculate and update total price
    function updatePrice() {
        var quantity = parseInt(quantityInput.value) || 1; // Default to 1 if empty/invalid

        if (quantity < 1) {
            quantity = 1; // Prevent negative or zero values
            quantityInput.value = 1;
        }

        var totalPrice = basePrice * quantity;
        totalPriceElement.innerText = totalPrice.toFixed(2);

        // Debugging logs (check in browser console)
        console.log("Base Price:", basePrice);
        console.log("Quantity:", quantity);
        console.log("Total Price:", totalPrice);
    }

    // Attach event listener to quantity input
    quantityInput.addEventListener("input", updatePrice);
    quantityInput.addEventListener("change", updatePrice); // Ensure updates on change

    // Initial update
    updatePrice();
});

