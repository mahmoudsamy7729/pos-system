function clearInput(target){
    target.value= "";
}

function deleteRow(btn) {
    numberofproducts--;
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    CalcQuantity();
    CalcTotal();
}
var numberofproducts = 0;
function GetSubTotal(ID)
{
    var Price = document.getElementById('price'+ID).innerHTML ;
    var Quantity = document.getElementById('quantity'+ID).value ;
    var SubTotal = document.getElementById('total'+ID);
    var HiddenSubTotal = document.getElementById('inv_products_'+ID);
    var ProductTotal = Price*Quantity;
    SubTotal.innerHTML = ProductTotal;
    HiddenSubTotal.value = ProductTotal;
    CalcQuantity();
    CalcTotal();
}
function CalcQuantity()
{
    var sum = 0;
    // or $( 'input[name^="ingredient"]' )
    $( 'input[name^="quantity"]' ).each( function( i , e ) {
        var v = parseInt( $( e ).val() );
        if ( !isNaN( v ) )
            sum += v;
    } );
    document.getElementById('invoice_quantity').innerHTML = numberofproducts + "("+sum+")"
    document.getElementById('Invoice_Quantity').value = numberofproducts + "("+sum+")"
}

function CalcTotal()
{
    var z = 0.0;
    var ShippingCost = document.getElementById("ShippingCost").value;
    var Type = document.getElementById("discount_type").value;
    var DiscountValue = document.getElementById("discount_value").value;
    var RealDiscount = DiscountValue;
    var elements = document.getElementById("pos-form").elements;
    for (var i = 0, element; element = elements[i++];) {
    if (element.type === "hidden"  && element.id.includes('inv_products_') )
    z = z + (element.value * 1);
    }
    document.getElementById("Invoice_Subtotal").value = (z).toFixed(2);
    if(Type == 1)
    {
        document.getElementById("invoice_discount").innerHTML = (Number(RealDiscount)).toFixed(2);
        document.getElementById("Invoice_Discount").value = (Number(RealDiscount)).toFixed(2);
    }else
    {
        RealDiscount = ( document.getElementById("Invoice_Subtotal").value * Number(DiscountValue) / 100).toFixed(2);
        document.getElementById("invoice_discount").innerHTML = ( document.getElementById("Invoice_Subtotal").value * Number(DiscountValue) / 100).toFixed(2);
        document.getElementById("Invoice_Discount").value = ( document.getElementById("Invoice_Subtotal").value * Number(DiscountValue) / 100).toFixed(2);
    }
    document.getElementById("all_subtotal").innerHTML = (z).toFixed(2);
    document.getElementById("all_total").innerHTML = (z + Number(ShippingCost) - Number(RealDiscount)).toFixed(2);
    document.getElementById("Invoice_Total").value = (z + Number(ShippingCost) - Number(RealDiscount)).toFixed(2);
    document.getElementById("totalPayment").value = document.getElementById("Invoice_Total").value ;


}

$("#OrderDiscount").on("hidden.bs.modal", function () {
    CalcTotal();
    
});
$("#Shipping").on("hidden.bs.modal", function () {
    document.getElementById("invoice_shipping").innerHTML = (Number(document.getElementById("ShippingCost").value)).toFixed(2);
    document.getElementById("Invoice_Shipping").value = (Number(document.getElementById("ShippingCost").value)).toFixed(2);
    CalcTotal();
});
