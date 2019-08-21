<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    /*
     * Activate new user account email.
     *
     */

    'activationSubject'  => 'Activación requerida',
    'activationGreeting' => '¡Bienvenido!',
    'activationMessage'  => 'Debe activar su correo electrónico antes de poder comenzar a utilizar todos nuestros servicios.',
    'activationButton'   => 'Activat',
    'activationThanks'   => '¡Gracias por utilizar nuestra aplicación!',

    /*
     * Goobye email.
     *
     */
    'goodbyeSubject'  => 'Siento verte ir...',
    'goodbyeGreeting' => 'Hola :username,',
    'goodbyeMessage'  => 'Lamentamos mucho que te vayas. Queremos informarle que su cuenta ha sido eliminada. Gracias por el tiempo que compartimos. Tiene '.config('settings.restoreUserCutoff').' días para restaurar tu cuenta.',
    'goodbyeButton'   => 'Restaurar cuenta',
    'goodbyeThanks'   => '¡Esperamos verte de nuevo!',

];
