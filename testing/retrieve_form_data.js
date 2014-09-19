var values = [];
var ctv = document.getElementByClass("coupon_types");
for(var i = 0, ctLen = ctv.length; i < ctLen; i++){
  if(ctv[i].checked){
    values.push(ctv[i].value);
  } 
}
alert('You selected: ' + values.join(', '));
