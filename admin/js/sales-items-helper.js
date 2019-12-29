let stockItems = [], cartItems = [];
let totalPrice = 0, maxDiscount = 0, discountApplied = 0, discountedPrice = 0, saleId = null;

$(document).ready(function () {
    getItemsForSaleAndCart();
});

function getItemsForSaleAndCart() {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    saleId = $('#sale_id').val();

    $.ajax({
        url: '/sales/get-available-items-for-sale',
        data: {_csrf: csrfToken, saleId: saleId},
        type: 'GET',
        dataType: 'json',
        success: function (json) {
            stockItems = json.stock;
            cartItems = json.cart;
            discountApplied = json.discount_applied;
            updateGUI();
        },
        error: function (jqXHR, status, error) {
            alert(jqXHR.responseJSON.message);
        },
        complete: function (jqXHR, status) {
            $('#btn-new-code').prop('disabled', false);
        }
    });
}

$("#new-item-code").on('keypress', function (e) {
    if (e.charCode === 13) {
        searchItemByCode();
    }
});

$("#btn-add-item").on('click', function () {
    searchItemByCode();
});

function searchItemByCode() {
    let code = $("#new-item-code").val();
    let itemsCount = stockItems.length;
    let itemFound;
    for (let i = 0; i < itemsCount; i++) {
        let item = stockItems[i];
        if (item.code.toLowerCase() === code.toLowerCase()) {
            itemFound = Object.assign({}, item);
            break;
        }
    }
    if (itemFound) {
        addItemToCart(itemFound);
        $("#new-item-code").val("");
    } else {
        alert('Código incorrecto.');
        $("#new-item-code").select();
    }
}

function addItemToCart(item) {
    let itemIndexInCart = getItemAttributeFromArray(cartItems, item, 'index');
    if (itemIndexInCart === null) {
        item.items = 1;
        item.price = item.price_out;
        cartItems.push(item);
    } else {
        alert(item.device_type + ' ' + item.brand_model + ' ya fue adicionado.');
    }
    updateGUI();
}

function updateGUI() {
    updateCartRows();
    $("#new-item-code").focus();
}

function updateCartRows() {
    let content = '';
    totalPrice = 0;
    maxDiscount = 0;
    let itemsCount = cartItems.length;

    for (let i = 0; i < itemsCount; i++) {
        let item = cartItems[i];
        totalPrice += parseFloat(item.price);
        maxDiscount += (getItemAttributeFromArray(stockItems, item, 'major_discount') * item.items);
        content += '<div class="row">';
        content += '<div class="col-sm-3"><label>' + item.device_type + '</label></div>';
        content += '<div class="col-sm-3"><label>' + item.brand_model + '</label></div>';
        content += '<div class="col-sm-2"><label>$' + item.price + '</label></div>';
        content += '<div class="col-sm-3"><label>' + item.items + '</label>';
        content += '<a class="btn-action btn-add" onclick="updateCartItemQuantity(' + i + ', 1)">+</a><a class="btn-action btn-substract" onclick="updateCartItemQuantity(' + i + ', -1)">-</a>';
        content += '</div>';
        content += '</div>';
    }

    if (totalPrice > 0) {
        content += '<div class="row">';
        content += '<div class="col-sm-3 col-sm-offset-3"><label class="bold">SUBTOTAL:</label></div>';
        content += '<div class="col-sm-2"><label class="bold">$' + totalPrice + '</label></div>';
        content += '</div>';

        content += '<div class="row mt-10">';
        content += '<div class="col-sm-3"><label>Descuento max:</label></div>';
        content += '<div class="col-sm-3"><label>$' + maxDiscount + '</label></div>';
        content += '</div>';

        content += '<div class="row">';
        content += '<div class="col-sm-3"><label>Descuento aplicar:</label></div>';
        content += '<div class="col-sm-2"><div class="form-group"><input onchange="substractDiscountFromTotalPrice()" value="' + discountApplied + '" id="discount-applied" class="form-control" style="margin-top: -40px;" /></div></div>';
        content += '</div>';

        content += '<div class="row">';
        content += '<div class="col-sm-3"><label>Total a pagar:</label></div>';
        content += '<div class="col-sm-3"><label id="discounted-price">$' + discountedPrice + '</label></div>';
        content += '</div>';

        content += '<div class="row">';
        content += '<div class="col-sm-3"><a id="btn-finish" onclick="sendItems()" class="btn btn-primary btn-sm"><i class="material-icons" style="top: 1px; margin-right: 3px;">check</i>Terminar</a></div>';
        content += '<div class="col-sm-3"><a id="btn-clear-cart" onclick="redirectToSaleDetailsView(null)" class="btn btn-danger btn-sm">Cancelar</a></div>';
        content += '</div>';
    }

    $('#cart-items').html(content);
    substractDiscountFromTotalPrice();
}

function sendItems() {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    let saleId = $('#sale_id').val();
    $('#btn-finish').prop('disabled', true);

    $.ajax({
        url: '/sales/ajax-set-items?_csrf=' + csrfToken,
        data: {sale_id: saleId, devices: cartItems, discount_applied: discountApplied},
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            $('#btn-finish').prop('disabled', false);
            alert(response.msg);
            redirectToSaleDetailsView(response.data);
        },
        error: function (jqXHR) {
            alert(jqXHR.responseText);
        },
        complete: function (jqXHR, status) {
            $('#btn-new-code').prop('disabled', false);
        }
    });
}

function redirectToSaleDetailsView(ajaxSaleId) {
    let currentUrl = window.location.href;
    let newUrl = (saleId) ? currentUrl.replace('update-items', 'view') : (ajaxSaleId) ? currentUrl.replace('create', 'view') + '?id=' + ajaxSaleId : currentUrl.replace('create', 'index');
    window.location.href = newUrl;
}

function clearCart() {
    cartItems = [];
    updateGUI();
}

function substractDiscountFromTotalPrice() {
    discountApplied = parseFloat($('#discount-applied').val());
    if (discountApplied <= maxDiscount) {
        discountedPrice = totalPrice - discountApplied;
    } else if (maxDiscount > 0) {
        //alert('El descuento aplicado no puede ser mayor que $' + maxDiscount);
        discountApplied = 0;
        discountedPrice = totalPrice;
        $('#discount-applied').val(0);
    }
    $('#discounted-price').html('$' + discountedPrice);
}

function updateCartItemQuantity(itemIndex, value) {
    let newQuantity = cartItems[itemIndex].items + value;
    if (newQuantity < 1) {
        cartItems.splice(itemIndex, 1);
    } else {
        let inStock = getItemAttributeFromArray(stockItems, cartItems[itemIndex], 'items');
        if (newQuantity > inStock) {
            alert('Puede adicionar hasta ' + inStock + ' unidades.');
        } else {
            cartItems[itemIndex].items = newQuantity;
            cartItems[itemIndex].price = cartItems[itemIndex].items * getItemAttributeFromArray(stockItems, cartItems[itemIndex], 'price_out');
        }
    }
    updateGUI();
}

function getItemAttributeFromArray(array, compareItem, returnAttrib) {
    let itemsCount = array.length;
    for (let i = 0; i < itemsCount; i++) {
        let arrayItem = array[i];
        if (itemsMatch(arrayItem, compareItem)) {
            return returnAttrib === 'index' ? i : arrayItem[returnAttrib];
        }
    }
    return null;
}

function itemsMatch(obj1, obj2) {
    return (obj1.device_type_id === obj2.device_type_id && obj1.brand_model_id === obj2.brand_model_id);
}
