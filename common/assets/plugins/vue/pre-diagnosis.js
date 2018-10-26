/*Vue.component('pre-diagnosis-item', {
 props: ['item'],
 template: '<div class="col-sm-4"><span class="pre-diagnosis-info">{{item.name}}</span></div><div class="col-sm-3"><span class="pre-diagnosis-info">{{item.items}}</span></div><div class="col-sm-4"><button @click="test()" type="button" class="btn btn-xs btn-danger"><i class="material-icons">delete</i></button></div>'
 });*/

var vm = new Vue({
    el: '#vue-app',
    data: {
        preDiagnosisItems: [],
        timeout: 0
    },
    mounted() {
    },
    methods: {
        addPreDiagnosisItem() {
            var newItem = $('#new-pre-diagnosis-item').val();
            if (newItem) {
                var newItem = JSON.parse(newItem);
                var items = parseInt($('#new-pre-diagnosis-items').val());
                if (!isNaN(items) && items > 0) {
                    newItem.items = items;
                    this.preDiagnosisItems.push(newItem);
                    $('#modal-pre-diagnosis').modal('hide');
                } else {
                    this.showSnackbar('warning', 'Debe introducir una cantidad correcta.');
                }
            } else {
                this.showSnackbar('warning', 'Debe seleccionar un dispositivo');
            }
        },
        showPreDiagnosisItemDlg() {
            $('#modal-pre-diagnosis').modal('show');
        },
        deletePreDiagnosisItem(index) {
            this.preDiagnosisItems.splice(index, 1);
        },
        showSnackbar(color, message) {
            clearTimeout(this.timeout);
            var snack = $('#snackbar');
            snack.removeClass('snackbar-default, snackbar-primary, snackbar-danger, snackbar-warning, snackbar-info')
            snack.addClass('snackbar-' + color);
            $('.snackbar-message').html(message);
            snack.addClass('show');
            this.timeout = setTimeout(function () {
                snack.removeClass('show');
            }, 7000);
        },
        hideSnackbar() {
            var snack = $('#snackbar');
            clearTimeout(this.timeout);
            snack.removeClass('show');
        }
    }
});

vm.$watch('preDiagnosis', function (newValue, oldValue) {
    console.log(newValue);
});
