<?php

return [
    // Titles
    'showing-all-traffic-lights'     => 'Mostrando todos los semáforos',
    'traffic-lights-menu-alt'        => 'Mostrar menú de gestión de semáforos',
    'create-new-traffic-light'       => 'Crear nuevo semáforo',
    'editing-traffic-light'          => 'Editando el semáforo: :code',
    'showing-traffic-light'  => 'Mostrando el semáforo :code',
    'showing-traffic-light-title'    => 'Información del semáforo: :code',

    // Flash Messages
    'createSuccess'   => '¡Semáforo creado con éxito! ',
    'updateSuccess'   => '¡Semáforo actualizado con éxito! ',
    'deleteSuccess'   => '¡Semáforo eliminado con éxito! ',

    // Show traffic light Tab
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelBrand'         => 'Fabricante:',
    'labelModel'         => 'Modelo:',
    'labelState'         => 'Estado:',
    'labelOrientation'         => 'Orientación:',
    'labelRegulator'         => 'Regulador:',
    'labelRegulator'         => 'Regulador:',
    'labelIntersection'         => 'Intersección:',
    'labelTensor'         => 'Tensor:',
    'labelPole'         => 'Poste:',
    'labelType'         => 'Tipo de semáforo:',
    'labelComment'         => 'Comentario:',
    'labelUser'         => 'Usuario:',
    'labelPoles'         => 'Postes de tráfico:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'traffic-lights-table' => [
        'caption'   => ':lightscount/:lightstotal semáforos',
        'code'        => 'Código',
        'erp-code'        => 'Código en el ERP',
        'state'     => 'Estado',
        'orientation'     => 'Orientación',
        'brand'     => 'Fabricante',
        'model'     => 'Modelo',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo semáforo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-traffic-lights' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">semáforos</span>',
        'back-to-traffic-light'  => 'Regresar  <span class="hidden-xs">al semáforo</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo semáforo',
        'back-traffic-lights'    => 'Regresar a semáforos',
        'submit-search' => 'Enviar búsqueda de semáforos',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'traffic-light-creation-success'  => '¡Semáforo creado con éxito!',
        'update-traffic-light-success'    => '¡Semáforo actualizado con éxito!',
        'update-traffic-light-error'    => 'Actualización de semáfoto fallida.',
        'show-error'    => 'Tensor no encontrado.',
        'delete-success'         => '¡Semáforo eliminado con éxito!'
    ],

    'show-light' => [
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
        'search-traffic-lights-ph'   => 'Buscar semáforos',
    ],

    'modals' => [
        'delete_traffic_light_message' => '¿Estás seguro que quiere eliminar el semáforo: :id?',
    ],
];
