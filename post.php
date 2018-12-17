<title>Home</title>

<?php
include_once 'header.php';
include ('../web_project/database/databasefile.php');

if (!isset($_REQUEST['id'])) {
    header("location: index.php");
} 
else {
    $id = $_REQUEST['id'];
    $statement = $db->prepare("SELECT * FROM news WHERE id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
}

?>

<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<hr class="bottom-line">

<?php
foreach ($result as $row) {
    ?>
    <div class = "col-sm-9">
        <div class = "blog-sec">
            <div class = "blog-img">
                <a href = "">
                    <img src = "uploads/<?php echo $row['image']; ?>" class = "img-responsive">
                </a>
            </div>
            <div class = "blog-info">
                <h2><?php echo $row['title']; ?></h2>
                <div class = "blog-comment">
    <?php
    $date = $row['date'];
    $day = substr($date, 8, 2);
    $month = substr($date, 5, 2);
    $year = substr($date, 0, 4);
    if ($month == '01') {
        $month = "Jan";
    }
    if ($month == '02') {
        $month = "Feb";
    }
    if ($month == '03') {
        $month = "Mar";
    }
    if ($month == '04') {
        $month = "Apr";
    }
    if ($month == '05') {
        $month = "May";
    }
    if ($month == '06') {
        $month = "Jun";
    }
    if ($month == '07') {
        $month = "Jul";
    }
    if ($month == '08') {
        $month = "Aug";
    }
    if ($month == '09') {
        $month = "Sep";
    }
    if ($month == '10') {
        $month = "Oct";
    }
    if ($month == '11') {
        $month = "Nov";
    }
    if ($month == '12') {
        $month = "Dec";
    }
    ?>
                    <p>Posted at: <span><?php echo $day . '   ' . $month . '   ' . $year; ?></span></p>
                    <p><span><a href = "#"><i class = "fa fa-eye"></i></a> 11</span></p>
                </div>
    <?php
    echo $row['description'];
    ?>
            </div>
        </div>
    </div>

    <?php
}
?>

<?php include_once './footer.php';
?>