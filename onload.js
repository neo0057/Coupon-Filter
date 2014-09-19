
function loadElements(categoryID) {
    // console.log(categoryID);
    loadCouponTypes(categoryID);
    loadStore(categoryID);
    loadSubCategories(categoryID);
    loadCouponData(categoryID);
}

function loadCouponTypes(categoryID){
    var xmlhttp_type;
    var coupon_type_element = document.getElementById("coupon_types");
    
    if (window.XMLHttpRequest)
    {
        xmlhttp_type = new XMLHttpRequest();
    }
    else 
    {
        xmlhttp_type = new ActiveXObject("Microsoft.XMLHTTP");   
    }

    xmlhttp_type.onreadystatechange = function()
    {
        if (xmlhttp_type.readyState == 4 && xmlhttp_type.status == 200) {
            coupon_type_element.innerHTML = "Coupon Types: " + xmlhttp_type.responseText;
        }
    }

    xmlhttp_type.open("GET", "coupon_type_onload.php?catID=" + categoryID, true);
    xmlhttp_type.send();

}

function loadStore(categoryID){

    var xmlhttp_store;
    var store_element = document.getElementById("store");

    if (window.XMLHttpRequest)
    {
        xmlhttp_store     = new XMLHttpRequest();
    }
    else 
    {
        xmlhttp_store     = new ActiveXObject("Microsoft.XMLHTTP");   
    }

    xmlhttp_store.onreadystatechange = function()
    {
        if (xmlhttp_store.readyState == 4 && xmlhttp_store.status == 200) {
            store_element.innerHTML = "Store: " + xmlhttp_store.responseText;
        }
    }

    xmlhttp_store.open("GET", "store_onload.php?catID=" + categoryID, true);
    xmlhttp_store.send();

}

function loadSubCategories(categoryID) {

    var xmlhttp_subcategory;
    var subcategories_element = document.getElementById("subcategories");

    if (window.XMLHttpRequest)
    {
        xmlhttp_subcategory = new XMLHttpRequest();
    }
    else
    {
        xmlhttp_subcategory = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp_subcategory.onreadystatechange = function()
    {
        if (xmlhttp_subcategory.readyState == 4 && xmlhttp_subcategory.status == 200)
        {
            subcategories_element.innerHTML = "Sub Categories: " + xmlhttp_subcategory.responseText;
        }
    }

    xmlhttp_subcategory.open("GET", "subcategory_onload.php?catID=" + categoryID, true);
    xmlhttp_subcategory.send();
}

function loadCategories() {

    var xmlhttp_category;
    var categories_element = document.getElementById("category_options");

    if (window.XMLHttpRequest)
    {
        xmlhttp_category = new XMLHttpRequest();
    }
    else
    {
        xmlhttp_category = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp_category.onreadystatechange = function()
    {
        if (xmlhttp_category.readyState == 4 && xmlhttp_category.status == 200)
        {
            categories_element.innerHTML = xmlhttp_category.responseText;
        }
    }

    xmlhttp_category.open("GET", "category_onload.php", true);
    xmlhttp_category.send();
}

function loadCouponData(categoryID)
{

    var xmlhttp_data;
    var data_element = document.getElementById("data");

    if (window.XMLHttpRequest)
    {
        xmlhttp_data = new XMLHttpRequest();
    }
    else
    {
        xmlhttp_data = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp_data.onreadystatechange = function()
    {
        if (xmlhttp_data.readyState == 4 && xmlhttp_data.status == 200)
        {
            data_element.innerHTML = "<br>Coupon Founds:" + xmlhttp_data.responseText;
        }
    }

    xmlhttp_data.open("POST", "data_onload.php?catID=" + categoryID, true);
    xmlhttp_data.send();
}

function redirect()
{
    var element = document.getElementById("category_options");
    var selected_category = element.options[element.selectedIndex].value;

    if (selected_category != 0) {
        window.location.replace("coupon_filter_category_page.php?q=" + selected_category);
    }
}