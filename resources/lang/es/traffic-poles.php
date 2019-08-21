<?php

return [

    // Titles
    'showing-all-traffic-poles'     => 'Mostrando todos los postes de tráfico',
    'traffic-poles-menu-alt'        => 'Mostrar menú de gestión de postes de tráfico',
    'create-new-traffic-pole'       => 'Crear nuevo poste de tráfico',
    'editing-traffic-pole'          => 'Editando el poste: :code',
    'showing-traffic-pole'  => 'Mostrando el poste :code',
    'showing-traffic-pole-title'    => 'Información del poste: :code',

    // Flash Messages
    'createSuccess'   => '¡Poste creado con éxito! ',
    'updateSuccess'   => '¡Poste actualizado con éxito! ',
    'deleteSuccess'   => '¡Poste eliminado con éxito! ',

    // Show traffic pole Tab
    'labelLatitude'          => 'Latitud:',
    'labelLongitude'         => 'Longitud:',
    'labelCode'         => 'Código:',
    'labelErpCode'         => 'Código en el ERP:',
    'labelIntersection'         => 'Intersección:',
    'labelHeight'         => 'Altura:',
    'labelState'         => 'Estado:',
    'labelMaterial'         => 'Material:',
    'labelComment'         => 'Comentario:',
    'labelGoogleAddress'         => 'Dirección en Google:',
    'labelAtmOwn'         => 'Propiedad de ATM:',
    'labelUser'         => 'Usuario:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'traffic-poles-table' => [
        'caption'   => ':polescount/:polestotal postes de tráfico',
        'id'        => 'ID',
        'code'      => 'Código',
        'brand'     => 'Fabricante',
        'state'     => 'Estado',
        'atm-own'     => 'Propio',
        'height'     => 'Altura',
        'material'     => 'Material',
        'latitude'     => 'Latitud',
        'longitude'     => 'Longitud',
        'google-address'     => 'Dirección de Google',
        'erp-code'     => 'Código de ERP',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo poste',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-traffic-poles' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Postes</span>',
        'back-to-traffic-pole'  => 'Regresar  <span class="hidden-xs">a Postes</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo poste de tráfico',
        'back-traffic-poles'    => 'Regresar a postes de tráfico',
        'submit-search' => 'Enviar búsqueda de postes de tráfico',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'traffic-pole-creation-success'  => '¡Poste creado con éxito!',
        'update-traffic-pole-success'    => '¡Poste actualizado con éxito!',
        'update-traffic-pole-error'    => 'Actualización de Poste fallida.',
        'delete-success'         => '¡Poste eliminado con éxito!'
    ],

    'show-poste' => [
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
        'search-traffic-poles-ph'   => 'Buscar postes de tráfico',
    ],

    'modals' => [
        'delete_traffic_pole_message' => '¿Estás seguro que quiere eliminar el poste de tráfico: :code?',
    ],
];
