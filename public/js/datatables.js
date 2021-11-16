$(document).ready( function () {
    $('#table').DataTable( {

        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json' //PT-BR
        },

        "order": [ 1, "desc" ],

        responsive: true,

    } );

     new $.fn.dataTable.FixedHeader( table );
    } );