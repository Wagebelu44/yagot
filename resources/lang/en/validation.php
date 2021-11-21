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
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
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
    'email' => 'The :attribute must be a valid email address.',
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
    'integer' => 'The :attribute must be an integer.',
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
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is.',
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
    'unique' => 'The :attribute has already been taken.',
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
        'summary' => 'summary',
        'title' => 'title',
        'title_en' => 'english title',
        'title_ar' => 'arabic title',
        'name' => 'name',
        'name_en' => 'english name',
        'name_ar' => 'arabic name',
        'description' => 'description',
        'description_en' => 'english description',
        'description_ar' => 'arabic description',
        'details' => 'details',
        'details_en' => 'english details',
        'details_ar' => 'arabic details',
        'content' => 'content',
        'content_en' => 'english content',
        'content_ar' => 'arabic content',
        'details' => 'details',
        'main_image' => 'main image',
        'additional_images' => 'additional images',
        'language_id' => 'language',
        'status_id' => 'status',
        'category_id' => 'category',
        'icon' => 'icon',
        'company_profile_text'=>'company profile',
        'status' => 'status',
        'start_date' => 'start date',
        'end_date' => 'end date',
        'performance_start_date' => 'application start date',
        'performance_end_date' => 'application end date',
        'price'=>'price',
        'visitation_goal'=>'visitation goal',
        'photo'=>'photo',
        'slug'=>'slug',
        'organizer_name'=>'organizer name',
        'delegate_name'=>'delegate name',
        'delegate_title'=>'delegate job title',
        'link'=>'link',
        'logo'=>'logo',
        'venue_logo'=>'venue logo',
        'number'=>'number',
        //show application validation
        'company_name'=>'company name',
        'company_tax_id_number'=>'company tax id number',
        'country'=>'country',
        'address'=>'address',
        'applicant_name_1'=>'first applicant\'s name',
        'applicant_name_2'=>'second applicant\'s name',
        'passport_number_1'=>'first applicant\'s passport number',
        'passport_number_2'=>'second applicant\'s passport number',
        'passport_image_1'=>'first applicant\'s passport image',
        'passport_image_2'=>'second applicant\'s passport image',
        'visa_image_1'=>'first applicant\'s business card image',
        'visa_image_2'=>'second applicant\'s business card image',
        'gender_1'=>'first applicant\'s gender',
        'gender_2'=>'second applicant\'s gender',
        'job_title_1'=>'first applicant\'s job title',
        'job_title_2'=>'second applicant\'s job title',
        'need_visa_1'=>'first applicant need visa',
        'need_visa_2'=>'second applicant need visa',
        'room_type'=>'room type',
        'phone_no'=>'phone number',
        'office_phone_no'=>'company office phone number',
        'fax'=>'fax',
        'email'=>'email',
        'website'=>'website',
        'facebook'=>'facebook business page',
        'company_profile'=>'company profile',
        'targeted_products'=>'targeted products',
        'branches_count'=>'number of branches/shops',
        'employee_count'=>'number of employees',
        'country_count'=>'number of countries covered',
        'importing_countries'=>'list of importing countries',
        'name_en'=>'english name',
        'name_ar'=>'arabic name',
        'details_en'=>'english details',
        'details_ar'=>'arabic details',
        'partner_name_en'=>'partner name in english',
        'partner_name_ar'=>'partner name in arabic',
        'partner_details_en'=>'partner details in english',
        'partner_details_ar'=>'partner details in english',
        'partner_address_en'=>'partner details in english',
        'partner_address_ar'=>'partner details in english',
        'price'=>'price',
        'discount'=>'discount',
        'city_id'=>'city',
        'partner_city_id'=>'partner city',
        'partner_country_id'=>'partner country',
        'partner_logo'=>'partner logo',
        'image'=>'main image',
        'partner_lat'=>'partner latitude',
        'partner_lon'=>'partner longitude',
        'category_id'=>'category',
        'country_id'=>'country',
        'logo'=>'logo',
        'pct' => 'percentage',
    'start_date' => 'start date',
    'end_date' => 'end date',


    ],

];