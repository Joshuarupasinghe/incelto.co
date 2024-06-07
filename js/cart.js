var cart = [];

  function addToCart(productName, price, productId) {
    var item = {
      id: productId,
      name: productName,
      price: price
    };

    cart.push(item);
    updateCart();
  }

  function deleteFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    updateCart();
  }

  function updateCart() {
    var cartItemsElement = document.getElementById('cart-items');
    var cartTotalElement = document.getElementById('cart-total');

    // Clear existing items
    cartItemsElement.innerHTML = '';

    var total = 0;

    // Add items to the cart
    cart.forEach(function(item) {
      var listItem = document.createElement('li');
      listItem.textContent = item.name + ' - Rs.' + item.price + '/=';
      
      // Add a delete button for each item
      var deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.onclick = function() {
        deleteFromCart(item.id);
      };
      
      listItem.appendChild(deleteButton);
      
      cartItemsElement.appendChild(listItem);

      // Update total
      total += parseFloat(item.price);
    });

    // Update total in the cart
    cartTotalElement.textContent = total.toFixed(2);
  }

  function checkout() {
    // Here, you can implement the logic for handling the checkout process
    // For example, redirect to a checkout page, process payment, etc.
    alert('Checkout functionality will be implemented here.');
  }

  document.addEventListener('DOMContentLoaded', function() {
    var showHideBtn = document.getElementById('showHideBtn');
    var myContainer = document.getElementById('myContainer');
  
    showHideBtn.addEventListener('click', function() {
      // Toggle the 'd-none' class to show/hide the container
      myContainer.classList.toggle('d-none');
    });
  });