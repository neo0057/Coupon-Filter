<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$id_no = 1;
$category_count = 0;
$prv_categoryID = 0;

$predicates = 'ORDER BY CategoryID ASC';
$results = $db_object->get_all_data('CouponCategoryInfo', $predicates);


$id = 'category_' . $id_no;
$all_category_count = $db_object->get_count('CouponCategoryInfo');

$category_checkbox_element = '<br><input type="radio" name="category[]" id="' . $id . '" value=0 checked/>';
$label = '<label for="' . $id . '">All(' . $all_category_count .')</label><br>';
$category_checkbox_element .= $label;
echo $category_checkbox_element;

while ($row = mysqli_fetch_array($results)) {
    if ($prv_categoryID == 0) {
        $prv_categoryID = $row['CategoryID'];
        $category_count = 1;
    }
    elseif ($prv_categoryID == $row['CategoryID']) {
        $category_count++;
    }
    else {
        $id_no++;
        $id = 'category_' . $id_no;
        $prv_categoryName = $db_object->get_CategoryName($prv_categoryID);
        $category_checkbox_element = '<input type="radio" name="category[]" id="' . $id . '" value='. $prv_categoryID . '/>';
        $label = '<label for="' . $id . '">' . $prv_categoryName . '(' . $category_count .')</label><br>';
        $category_checkbox_element .= $label;
        echo $category_checkbox_element;

        $prv_categoryID = $row['CategoryID'];
        $category_count = 1;
    }
}

?>