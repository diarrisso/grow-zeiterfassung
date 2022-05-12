
const element = document.getElementById('datatable');
if(typeof(element) !== undefined && element != null){
    const datatable = new simpleDatatables.DataTable('#datatable', {
        searchable: true,
        perPage: 14,
        perPageSelect: [25, 50, 75, 100]
    });
    datatable.on(datatable.init, function() {
        new SlimSelect({
            select: dataTable-selector,
        showSearch: true
    });
    });
}