<?php
ob_start();
session_start();
if ($_SESSION['name'] != "my_admin") {
    header('location: login.php');
}

include_once './database/databasefile.php';
?>

<?php
if (!isset($_REQUEST['id'])) {
    header("location: viewpost.php");
} else {
    $id = $_REQUEST['id'];
}
?>

<?php
if (isset($_POST['form_update'])) {


    try {

        if (empty($_POST['title'])) {
            throw new Exception("Title can not be empty.");
        }

        if (empty($_POST['description'])) {
            throw new Exception("Description can not be empty.");
        }

        if (empty($_FILES["image"]["name"])) {

            $statement = $db->prepare("UPDATE news SET title=?, description=?, category_name=? WHERE id=?");
            $statement->execute(array($_POST['title'], $_POST['description'], $_POST['category_name'], $id));
        } else {

            $up_filename = $_FILES["image"]["name"];
            $file_basename = substr($up_filename, 0, strripos($up_filename, '.'));
            $file_ext = substr($up_filename, strripos($up_filename, '.'));
            $f1 = $id . $file_ext;

            if (($file_ext != '.png') && ($file_ext != '.jpg') && ($file_ext != '.jpeg') && ($file_ext != '.gif'))
                throw new Exception("Only jpg, jpeg, png and gif format images are allowed to upload.");


            $statement = $db->prepare("SELECT * FROM news WHERE id=?");
            $statement->execute(array($id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $real_path = "../uploads/" . $row['image'];
                unlink($real_path);
            }
            move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $f1);


            $statement = $db->prepare("UPDATE news SET title=?, description=?,image=? WHERE id=?");
            $statement->execute(array($_POST['title'], $_POST['description'], $f1, $id));
        }

        $success_message = "Post updated successfully.";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

$statement = $db->prepare("SELECT * FROM news WHERE id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $title = $row['title'];
    $description = $row['description'];
    $image = $row['image'];
}
?>

<?php
include ('./header.php');
?>

<?php
if (isset($error_message)) {
    echo "<div class='error'>" . $error_message . "</div>";
}
if (isset($success_message)) {
    echo "<div class='success'>" . $success_message . "</div>";
}
?>


<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->
<div class = "col-md-4 col-sm-6 col-xs-12">
    <div class = "blog-sec">

        <h2 style="font-size: 16px">Edit Post</h2>
        <form action="editpost.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <!--    <input type="hidden" name="id" value="//<?php //echo $id;//  ?>" name="id">-->
           <table class="table table-responsive">
                <tr><td>Title</td></tr>
                <tr><td><input class="long" type="text" name="title" value="<?php echo $title; ?>"></td></tr>
                <tr><td>Description</td></tr>
                <tr>
                    <td><textarea name="description" cols="30" rows="10">
                            <?php echo $description; ?>
                        </textarea>
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
                <tr><td>Previous Image</td></tr>
                <tr><td><img src="../uploads/<?php echo $image; ?>" alt="" width="200px"></td></tr>
                <tr><td>New Image</td></tr>
                <tr><td><input type="file" name="image" ></td></tr>
                <tr><td><input type="submit" value="Save" name="form_update"></td></tr>
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