<?php

return [
    // Titles
    'showing-all-regulator-boxes'     => 'Mostrando todos los reguladores de tráfico',
    'regulator_boxes-menu-alt'        => 'Mostrar menú de gestión de reguladores de tráfico',
    'create-new-regulator-box'       => 'Crear nuevo regulador de tráfico',
    'editing-regulator-box'          => 'Editando el regulador: :code',
    'showing-regulator-box'  => 'Mostrando el regulador :code',
    'showing-regulator-box-title'    => 'Información del regulador: :code',

    // Flash Messages
    'createSuccess'   => '¡Regulador creado con éxito! ',
    'updateSuccess'   => '¡Regulador actualizado con éxito! ',
    'deleteSuccess'   => '¡Regulador eliminado con éxito! ',

    // Show traffic regulator Tab
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelLatitude'         => 'Latitud:',
    'labelLongitude'         => 'Longitud:',
    'labelGoogleAddress'         => 'Dirección en Google:',
    'labelBrand'         => 'Fabricante:',
    'labelComment'         => 'Comentario:',
    'labelUser'         => 'Usuario:',
    'labelState'         => 'Estado:',
    'labelIntersection'         => 'Intersección:',
    'labelPicuteIn'         => 'Foto interior:',
    'labelPicuteOut'         => 'Foto exterior:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'regulator-boxes-table' => [
        'caption'   => ':rbox_count/:rbox_total reguladores de tráfico',
        'id'        => 'ID',
        'state'     => 'Estado',
        'code'     => 'Código',
        'erp_code'     => 'Código en el ERP',
        'latitude'     => 'Latitud',
        'longitude'     => 'Longitud',
        'google_address'   => 'Direccion en Google',
        'brand'     => 'Fabricante',
        'intersection'     => 'Intersección',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo regulador',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-regulator-boxes' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">reguladores</span>',
        'back-to-regulator-box'  => 'Regresar  <span class="hidden-xs">a regulador</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo regulador de tráfico',
        'back-regulator_boxes'    => 'Regresar a reguladores de tráfico',
        'submit-search' => 'Enviar búsqueda de reguladores de tráfico',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'regulator-box-creation-success'  => '¡Regulador de tráfico creado con éxito!',
        'update-regulator-box-success'    => '¡Regulador de tráfico actualizado con éxito!',
        'update-regulator-box-error'    => 'Actualización de regulador fallida.',
        'show-error'    => 'Regulador no encontrado.',
        'delete-success'         => '¡Regulador de tráfico eliminado con éxito!'
    ],

    'show-regulator' => [
        'id'                => 'ID',
        'name'              => 'Nombre de usuario',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'Rol de usuario',
        'created'           => 'Creada <span class="hidden-xs">el</span>',
        'updated'           => 'Actualizada <span class="hidden-xs">el</span>',
    ],

    'search'  => [
        'title'             => 'Mostrando resultados de búsqueda',
        'found-footer'      => ' Registro(s) encontrado(s)',
        'no-results'        => 'No hay resultados',
        'search-regulator-box-ph'   => 'Buscar regulador de tráfico',
    ],

    'modals' => [
        'delete_traffic_regulator_message' => '¿Estás seguro que quiere eliminar el regulador de tráfico: :code?',
    ],
];
