<?php

return [

    // Titles
    'showing-all'     => 'Mostrando todos los motivos',
    'alerts-menu-alt'        => 'Mostrar menú de gestión de motivos',
    'create-new-alert'       => 'Crear nueva motivo',
    'show-deleted-alerts'    => 'Mostrar motivos eliminados',
    'editing-alert'          => 'Editando el motivo :code',
    'showing-alert'          => 'Mostrando el motivo :name',
    'showing-alert-title'    => 'Información del motivo: :name',

    // Flash Messages
    'createSuccess'   => '¡Motivo creado! ',
    'updateSuccess'   => '¡Motivo actualizado! ',
    'deleteSuccess'   => '¡Motivo eliminado! ',
    'deleteSelfError' => '¡Ud no puede auto eliminarse! ',

    // Show Vertical Signal Tab
    'viewProfile'            => 'View Profile',
    'editUser'               => 'Edit Motivos',
    'deleteUser'             => 'Delete  Motivos',
    'alertsBackBtn'           => 'Regresar a  Motivos',
    'alertsPanelTitle'        => 'User Information',
    'labelErpCode'             => 'Código en el ERP:',
    'labelName'             => 'Nombre de la señal:',
    'labelGroup'             => 'Grupo:',
    'labelSubgroup'             => 'Subgrupo:',
    'labelDimension'             => 'Dimensión:',
    'labelLatitude'             => 'Latitud:',
    'labelLongitude'             => 'Longitud:',
    'labelComment'             => 'Comentario:',
    'labelGoogleAddress'             => 'Dirección en Google:',
    'labelOrientation'             => 'Orientación:',
    'labelNeighborhood'             => 'Vecindario:',
    'labelParish'             => 'Parroquía:',
    'labelState'             => 'Estado:',
    'labelStreet1'             => 'Calle 1:',
    'labelStreet2'             => 'Calle 2:',
    'labelNormative'             => 'Normativa:',
    'labelFastener'             => 'Fijadores:',
    'labelMaterial'             => 'Materiales:',
    'labelCollector'             => 'Usuario:',
    'labelCreatedAt'         => 'Creada el:',
    'labelUpdatedAt'         => 'Actualizada el:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'alertsDeletedPanelTitle' => 'Deleted  Motivos Information',
    'alertsBackDelBtn'        => 'Regresar a  Motivos borrados',

    'successRestore'    => 'Alerts successfully restored.',
    'successDestroy'    => 'Alerts record successfully destroyed.',
    'errorUserNotFound' => 'Alerts  not found.',

    'labelUserLevel'  => 'Level',
    'labelUserLevels' => 'Levels',

    'alerts-table' => [
        'caption'   => ':alertscount/:alertstotal motivos.',
        'id'        => 'ID',
        'code'        => 'Código',
        'creator'      => 'Creador',
        'name'     => 'Nombre',
        'latitude'     => 'Latitud',
        'longitude'     => 'Longitud',
        'picture'      => 'Imagen',
        'comment'   => 'Comentario',
        'orientation'   => 'Orientacion',
        'google_address'   => 'Direccion en Google',
        'street1'   => 'Calle 1',
        'street2'   => 'Calle 2',
        'neighborhood'   => 'Vecindario',
        'parish'   => 'Parroquia',
        'state'   => 'Estado',
        'normative'   => 'Normativa',
        'fastener'   => 'Fijador',
        'material'   => 'Material',
        'actions'   => 'Acciones',
        'created'   => 'Creada',
        'updated'   => 'Actualizada',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo motivo',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> ',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ',
        'back-to-alerts' => '<span class="hidden-sm hidden-xs">Regresar </span><span class="hidden-xs">a Motivos</span>',
        'back-to-alert'  => 'Regresar  <span class="hidden-xs">a Motivo</span>',
        'delete-alert'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  ',
        'edit-alert'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo motivo',
        'back-alerts'    => 'Regresar a señales verticales',
        'back-alert'    => 'Regresar a motivo',
        'email-alert'    => 'Email :alert',
        'submit-search' => 'Enviar búsqueda de motivo',
        'clear-search'  => 'Limpiar los resultados de búsqueda',
    ],

    'messages' => [
        'alertNameTaken'          => 'Username is taken',
        'alertNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'MOtive role is required.',
        'alert-creation-success'  => 'Successfully created vertical signal!',
        'update-alert-success'    => 'Successfully updated vertical signal!',
        'delete-success'         => '¡Señal vertical borrada con éxito!',
        'delete-error'         => '¡Error eliminando el motivo!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-alert' => [
        'id'                => 'User ID',
        'name'              => 'Username',
        'email'             => '<span class="hidden-xs">Alerts </span>Email',
        'role'              => 'Alerts Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'Alert Role',
        'labelAccessLevel'  => '<span class="hidden-xs">Alert</span> Access Level|<span class="hidden-xs">Alerts</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Mostrando los resultados de la búsqueda',
        'found-footer'      => ' Señales(s) encontradas',
        'no-results'        => 'Sin resultados',
        'search-alerts-ph'   => 'Buscar señales verticales',
    ],

    'modals' => [
        'delete_alert_message' => '¿Está segudo de borrar el motivo :alert?',
    ],
];