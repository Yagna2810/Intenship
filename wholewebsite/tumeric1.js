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

//change price

// Define the base price
var basePrice = 40;

// Function to calculate and update total price
function updatePrice() {
  var quantity = parseInt(document.getElementById('quantity').value);
  var totalPrice = basePrice * quantity;
  document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
}

// Attach event listener to quantity input
document.getElementById('quantity').addEventListener('input', updatePrice);

// Initial update
updatePrice();
// cart
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