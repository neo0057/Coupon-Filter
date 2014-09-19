<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$id_no = 1;
$category_count = 0;
$prv_categoryID = 0;

$predicates = 'ORDER BY CategoryID ASC';
$results = $db_object->get_all_data('CouponCategoryInfo', $predicates);


$id = 'category_' . $id_no;

$category_option = '<option value="0">--Select a Category--</option>';
echo $category_option;

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

        $category_option = '<option value="' . $prv_categoryID . '"> '. $prv_categoryName . '(' . $category_count . ')</option>';
        echo $category_option;

        $prv_categoryID = $row['CategoryID'];
        $category_count = 1;
    }
}

?>