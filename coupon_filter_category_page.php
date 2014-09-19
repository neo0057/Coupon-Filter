<html>

    <title>Coupon Filter Category Page</title>
    <link rel="stylesheet" type="text/css" href="scroll.css">

    <?php
        $category = $_REQUEST['q'];
        //echo $category . "<br>";
        echo "<body onload='loadElements($category)'> 
                <form onchange='refresh_page($category)'>
                    <div id='coupon_types' name='coupon_type_name' class='coupon_type_class'></div>
                    <div id='store' class='store_class'></div>
                    <div id='subcategories' class='subcategory_class'></div>
                    <div id='data'></div>
                </form>
            </body>";

    ?>
    <script type="text/javascript" src="onload.js"></script>
    <script type="text/javascript" src="onclick.js"></script>
</html>
