<?php

echo "Coupon Type: ";
include_once("retrieve_data.php");

$db_object = new retrieve_data();

$predicate = "WHERE IsDeal = 0";
$all_coupon_count = $db_object->get_count('Coupon');
$coupon_count = $db_object->get_count('Coupon',$predicate);

// All Count
$radio_element = '<input type="radio" name="coupon_type[]" id="coupon_type_1" value=2 checked/>';
$label = '<label for="coupon_type_1">All(' . $all_coupon_count .')</label>';
$radio_element .= $label;
echo $radio_element;

// Coupon Count
$radio_element = '<input type="radio" name="coupon_type[]" id="coupon_type_2" value=0/>';
$label = '<label for="coupon_type_2">Coupons(' . $coupon_count .')</label>';
$radio_element .= $label;
echo $radio_element;

// Deal Count
$radio_element = '<input type="radio" name="coupon_type[]" id="coupon_type_2" value=1/>';
$label_text = $all_coupon_count - $coupon_count;
$label = '<label for="coupon_type_3">Deals(' . $label_text .')</label>';
$radio_element .= $label;
echo $radio_element;

?>