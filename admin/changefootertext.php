<?php
ob_start();
session_start();
if ($_SESSION['name'] != 'my_admin') {
    header('location: login.php');
}
include_once './database/databasefile.php';
?>


<?php
if (isset($_POST['form_footer'])) {

    try {

        if (empty($_POST['footer_text'])) {
            throw new Exception("Footer Text can not be empty");
        }

        $statement = $db->prepare("UPDATE footer_text SET description=? WHERE id=1");
        $statement->execute(array($_POST['footer_text']));

        $success_message = "Footer text updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>

<?php
$statement = $db->prepare("SELECT * FROM footer_text WHERE id = 1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $description = $row['description'];
}
?>


<?php
include ('./header.php');
?>
<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->
<div class = "col-md-4 col-sm-6 col-xs-12">
    <div class = "blog-sec">



        <?php
        if (isset($error_message)) {
            echo "<div class='error'>" . $error_message . "</div>";
        }
        if (isset($success_message)) {
            echo "<div class='success'>" . $success_message . "</div>";
        }
        ?>
        <form action="" method="post">
            <table class="tbl1" style="margin-top: 70px;padding: 70px;">
                <tr>
                    <td><h2>Footer Text</h2></td>
                </tr>
                <tr>
                    <td><input class="long" type="text" name="footer_text" value="<?php echo $description; ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Save" name="form_footer"></td>
                </tr>
            </table>

        </form>

        <div class = "blog-info">
            <h2></h2>
        </div>
    </div>
</div>
<?php
include_once './footer.php';
?>