<?php

// echo "Hello World!";
include_once("retrieve_data.php");

$db_object = new retrieve_data();

$array = json_decode($_REQUEST['store'], true);

$IsDeal = intval($array[0]);
$categoryID = intval($array[1]);

$predicate = " WHERE CouponCategoryInfo.CategoryID=".$categoryID;
if ($IsDeal != 2) {
    $predicate .= " AND Coupon.IsDeal=".$IsDeal;
}

$store_predicate = "";
for ($i = 2; $i < count($array); $i++) {
    if ($array[$i] == 0) {
        $store_predicate = "";
        break;
    }
    if ($store_predicate == "") {
        $store_predicate .= " Coupon.WebsiteID=".$array[$i];
    }
    else{
        $store_predicate .= " OR Coupon.WebsiteID=".$array[$i];
    }
}
if ($store_predicate != "") {
    $predicate .= ' AND (' .$store_predicate.' )';
}

//echo $predicate;

$predicate .= 'ORDER BY SubCategoryID ASC';
$query = 'select SubCategoryID from CouponCategoryInfo INNER JOIN Coupon ON CouponCategoryInfo.CouponID = Coupon.CouponID' . $predicate;
$results = $db_object->execute_query($query);

$prv_SubCategoryName = "";
$prv_SubCategoryID = 0;
$store_count = 0;
$all_store_count = 0;
$id_no = 1;

while ($row = mysqli_fetch_array($results)) {
    $all_store_count++;
}

$results = $db_object->execute_query($query);

$label_id = 'label_subcategory_1';
$label_text = 'All('.$all_store_count.')';

$array = array($label_id, $label_text);

while ($row = mysqli_fetch_array($results)) {

    if ($prv_SubCategoryName == "") {
        $prv_SubCategoryID = $row['SubCategoryID'];
        $prv_SubCategoryName = $db_object->get_SubCategoryName($prv_SubCategoryID);
        $store_count = 1;
    }
    elseif ($prv_SubCategoryID == $row['SubCategoryID']) {
        $store_count++;
    }
    else {
        $id_no++;
        $label_id = 'label_subcategory_' . $id_no;
        $label_text = $prv_SubCategoryName . '(' . $store_count . ')';
        array_push($array, $label_id);
        array_push($array, $label_text);

        $prv_SubCategoryID = $row['SubCategoryID'];
        $prv_SubCategoryName = $db_object->get_SubCategoryName($prv_SubCategoryID);
        $store_count = 1;
    }
}
echo json_encode($array);

?>