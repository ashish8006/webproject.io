<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo base_url();?>">Home</a></li>
				  <li class="active">Payment</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php $cart_content = $this->cart->contents();
						
						?>

						<?php foreach ($cart_content as $items){ 
							$_SESSION['product_id'] = $items['id'].',';
							//  $this->session->set_userdata('product_id',$items['id'].',');
						
							?>
							
						<tr>
							<td class="cart_product">
								<a href=""><img  width="100" src="<?php echo $items['options']['pro_image']?>" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $items['name']?></a></h4>
							</td>
							<td class="cart_price">
								<p>$<?php echo $items['price']?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="<?php echo base_url()?>update-cart-qty-payment" method="post">
										<a class="cart_quantity_up" href=""> + </a>
										<input class="cart_quantity_input" type="text" name="qty" value="<?php echo $items['qty']?>" autocomplete="off" size="2">
										<a class="cart_quantity_down" href=""> - </a>
										<input  type="hidden" name="rowid" value="<?php echo $items['rowid']?>">
										<input  type="submit"  value="Update"/>
									<form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<?php echo $items['subtotal']?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="<?php echo base_url()?>delete-to-cart-payment/<?php echo $items['rowid']?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<?php 
								$cart_total = $this->cart->total();
							?>
							<li>Cart Sub Total <span>$<?php echo $cart_total;?></span></li>
							<?php
								$tax = ($cart_total*2)/100;
							?>
							<li>Eco Tax 2% <span>$<?php echo $tax?></span></li>
							<!-- Shipping Cost Dependend Quantity, price, buyer distance etc -->
							<?php
								if($cart_total>0 && $cart_total<49){
									$shiping = 0;
								}elseif($cart_total>50 && $cart_total<98){
									$shiping = 2;
								}elseif($cart_total>99 && $cart_total<198){
									$shiping = 5;
								}elseif($cart_total>199){
									$shiping = 10;
								}elseif($cart_total==0){
									$shiping = 0;
								}
							?>
							<li>Shipping Cost <span>$<?php echo $shiping?></span></li>
							<?php $g_total = $cart_total+$tax+$shiping;?>
							<li>Total <span>$<?php echo $g_total;?></span></li>
						</ul>
							<form action="<?php echo base_url()?>update-cart-qty-payment" method="post" >	
							
							</form>	
					</div>
				</div>
				<div class="col-sm-6">
					<form action="<?php echo base_url()?>place-order" method="post" >
						<div class="payment-options">
							<div class="order-message">
								<p class="alert alert-warning">Shipping Order</p>
								<?php echo $this->session->flashdata("flash_msg")?>
								<textarea name="payment_message"  placeholder="Notes about your order, Special Notes for Delivery" rows="10"></textarea>
							</div>	
							<!-- <span>
								<label><input type="radio"  name="payment_gateway" class="payment_btn" value="cash_on_delivery"> Cash on delivery</label>
							</span>
							<span>
								<label><input type="radio"  name="payment_gateway"  class="payment_btn" value="paypal_payment">Razorpay</label>
							</span> -->

						
								<div class="row">
									<div class="col-lg-12 col-md-6">
									<div class="radio_container">
							<input type="radio" name="payment_gateway" id="one"  value="cash_on_delivery" checked>
							<label for="one">Cash on delivery</label>
							<input type="radio" name="payment_gateway" value="paypal_payment" id="two">
							<label for="two"><a href="http://localhost/pari_app/checkout/pay"> Pay Online</a></label>
								</div>
									</div>
									
								</div>



							<span>
								<input type="submit" name="btn" class="btn btn-primary" value="Place Order">
							</span>
						</div>
					</form>
				</div>

			</div>
		</div>
	</section><!--/#do_action-->
	<style>
		
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700");

.radio_container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    background-color: #cecece;
    width: 560px;
    height: 50px;
    border-radius: 9999px;
    box-shadow: inset 0.5px 0.5px 2px 0 rgba(0, 0, 0, 0.15);
}

input[type="radio"] {
    appearance: none;
    display: none;
}

label {
    font-family: "Open Sans", sans-serif;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: inherit;
    width: 225px;
    height: 40px;
    text-align: center;
    border-radius: 9999px;
    overflow: hidden;
    transition: linear 0.3s;
    color: #6e6e6edd;
}

input[type="radio"]:checked + label {
    background-color: #1e90ff;
    color: #f1f3f5;
    font-weight: 900;
    transition: 0.3s;
}

	</style>
	