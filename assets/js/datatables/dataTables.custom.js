$(document).ready(function() {
	var label_search = $('div.dataTables_filter').find('label');
  var link         = $('span.jsonlink').text();
  var selector     = '#'+$('table.table').attr('id');
	label_search.find('input[type="search"]').addClass('txt-dbs-cari');

  if ($(selector).length == 1) {
      datatables_run(selector,link); //call running ajax datatables
  };
	 

	$(document).on('keydown','.txt-dbs-cari',function(e){
      if (e.keyCode === 0 || e.keyCode === 32) {
        e.preventDefault();
      }
    });

});
function datatables_run(selector,link){
    table = $(selector).DataTable({
      "oLanguage": {
          "sEmptyTable":     "Belum ada data. <a href='#' class='btn btn-primary add-from-tb'><i class='glyphicon glyphicon-plus'></i> Tambahkan data</a>"
        },
        "iDisplayLength": 5,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": link,
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        }
        ]
        /*, dom: 'Bfrtip',
        buttons: [
            {
                text: 'Semua',
                action: function ( e, dt, node, config ) {
                    //alert( 'Button activated' );
                    $('.cekid').attr('checked', this.checked);
                }
            }
        ] */


      });
}