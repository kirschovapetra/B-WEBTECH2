//https://www.ihbc.org.uk/consultationsdb_new/examples/api/multi_filter.html
$(document).ready(function() {
    $('.withoutFilter').DataTable({
        info: false,
        paging: false
    });

    $('#table_id #filters th').each(function () {
        var title = $('#table_id #filters th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="Filter: ' + title + '" />');
    });
    $('#table_id2 #filters2 th').each(function () {
        var title = $('#table_id2 #filters2 th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="Filter: ' + title + '" />');
    });

    var table = $('#table_id').DataTable({
        info: false,
        paging: false
    });
    var table2 = $('#table_id2').DataTable({
        info: false,
        paging: false
    });

    if (table.columns().eq(0)) {
        table.columns().eq(0).each(function (colIdx) {
            $('input', table.column(colIdx).header()).on('keyup change', function () {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        })
    }
    if (table2.columns().eq(0)) {
        table2.columns().eq(0).each(function (colIdx) {
            $('input', table2.column(colIdx).header()).on('keyup change', function () {
                table2
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
    }
});
