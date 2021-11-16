$(document).ready( function () {
    $('#table-user').DataTable( {

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json' //PT-BR
        },

        "order": [ 0, "asc" ],


    } );

     new $.fn.dataTable.FixedHeader( table );
    } );