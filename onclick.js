// write the action going to perform when user click a radio/checkbox on the form.
function refresh_page(categoryID)
{
    replace_coupon_type_elements(categoryID);
    replace_store_elements(categoryID);
    replace_subcategory_elements(categoryID);
    replace_data_elements(categoryID);
}

function replace_coupon_type_elements(categoryID)
{
    var store_element = document.getElementsByName("store");
    var subcategory_element = document.getElementsByName("subcategory");

    var store_array = [];
    for(var i = 0; i < store_element.length; i++){
        if(store_element[i].checked){
            store_array.push(store_element[i].value);
        }
    }

    var subcategory_selected = 0;
    for(var i = 0; i < subcategory_element.length; i++){
        if(subcategory_element[i].checked){
            subcategory_selected = subcategory_element[i].value;
            break;
        }
    }
    store_array.push(categoryID);
    store_array.push(subcategory_selected);

    var xmlhttp_type;
    
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
            var arr = JSON.parse(xmlhttp_type.responseText);
            document.getElementById('label_coupon_type_1').innerHTML = arr['label_coupon_type_1'];
            document.getElementById('label_coupon_type_2').innerHTML = arr['label_coupon_type_2'];
            document.getElementById('label_coupon_type_3').innerHTML = arr['label_coupon_type_3'];
        }
    }
    var data = JSON.stringify(store_array);
    xmlhttp_type.open("GET", "coupon_type_onclick.php?coupon_type="+data, true);
    xmlhttp_type.send();
}

function replace_store_elements(categoryID)
{
    var coupon_type_element = document.getElementsByName("coupon_type");
    var subcategory_element = document.getElementsByName("subcategory");

    var array = [];
    for(var i = 0; i < coupon_type_element.length; i++){
        if(coupon_type_element[i].checked){
            array.push(coupon_type_element[i].value);
            break;
        }
    }

    array.push(categoryID);

    for(var i = 0; i < subcategory_element.length; i++){
        if(subcategory_element[i].checked){
            array.push(subcategory_element[i].value);
            break;
        }
    }

    var xmlhttp_store;
    
    if (window.XMLHttpRequest)
    {
        xmlhttp_store = new XMLHttpRequest();
    }
    else 
    {
        xmlhttp_store = new ActiveXObject("Microsoft.XMLHTTP");   
    }

    xmlhttp_store.onreadystatechange = function()
    {
        if (xmlhttp_store.readyState == 4 && xmlhttp_store.status == 200) {
            //console.log(xmlhttp_store.responseText);
            var arr = JSON.parse(xmlhttp_store.responseText);
            for (var i = 0; i < arr.length; i+=2) {
                if (i == 0) {
                    document.getElementById(arr[0]).innerHTML = arr[1];
                }
                else{
                    document.getElementById(arr[i]).innerHTML = arr[i+1];
                }
            }
        }
    }
    var data = JSON.stringify(array);
    xmlhttp_store.open("GET", "store_onclick.php?store="+data, true);
    xmlhttp_store.send();   
}

function replace_subcategory_elements(categoryID)
{
    var store_element = document.getElementsByName("store");
    var coupon_type_element = document.getElementsByName("coupon_type");

    var array = [];
    for(var i = 0; i < coupon_type_element.length; i++){
        if(coupon_type_element[i].checked){
            array.push(coupon_type_element[i].value);
            break;
        }
    }

    array.push(categoryID);

    for(var i = 0; i < store_element.length; i++){
        if(store_element[i].checked){
            array.push(store_element[i].value);
        }
    }

    var xmlhttp_subcategory;
    
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
        if (xmlhttp_subcategory.readyState == 4 && xmlhttp_subcategory.status == 200) {
            //console.log(xmlhttp_subcategory.responseText);
            var arr = JSON.parse(xmlhttp_subcategory.responseText);
            for (var i = 0; i < arr.length; i+=2) {
                if (i == 0) {
                    document.getElementById(arr[0]).innerHTML = arr[1];
                }
                else{
                    document.getElementById(arr[i]).innerHTML = arr[i+1];
                }
            }
        }
    }
    var data = JSON.stringify(array);
    xmlhttp_subcategory.open("GET", "subcategory_onclick.php?store="+data, true);
    xmlhttp_subcategory.send();   
}

function replace_data_elements(categoryID)
{
    var coupon_type_element = document.getElementsByName("coupon_type");
    var store_element = document.getElementsByName("store");
    var subcategory_element = document.getElementsByName("subcategory");

    var array = [];
    for(var i = 0; i < coupon_type_element.length; i++){
        if(coupon_type_element[i].checked){
            array.push(coupon_type_element[i].value);
            break;
        }
    }

    array.push(categoryID);

    for(var i = 0; i < subcategory_element.length; i++){
        if(subcategory_element[i].checked){
            array.push(subcategory_element[i].value);
            break;
        }
    }

    for(var i = 0; i < store_element.length; i++){
        if(store_element[i].checked){
            array.push(store_element[i].value);
        }
    }

    var xmlhttp_data;
    
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
        if (xmlhttp_data.readyState == 4 && xmlhttp_data.status == 200) {
            document.getElementById('data').innerHTML = "<br>Coupon Founds:" + xmlhttp_data.responseText;
        }
    }
    var data = JSON.stringify(array);
    xmlhttp_data.open("GET", "data_onclick.php?store="+data, true);
    xmlhttp_data.send();
}

function get_all_inside_elements(divname, prefix)   // not called yet anywhere
{
    var $list = $('#divname input[id^=prefix]');   // get all input controls with id prefix

    // once you have $list you can do whatever you want

    var ControlCnt = $list.length;
    // Now loop through list of controls
    $list.each( function() {

        var id = $(this).prop("id");      // get id
        var cbx = '';
        if ($(this).is(':checkbox') || $(this).is(':radio')) {
            // Need to see if this control is checked
        }
        else { 
            // Nope, not a checked control - so do something else
        }

    });
}