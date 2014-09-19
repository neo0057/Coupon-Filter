<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$catID = $_REQUEST['catID'];

//$predicate = 'WHERE CategoryID = ' . $catID . ' ORDER BY CountSuccess DESC';

$query = 'select * from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID WHERE CouponCategoryInfo.CategoryID = ' . $catID . ' ORDER BY CountSuccess DESC';

$results = $db_object->execute_query($query);

echo '<table border="1" cellpadding="10" width="1000">
            <tr>
                <th>Offer Title</th>
                <th>Description</th>
                <th>Coupon Code/Deal</th>
                <th>Website Name</th>
                <th>Link</th>
            </tr>';

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
 }
 echo '</table>';

?>