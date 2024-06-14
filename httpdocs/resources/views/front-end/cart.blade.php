<style>

    td{
        border:1px solid grey;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(count($cartItems) > 0)
    <div id="divcart">
    <table class="table" style="border:1px solid grey">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Remove Item </th>
            </tr>
        </thead>
        <tbody >
            @foreach($cartItems as $cartItem)
                           <tr>
                    <td>{{ $cartItem['name'] }}</td>
                     <td>
            <button class="decrement-quantity" type="button" data-id="{{ $cartItem['id'] }}">-</button>
            <span class="quantity">{{ $cartItem['quantity'] }}</span>
            <button class="increment-quantity" type="button" data-id="{{ $cartItem['id'] }}">+</button>
        </td>
                  
							  @php 
							   $price = str_replace('$', '', $cartItem['price']); 
							   @endphp
					<td>{{ (int)$price }}</td>
                    <td>{{ (int)$cartItem['quantity'] * (int)($price) }}</td>
                   
                    <!-- <td><a  href="{{ route('cart.remove', ['id'=>$cartItem['id']]) }}">Remove</a></td> -->

                    <td>
    <button class="remove-item"  type="button" data-id="{{ $cartItem['id'] }}">Remove</button>
  </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
               <td id="cart-total"><strong>Total:
    {{$total}}</strong>
</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
     </div>
@else
    <p>Your cart is currently empty.</p>
@endif

<a href="buyer/checkout" class="btn btn-primary">Checkout</a>
<script>
var tablehtml = '<table class="table" style="border:1px solid grey">';
    var tablehtml = tablehtml+'<thead><tr><th>Item</th><th>Quantity</th><th>Price</th><th>Subtotal</th><th>Remove Item </th></tr>';
$(document).on('click', '.remove-item', function () {
  var button = $(this);
  var itemId = button.data('id');
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: '{{ route("cart.remove") }}',
    type: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken },
    data: { id: itemId },
    success: function (response) {
      if (response.success) {
        // Remove the item from the table
        //button.closest('tr').remove();
        // Update the cart total and item count
        //$('#cart-total').text(response.cartTotal);

        // Update the total price
        //$('tfoot td:last-child').text(response.total);
        location.reload();
      } else {
        //alert('Error removing item from cart');
        location.reload();
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Error removing item from cart');
    }
  });
});

$(document).on('click', '.decrement-quantity', function () {
  var button = $(this);
  var itemId = button.data('id');
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajax({
    url: '{{ route("cart.decrement") }}',
    type: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken },
    data: { id: itemId },
    success: function (response) {
        location.reload();
      /*if (response.success) {
                // Update the item quantity and subtotal in the table
        button.siblings('.quantity').text(response.quantity);
        button.closest('tr').find('td:last-child').text(response.subtotal);

        // Update the cart total and item count
        $('#cart-total').text(response.cartTotal);

        // Update the total price
        $('tfoot td:last-child').text(response.total);
      } else {
        alert('Error updating cart');
      }*/
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Error updating cart');
    }
  });
});

$(document).on('click', '.increment-quantity', function () {
  var button = $(this);
  var itemId = button.data('id');
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: '{{ route("cart.increment") }}',
    type: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken },
    data: { id: itemId },
    success: function (response) {
      /*if (response.success) {
        // Update the item quantity and subtotal in the table
        button.siblings('.quantity').text(response.quantity);
        button.closest('tr').find('td:last-child').text(response.subtotal);

        // Update the cart total and item count
        $('#cart-total').text(response.cartTotal);

        // Update the total price
        $('tfoot td:last-child').text(response.total);
      } else {
        alert('Error updating cart');
      }*/
      location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert('Error updating cart');
    }
  });
});

$(document).ready(function() {
  $('.add-to-cart').click(function() {
    var itemId = $(this).data('item-id');
    var viewItemLink = $('.view-item-link[data-item-id="' + itemId + '"]');

    // Make Ajax request to server to add item to cart
    $.ajax({
      url: '/cart/count',
      type: 'POST',
      data: { item_id: itemId },
      success: function(response) {
        // Show link to view item
        viewItemLink.html('<a href="/items/' + itemId + '">View Item (' + itemId + ')</a>');
      },
      error: function(xhr, status, error) {
        // Handle error
      }
    });
  });
});
</script>