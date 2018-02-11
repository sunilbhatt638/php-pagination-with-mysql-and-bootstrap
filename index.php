<?php
/*
Author : Sunil Bhatt
*/
require_once("dbclass.php");
require_once("pagination.class.php");
$dbConnection  = new Connection();
$perPage       = new sbpagination();

$page = 1;
if(!empty($_GET["page"]))
{
    $page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;


$sqlquery   = "SELECT * from pagination ";
$query      = $sqlquery . " limit " . $start . "," . $perPage->perpage; 
$getData    = $dbConnection->runQuery($query);

$rowcount      = $dbConnection->numRows($sqlquery);
$url = 'http://'.$_SERVER['SERVER_NAME'].'/php-pagination-with-mysql-and-bootstrap/';
$showpagination = $perPage->getAllPageLinks($url,$rowcount,$page,"page-item","link");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Pagination with Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>AJAX Pagination with PHP and Bootstrap</h2>
        <div class="col-md-12">
            <div id="pagination-result">
                <table class="table" style="width: 30%;">
                    <tbody>
                        <?php
                        foreach ($getData as $data)
                        {
                            echo "<tr><td>".$data["id"]."</td><td>".$data["country_name"]."</td><tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                if(!empty($showpagination))
                {
                    ?>
                    <ul class="pagination">
                        <?php echo $showpagination; ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
