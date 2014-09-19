<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$array = json_decode($_REQUEST['store'], true);

$IsDealID = intval($array[0]);
$categoryID = intval($array[1]);
$subcategoryID = intval($array[2]);

$predicate = " WHERE CouponCategoryInfo.CategoryID=".$categoryID;

if ($IsDealID != 2) {
    $predicate .= " AND Coupon.IsDeal=".$IsDealID;
}
if ($subcategoryID != 0) {
    $predicate .= " AND CouponCategoryInfo.SubCategoryID=".$subcategoryID;
}

$predicate .= ' ORDER BY WebsiteID ASC';
$query = 'select WebsiteID from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID'.$predicate;
//echo $query;
$results = $db_object->execute_query($query);

$all_store_count = 0;
while ($row = mysqli_fetch_array($results)) {
    $all_store_count++;
}

$results = $db_object->execute_query($query);

$prv_websiteName = "";
$prv_websiteID = 0;
$store_count = 0;
$id_no = 1;

$label_id = 'label_store_1';
$label_text = 'All('.$all_store_count.')';

$array = array($label_id, $label_text);

while ($row = mysqli_fetch_array($results)) {
    if ($prv_websiteName == "") {
        $prv_websiteID = $row['WebsiteID'];
        $prv_websiteName = $db_object->get_WebsiteName($prv_websiteID);
        $store_count = 1;
    }
    elseif ($prv_websiteID == $row['WebsiteID']) {
        $store_count++;
    }
    else {
        $id_no++;
        $label_id = 'label_store_'.$id_no;
        $label_text = $prv_websiteName . '(' . $store_count .')';

        array_push($array, $label_id);
        array_push($array, $label_text);

        $prv_websiteID = $row['WebsiteID'];
        $prv_websiteName = $db_object->get_WebsiteName($prv_websiteID);
        $store_count = 1;
    }
}

echo json_encode($array);

?>