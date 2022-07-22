
    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos5 thead tr')
        .clone(true)
        .addClass('filters5')
        .appendTo('#tablaDatos5 thead');
 
    var table5 = $('#tablaDatos5').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters5 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters5 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'asc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS MOTOS

    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos6 thead tr')
        .clone(true)
        .addClass('filters6')
        .appendTo('#tablaDatos6 thead');
 
    var table6 = $('#tablaDatos6').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters6 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters6 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'asc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS BICICLETAS

    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos7 thead tr')
        .clone(true)
        .addClass('filters7')
        .appendTo('#tablaDatos7 thead');
 
    var table7 = $('#tablaDatos7').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters7 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters7 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'asc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS AUTOS AUTORIZADOS -->

    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos8 thead tr')
        .clone(true)
        .addClass('filters8')
        .appendTo('#tablaDatos8 thead');
 
    var table8 = $('#tablaDatos8').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters8 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters8 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS MOTOS

    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos9 thead tr')
        .clone(true)
        .addClass('filters9')
        .appendTo('#tablaDatos9 thead');
 
    var table9 = $('#tablaDatos9').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters9 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters9 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS BICICLETAS

    $(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos10 thead tr')
        .clone(true)
        .addClass('filters10')
        .appendTo('#tablaDatos10 thead');
 
    var table10 = $('#tablaDatos10').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters10 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters10 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS AUTOS ANULADOS

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos11 thead tr')
        .clone(true)
        .addClass('filters11')
        .appendTo('#tablaDatos11 thead');
 
    var table11 = $('#tablaDatos11').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters11 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters11 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});

//SCRIPTS MOTOS

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos12 thead tr')
        .clone(true)
        .addClass('filters12')
        .appendTo('#tablaDatos12 thead');
 
    var table12 = $('#tablaDatos12').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters12 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters12 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});
// SCRIPTS BICICLETAS

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#tablaDatos13 thead tr')
        .clone(true)
        .addClass('filters13')
        .appendTo('#tablaDatos13 thead');
 
    var table13 = $('#tablaDatos13').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters13 th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters13 th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('keyup change', function (e) {
                            e.stopPropagation();
 
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
 
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        "pageLength": 5,
        "order": [[ 3, 'desc' ]],
        "dom": 'Bfrtip',
        "buttons": ['excel'],

        "language": 
        {
        "decimal":        ".",
        "emptyTable":     "No hay datos para mostrar",
        "info":           "del _START_ al _END_ (_TOTAL_ total)",
        "infoEmpty":      "del 0 al 0 (0 total)",
        "infoFiltered":   "(filtrado de todas las _MAX_ entradas)",
        "infoPostFix":    "",
        "thousands":      "'",
        "lengthMenu":     "Mostrar _MENU_ entradas",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No hay resultados",
        "paginate": 
        {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": 
        {
            "sortAscending":  ": ordenar de manera Ascendente",
            "sortDescending": ": ordenar de manera Descendente ",
        }
        }
        
    }).on('draw', function () {
    console.log( 'Table redibujada' );
    //cargarcualquierfuncion();
    });

});