<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();

include ("header.php");

$req="SELECT foods.*,restaurant.name as nom_restau,restaurant.image as image_restau FROM foods 
join restaurant on foods.restaurant_id=restaurant.id WHERE foods.id='".$_GET['food_id']."'";
$stmt = $db->prepare($req);
$stmt->execute();
$f=$stmt->fetchAll(PDO::FETCH_BOTH);
foreach ($f as $food) {}
?>

    <script src="filtrer/js/jquery-1.10.2.min.js"></script>

<section class="flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(admins/images/restaurants/<?php echo $food['image_restau']; ?>); background-attachment: fixed;">
		<h2 class="tit11 t-center">
        <?php echo $food['nom_restau']; ?>
		</h2>
	</section>

    	<!-- cart section end -->
	<section class="cart-section spad m-t-50">
		<form method="POST" action="add_commande.php">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<h3>Votre commande</h3>
						<div class="cart-table-warp">
							<table class="table table-bordered table-responsive">
							  <thead>
							    <tr>
							      	<th scope="col">Nom de plat</th>
	                                <th scope="col">Ingrédients</th>
	                                <th scope="col">Prix</th>
	                                <th scope="col">Quantité</th>
	                                <th scope="col">Prix Totale</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
	                                <td> <?php echo $food['name']; ?></td>
	                                <td> <?php echo $food['description']; ?></td>
	                                <td> <?php echo $food['price']; ?> DT</td>
	                                <td><input type="number" min="1" value="1" class="number" name="qty"></td>
	                                <td class="prix_total1"><?php echo $food['price']; ?> DT</td>
                                </tr>
							  </tbody>
							</table>
						</div>
						<div class="total-cost">
							<h6>Totale <span class="prix_total2"><?php echo $food['price']; ?> DT</span></h6>
						</div>
					</div>
				</div>
			
				<input type="hidden" name="food_id" value="<?php echo $food['id']; ?>">
				<input type="hidden" name="price_unit" class="price_unit" value="<?php echo $food['price']; ?>">
				<input type="hidden" name="price_total" class="price_total" value="<?php echo $food['price']; ?>">
            

				<div class="col-lg-4 card-right p-b-20">
				<?php if(isset($_SESSION['user_id'])) {  ?>
					<input type="submit" class="btn btn-primary" name="commander" value="Commander">
				<?php } else { ?>
					<a href="login.php" class="btn btn-primary">Connectez-vous</a>
				<?php } ?>
                    <a href="restaurants.php" class="btn btn-danger">Annuler</a>
				</div>
			</div>
		</div>
		</form>
	</section>
	<!-- cart section end -->
	
	<script>
		$(document).ready(function(){
			$('.number').on('input',function(){
			var qty = $('.number').val();
			var price_unit = $('.price_unit').val();
			var sum = qty*price_unit;
			$('.prix_total1').html(sum+'.000 DT');
			$('.prix_total2').html(sum+'.000 DT');
			$('.price_total').val(sum);
			});
		});
	</script>

    <style>
    .scrollbar {
	margin: 80px auto 0;
	width: 100%;
	height: 7px;
	line-height: 0;
	background: #ececec;
	overflow: hidden;
}

.scrollbar .handle {
	width: 100px;
	height: 100%;
	background: #fff;
	cursor: pointer;
}

.scrollbar .handle .mousearea {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 7px;
	background: #b09d81;
	border-radius: 30px;
}

.cart-table {
	padding: 40px 34px 0;
	background: rgba(233, 236, 239, 0.23);
	border-radius: 27px;
	overflow: hidden;
    margin-bottom: 3em;
    border: 1px solid #ed222a;
}

.cart-table h3 {
	font-weight: 700;
	margin-bottom: 37px;
}

.cart-table table {
	width: 100%;
	min-width: 442px;
	margin-bottom: 17px;
}

.cart-table .total-cost {
	background: #ed222a;
	margin: 0 -34px;
	text-align: right;
	padding: 22px 0;
	padding-right: 50px;
}

.cart-table .total-cost h6 {
	line-height: 1;
	font-size: 18px;
	font-weight: 700;
	color: #fff;
}

.cart-table .total-cost h6 span {
	margin-left: 38px;
}
.number{
	box-shadow: 0 0 0px 2px #ec1d25;
}

.cart-table table th,td{
	text-align: center;
}

    </style>


<?php include("footer.php"); ?>