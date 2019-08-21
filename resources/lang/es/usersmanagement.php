<?php

return [

    // Titles
    'showing-all-users'     => 'Mostrando todos los usuarios',
    'users-menu-alt'        => 'Mostrar menú de gestión de usuarios',
    'create-new-user'       => 'Crear nuevo usuario',
    'show-deleted-users'    => 'Mostrar usuario borrado',
    'editing-user'          => 'Editando el usuario :name',
    'showing-user'          => 'Mostrando el usuario :name',
    'showing-user-title'    => 'Información del usuario :name',

    // Flash Messages
    'createSuccess'   => '¡Usuario creado con éxito! ',
    'updateSuccess'   => '¡Usuario actualizado con éxito! ',
    'deleteSuccess'   => '¡Usuario eliminado con éxito! ',
    'deleteSelfError' => '¡No puedes eliminarte a ti mismo! ',

    // Show User Tab
    'viewProfile'            => 'Ver perfil',
    'editUser'               => 'Editar usuario',
    'deleteUser'             => 'Eliminar usuario',
    'usersBackBtn'           => 'Regresar a usuarios',
    'usersPanelTitle'        => 'Información de usuario',
    'labelUserName'          => 'Nombre de usuario:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'Nombre:',
    'labelLastName'          => 'Apellido:',
    'labelRole'              => 'Rol:',
    'labelStatus'            => 'Estado:',
    'labelAccessLevel'       => 'Acceso',
    'labelPermissions'       => 'Permisos:',
    'labelCreatedAt'         => 'Creado:',
    'labelUpdatedAt'         => 'Eliminado:',
    'labelIpEmail'           => 'IP de registro email:',
    'labelIpEmail'           => 'IP de registro email:',
    'labelIpConfirm'         => 'IP de confirmación:',
    'labelIpSocial'          => 'IP de registro socialite:',
    'labelIpAdmin'           => 'IP de registro de admin:',
    'labelIpUpdate'          => 'IP de la última actualización:',
    'labelDeletedAt'         => 'Eliminado el',
    'labelIpDeleted'         => 'IP de eliminación:',
    'usersDeletedPanelTitle' => 'Información del usuario eliminado',
    'usersBackDelBtn'        => 'Regresar a usuarios eliminados',

    'successRestore'    => 'Usuario restaurado exitosamente.',
    'successDestroy'    => 'Registro de usuario destruido exitosamente.',
    'errorUserNotFound' => 'Usuario no encontrado.',

    'labelUserLevel'  => 'Nivel',
    'labelUserLevels' => 'Niveles',

    'users-table' => [
        'caption'   => '{1} :userscount total del usuario|[2,*] :userscount total del usuario',
        'id'        => 'ID',
        'name'      => 'Nombre usuario',
        'fname'     => 'Nombre',
        'lname'     => 'Apellidos',
        'email'     => 'Email',
        'role'      => 'Rol',
        'created'   => 'Creado',
        'updated'   => 'Actualizado',
        'actions'   => 'Acciones',
        'updated'   => 'Actualizado',
    ],

    'buttons' => [
        'create-new'    => 'Nuevo usuario',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Eliminar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Mostrar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Editar</span><span class="hidden-xs hidden-sm hidden-md"> Usuario</span>',
        'back-to-users' => '<span class="hidden-sm hidden-xs">Regresar a </span><span class="hidden-xs">Usuarios</span>',
        'back-to-user'  => 'Regresar  <span class="hidden-xs">a Usuario</span>',
        'delete-user'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Eliminar</span><span class="hidden-xs"> Usuario</span>',
        'edit-user'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Editar</span><span class="hidden-xs"> Usuario</span>',
    ],

    'tooltips' => [
        'delete'        => 'Eliminar',
        'show'          => 'Mostrar',
        'edit'          => 'Editar',
        'create-new'    => 'Crear nuevo usuario',
        'back-users'    => 'Regresar a usuarios',
        'email-user'    => 'Email :user',
        'submit-search' => 'Enviar búsqueda de usuarios',
        'clear-search'  => 'Borrar resultados de búsqueda',
    ],

    'messages' => [
        'userNameTaken'          => 'Nombre de usuario en uso',
        'userNameRequired'       => 'Nombre de usuario requerido',
        'fNameRequired'          => 'Nombre requerido',
        'lNameRequired'          => 'Apellidos requerido',
        'emailRequired'          => 'Email requerido',
        'emailInvalid'           => 'Email inválido',
        'passwordRequired'       => 'Contraseña requerida',
        'PasswordMin'            => 'La contraseña debe tener al menos 6 caracteres',
        'PasswordMax'            => 'La contraseña no puede exceder los 20 caracteres',
        'captchaRequire'         => 'Captcha requerido',
        'CaptchaWrong'           => 'Captcha incorrecto, por favor intentalo de nuevo.',
        'roleRequired'           => 'Rol de usuario requerido.',
        'user-creation-success'  => '¡Usuario creado con éxito!',
        'update-user-success'    => '¡Usuario actualizado con éxito!',
        'delete-success'         => '¡Usuario eliminado con éxito!',
        'cannot-delete-yourself' => '¡No puedes eliminarte a ti mismo!',
    ],

    'show-user' => [
        'id'                => 'ID',
        'name'              => 'Nombre de usuario',
        'email'             => '<span class="hidden-xs">User </span>Email',
        'role'              => 'Rol de usuario',
        'created'           => 'Creado <span class="hidden-xs">el</span>',
        'updated'           => 'Actualizado <span class="hidden-xs">el</span>',
        'labelRole'         => 'Rol de usuario',
        'labelAccessLevel'  => '<span class="hidden-xs">Nivel de</span> accesso de usuario|<span class="hidden-xs">Niveles de acceso</span> de usuarios',
    ],

    'search'  => [
        'title'             => 'Mostrando resultados de búsqueda',
        'found-footer'      => ' Registro(s) encontrado(s)',
        'no-results'        => 'No hay resultados',
        'search-users-ph'   => 'Buscar usuarios',
    ],

    'modals' => [
        'delete_user_message' => '¿Estás seguro que quieres borrar a :user?',
    ],
];
