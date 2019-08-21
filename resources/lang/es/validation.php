<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => 'El :attribute debe ser aceptado.',
    'active_url'      => 'El :attribute no es una URL válida.',
    'after'           => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal'  => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha'           => 'El :attribute solo puede contener letras.',
    'alpha_dash'      => 'El :attribute solo puede contener letras, números y guiones.',
    'alpha_num'       => 'El :attribute solo puede contener letras y números.',
    'array'           => 'El :attribute debe ser un arreglo.',
    'before'          => 'El :attribute debe ser una fecha previa a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha previa o igual a :date.',
    'between'         => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file'    => 'El :attribute debe estar entr :min y :max kilobytes.',
        'string'  => 'El :attribute debe estar entr :min y :max caracteres.',
        'array'   => 'El :attribute debe estar entr :min y :max elementos.',
    ],
    'boolean'        => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'      => 'La confirmación de :attribute no coincide.',
    'date'           => 'El :attribute no es una fecha válida.',
    'date_format'    => 'El :attribute no coincide con el formato :format.',
    'different'      => 'El :attribute y :other deben ser diferentes.',
    'digits'         => 'El :attribute debe ser :digits dígitos.',
    'digits_between' => 'El :attribute debe estar entre :min y :max dígitos.',
    'dimensions'     => 'El :attribute posee unas dimensiones de imagen inválidas.',
    'distinct'       => 'El campo :attribute posee un valor duplicado.',
    'email'          => 'El :attribute debe ser un email válido.',
    'exists'         => 'El selected :attribute es inválido.',
    'file'           => 'El :attribute debe ser un archivo.',
    'filled'         => 'El campo :attribute debe tener un valor.',
    'image'          => 'El :attribute debe ser una imagen.',
    'in'             => 'El selected :attribute es inválido.',
    'in_array'       => 'El campo :attribute no existe en :other.',
    'integer'        => 'El :attribute debe ser un entero.',
    'ip'             => 'El :attribute debe ser una dirección IP válida.',
    'json'           => 'El :attribute debe ser una cadena JSON válida.',
    'max'            => [
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'file'    => 'El :attribute no debe ser mayor de :max kilobytes.',
        'string'  => 'El :attribute no debe ser mayor de :max caracteres.',
        'array'   => 'El :attribute no debe tener mas de :max elementos.',
    ],
    'mimes'     => 'El :attribute debe ser un archivo del tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo del tipo: :values.',
    'min'       => [
        'numeric' => 'El :attribute debe tener al menos :min.',
        'file'    => 'El :attribute debe tener al menos :min kilobytes.',
        'string'  => 'El :attribute debe tener al menos :min caracteres.',
        'array'   => 'El :attribute mdebe tener al menos :min elementos.',
    ],
    'not_in'               => 'El selected :attribute es inválido.',
    'numeric'              => 'El :attribute debe ser una número.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El :attribute formato es inválido.',
    'required'             => 'El campo :attribute es requerido.',
    'required_if'          => 'El campo :attribute es requerido cuando :other is :value.',
    'required_unless'      => 'El campo :attribute es requerido a menos que :other está en :values.',
    'required_with'        => 'El campo :attribute es requerido cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es requerido cuando :values está presente.',
    'required_without'     => 'El campo :attribute es requerido cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno :values están presentes.',
    'same'                 => 'El :attribute y :other must match.',
    'size'                 => [
        'numeric' => 'El :attribute debe ser :size.',
        'file'    => 'El :attribute debe ser :size kilobytes.',
        'string'  => 'El :attribute debe ser :size caracteres.',
        'array'   => 'El :attribute debe contener :size elementos.',
    ],
    'string'   => 'El :attribute debe ser una cadena.',
    'timezone' => 'El :attribute debe ser una zona válida.',
    'unique'   => 'El :attribute ya está en uso.',
    'uploaded' => 'El :attribute no se pudo subir.',
    'url'      => 'El :attribute formato inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
