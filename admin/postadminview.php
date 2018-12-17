
<?php
include_once './database/databasefile.php';
ob_start();
session_start();
if ($_SESSION['name'] != 'my_admin') {
    header('location: login.php');
}
?>

<?php
include_once './header.php';
?>

<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->
<div class = "">
    <div class = "blog-sec">

        <?php
        if (!isset($_REQUEST['id'])) {
            header("location: viewpost.php");
        } else {
            $id = $_REQUEST['id'];
            $statement = $db->prepare("SELECT * FROM news WHERE id =?");
            $statement->execute(array($id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>
        <?php
        foreach ($result as $row) {
            ?>

            <table class="table table-responsive">
                <tr><td style="font-size: 30px;">Title</td></tr>
                <tr><td><?php echo $row['title'] ?></tr>
                <tr><td style="font-size: 30px;">Category</td></tr>
                <tr><td><?php echo $row['category_name'] ?></td></tr>
                <tr><td style="font-size: 30px;">Image</td></tr>
                <td><img src="../uploads/<?php echo $row['image']; ?>" alt="" width="200px" height="150px"></td>
                <tr><td style="font-size: 30px;">Description</td></tr>
                <tr><td><?php echo $row['description'] ?></td></tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php
include_once './footer.php';
?>