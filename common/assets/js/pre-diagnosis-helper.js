var preDiagnosisItems = [];
var timeout = 0;
var preDiagnosisItemsContainer = $('#pre-diagnosis-items-container');

$(document).on('click', '.btn-remove-pre-diagnosis', function () {
    preDiagnosisItems.splice($(this).attr('data-id'), 1);
    updatePreDiagnosisItemsContainer();
});

$(document).ready(function () {
    var model_id = $('#workshop-id').val();
    var baseUrl = $('#base-url').val();

    if (model_id && baseUrl) {

        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: baseUrl + '/workshop/get-pre-diagnosis-items',
            data: {model_id: model_id, _csrf: csrfToken, XDEBUG_SESSION_START: 'netbeans-xdebug'},
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                preDiagnosisItems = response;
                /*preDiagnosisItems = response.pre_diagnosis;
                 for (var i in response.warehouse_devices) {
                 var item = response.warehouse_devices[i];
                 var newOption = new Option(item.name, item.id, false, false);
                 $('#devices-by-brand-list').append(newOption).trigger('change');
                 }*/
                updatePreDiagnosisItemsContainer();
            },
            error: function (jqXHR, status, error) {
                console.log(jqXHR);
            }
        });
    }
});

function addPreDiagnosisItem() {
    let selectedItem = $('#devices-by-brand-list').select2('data')[0];
    var newItem = {id: selectedItem.id, name: selectedItem.text, major_discount: selectedItem.element.getAttribute('data-major-discount'), price_out: selectedItem.element.getAttribute('data-price-out')};
    newItem.id = parseInt(newItem.id);
    if (Number.isInteger(newItem.id)) {
        var items = parseInt($('#new-pre-diagnosis-items').val());
        if (!isNaN(items) && items > 0) {
            newItem.items = items;
            var itemName = newItem.name;
            newItem.name = newItem.name.substring(0, newItem.name.indexOf('(max: ') - 1);
            var maxItems = selectedItem.element.getAttribute('data-max-items');
            /*var maxItems = itemName.substring(itemName.indexOf('(max: ') + 6);
             maxItems = maxItems.substring(0, maxItems.length - 1);*/
            var found = false;
            var error = false;
            for (var i in preDiagnosisItems) {
                if (preDiagnosisItems[i].id === newItem.id) {
                    found = true;
                    if (preDiagnosisItems[i].items + newItem.items <= maxItems) {
                        preDiagnosisItems[i].items += newItem.items;
                    } else {
                        error = true;
                        alert('La cantidad no puede ser mayor de ' + maxItems);
                    }
                }
            }
            if (!error) {
                if (!found) {
                    if (newItem.items <= maxItems) {
                        preDiagnosisItems.push(newItem);
                        $('#devices-by-brand-list').val(null).trigger('change');
                        $('#new-pre-diagnosis-items').val('');
                    } else {
                        error = true;
                        alert('La cantidad no puede ser mayor de ' + maxItems);
                    }
                }
                //$('#modal-pre-diagnosis').modal('hide');
                updatePreDiagnosisItemsContainer();
            }
        } else {
            alert('Debe introducir una cantidad correcta.');
            $('#new-pre-diagnosis-items').focus();
            //showSnackbar('warning', 'Debe introducir una cantidad correcta.');
        }
    } else {
        alert('Debe seleccionar un dispositivo.');
    }
}

function clearPreDiagnosisItems() {
    preDiagnosisItems = [];
    updatePreDiagnosisItemsContainer();
}

function showPreDiagnosisForm() {
    /*$('#devices-by-brand-list').val(null).trigger('change');
     $('#new-pre-diagnosis-items').val('');*/
    /*var newOption = new Option('Hola', 33, false, false);
     $('#devices-by-brand-list').append(newOption).trigger('change');*/
    /*$('#modal-pre-diagnosis').modal('show');*/
    var btn = $('#toggle-pre-diagnosis-form-status');
    if (btn.attr('data-status') === '0') {
        btn.html('<i style="font-size: 12px;" class="fa fa-arrow-up"></i> Ocultar formulario');
        $('#pre-diagnosis-form-container').removeClass('fadeOut hidden').addClass('fadeIn');
    } else {
        btn.html('<i style="font-size: 12px;" class="fa fa-arrow-down"></i> Mostrar formulario');
        $('#pre-diagnosis-form-container').removeClass('fadeIn').addClass('fadeOut');
        setTimeout(function () {
            $('#pre-diagnosis-form-container').addClass('hidden');
        }, 500);
    }
    btn.attr('data-status', (btn.attr('data-status') === '1') ? '0' : '1');
}

function showSnackbar(color, message) {
    clearTimeout(timeout);
    var snack = $('#snackbar');
    snack.removeClass('snackbar-default, snackbar-primary, snackbar-danger, snackbar-warning, snackbar-info')
    //snack.addClass('snackbar-' + color);
    $('#snackbar-message').html(message);
    snack.addClass('show');
    timeout = setTimeout(function () {
        snack.removeClass('show');
    }, 7000);
}

function hideSnackbar() {
    var snack = $('#snackbar');
    clearTimeout(timeout);
    snack.removeClass('show');
}

function updatePriceOut() {
    let sumPriceOut = 0, sumItemsMajorDiscount = 0;
    for (var i in preDiagnosisItems) {
        var item = preDiagnosisItems[i];
        sumPriceOut += (parseInt(item.price_out) * item.items);
        sumItemsMajorDiscount += (parseFloat(item.major_discount) * item.items);
    }
    let effort = parseFloat($('#workshop-effort').val());
    let discountApplied = parseFloat($('#workshop-discount_applied').val());
    if (discountApplied < 0) {
        alert('El descuento no puede ser menor de $0');
        $('#workshop-discount_applied').val(0);
        $('#workshop-discount_applied').focus();
    }
    else if (discountApplied > sumItemsMajorDiscount) {
        alert('El descuento no puede ser mayor de $' + sumItemsMajorDiscount);
        $('#workshop-discount_applied').val(sumItemsMajorDiscount);
        $('#workshop-discount_applied').focus();
    } else {
        sumPriceOut += effort ? effort : 0;
        sumPriceOut -= discountApplied ? discountApplied : 0;
        $('#workshop-final_price').val(sumPriceOut);
    }
}

function updatePreDiagnosisItemsContainer() {
    var content = "";
    let sumItemsQuantity = 0, sumItemsMajorDiscount = 0, sumPriceOut = 0;
    for (var i in preDiagnosisItems) {
        var item = preDiagnosisItems[i];
        sumItemsQuantity += parseInt(item.items);
        sumPriceOut += (parseInt(item.price_out) * item.items);
        sumItemsMajorDiscount += (parseFloat(item.major_discount) * item.items);
        content += '<div class="row animated fadeIn"><div class="col-sm-4"><span class="pre-diagnosis-info">' + item.name + '</span></div><div class="col-sm-2"><span class="pre-diagnosis-info">' + item.items + '</span></div><div class="col-sm-2"><span class="pre-diagnosis-info">' + item.major_discount + '</span></div><div class="col-sm-2"><button data-id="' + i + '" type="button" class="btn btn-xs btn-danger btn-remove-pre-diagnosis"><i class="material-icons">delete</i></button></div></div>';
    }
    sumItemsMajorDiscount = Math.round(sumItemsMajorDiscount * 100) / 100;
    content += '<div class="row animated fadeIn"><div class="col-sm-4"><span class="pre-diagnosis-info"><b>TOTAL</b></span></div><div class="col-sm-2"><span class="pre-diagnosis-info"><b>' + sumItemsQuantity + '</b></span></div><div class="col-sm-2"><span class="pre-diagnosis-info"><b>' + sumItemsMajorDiscount + '</b></span></div></div>';
    preDiagnosisItemsContainer.html(content);
    $('#pre-diagnosis-items').val(JSON.stringify(preDiagnosisItems));
    updatePriceOut();
}
