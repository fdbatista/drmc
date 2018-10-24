$('.chk-select-all').click(function(){
    var dataId = $(this).attr('data-id');
    $('input[data-parent="' + dataId + '"]').prop('checked', $(this).prop('checked'));
});