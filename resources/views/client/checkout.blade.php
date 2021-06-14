@extends('layouts.app1')

{{-- Start content --}}

    @section('contenu')

		<div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate text-center">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
						<h1 class="mb-0 bread">Checkout</h1>
					</div>
				</div>
			</div>
	  	</div>
  
	  <section class="ftco-section">
		<div class="container">
		  <div class="row justify-content-center">
			<div class="col-xl-7 ftco-animate">
				<form action="{{url('/payer')}}" method="POST" id="checkout-form" class="billing-form">
					{{ csrf_field() }}
					<h3 class="mb-4 billing-heading">Billing Details</h3>
					@if (Session::has('error'))
						<div class="alert alert-danger">
							{{Session::get('error')}}
							{{Session::put('error')}}
						</div>
                    @endif
					<div class="row align-items-end">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Full Name</label>
								<input type="text" name="name" class="form-control" placeholder="">
					  		</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="adress">Address</label>
								<input type="text" name="address" class="form-control" placeholder="">
							</div>
				  		</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="card-name">Name on Card</label>
								<input type="text" name="card_name" id="card-name" class="form-control" placeholder="">
							</div>
				  		</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="card-number">Number</label>
								<input type="number" name="card_number" id="card-number" class="form-control" placeholder="">
							</div>
				  		</div>
						  <div class="col-md-6">
							<div class="form-group">
								<label for="card-expiry-month">Expiration Month</label>
								<input type="text" name="card_expiry_month" id="card-expiry-month" class="form-control" placeholder="">
							</div>
				  		</div>
						  <div class="col-md-6">
							<div class="form-group">
								<label for="card-expiry-year">Expiration Year</label>
								<input type="text" name="card_expiry_year" id="card-expiry-year" class="form-control" placeholder="">
							</div>
				  		</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="card-cvc">CVC</label>
								<input type="number" name="card_cvc" id="card-cvc" class="form-control" placeholder="">
							</div>
				  		</div>

					  <div class="col-md-12">
						<div class="form-group">
							<input type="submit" value="Acheter" class="btn btn-primary">
						</div>
				  	</div>
				  </div>
				</form><!-- END -->
			</div>
			<div class="col-xl-5">
				<div class="row mt-5 pt-3">
					<div class="col-md-12 d-flex mb-5">
						<div class="cart-detail cart-total p-3 p-md-4">
							<h3 class="billing-heading mb-4">Cart Total</h3>
							<p class="d-flex">
									  <span>Subtotal</span>
									  <span>$20.60</span>
								  </p>
								  <p class="d-flex">
									  <span>Delivery</span>
									  <span>$0.00</span>
								  </p>
								  <p class="d-flex">
									  <span>Discount</span>
									  <span>$3.00</span>
								  </p>
								  <hr>
								  <p class="d-flex total-price">
									  <span>Total</span>
									  <span>{{Session::get('cart')->totalPrice}} FCFA</span>
								  </p>
								  </div>
					</div>
					<div class="col-md-12">
						<div class="cart-detail p-3 p-md-4">
							<h3 class="billing-heading mb-4">Payment Method</h3>
									  <div class="form-group">
										  <div class="col-md-12">
											  <div class="radio">
												 <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
											  </div>
										  </div>
									  </div>
									  <div class="form-group">
										  <div class="col-md-12">
											  <div class="radio">
												 <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
											  </div>
										  </div>
									  </div>
									  <div class="form-group">
										  <div class="col-md-12">
											  <div class="radio">
												 <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
											  </div>
										  </div>
									  </div>
									  <div class="form-group">
										  <div class="col-md-12">
											  <div class="checkbox">
												 <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											  </div>
										  </div>
									  </div>
									  <p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
								  </div>
					</div>
				</div>
			</div> <!-- .col-md-8 -->
		  </div>
		</div>
	  </section> <!-- .section -->

	@endsection
		
	@section('scripts')

	<script src="https://js.stripe.com/v2/"></script>
	<script src="src/js/checkout.js"></script>
		
	<script>
		$(document).ready(function(){

		var quantitiy=0;
		$('.quantity-right-plus').click(function(e){
				
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());
				
				// If is not undefined
					
					$('#quantity').val(quantity + 1);

				
					// Increment
				
			});

			$('.quantity-left-minus').click(function(e){
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());
				
				// If is not undefined
			
					// Increment
					if(quantity>0){
					$('#quantity').val(quantity - 1);
					}
			});
			
		});
	</script>

	@endsection

{{-- Start content --}}