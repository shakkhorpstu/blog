
<?php
include_once './database/databasefile.php';
ob_start();
session_start();
if ($_SESSION['name'] != 'my_admin') {
    header('location: login.php');
}
?>
<?php include("./header.php"); ?>
<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->

<div class = "col-md-4 col-sm-6 col-xs-12">
    <div class = "blog-sec">

        <?php
        if (isset($_POST['form1'])) {


            try {

                if (empty($_POST['title'])) {
                    throw new Exception("Title can not be empty.");
                }

                if (empty($_POST['description'])) {
                    throw new Exception("Description can not be empty.");
                }

                if (empty($_POST['category_name'])) {
                    throw new Exception("Category Name can not be empty.");
                }

                $statement = $db->prepare("SHOW TABLE STATUS LIKE 'news'");
                $statement->execute();
                $result = $statement->fetchAll();
                foreach ($result as $row)
                    $new_id = $row[10];


                $up_filename = $_FILES["image"]["name"];
                $file_basename = substr($up_filename, 0, strripos($up_filename, '.')); // strip extention
                $file_ext = substr($up_filename, strripos($up_filename, '.')); // strip name
                $f1 = $new_id . $file_ext;

                if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif'))
                    throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");

                move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $f1);

                $date = date('Y-m-d');
                $timestamp = strtotime(date('Y-m-d'));
                $year = substr($date, 0, 4);
                $month = substr($date, 5, 2);

                $statement = $db->prepare("INSERT INTO news (title,description,image,category_name,date,year,month,timestamp) VALUES (?,?,?,?,?,?,?,?)");
                $statement->execute(array($_POST['title'], $_POST['description'], $f1, $_POST['category_name'], $date, $year, $month, $timestamp));


                $success_message = "Post inserted successfully.";
            } catch (Exception $e) {
                $error_message = $e->getMessage();
            }
        }
        ?>



        <h2>Add New Post</h2>

        <?php
        if (isset($error_message)) {
            echo "<div class='error'>" . $error_message . "</div>";
        }
        if (isset($success_message)) {
            echo "<div class='success'>" . $success_message . "</div>";
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-responsive">
                <tr><td>Title</td></tr>
                <tr><td><input class="long" type="text" name="title"></td></tr>
                <tr><td>Description</td></tr>
                <tr>
                    <td>
                        <textarea name="description" cols="78" rows="30"></textarea>
                        <script type="text/javascript">
                            if (typeof CKEDITOR == 'undefined')
                            {
                                document.write(
                                        '<strong><span style="color: #ff0000">Error</span>: CKEditor not found</strong>.' +
                                        'This sample assumes that CKEditor (not included with CKFinder) is installed in' +
                                        'the "/ckeditor/" path. If you have it installed in a different place, just edit' +
                                        'this file, changing the wrong paths in the &lt;head&gt; (line 5) and the "BasePath"' +
                                        'value (line 32).');
                            }
                            else
                            {
                                var editor = CKEDITOR.replace('description');
                                //editor.setData( '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' );
                            }

                        </script>
                    </td>
                </tr>
                <tr><td>Featured Image</td></tr>
                <tr><td><input type="file" name="image"></td></tr>
                <tr><td>Select a Category</td></tr>
                <tr>
                    <td>
                        <select name="category_name">
                            <option value="">Select a Category</option>
                            <?php
                            $statement = $db->prepare("SELECT * FROM news_category ORDER BY category_name ASC");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                ?>
                                <option><?php echo $row['category_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr><td><input type="submit" value="SAVE" name="form1"></td></tr>
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