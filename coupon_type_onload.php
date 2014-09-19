<?php

// echo "Hello World!";
include_once("retrieve_data.php");

$db_object = new retrieve_data();

//$categoryID = $_POST['category_option'];

$catID = $_REQUEST['catID'];

$predicate = "WHERE CategoryID = " . $catID;
$all_coupon_count = $db_object->get_count('CouponCategoryInfo', $predicate);

$predicate = "select Isdeal, CategoryID from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID";
$results = $db_object->execute_query($predicate);

$coupon_count = 0;

while ($row = mysqli_fetch_array($results)) {
    if ($row['CategoryID'] == $catID) {
        if ($row['Isdeal'] == 0) {
            $coupon_count++;
        }
    }
}

// All Count
$radio_element = '<br><input type="radio" name="coupon_type" id="coupon_type_1" value=2 checked/>';   // value = 2 for all (coupons + deal)
$label = '<label id="label_coupon_type_1" for="coupon_type_1">All(' . $all_coupon_count .')</label><br>';
$radio_element .= $label;
echo $radio_element;

// Coupon Count
$radio_element = '<input type="radio" name="coupon_type" id="coupon_type_2" value=0/>'; // value = 0 for Coupons
$label = '<label id="label_coupon_type_2" for="coupon_type_2">Coupons(' . $coupon_count .')</label><br>';
$radio_element .= $label;
echo $radio_element;

// Deal Count
$radio_element = '<input type="radio" name="coupon_type" id="coupon_type_3" value=1/>'; // value = 1 for deals
$deal_count = $all_coupon_count - $coupon_count;
$label = '<label id="label_coupon_type_3" for="coupon_type_3">Deals(' . $deal_count .')</label>';
$radio_element .= $label;
echo $radio_element;

?>