
<script type="text/javascript">

    let ID_TABLE = `{{$id_table}}`;
    let data_tables = 'data_tables_'+`{{$id_table}}`;
    let filename = 'Listado de '+`{{$name_modulo}}`;
    
    // $('#table-empresa').DataTable( {
	// 			responsive: {
	// 				details: {
	// 					type: 'column',
	// 					target: 'tr'
	// 				}
	// 			},
	// 			columnDefs: [ 		
	// 				{ responsivePriority: 1, targets: 0 },
	// 				{ responsivePriority: 2, targets: -1 }, 
	// 				{ 
	// 					className: 'control',
	// 					orderable: false,
	// 					targets:   0
	// 				} 
	// 			],
	// 			order: [ 1, 'asc' ]
	// 		} );
$(document).ready(function () {
    
            
    data_tables = $('#'+ID_TABLE).DataTable({
        dom: 'Blfrtip',
 
				responsive: {
					details: {
						type: 'column',
						target: 'tr'
					}
				},
				columnDefs: [ 		
					{ responsivePriority: 1, targets: 0 },
					{ responsivePriority: 2, targets: -1 }, 
					{ 
						className: 'control',
						orderable: false,
						targets:   0
					} 
				],

        buttons: [{
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            filename: filename,
            title: '',
            // exportOptions: {
            //     "columns": columnas
            // },
        }],
        "bSortCellsTop": true,
        "order": [
            [0, "asc"]
        ],
        "paging": true,
        "pagingType": "numbers",
         "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ <br>de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 <br>de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

});
    $(data_tables.table().container()).on('keyup', 'thead input', function() {
        data_tables
            .column($(this).data('index'))
            .search(this.value)
            .draw();
    });

    // $(function() {
    //     redrawTableWrapper();
    // });

    // function redrawTableWrapper() {
    //     setTimeout(() => {
    //         $('.loading').addClass('d-none');
    //         $('.tableWrapper').removeClass('d-none');
    //         $($.fn.dataTable.tables(true)).DataTable()
    //             .columns.adjust()
    //             .fixedColumns().relayout();
    //     }, 1000);
    // }
</script>