<?php

// echo "Hello World!";
include_once("retrieve_data.php");

$db_object = new retrieve_data();

$array = json_decode($_REQUEST['store'], true);

$IsDeal = intval($array[0]);
$CategoryID = intval($array[1]);
$SubCategoryID = intval($array[2]);

$predicate = " WHERE CouponCategoryInfo.CategoryID=".$CategoryID;
if ($IsDeal != 2) {
    $predicate .= " AND Coupon.IsDeal=".$IsDeal;
}

if ($SubCategoryID != 0) {
    $predicate .= " AND CouponCategoryInfo.SubCategoryID=".$SubCategoryID;
}

$store_predicate = "";
for ($i = 3; $i < count($array); $i++) {
    $val = intval($array[$i]);
    if ($val == 0) {
        $store_predicate = "";
        break;
    }
    if ($store_predicate == "") {
        $store_predicate .= " Coupon.WebsiteID=".$val;
    }
    else{
        $store_predicate .= " OR Coupon.WebsiteID=".$val;
    }
}
if ($store_predicate != "") {
    $predicate .= ' AND (' .$store_predicate.' )';
}

$predicate .= ' ORDER BY Coupon.CountSuccess DESC';
$query = 'select * from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID=CouponCategoryInfo.CouponID ' . $predicate;
//echo $query;
$results = $db_object->execute_query($query);

echo '<table border="1" cellpadding="10" width="1000">
            <tr>
                <th>Offer Title</th>
                <th>Description</th>
                <th>Coupon Code/Deal</th>
                <th>Website Name</th>
                <th>Link</th>
            </tr>';

$count = 0;
while ($row = mysqli_fetch_array($results))
{
    $WebsiteID = $row['WebsiteID'];
    $div = ($row['CountSuccess'] + $row['CountFail']);
    if (($row['CountSuccess'] + $row['CountFail']) == 0) {
        $div = 1;
    }
    echo '<tr>
                <td>' . $row['Title'] . '</td>
                <td>' . $row['Description'] . '</td>
                <td>' . $row['CouponCode'] . '</td>
                <td>' . $db_object->get_WebsiteName($WebsiteID) . '</td>
                <td>' . $row['Link'] . '</td>
            </tr>';
    $count++;
 }
 //echo "count: ".$count;
 echo '</table>';

?>