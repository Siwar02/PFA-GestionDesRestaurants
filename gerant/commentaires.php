<?php
include("connexion/connect.php");
error_reporting(0);
session_start();
if(empty($_SESSION["gerant_id"]))
{
    header('location:../login.php');
}
else
{
include("header.php");  
 
?>
<!--inner block start here-->
<div class="inner-block">
<div class="portlet-grid-page">  
      <h2>Les commentaires :</h2> 
        <?php 
            $sql = "SELECT comment.*,user.first_name,user.last_name FROM comment 
            JOIN admins on comment.id_restaurant=admins.id_restaurant
            join user on comment.id_user = user.id
            WHERE admins.id= '".$_SESSION['gerant_id']."' ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rowComm= $stmt->fetchAll(PDO::FETCH_BOTH);
            foreach($rowComm as $com){
        ?>
      <div class="portlet-grid panel-success"> 
         <div class="panel-heading">
              <h3 class="panel-title"><?php echo $com['first_name'].' '.$com['last_name'] ?></h3>
          </div> 
          <div class="panel-body">
              <?php echo $com['comment'] ?>
          </div>
          <div class="panel-footer">
              <p><?php echo $com['date'] ?></p>
          </div>
      </div>
        <?php } ?>
    <div class="clearfix"> </div>
  </div>

  </div>
<!--inner block end here-->
<?php include("footer.php");?>
</div>
</div>
<?php include("menu.php");?>
</body>
</html>                     
<?php
}
?>
