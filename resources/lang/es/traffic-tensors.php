<?php

return [
    // Titles
    'showing-all-traffic-tensors'     => 'Mostrando todos los tensores de tráfico',
    'traffic-tensors-menu-alt'        => 'Mostrar menú de gestión de tensores de tráfico',
    'create-new-traffic-tensor'       => 'Crear nuevo tensor de tráfico',
    'editing-traffic-tensor'          => 'Editando el tensor: :id',
    'showing-traffic-tensor'  => 'Mostrando el tensor :id',
    'showing-traffic-tensor-title'    => 'Información del tensor: :id',

    // Flash Messages
    'createSuccess'   => '¡Tensor creado con éxito! ',
    'updateSuccess'   => '¡Tensor actualizado con éxito! ',
    'deleteSuccess'   => '¡Tensor eliminado con éxito! ',

    // Show traffic tensor Tab
    'labelHeight'         => 'Altura:',
    'labelState'         => 'Estado:',
    'labelMaterial'         => 'Material:',
    'labelComment'         => 'Comentario:',
    'labelUser'         => 'Usuario:',
    'labelPoles'         => 'Postes de tráfico:',
    'labelCreatedAt'         => 'Creado el:',
    'labelUpdatedAt'         => 'Actualizado el:',

    'traffic-tensors-table' => [
        'caption'   => ':tensorscount/:tensorstotal tensores de tráfico',
        'id'        => 'ID',
        'state'     => 'Estado',
        'height'     => 'Altura',
        'material'     => 'Material',
        'comment'     => 'Comentario',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
        'actions'   => 'Acciones',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo tensor',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-traffic-tensors' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">tensores</span>',
        'back-to-traffic-tensor'  => 'Regresar  <span class="hidden-xs">a Tensores</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo tensore de tráfico',
        'back-traffic-tensors'    => 'Regresar a tensores de tráfico',
        'submit-search' => 'Enviar búsqueda de tensores de tráfico',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'traffic-tensor-creation-success'  => '¡Tensor de tráfico creado con éxito!',
        'update-traffic-tensor-success'    => '¡Tensor de tráfico actualizado con éxito!',
        'update-traffic-tensor-error'    => 'Actualización de tensor fallida.',
        'show-error'    => 'Tensor no encontrado.',
        'delete-success'         => '¡Tensor de tráfico eliminado con éxito!'
    ],

    'show-tensor' => [
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
        'search-traffic-tensors-ph'   => 'Buscar tensores de tráfico',
    ],

    'modals' => [
        'delete_traffic_tensor_message' => '¿Estás seguro que quiere eliminar el tensor de tráfico: :id?',
    ],
];
