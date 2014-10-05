function roundNumber(number, decimal_points) {
    if (!decimal_points)
        return Math.round(number);
    if (number == 0) {
        var decimals = "";
        for (var i = 0; i < decimal_points; i++)
            decimals += "0";
        return "0." + decimals;
    }

    var exponent = Math.pow(10, decimal_points);
    var num = Math.round((number * exponent)).toString();
    return num.slice(0, -1 * decimal_points) + "." + num.slice(-1 * decimal_points)
}
// Show the selected logo image


// Update total invoice amount
function update_total() {
    var total = 0;
    var taxrate =$('#tax_rate').find(':selected').data('rate');
    //var totalamount = 0;
    $('.item_total').each(function(i) {
        item_total = $(this).html().replace("$", "");
        if (!isNaN(item_total))
            total += Number(item_total);
    });

    subtotal = parseFloat(total);

    taxtotal = parseFloat(subtotal * taxrate / 100);

    total = roundNumber(subtotal + taxtotal, 2);

    $('span.subtotal').html(roundNumber(subtotal, 2));
    $('.subtotal').val(roundNumber(subtotal, 2));
 
    $('#taxtotal').html(roundNumber(taxtotal, 2));
    
    $('#invoice_total_tax').val(taxtotal);
    
    $('#total').html(total);
    $('.total').val(total);

    update_balance();
}

// Update total balance
function update_balance() {
    var due = $("#total").html().replace("$", "") - $("#paid").val().replace("$", "");
    due = roundNumber(due, 2);

    $('.due').html(due);
}

// Update prices
function update_price() {
    var row = $(this).parents('.item-row');
    var price = row.find('.cost').val().replace("$", "") * row.find('.qty').val();
    price = roundNumber(price, 2);
    isNaN(price) ? row.find('.item_total').html("N/A") : row.find('.item_total').html(price);

    update_total();
}

function bind() {
    $(".cost").blur(update_price);
    $(".qty").blur(update_price);
}
//format address from json response
function address(a) {
    var lines = [];
    if (a.info.name !== null && a.info.name)
        lines.push("<strong>" + a.info.name + "</strong>");
    if (a.info.address_1 !== null && a.info.address_1)
        lines.push(a.info.address_1);
    if (a.info.address_2 !== null && a.info.address_2)
        lines.push(a.info.address_2);
    if (a.info.city || a.info.state || a.info.zip) {
        var line = [];
        if (a.info.city !== null)
            line.push(a.info.city);
        if (a.info.state !== null)
            line.push(a.info.state);
        if (a.info.zip !== null)
            line.push(a.info.zip);
        lines.push(line.join(" "));
    }
    if (a.country !== null && a.country)
        lines.push(a.country);
    if (a.info.phone !== null && a.info.phone)
        lines.push(a.info.phone);
    if (a.info.email !== null && a.info.email && a.info.email)
        lines.push(a.info.email);
    if (a.info.web !== null && a.info.web)
        lines.push(a.info.web);
    return lines.join("<br>");
}
function logo(a) {
    var lines = [];
    if (a.image_path_thumbnail !== null && a.info.image_path_thumbnail){
        lines.push("<img src='" + a.image_path_thumbnail + "'>");
    } else {
         lines.push("<h1>" + a.info.name + "</h1>");
       
    }
    return lines.join("<br>");
}
