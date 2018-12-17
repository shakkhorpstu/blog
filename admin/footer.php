<!---->
<?php
include_once './database/databasefile.php';
?>
</div>
</div>
<div class="col-sm-3">
    
    <div class="clear" style="clear: both;">
        
    </div>
    
    <h3>Settings</h3>
    <div class="list-group">
        <a href="changepassword.php" class="list-group-item">Change Password</a>
        <a href="changefootertext.php" class="list-group-item">Change Footer Text</a>
    </div>
</div>
</div>
</div>
<!---->
<footer id="footer">
    <div class="container">
        <div class="row text-center">
            <p>
            <?php
            include_once './database/databasefile.php';
            $statement = $db->prepare("SELECT * FROM footer_text WHERE id = 1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                echo $row['description'];
            }
            ?>
        </p>
<!--        <div class="credits">
             
                All the links in the footer should remain intact. 
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Baker
            
        </div>-->
    </div>
</div>
</footer>
<!---->
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/custom.js"></script>
<script src="contactform/contactform.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</body>
</html>