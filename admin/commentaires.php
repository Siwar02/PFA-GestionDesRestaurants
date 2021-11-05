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
include("header.php");  
 
?>
<!--inner block start here-->
<div class="inner-block">

<div class="market-updates">
      <div class="col-md-4 market-update-gd">
        <div class="market-update-block clr-block-5">
          <div class="col-md-8 market-update-left">
                    <?php 
                        $sql = "SELECT COUNT(id) as nbr_comments from comment";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                        $rowGer= $stmt->fetchAll(PDO::FETCH_BOTH);
                        foreach($rowGer as $number){  }
                    ?>
            <h3><?php echo $number['nbr_comments'] ?></h3>
            <h4>Commentaires(s).</h4>
            <p>Other hand, we denounce</p>
          </div>
          <div class="col-md-4 market-update-right">
              <i class="fa fa-comments"></i>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="clearfix"> </div>
  </div><br>
  
<div class="portlet-grid-page" style="margin-left: 13px;">  
      <h2>Les commentaires :</h2> 
        <?php 
            $sql = "SELECT * from restaurant";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rowRes= $stmt->fetchAll(PDO::FETCH_BOTH);
            foreach($rowRes as $res){
        ?>
      <div class="portlet-grid panel-success"> 
         <div class="header_comm">
              <h3 class="panel-title"><?php echo $res['name'] ?></h3>
          </div> 
          <div class="panel-body" style="text-align: justify;">
              <?php
                 $req="SELECT user.username as nom_user , comment.comment , comment.date
                 FROM comment
                 join user on comment.id_user = user.id
                 WHERE comment.id_restaurant='".$res['id']."'";
                 $st = $db->prepare($req);
                 $st->execute();
                 $rowComm= $st->fetchAll(PDO::FETCH_BOTH);
                 foreach($rowComm as $com){
              ?>
              <?php echo '<b class="nom_comm">'.$com['nom_user'].' : </b>' ?>
              <?php echo $com['comment'].'.<br>' ?>
              <?php $date=date_create($com['date']); echo 
              ' <span class="date">'.date_format($date,'Y/m/d').'</span><br>' ?><hr>
            <?php } ?>
            
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
