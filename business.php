<title>Business</title>

<?php
include_once 'header.php';
include ('../web_project/database/databasefile.php');
/* ===================== Pagination Code Starts ================== */
$adjacents = 2;

$statement = $db->prepare("SELECT * FROM news WHERE category_name = 'Business' ORDER BY id DESC");
$statement->execute();
$total_pages = $statement->rowCount();


$targetpage = $_SERVER['PHP_SELF'];   //your file name  (the name of this file)
$limit = 3;                                 //how many items to show per page
$page = @$_GET['page'];
if ($page)
    $start = ($page - 1) * $limit;          //first item to display on this page
else
    $start = 0;


$statement = $db->prepare("SELECT * FROM news WHERE category_name = 'Business' ORDER BY id DESC LIMIT $start, $limit");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);


if ($page == 0)
    $page = 1;                  //if no page var is given, default to 1.
$prev = $page - 1;                          //previous page is page - 1
$next = $page + 1;                          //next page is page + 1
$lastpage = ceil($total_pages / $limit);      //lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;
$pagination = "";
if ($lastpage > 1) {
    $pagination .= "<div class=\"pagination\">";
    if ($page > 1)
        $pagination.= "<a href=\"$targetpage?page=$prev\">&#171; previous</a>";
    else
        $pagination.= "<span class=\"disabled\">&#171; previous</span>";
    if ($lastpage < 7 + ($adjacents * 2)) {   //not enough pages to bother breaking it up
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page)
                $pagination.= "<span class=\"current\">$counter</span>";
            else
                $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
        }
    }
    elseif ($lastpage > 5 + ($adjacents * 2)) {    //enough pages to hide some
        if ($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
            $pagination.= "...";
            $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
            $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
        }
        else {
            $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
            $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
            $pagination.= "...";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
            }
        }
    }
    if ($page < $counter - 1)
        $pagination.= "<a href=\"$targetpage?page=$next\">next &#187;</a>";
    else
        $pagination.= "<span class=\"disabled\">next &#187;</span>";
    $pagination.= "</div>\n";
}
/* ===================== Pagination Code Ends ================== */
?>

<h2 class="service-title pad-bt15"></h2>
<p class="sub-title pad-bt15"></p>
<!--<hr class="bottom-line">-->

<?php
foreach ($result as $row) {
    ?>
    <div class = "col-md-4 col-sm-6 col-xs-12">
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
                $limited_word = substr($row['description'], 1, 100);
                
                echo $limited_word.'....';
                ?>
                <a href = "post.php?id=<?php echo $row['id'] ?>" class = "read-more">Read more →</a>
            </div>
        </div>
    </div>

    <?php
}
?>

<?php include_once './footer.php';
?>