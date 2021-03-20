//https://www.ihbc.org.uk/consultationsdb_new/examples/api/multi_filter.html
//tabulky
$(document).ready(function(){
    $('#table_id #filters th').each(function () {
        var title = $('#table_id #filters th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="Filter: ' + title + '" />');
    });
    var table = $('#table_id').DataTable({
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
});

//zobrazenie/skrytie statistik prihlasenia
var statsVisible = false;
function showStats(button) {
    var stats = document.getElementById("stats");
    if (statsVisible){
        button.innerHTML = "Zobraziť štatistiky";
        stats.style.display = "none";
        statsVisible = false;
    }
    else {
        button.innerHTML = "Skryť štatistiky";
        stats.style.display = "block";
        statsVisible = true;
    }
}

//zobrazenie/skrytie historie prihlaseni
var historyVisible = false;
function showHistory(button) {
    var hist = document.getElementById("history");
    if (historyVisible){
        button.innerHTML = "Zobraziť minulé prihlásenia";

        hist.style.display = "none";
        historyVisible = false;
    }
    else {

        button.innerHTML = "Skryť minulé prihlásenia";
        hist.style.display = "block";
        historyVisible = true;
    }
}