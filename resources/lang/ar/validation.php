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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'حقل :attribute يجب ان يكون بعد :date.',
    'after_or_equal' => 'حقل :attribute يجب ان يكون يساوي او بعد :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'حقل :attribute يجب ان يكون قبل :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'حقل :attribute يجب ان يكون بريد الكتروني صحيح.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'حقل :attribute يجب ان يكون عددا صحيحا.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'حقل :attribute يجب ان لا يكون اكبر من :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'حقل :attribute يجب ان لا يكون اطول من :max خانة.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'حقل :attribute يجب ان كون من نوع: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'حقل :attribute يجب ان لا يكون اصغر من :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'حقل :attribute يجب ان يكون رقما.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'تأكد من صحة حقل :attribute',
    'required' => 'حقل :attribute مطلوب',
    'required_if' => 'حقل :attribute مطلوب',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'حقل :attribute مطلوب',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'حقل :attribute مطلوب',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'حقل :attribute موجود مسبقا.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

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

    'attributes' => [
        'title' => 'العنوان',
        'email' => 'الايميل',
        'password' => 'كلمة السر',
        'phone' => 'الجوال',
        'value' => 'القيمة',
        'title_en' => 'العنوان الانجليزي',
        'title_ar' => 'العنوان العربي',
        'name' => 'الاسم',
        'name_en' => 'الاسم بالانجليزية',
        'name_ar' => 'الاسم بالعربية',
        'description' => 'الوصف',
        'description_en' => 'الوصف الانجليزي',
        'description_ar' => 'الوصف العربي',
        'details' => 'التفاصيل',
        'details_en' => 'التفاصيل الانجليزية',
        'details_ar' => 'التفاصيل العربية',
        'name_en'=>'الاسم بالانجليزية',
        'name_ar'=>'الاسم بالعربية',
        'details_en'=>'الوصف بالانجليزية',
        'details_ar'=>'الوصف بالعربية',
        'partner_name_en'=>'اسم الشريك بالانجليزية',
        'partner_name_ar'=>'اسم الشريك بالعربية',
        'partner_details_en'=>'وصف الشري بالانجليزية',
        'partner_details_ar'=>'وصف الشريك بالعربية',
        'partner_address_en'=>'عنوان الشريك بالانجليزية',
        'partner_address_ar'=>'عنوان الشريك بالعربية',
        'price'=>'السعر',
        'discount'=>'الخصم',
        'partner_city_id'=>'المدينة',
        'partner_country_id'=>'الدولة',
        'country_id'=>'الدولة',
        'logo'=>'الشعار',
        'partner_logo'=>'شعار الشريك',
        'image'=>'الصورة الرئيسية',
        'partner_lat'=>'موقع الشريك عرض',
        'partner_lon'=>'موقع الشريك طول',
        'category_id'=>'التصنيف',
        'pct' => 'النسبة',
        'question_en'=>'السؤال بالانجليزية',
        'question_ar'=>'السؤال بالعربية',
        'answer_en'=>'الجواب بالانجليزية',
        'answer_ar'=>'الجواب بالعربية',
        'city_id'=>'المدينة',
        'start_date' => 'تاريخ البداية',
        'end_date' => 'تاريخ النهاية',
        'host_name' => 'اسم الداعي',
        'groom_name' => 'اسم المتزوج',
        'bride_name' => 'اسم المتزوجة',
        'occasion_date' => 'تاريخ المناسبة',
        'income'=>'الدخل الشهري',
        'social_security'=>'الضمان الاجتماعي',
        'family_connection'=>'صلة الارتباط بالعشيرة',
        'family_connection_text'=>'صلة الارتباط بالعشيرة',
        'family_count_help'=>'عدد الأفراد الذي يعولهم مستحق المساعدة',
        'family_count'=>'عدد افراد الاسرة',
        'salary_type'=>'الراتب',
        'client_status'=>'نوع الحالة',
        'client_status_text'=>'نوع الحالة',
        'home_info'=>'معلومات السكن',
        'home_type'=>'نوع السكن',
        'help_type'=>'نوع الإعانة المطلوبة',
        'help_type_text'=>'نوع الإعانة المطلوبة',
        'specialization'=>'التخصص',
        'org'=>'المنظمة',
        'gender'=>'الجنس',
        'link'=>'الرابط',
        'roles'=>'الادوار',
        'zone_id'=>'المنطقة',

    ],

];
