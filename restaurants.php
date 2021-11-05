<?php
include("connexion/connect.php"); 
error_reporting(0);
session_start();
include("header.php");
?>
<head>
    <script src="filtrer/js/jquery-1.10.2.min.js"></script>
    <script src="filtrer/js/jquery-ui.js"></script>
    <script src="filtrer/js/bootstrap.min.js"></script>
</head>
    



<section class="bg-gallery flex-c-m p-t-160 p-b-80 p-l-15 p-r-15" style="background-image: url(images/gallery21.jpg);">
</section><br>
<style>
.bg-gallery{
    width: 100%;
   height: 32em;
   background-attachment: fixed;
}
</style>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">      
                <div class="list-group m-b-30">
                    <h3 class="tit22">Région :</h3>
                    <div class="m-t-10" style="height: 173px; overflow-y: auto; overflow-x: hidden;border: 2px solid rgba(255, 0, 0, 0.38);">
                        <?php
                        $query = "SELECT name FROM address ORDER BY name ASC";
                        $statement = $db->prepare($query);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        foreach($result as $row)
                        {
                        ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector address" value="<?php echo $row['name']; ?>"  > <?php echo $row['name']; ?></label>
                    </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="list-group m-b-60">
                    <h3 class="tit22">Choix :</h3>
                    <div style="border: 2px solid rgba(255, 0, 0, 0.38);" class="m-t-10">
                    <?php

                    $query = "
                    SELECT name FROM category ORDER BY name ASC
                    ";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector category" value="<?php echo $row['name']; ?>" > <?php echo $row['name']; ?></label>
                    </div>
                    <?php    
                    }
                    ?>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <br />
                <div class="row filter_data">

                </div>
            </div>
        </div>
    </div>
  
<style>
#loading
{
    text-align:center; 
    background: url('loader.gif') no-repeat center; 
    height: 200px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var address = get_filter('address');
        var category = get_filter('category');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action,address:address, category:category},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

});
</script>








    <?php include("footer.php"); ?>


