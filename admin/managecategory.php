<?php
include_once './header.php';
include ('./database/databasefile.php');
?>

<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->
    <div class = "col-md-4 col-sm-6 col-xs-12">
        <div class = "blog-sec">
            <span id="content" style="clear: both;">
    <h4 style=" padding-top: 5px;">
        View All Category</h4></span>

<table class="tbl2" width="50%" style="padding-top: 5px;">
    <tr>
        <th width="10%">Serial</th>
        <th width="60%">Category Name</th>
    </tr>
    
    <?php
     $i = 0;
     $statement = $db->prepare("SELECT * FROM news_category ORDER BY category_name ASC");
     $statement->execute(array());
     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
     foreach($result as $row){
         $i++;
         ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['category_name']?></td>
    </tr>
    <?php
         
     }
    
    ?>
</table>
            <div class = "blog-info">
                <h2></h2>
            </div>
        </div>
    </div>


<?php
include_once './footer.php';
?>
