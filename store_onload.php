<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$catID = $_REQUEST['catID'];

$id_no = 1;
$store_count = 0;
$prv_websiteName = "";
$prv_websiteID = 0;

$predicate = "WHERE CategoryID = " . $catID;
$all_store_count = $db_object->get_count('CouponCategoryInfo', $predicate);

$predicates = 'select WebsiteID from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID WHERE CategoryID = ' . $catID;
$results = $db_object->execute_query($predicates);
// $store_name = $db_object->get_data_by_store();

$id = 'store_' . $id_no;
//$all_store_count = $db_object->get_count('Website');


$store_checkbox_element = '<br><input type="checkbox" name="store" id="' . $id . '" value=0 checked/>';
$label = '<label id="label_store_1" for="' . $id . '">All(' . $all_store_count .')</label><br>';
$store_checkbox_element .= $label;
echo $store_checkbox_element;

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
        $id = 'store_' . $id_no;
        $label_id = 'label_'.$id;
        $store_checkbox_element = '<input type="checkbox" name="store" id="' . $id . '" value='. $prv_websiteID . ' checked/>';
        $label = '<label id="'. $label_id .'" for="' . $id . '">' . $prv_websiteName . '(' . $store_count .')</label><br>';
        $store_checkbox_element .= $label;
        echo $store_checkbox_element;

        $prv_websiteID = $row['WebsiteID'];
        $prv_websiteName = $db_object->get_WebsiteName($prv_websiteID);
        $store_count = 1;
    }
}

?>