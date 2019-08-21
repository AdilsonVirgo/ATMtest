<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'Las credenciales no coinciden con nuestros registros.',
    'throttle' => 'Demasiados intentos de inicio de sesión. Por favor, intente de nuevo en :seconds segundos.',

    // Activation items
    'sentEmail'        => 'Hemos enviado un correo electrónico a :email.',
    'clickInEmail'     => 'Por favor haga clic en el enlace para activar su cuenta.',
    'anEmailWasSent'   => 'Un correo electrónico fue enviado a :email el :date.',
    'clickHereResend'  => 'Haga clic aquí para reenviar el correo electrónico.',
    'successActivated' => 'Tu cuenta ha sido activada con éxito.',
    'unsuccessful'     => 'Tu cuenta no pudo ser activada; Inténtalo de nuevo.',
    'notCreated'       => 'Tu cuenta no pudo ser creada; Inténtalo de nuevo.',
    'tooManyEmails'    => 'Se han enviado demasiados correos electrónicos de activación a :email. <br />Por favor inténtelo de nuevo en <span class="label label-danger">:hours horas</span>.',
    'regThanks'        => 'Gracias por registrarte, ',
    'invalidToken'     => 'Token de activación no válido. ',
    'activationSent'   => 'Correo electrónico de activación enviado. ',
    'alreadyActivated' => 'Activado ya. ',

    // Labels
    'whoops'          => 'Whoops! ',
    'someProblems'    => 'Hubo algunos problemas con su entrada.',
    'email'           => 'E-Mail',
    'password'        => 'Contraseña',
    'rememberMe'      => ' Recuérdame',
    'login'           => 'Iniciar sesión',
    'forgot'          => '¿Olvidaste tu contraseña?',
    'forgot_message'  => '¿Problemas con la contraseña?',
    'name'            => 'Nombre de usuario',
    'first_name'      => 'Nombre',
    'last_name'       => 'Apellidos',
    'confirmPassword' => 'Confirmar contraseña',
    'register'        => 'Registrar',

    // Placeholders
    'ph_name'          => 'Nombre de usuario',
    'ph_email'         => 'E-mail',
    'ph_firstname'     => 'Nombre',
    'ph_lastname'      => 'Apellidos',
    'ph_password'      => 'Contraseña',
    'ph_password_conf' => 'Confirmar contraseña',

    // User flash messages
    'sendResetLink' => 'Enviar enlace para restablecer contraseña',
    'resetPassword' => 'Restablecer la contraseña',
    'loggedIn'      => '¡Has iniciado sesión!',

    // email links
    'pleaseActivate'    => 'Por favor active su cuenta.',
    'clickHereReset'    => 'Click aquí para restaurar tu contraseña: ',
    'clickHereActivate' => 'Click aquí para activar tu cuenta: ',

    // Validators
    'userNameTaken'    => 'El nombre de usuario ya está en uso',
    'userNameRequired' => 'El nombre de usuario es requerido',
    'fNameRequired'    => 'El nombre es requerido',
    'lNameRequired'    => 'Los apellidos son requeridos',
    'emailRequired'    => 'El email es requerido',
    'emailInvalid'     => 'Email inválido',
    'passwordRequired' => 'La contraseña es requerida',
    'PasswordMin'      => 'La contraseña debe tener al menos 6 caracteres',
    'PasswordMax'      => 'La longitud máxima de la contraseña es de 20 caracteres',
    'captchaRequire'   => 'Captcha es requerido',
    'CaptchaWrong'     => 'Captcha incorrecto, inténtelo de nuevo por favor.',
    'roleRequired'     => 'El rol del usuario es requerido.',

];
