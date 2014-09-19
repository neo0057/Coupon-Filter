<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$store_array = json_decode($_REQUEST['coupon_type'], true);

$subcategoryID = 0;
$len = count($store_array);

$categoryID = intval($store_array[$len-2]);
$subcategoryID = intval($store_array[$len-1]);

$predicate = " WHERE CouponCategoryInfo.CategoryID=".$categoryID;
$store_predicate = "";

for ($i=0; $i < $len-2; $i++) {
    $value = intval($store_array[$i]);
    if ($value == 0) {
        $store_predicate = "";
        break;
    }
    if ($store_predicate == "") {
        $store_predicate .= " Coupon.WebsiteID=".$value . ' ';
    }
    else{
        $store_predicate .= " OR Coupon.WebsiteID=".$value . ' ';
    }
}

if ($store_predicate != "") {
    $store_predicate = ' AND (' . $store_predicate . ' )'; 
}

$sub_predicate = "";
if ($subcategoryID > 0) {
    $sub_predicate .= ' AND CouponCategoryInfo.SubCategoryID='.$subcategoryID;
}

$predicate .= $store_predicate . $sub_predicate;

$predicate .= ' ORDER BY Coupon.IsDeal ASC';
$query = 'select IsDeal from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID' . $predicate;
$results = $db_object->execute_query($query);

$coupon_count = 0;
$all_count = 0;

while ($row = mysqli_fetch_array($results)) {
    $all_count++;
    if ($row['IsDeal'] == 0) {
        $coupon_count++;
    }
}

$label_id = 'label_coupon_type_1';

$all = 'All('.$all_count.')';
//$coupon_type_array = array('label_id'=>$label_id, 'count'=>$val);

$coupon = 'Coupons('.$coupon_count.')';
$deal   = 'Deals('.($all_count-$coupon_count).')';
$array = array(
    "label_coupon_type_1" => $all,
    "label_coupon_type_2" => $coupon,
    "label_coupon_type_3" => $deal,
);

echo json_encode($array);

?>