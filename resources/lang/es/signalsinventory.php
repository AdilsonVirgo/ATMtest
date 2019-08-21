<?php

return [

    // Titles
    'showing-all-signals-inventories'     => 'Mostrando todo el inventario',
    'create-new-signals-inventory'       => 'Crear nueva señal',
    'show-deleted-signals-inventories'    => 'Mostrar señales eliminadas',
    'editing-signals-inventory'          => 'Editando la señal :code',
    'showing-signals-inventory'          => 'Mostrando la señal :code',
    'showing-signals-inventory-title'    => 'Información de la señal :code',

    // Flash Messages
    'createSuccess'   => '¡Señal creada con éxito!',
    'updateSuccess'   => '¡Señal actualizadad con éxito!',
    'deleteSuccess'   => '¡Señal eliminada con éxito!',

    // Show User Tab
    'viewProfile'            => 'View Profile',
    'editUser'               => 'Edit User',
    'deleteUser'             => 'Delete User',
    'signals-inventoriesBackBtn'           => 'Regresar a inventario de señales',
    'signals-inventoriesPanelTitle'        => 'User Information',
    'labelCode'          => 'Código:',
    'labelGroup'             => 'Grupo:',
    'labelSubgroup'         => 'Subgrupo:',
    'labelName'          => 'Nombre:',
    'labelVariation'              => 'Variaciones:',
    'labelUsage'            => 'Uso:',
    'labelErpCode'            => 'Código en el ERP:',
    'labelDescription'       => 'Descripción:',
    'labelDimension'       => 'Dimensión:',
    'labelCreatedAt'         => 'Creada el:',
    'labelUpdatedAt'         => 'Actualizada el:',
    'labelDeletedAt'         => 'Deleted on',

    'signals-inventories-table' => [
        'caption'   => ':signals-inventoriescount/:inventoriestotal señales.',
        'id'        => 'ID',
        'code'      => 'Código',
        'name'     => 'Nombre',
        'group'     => 'Grupo',
        'subgroup'     => 'Subgrupo',
        'variation'      => 'Variación',
        'variations'      => 'Variaciones',
        'usage'      => 'Uso',
        'description'      => 'Descripción',
        'dimension'      => 'Dimensión',
        'created'   => 'Creación',
        'updated'   => 'Actualización',
        'actions'   => 'Acciones',
        'updated'   => 'Actualizado',
    ],

    'buttons' => [
        'create-new'    => 'Nueva señal',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
        'back-to-signals-inventories' => '<span class="hidden-sm hidden-xs">Regresar al </span><span class="hidden-xs">inventario</span>',
        'back-to-signals-inventory'  => 'Regresar  <span class="hidden-xs">a la señal</span>',
        'delete-signals-inventory'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>',
        'edit-signals-inventory'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nueva señal',
        'back-signals-inventories'    => 'Regresar al inventario de señales',
        'submit-search' => 'Enviar búsqueda de señales',
        'clear-search'  => 'Limpiar resultados de búsqueda',
    ],

    'messages' => [
        'signals-inventoryNameTaken'          => 'Username is taken',
        'signals-inventoryNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'signals-inventory-creation-success'  => 'Successfully created signals-inventory!',
        'update-signals-inventory-success'    => 'Successfully updated signals-inventory!',
        'delete-success'         => '¡Señal eliminada con éxito!',
        'update-success'         => '¡Señal actualizada con éxito!',
        'delete-error'         => 'Error eliminando la señal. Inténtelo de nuevo o contacte al administrador.',
        'create-error'         => 'Error creando la señal. Inténtelo de nuevo o contacte al administrador.',
        'show-error'         => 'Error obteniendo la señal. Inténtelo de nuevo o contacte al administrador.',
        'update-error'         => 'Error actualizando la señal. Inténtelo de nuevo o contacte al administrador.',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-signals-inventory' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'User Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'User Role',
        'labelAccessLevel'  => '<span class="hidden-xs">User</span> Access Level|<span class="hidden-xs">User</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Mostrando los resultados de búsqueda',
        'found-footer'      => ' registro(s) encontrados',
        'no-results'        => 'Sin resultados',
        'search-signals-inventories-ph'   => 'Buscar señal',
    ],

    'modals' => [
        'delete_signals-inventory_message' => '¿Está seguro que desea eliminar la señal :signals-inventory?',
    ],
];
