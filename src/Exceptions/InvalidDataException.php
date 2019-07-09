<?php
    
    namespace CollingMedia\Tenstreet\Exceptions;
    
    /**
     * Class InvalidDataException
     *
     * Handles throwing an exception for
     * the invalid data that was passed.
     *
     * @since 1.0.0
     *
     * @package CollingMedia\Tenstreet
     */
    class InvalidDataException extends \Exception
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
        protected $message = 'The data provided is not valid, or could not be validated as an array, string, or SimpleXML Object.';
    
        /**
         * Code
         *
         * The code thrown with the error.
         *
         * @since 1.0.0
         *
         * @var int
         */
        protected $code = 9902;
    }