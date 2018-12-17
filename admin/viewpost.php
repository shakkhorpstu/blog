<?php
ob_start();
session_start();
if ($_SESSION['name'] != "my_admin") {
    header('location: login.php');
}

include_once './database/databasefile.php';
?>

<?php
include ('header.php');
?>

<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->
<div class = "col-md-4 col-sm-6 col-xs-12">
    <div class = "blog-sec">

        <h2>View All Posts</h2>
        <table class="tbl2" width="80%">
            <tr>
                <th width="5%">Serial</th>
                <th width="55%">Title</th>
                <th width="40%">Action</th>
            </tr>

            <?php
            $i = 0;
            $statement = $db->prepare("SELECT * FROM news ORDER BY id DESC");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $i++;
                ?>
                <tr>   
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><a href="postadminview.php?id=<?php echo $row['id']; ?>">View</a>
                        &nbsp;|
                        <a href="editpost.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;|
                        <a onclick="return confirm_delete();"  href="deletepost.php?id=<?php echo $row['id']; ?>">Delete</td>
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