<?php

include_once("retrieve_data.php");

$db_object = new retrieve_data();

$catID = $_REQUEST['catID'];

$id_no = 1;
$subcategory_count = 0;
$prv_subcategoryID = 0;

// echo $prv_categoryID;
$predicate = "WHERE CategoryID = " . $catID;
$all_category_count = $db_object->get_count('CouponCategoryInfo' , $predicate);

// $predicates = 'select WebsiteID from Coupon INNER JOIN CouponCategoryInfo ON Coupon.CouponID = CouponCategoryInfo.CouponID 
// WHERE CategoryID = ' . $catID;
$predicate = 'select SubCategoryID from CouponCategoryInfo WHERE CategoryID = ' . $catID . ' ORDER BY SubCategoryID ASC';
$results = $db_object->execute_query($predicate);


$id = 'subcategory_' . $id_no;

$SubCategory_checkbox_element = '<br><input type="radio" name="subcategory" id="' . $id . '" value=0 checked/>';
$label = '<label id="label_subcategory_1" for="' . $id . '">All(' . $all_category_count .')</label><br>';
$SubCategory_checkbox_element .= $label;
echo $SubCategory_checkbox_element;

while ($row = mysqli_fetch_array($results)) {
    if ($prv_subcategoryID == 0) {
        $prv_subcategoryID = $row['SubCategoryID'];
        $subcategory_count = 1;
    }
    elseif ($prv_subcategoryID == $row['SubCategoryID']) {
        $subcategory_count++;
    }
    else {
        $id_no++;
        $id = 'subcategory_' . $id_no;
        $label_id = 'label_'.$id;
        $prv_SubcategoryName = $db_object->get_SubCategoryName($prv_subcategoryID);
        $SubCategory_checkbox_element = '<input type="radio" name="subcategory" id="' . $id . '" value='. $prv_subcategoryID . '/>';
        $label = '<label id="' . $label_id . '" for="' . $id . '">' . $prv_SubcategoryName . '(' . $subcategory_count .')</label><br>';
        $SubCategory_checkbox_element .= $label;
        echo $SubCategory_checkbox_element;

        $prv_subcategoryID = $row['SubCategoryID'];
        $subcategory_count = 1;
    }
}

?>