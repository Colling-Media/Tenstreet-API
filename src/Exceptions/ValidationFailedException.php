<?php
    
    namespace CollingMedia\Tenstreet\Exceptions;
    
    /**
     * Class ValidationFailedException
     *
     * Handles throwing an exception for
     * the invalid data that was passed.
     *
     * @since 1.0.0
     *
     * @package CollingMedia\Tenstreet
     */
    class ValidationFailedException extends \Exception
    {
    
        /**
         * Message
         *
         * The exception message.
         *
         * @since 1.0.0
         *
         * @var string
         */
        protected $message = 'The data provided is not valid data, or could not be validated.';
    
        /**
         * Code
         *
         * The code thrown with the error.
         *
         * @since 1.0.0
         *
         * @var int
         */
        protected $code = 9901;
    
        /**
         * ValidationFailedException constructor.
         *
         * The constructor of the exception.
         *
         * @since 1.0.0
         *
         * @param null|array $errors
         */
        public function __construct($errors = null) {
            if($errors) {
                $fields = [];
                foreach ($errors AS $field => $error) {
                    $fields[] = $field;
                }
                $this->message = 'The data for the fields: ' . implode(', ', $fields) . ' did not pass validation.';
            }
        }
    }