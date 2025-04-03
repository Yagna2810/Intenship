window.onload = function() {
  displayCart();
};

function displayCart() {
  const cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
  const cartTable = document.getElementById('cart-items');
  const cartHeader = document.querySelector('#cart-table thead');
  const emptyCartMsg = document.getElementById('empty-cart-msg');
  const cs= document.getElementById('cs');
  const clear= document.getElementById('clear');
  const checkout=document.getElementById('checkout');
  const gt=document.getElementById('grand-total');


  if (cartItems.length === 0) {
    emptyCartMsg.style.display = 'block';
    cartHeader.style.display = 'none';
    cs.style.display = 'none';
    clear.style.display = 'none';
    checkout.style.display='none';
    gt.style.display='none';
  } else {
    let grandTotal = 0;
    cartItems.forEach((item, index) => {
      const tr = document.createElement('tr');
      const subtotal = item.price * item.quantity;
      grandTotal += subtotal;
      tr.innerHTML = `
        <td><img src="${item.imageSrc}" alt="${item.name}" style="max-width: 100px; height: auto;"></td>
        <td><input type="hidden"  name="name" value="${item.name}">${item.name}</td>
        <td><input type="hidden"  name="price" value="₹${item.price.toFixed(2)}">₹${item.price.toFixed(2)}</td>
        <td><input type="number" id='qi' name="qty" min="1" value="${item.quantity}" onchange="updateQuantity(this, ${item.price})"></td>
        <td><input type="hidden"  name="total" value="₹${subtotal.toFixed(2)}">₹${subtotal.toFixed(2)}</td>
        <td><button onclick="removeItem(${index})">Remove</button></td>
      `;
      cartTable.appendChild(tr);
    });
    document.getElementById('grand-total').textContent = `Grand Total: ₹${grandTotal.toFixed(2)}`;
  }
}

function updateQuantity(input, price) {
  const quantity = parseInt(input.value);
  const subtotal = quantity * price;
  const row = input.parentNode.parentNode;
  row.cells[4].textContent = '₹' + subtotal.toFixed(2);
  // Update sessionStorage with new quantity
  const index = Array.prototype.indexOf.call(row.parentNode.children, row);
  let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
  cartItems[index].quantity = quantity;
  sessionStorage.setItem('cart', JSON.stringify(cartItems));
  updateGrandTotal();
}

function removeItem(index) {
  let cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
  cartItems.splice(index, 1); // Remove item from cart array
  sessionStorage.setItem('cart', JSON.stringify(cartItems)); // Update sessionStorage
  location.reload(); // Refresh the page to reflect changes
}

function clearCart() {
  sessionStorage.removeItem('cart'); // Remove the entire cart from sessionStorage
  location.reload(); // Refresh the page to reflect changes
}


function updateGrandTotal() {
  let grandTotal = 0;
  const cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
  cartItems.forEach(item => {
    grandTotal += item.price * item.quantity;
  });
  document.getElementById('grand-total').textContent = `Grand Total: ₹${grandTotal.toFixed(2)}`;
}
function checkout() {
  // Redirect to the login or sign-up page
  window.location.href = 'bill.html';
}


// billing

let currentStep = 0;
    const steps = document.querySelectorAll('.step');
    const stepIndicators = document.querySelectorAll('.step-indicator');
    const progressLine = document.querySelector('.progress-line');
    const sh=document.querySelector('input[name="ship"]:checked');
    
    

    function validateForm() {
      // Get form fields
      var reqired1 = document.getElementById("required1").value;
      var reqired2 = document.getElementById("required2").value;
      var reqired3 = document.getElementById("required3").value;
      var reqired4 = document.getElementById("required4").value;
      var reqired5 = document.getElementById("required5").value;
      var reqired6 = document.getElementById("required6").value;
      var reqired7 = document.getElementById("required7").value;
      var reqired8 = document.getElementById("required8").value;


      // Check if all required fields are filled
      if (reqired1 === '' || reqired2 === '' || reqired3 === '' || reqired4 === '' || reqired5 === '' || reqired6 === '' || reqired7 === '' || reqired8 === '') {
          alert("Please fill in all required fields.");
          return false;
      } else {
          // Redirect to the next section
          address();
          return false; // Prevent form submission
      }
  }

  function address(){
      var fname = document.getElementById("required1").value;
      var middle = document.getElementById("middle").value;
      var lname = document.getElementById("required2").value;
      var company = document.getElementById("company").value;
      var email = document.getElementById("required3").value;
      var address = document.getElementById("required4").value;
      var state = document.getElementById("required5").value;
      var city = document.getElementById("required6").value;
      var zipcode = document.getElementById("required7").value;
      var country = document.getElementById("country").value;
      var mobile = document.getElementById("required8").value;
      var whatsapp = document.getElementById("whatsapp").value;

      document.getElementById("ba").innerHTML ='<p>'+fname +" "+middle+" "+lname+'</p>'+'<p>'+company +" "+ email+ '</p>'+'<p>'+address + city+" "+state+" " +country+"-"+zipcode+'</p>'+'<p>'+mobile+" ,"+ whatsapp+'</p>';
      document.getElementById("ba1").innerHTML ='<p>'+fname +" "+middle+" "+lname+'</p>'+'<p>'+company +" "+ email+ '</p>'+'<p>'+address + city+" "+state+" " +country+"-"+zipcode+'</p>'+'<p>'+mobile+" ,"+ whatsapp+'</p>';
      document.getElementById("ba2").innerHTML ='<p>'+fname +" "+middle+" "+lname+'</p>'+'<p>'+company +" "+ email+ '</p>'+'<p>'+address + city+" "+state+" " +country+"-"+zipcode+'</p>'+'<p>'+mobile+" ,"+ whatsapp+'</p>';
    }
    function goToHome(){
      window.location.href='index.html';};

    document.getElementById("numberInput").addEventListener("keydown", function(event) {
        // Allow only digit keys (0-9) and some specific keys like backspace and arrow keys
        if (!/[0-9\b\t]/.test(event.key)) {
            event.preventDefault();
        }
    });
    
    //digit

    function allowOnlyDigits(event) {
      // Allow only digit keys (0-9) and specific control keys
      if ((event.keyCode >= 48 && event.keyCode <= 57) || // 0-9 keys
          (event.keyCode >= 96 && event.keyCode <= 105) || // Numpad 0-9 keys
          event.keyCode === 8 || // Backspace
          event.keyCode === 9 || // Tab
          event.keyCode === 37 || // Left arrow
          event.keyCode === 39 || // Right arrow
          event.keyCode === 46 // Delete
      ) {
          return true;
      } else {
          event.preventDefault();
          return false;
      }
  }

