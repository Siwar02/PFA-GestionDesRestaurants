<?php
error_reporting(0);
//fetch_data.php

include('connexion/connect.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT restaurant.* FROM restaurant JOIN address on restaurant.address_id=address.id 
		JOIN foods on restaurant.id=foods.restaurant_id
		JOIN category on foods.categorie_id=category.id
	";
	/*if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}*/
	if(isset($_POST["address"]))
	{
		$address_filter = implode("','", $_POST["address"]);
		$query .= "
		 WHERE address.name IN('".$address_filter."')
		";
	}
	if(isset($_POST["category"]))
	{
		$category_filter = implode("','", $_POST["category"]);
		$query .= "
		 AND category.name IN('".$category_filter."')
		";
	}
	$query.="GROUP by restaurant.name";

	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$req = "SELECT (sum(rating.rating)/count(rating.id_restaurant))/100 AS percent,
			restaurant.name
			FROM rating 
			JOIN restaurant on rating.id_restaurant=restaurant.id
			WHERE rating.id_restaurant='".$row['id']."'
			GROUP BY rating.id_restaurant";
			$stmt = $db->prepare($req);
			$stmt->execute();
			$res = $stmt->fetchAll();
			foreach($res as $r){}
			if($stmt->rowCount()==0){
				$j='
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}
			elseif($r['percent']>0 && $r['percent']<=0.1){
				$j='
				<span class="fa fa-star-half-empty checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}
			elseif($r['percent']>0.1 && $r['percent']<=0.2){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}
			elseif($r['percent']>0.2 && $r['percent']<=0.3){
				$j='
					<span class="fa fa-star checked"></span>
					<span class="fa fa-star-half-empty checked"></span>
					<span class="fa fa-star-o checked"></span>
					<span class="fa fa-star-o checked"></span>
					<span class="fa fa-star-o checked"></span>
				';
				}
			elseif($r['percent']>0.3 && $r['percent']<=0.4){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}elseif($r['percent']>0.4 && $r['percent']<=0.5){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-half-empty checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}elseif($r['percent']>0.5 && $r['percent']<=0.6){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-o checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}elseif($r['percent']>0.6 && $r['percent']<=0.7){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-half-empty checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}elseif($r['percent']>0.7 && $r['percent']<=0.8){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-o checked"></span>
			';
			}elseif($r['percent']>0.8 && $r['percent']<=0.9){
			$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star-half-empty checked"></span>
			';
			}else{
				$j='
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
				<span class="fa fa-star checked"></span>
			';
			}
			$output .= '
			<div class="col-sm-4 col-lg-4 col-md-4">
				<div style="border:2px solid #ff9e9e; border-radius:5px; padding:10px;margin-bottom:2em;">
					<img src="gerant/images/restaurants/'. $row['image'] .'" alt="" class="img-responsive" style="width:100%;height:12em;">
					<p class="nom">'. $row['name'] .'</p>
					<p><b>Adresse :</b> '.$row['localisation'].'</p>
                    <p>
	                   '.$j.'
	                </p>
                    <a href ="restaurant.php?id='.$row['id'].'"><button class="btn btn-danger">Accéder</button></a>
				</div>
			</div>
			';
		}
	}
	else
	{
		$output = '<div class="alert alert-danger col-lg-12 text-center"><h3>No Data Found</h3></div>';
	}
	echo $output;
}

?>
<style>
.nom{
    font-weight: bold;
    font-size: 18px;
    color: #d00e0e;
    text-transform: capitalize;
    font-family: 'Courgette';
}
.checked{
    color: gold;
}
</style>