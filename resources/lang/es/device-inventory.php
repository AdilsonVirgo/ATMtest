<?php

return [

    // Titles
    'showing-all-devices-inventories'     => 'Mostrando todo el inventario de dispositivos de tráfico',
    'create-new-device-inventory'       => 'Crear nuevo dispositivo de tráfico',
    'editing-device-inventory'          => 'Editando el dispositivo :code',
    'showing-device-inventory'          => 'Mostrando el dispositivo :code',
    'showing-device-inventory-title'    => 'Información del dispositivo :code',

    // Flash Messages
    'createSuccess'   => '¡Dispositivo creado con éxito!',
    'updateSuccess'   => '¡Dispositivo actualizado con éxito!',
    'deleteSuccess'   => '¡Dispositivo eliminado con éxito!',

    // Show User Tab
    'device-inventoriesBackBtn'           => 'Regresar a inventario de señales',
    'labelCode'          => 'Código:',
    'labelName'             => 'Nombre:',
    'labelSimbolo'         => 'Símbolo:',
    'labelDimensions'          => 'Dimensiones:',
    'labelErpCode'              => 'Código en el ERP:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'devices-inventories-table' => [
        'caption'   => ':inventoriescount/:inventoriestotal de dispositivos de tráfico.',
        'id'        => 'ID',
        'code'      => 'Código',
        'name'     => 'Nombre',
        'symbol'     => 'Símbolo',
        'dimensions'     => 'Dimensiones',
        'erpcode'     => 'Código en el ERP',
        'created'   => 'Creación',
        'updated'   => 'Actualización',
        'actions'   => 'Acciones',
        'updated'   => 'Actualizado',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo dispositivo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
        'back-to-device-inventories' => '<span class="hidden-sm hidden-xs">Regresar al </span><span class="hidden-xs">inventario</span>',
        'back-to-device-inventory'  => 'Regresar  <span class="hidden-xs">al dispositivo</span>',
        'delete-device-inventory'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'edit-device-inventory'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo dispositivo',
        'back-device-inventories'    => 'Regresar al inventario de dispositivos',
        'submit-search' => 'Enviar búsqueda de dispositivos',
        'clear-search'  => 'Limpiar resultados de búsqueda',
    ],

    'messages' => [
        'delete-success'         => '¡Dispositivo eliminado con éxito!',
        'update-success'         => '¡Dispositivo actualizado con éxito!',
        'delete-error'         => 'Error eliminando el dispositivo de tráfico. Inténtelo de nuevo o contacte al administrador.',
        'create-error'         => 'Error creando el dispositivo de tráfico. Inténtelo de nuevo o contacte al administrador.',
        'show-error'         => 'Error obteniendo el dispositivo de tráfico. Inténtelo de nuevo o contacte al administrador.',
        'update-error'         => 'Error actualizando el dispositivo de tráfico. Inténtelo de nuevo o contacte al administrador.',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'search'  => [
        'title'             => 'Mostrando los resultados de búsqueda',
        'found-footer'      => ' registro(s) encontrados',
        'no-results'        => 'Sin resultados',
        'search-device-inventories-ph'   => 'Buscar dispositivos',
    ],

    'modals' => [
        'delete_device-inventory_message' => '¿Está seguro que desea eliminar el dispositivo :device-inventory?',
    ],
];
