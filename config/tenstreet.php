<?php

return [
    
    /**
     * The API Key is provided from Tenstreet.
     * They should provide you one.
     */
    'api_key' => env("TENSTREET_API_KEY", null),
    
    /**
     * The Company ID is the ID that is assigned
     * to your company by Tenstreet.
     */
    'company_id' => env("TENSTREET_COMPANY_ID", null),
    
    /**
     * The source must be approved by Tenstreet
     * and tied to the API Key they provide you.
     */
    'source' => env("TENSTREET_SOURCE", null),
    
    /**
     * The mode is either DEV or PROD.
     *
     * If you set this to DEV, we replace the
     * Company ID with the Test Company ID (15),
     * and we will return the full response from
     * Tenstreet.
     *
     * If you set this to PROD, we use the
     * Company ID provided, and only return
     * a boolean unless you specify otherwise.
     */
    'mode' => env("TENSTREET_MODE", 'PROD'),
    
    /**
     * The submission return defines what
     * you get as a response from the
     * submitLead() function. It can either
     * be short or full.
     *
     * Short will read the response from
     * Tenstreet, and if it registers as
     * accepted, it will return an array with
     * the two keys:
     * [
     *  'accepted' => true/false,
     *  'subject_id' => string
     * ]
     *
     * The Subject ID is the Tenstreet
     * assigned ID for the lead. This ID
     * allows you to update or find a lead
     * later on.
     *
     * Full will return the full XML
     * response as a string, for you to
     * decode and use as you want.
     */
    'submission_return' => env("TENSTREET_SUBMISSION_RETURN", 'short'),
    
    /**
     * The only reason we provide the
     * ability to edit the endpoint is
     * for you to debug what the XML you
     * create looks like. Otherwise, it
     * should remain unchanged.
     *
     * The default value is:
     * https://dashboard.tenstreet.com/post/
     */
    'endpoint' => 'https://dashboard.tenstreet.com/post/',
    
    
    /**
     * The fields are a list of fields that can
     * be passed during the creation of a lead.
     *
     * They pass through the Laravel Validation
     * and are used if they pass validation.
     *
     * You can use the typical Laravel Validation
     * rules here. The default ones provided are
     * what are required by Tenstreet to create
     * a lead.
     *
     * We have included below an example of what
     * a display field, and custom question would
     * look like. We parse through the validation
     * rules and extract where they should go based
     * on what is included.
     *
     * If you plan on adding custom fields, that
     * you also want to pass through Laravel Validation,
     * you can read up on it here:
     *
     * https://laravel.com/docs/5.8/validation#available-validation-rules
     */
    'fields' => [
        /**
         * Basic Fields
         * These fields are available
         * by default to all API users.
         * The ones marked Required are
         * required by Tenstreet to create
         * a lead. All others are optional,
         * and have what we suggest as the
         * best validations for the fields.
         *
         * The phone numbers passed must be
         * in ***-***-**** format. You can
         * use the included helper function
         * to format the phone number if
         * you would like:
         *
         * $cleanNumber = format_phone($dirtyNumber);
         */
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|email',
        'referrer' => 'required|max:255',
        'primary_phone' => 'required|max:12',
        'secondary_phone' => 'max:12',
        'city' => '',
        'state' => '',
        'zip_code' => 'max:5',
    
    
        /**
         * CDL Information
         * The CDL information, if provided,
         * is automatically put into the
         * licenses fields in Tenstreet.
         *
         * If the CDL Number is provided,
         * the CDL Issuing State is required.
         */
        'cdl_number' => 'required_with:cdl_issuing_state',
        'cdl_issuing_state' => 'required_with:cdl_number',
        
        /**
         * Social Security Numbers
         * PLEASE NOTE: If you intend to pass Social
         * Security Numbers through to Tenstreet, it
         * is highly suggested to make sure you have
         * SSL on the instance, and encrypt the value
         * upon receiving it. We have included a custom
         * validation rule called decrypt. The variable
         * passed to it is decrypted using Laravel's built
         * in Hash::decrypt() function. We also suggest
         * not storing any Social Security Numbers.
         */
        // 'social_security_number' => 'decrypt'
        
        /**
         * Display Fields
         *
         * For display fields, you pass in the validation rules
         * displayField:{name}, and we put it in a display field
         * automatically under that name. The following is an example
         * of what you can do to pass a Campaign Name in.
         */
        // 'campaign_name' => 'displayField:Campaign Name|max:255',
        
        /**
         * Custom Questions
         *
         * For custom questions, again you pass it in the validation
         * rules, and we parse it out. This time though, you pass
         * customQuestion:{id}:{question}, and we parse it out
         * and create the required information.
         */
        // 'experience' => 'customQuestion:experience_level:Experience Level|max:255',
    ],
];
