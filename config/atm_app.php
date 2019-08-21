<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-users setting
    |--------------------------------------------------------------------------
    */

    // Users List Pagination
    'enablePagination'              => true,
    'paginateListSize'              => env('USER_LIST_PAGINATION_SIZE', 25),

    // Enable Search Users- Uses jQuery Ajax
    'enableSearch'                  => true,

    // Users List JS DataTables - not recommended use with pagination
    'enabledDatatablesJs'           => false,
    'datatablesJsStartCount'        => 25,
    'datatablesCssCDN'              => 'https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css',
    'datatablesJsCDN'               => 'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',
    'datatablesJsPresetCDN'         => 'https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js',

    'enabledSelectizeJs'             => true,
    'selectizeJsCDN'                => 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js',
    'selectizeCssCDN'               => 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css',

    // Bootstrap Tooltips
    'tooltipsEnabled'               => true,
    'enableBootstrapPopperJsCdn'    => true,
    'bootstrapPopperJsCdn'          => 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',

];
