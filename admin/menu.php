<?php
include("connexion/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["admin_id"]))
{
    header('location:login.php');
}
else
{	
?>
<!--slider menu-->
<div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
			      <!--<img id="logo" src="" alt="Logo"/>--> 
			  </a> </div>		  
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
				<li id="menu-comunicacao" ><a href="restaurants.php"><i class="fa fa-cutlery"></i><span>Restaurant(s)</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-comunicacao-sub" >
		            <li id="menu-mensagens" style="width: 120px" ><a href="add_restaurant.php">Ajouter</a>		              
		            </li>
		          </ul>
		        </li>
		        <li id="menu-comunicacao" ><a href="gerants.php"><i class="fa fa-user"></i><span>Gérant(s)</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-comunicacao-sub" >
		            <li id="menu-mensagens" style="width: 120px" ><a href="add_gerant.php">Ajouter</a>		              
		            </li>
		          </ul>
		        </li>
				<li><a href="reservation.php"><i class="fa fa-calendar"></i><span>Réservations</span></a>
				<li><a href="commande.php"><i class="fa fa-phone"></i><span>Commandes</span><span  style="float: right"></span></a>
				<li><a href="commentaires.php"><i class="fa fa-comments-o"></i><span>Commentaires</span><span style="float: right"></span></a>
		          
		          <li><a href="maps.html"><i class="fa fa-map-marker"></i><span>Maps</span></a></li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<script>
var toggle = true;
            
$(".sidebar-icon").click(function() {                
  if (toggle)
  {
    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    $("#menu span").css({"position":"absolute"});
  }
  else
  {
    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
    setTimeout(function() {
      $("#menu span").css({"position":"relative"});
    }, 400);
  }               
                toggle = !toggle;
            });
</script>
<!--scrolling js-->

<?php
}
?>