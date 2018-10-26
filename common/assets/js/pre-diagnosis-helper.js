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
    var newItem = JSON.parse($('#new-pre-diagnosis-item').val());
    newItem.id = parseInt(newItem.id);
    if (Number.isInteger(newItem.id)) {
        var items = parseInt($('#new-pre-diagnosis-items').val());
        if (!isNaN(items) && items > 0) {
            newItem.items = items;
            var itemName = newItem.name;
            newItem.name = newItem.name.substring(0, newItem.name.indexOf('(max: ') - 1);
            var maxItems = itemName.substring(itemName.indexOf('(max: ') + 6);
            maxItems = maxItems.substring(0, maxItems.length - 1);
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
                    } else {
                        error = true;
                        alert('La cantidad no puede ser mayor de ' + maxItems);
                    }
                }
                $('#modal-pre-diagnosis').modal('hide');
                updatePreDiagnosisItemsContainer();
                console.log(preDiagnosisItems);
            }
        } else {
            alert('Debe introducir una cantidad correcta.');
            //showSnackbar('warning', 'Debe introducir una cantidad correcta.');
        }
    } else {
        alert('Debe seleccionar un dispositivo');
        //showSnackbar('warning', 'Debe seleccionar un dispositivo');
    }
}

function showPreDiagnosisItemDlg() {
    $('#devices-by-brand-list').val(null).trigger('change');
    $('#new-pre-diagnosis-items').val('');
    /*var newOption = new Option('Hola', 33, false, false);
     $('#devices-by-brand-list').append(newOption).trigger('change');*/
    $('#modal-pre-diagnosis').modal('show');
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

function updatePreDiagnosisItemsContainer() {
    var content = "";
    for (var i in preDiagnosisItems) {
        var item = preDiagnosisItems[i];
        content += '<div class="row animated fadeIn"><div class="col-sm-4"><span class="pre-diagnosis-info">' + item.name + '</span></div><div class="col-sm-3"><span class="pre-diagnosis-info">' + item.items + '</span></div><div class="col-sm-4"><button data-id="' + i + '" type="button" class="btn btn-xs btn-danger btn-remove-pre-diagnosis"><i class="material-icons">delete</i></button></div></div>';
    }
    preDiagnosisItemsContainer.html(content);
    $('#pre-diagnosis-items').val(JSON.stringify(preDiagnosisItems));
}