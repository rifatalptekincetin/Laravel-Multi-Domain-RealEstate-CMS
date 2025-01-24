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

    'accepted' => ':attribute kabul edilmelidir.',
    'accepted_if' => ':other :value olduğunda :attribute kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL olmalıdır.',
    'after' => ':attribute :date tarihinden sonra olmalıdır.',
    'after_or_equal' => ':attribute :date tarihinden sonra veya aynı tarihte olmalıdır.',
    'alpha' => ':attribute sadece harf içerebilir.',
    'alpha_dash' => ':attribute sadece harf, rakam, tire ve alt çizgi içerebilir.',
    'alpha_num' => ':attribute sadece harf ve rakam içerebilir.',
    'array' => ':attribute dizi olmalıdır.',
    'ascii' => ':attribute yalnızca tek baytlık alfanümerik karakterler ve semboller içerebilir.',
    'before' => ':attribute :date tarihinden önce olmalıdır.',
    'before_or_equal' => ':attribute :date tarihinden önce veya aynı tarihte olmalıdır.',
    'between' => [
        'array' => ':attribute :min - :max arasında öğe içermelidir.',
        'file' => ':attribute :min - :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute :min - :max arasında olmalıdır.',
        'string' => ':attribute :min - :max karakter arasında olmalıdır.',
    ],
    'boolean' => ':attribute alanı doğru veya yanlış olmalıdır.',
    'can' => ':attribute alanı yetkisiz bir değer içeriyor.',
    'confirmed' => ':attribute doğrulaması eşleşmiyor.',
    'current_password' => 'Şifre yanlış.',
    'date' => ':attribute geçerli bir tarih olmalıdır.',
    'date_equals' => ':attribute :date tarihine eşit olmalıdır.',
    'date_format' => ':attribute :format biçimi ile eşleşmelidir.',
    'decimal' => ':attribute :decimal ondalık basamağa sahip olmalıdır.',
    'declined' => ':attribute reddedilmelidir.',
    'declined_if' => ':other :value olduğunda :attribute reddedilmelidir.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute :digits basamaklı olmalıdır.',
    'digits_between' => ':attribute :min - :max basamak arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahiptir.',
    'distinct' => ':attribute alanı yinelenen bir değere sahiptir.',
    'doesnt_end_with' => ':attribute aşağıdakilerden biriyle bitmemelidir: :values.',
    'doesnt_start_with' => ':attribute aşağıdakilerden biriyle başlamamalıdır: :values.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with' => ':attribute aşağıdakilerden biriyle bitmelidir: :values.',
    'enum' => 'Seçilen :attribute geçersiz.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'extensions' => ':attribute şu uzantılardan birine sahip olmalıdır: :values.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanı bir değere sahip olmalıdır.',
    'gt' => [
        'array' => ':attribute :value öğeden fazla olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük olmalıdır.',
        'numeric' => ':attribute :value değerinden büyük olmalıdır.',
        'string' => ':attribute :value karakterden büyük olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute :value öğeden fazla olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük veya eşit olmalıdır.',
        'numeric' => ':attribute :value değerinden büyük veya eşit olmalıdır.',
        'string' => ':attribute :value karakterden büyük veya eşit olmalıdır.',
    ],
    'hex_color' => ':attribute geçerli bir onaltılık renk olmalıdır.',
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'in_array' => ':attribute alanı :other içinde mevcut değil.',
    'integer' => ':attribute bir tam sayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'list' => ':attribute bir liste olmalıdır.',
    'lowercase' => ':attribute küçük harf olmalıdır.',
    'lt' => [
        'array' => ':attribute :value öğeden az olmalıdır.',
        'file' => ':attribute :value kilobayttan küçük olmalıdır.',
        'numeric' => ':attribute :value değerinden küçük olmalıdır.',
        'string' => ':attribute :value karakterden küçük olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute :value öğeden fazla olmamalıdır.',
        'file' => ':attribute :value kilobayttan küçük veya eşit olmalıdır.',
        'numeric' => ':attribute :value değerinden küçük veya eşit olmalıdır.',
        'string' => ':attribute :value karakterden küçük veya eşit olmalıdır.',
    ],
    'mac_address' => ':attribute geçerli bir MAC adresi olmalıdır.',
    'max' => [
        'array' => ':attribute :max öğeden fazla olmamalıdır.',
        'file' => ':attribute :max kilobayttan büyük olmamalıdır.',
        'numeric' => ':attribute :max değerinden büyük olmamalıdır.',
        'string' => ':attribute :max karakterden büyük olmamalıdır.',
    ],
    'max_digits' => ':attribute :max basamaktan fazla olmamalıdır.',
    'mimes' => ':attribute dosya türü: :values olmalıdır.',
    'mimetypes' => ':attribute dosya türü: :values olmalıdır.',
    'min' => [
        'array' => ':attribute en az :min öğe içermelidir.',
        'file' => ':attribute en az :min kilobayt olmalıdır.',
        'numeric' => ':attribute en az :min olmalıdır.',
        'string' => ':attribute en az :min karakter olmalıdır.',
    ],
    'min_digits' => ':attribute en az :min basamaklı olmalıdır.',
    'missing' => ':attribute eksik olmalıdır.',
    'missing_if' => ':other :value olduğunda :attribute eksik olmalıdır.',
    'missing_unless' => ':other :value olmadığında :attribute eksik olmalıdır.',
    'missing_with' => ':values mevcut olduğunda :attribute eksik olmalıdır.',
    'missing_with_all' => ':values mevcut olduğunda :attribute eksik olmalıdır.',
    'multiple_of' => ':attribute :value katı olmalıdır.',
    'not_in' => 'Seçilen :attribute geçersiz.',
    'not_regex' => ':attribute biçimi geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'password' => [
        'letters' => ':attribute en az bir harf içermelidir.',
        'mixed' => ':attribute en az bir büyük harf ve bir küçük harf içermelidir.',
        'numbers' => ':attribute en az bir rakam içermelidir.',
        'symbols' => ':attribute en az bir sembol içermelidir.',
        'uncompromised' => 'Verilen :attribute bir veri sızıntısında göründü. Lütfen farklı bir :attribute seçin.',
    ],
    'present' => ':attribute mevcut olmalıdır.',
    'present_if' => ':other :value olduğunda :attribute mevcut olmalıdır.',
    'present_unless' => ':other :value olmadığında :attribute mevcut olmalıdır.',
    'present_with' => ':values mevcut olduğunda :attribute mevcut olmalıdır.',
    'present_with_all' => ':values mevcut olduğunda :attribute mevcut olmalıdır.',
    'prohibited' => ':attribute alanı yasaktır.',
    'prohibited_if' => ':other :value olduğunda :attribute yasaktır.',
    'prohibited_unless' => ':other :values içinde olmadığında :attribute yasaktır.',
    'prohibits' => ':attribute alanı :other mevcut olmasını engeller.',
    'regex' => ':attribute biçimi geçersiz.',
    'required' => ':attribute alanı gereklidir.',
    'required_array_keys' => ':attribute şunlar için girişler içermelidir: :values.',
    'required_if' => ':other :value olduğunda :attribute gereklidir.',
    'required_if_accepted' => ':other kabul edildiğinde :attribute gereklidir.',
    'required_unless' => ':other :values içinde olmadığında :attribute gereklidir.',
    'required_with' => ':values mevcut olduğunda :attribute gereklidir.',
    'required_with_all' => ':values mevcut olduğunda :attribute gereklidir.',
    'required_without' => ':values mevcut olmadığında :attribute gereklidir.',
    'required_without_all' => ':values mevcut olmadığında :attribute gereklidir.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'array' => ':attribute :size öğe içermelidir.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'numeric' => ':attribute :size olmalıdır.',
        'string' => ':attribute :size karakter olmalıdır.',
    ],
    'starts_with' => ':attribute aşağıdakilerden biriyle başlamalıdır: :values.',
    'string' => ':attribute bir dize olmalıdır.',
    'timezone' => ':attribute geçerli bir saat dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'uploaded' => ':attribute yüklenemedi.',
    'uppercase' => ':attribute büyük harf olmalıdır.',
    'url' => ':attribute geçerli bir URL olmalıdır.',
    'ulid' => ':attribute geçerli bir ULID olmalıdır.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
