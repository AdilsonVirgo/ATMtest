<?php

return [

    // Titles
    'showing-all-workorders'   => 'Órdenes de Trabajo Abiertas',
    'showing-all-materials'    => 'Materiales necesarios para ejecutar la orden',
    'search-workorders'        => 'Buscar órdenes de trabajo',
    'search-materials'         => 'Buscar materiales',
    'create-new-workorder'     => 'Crear nueva orden de trabajo',
    'create-new-material'      => 'Adicionar nuevo material',
    'save-edit-workorder'      => 'Guardar los cambios realizados',
    'labelUserId'              => 'Usuario:',
    'labelorderId'             => 'No Orden:',
    'labelReportId'            => 'No. Reporte:',
    'labelStartDate'           => 'Fecha de Inicio:',
    'labelStatus'              => 'Estado:',
    'editing-workorder'        => 'Editando la Order de Trabajo:',
    'showing-workorder'        => 'Orden de Trabajo :id',
    'showing-workorder-title'  => 'Información de la Order de Trabajo :id',
    'editorigen'               => 'Origen',
    'updateMaterialsSuccess'   => 'Origen del Material actualizado con éxito!',
    
    // Flash Messages
    'createSuccess'    => '¡Orden de Trabajo creada con éxito! ',
    'updateSuccess'    => '¡Orden de Trabajo actualizada con éxito! ',
    'deleteSuccess'    => '¡Orden de Trabajo eliminada con éxito! ',
    'closeSuccess'     => '¡Orden de Trabajo cerrada con éxito! ',
    'errorAuthSuccess' => 'No tiene permisos para realizar esta operación de cierre',
    'deleteSelfError'  => '¡No puedes eliminarte a ti mismo! ',
    
    'workorder-table' => [
        'caption'     => '{1} :intersectionscount total del interseccione|[2,*] :intersectionscount total de intersección',
        'id'          => 'ID',
        'user_id'     => 'Asignada a:',
        'report_id'   => 'No. Reporte',
        'description'   => 'descripción',
        'startdate'   => 'Fecha de Apertura',
        'enddate'     => 'Fecha de Cierre',
        'state'       => 'Estado',
        'created'     => 'Creada',
        'updated'     => 'Actualizada',
        'actions'     => 'Acciones',
    ],

    'materials-table' => [
        'caption'     => '{1} :intersectionscount total del interseccione|[2,*] :intersectionscount total de intersección',
        'id'          => 'ID',
        'erp_code'    => 'Código ERP',
        'name'        => 'Descripción',
        'quantity'    => 'Cantidad',
        'origen'      => 'Origen',
        'actions'     => 'Acciones',
    ],
    
    'buttons' => [
        'cerrar'             => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Cerrar</span>',
        'cerrar_orden'             => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Cerrar Orden</span>',
        'show'               => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span>',
        'edit'               => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span>',
        'back-to-workorders' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Ordenes de Trabajo</span>',
        'back-to-workorder'  => 'Regresar  <span class="hidden-xs">a Orden de Trabajo</span>',
        'edit_materials'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar Origen Material</span>',
    ],

    'tooltips' => [
        'delete'              => 'Eliminar',
        'show'                => 'Mostrar',
        'edit'                => 'Editar',
        'create-new'          => 'Crear nueva intersección',
        'back-intersections'  => 'Regresar a intersecciones',
        'submit-search'       => 'Enviar búsqueda de ordenes de trabajo',
        'clear-search'        => 'Borrar resultados de búsqueda',
    ],
    
];
