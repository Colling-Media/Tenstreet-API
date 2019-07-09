<?php
    
    namespace CollingMedia\Tenstreet;
    
    use Illuminate\Http\Request;

    /**
     * Class Tenstreet
     *
     * The main file for the package.
     * Handles setting up the entire thing.
     *
     * @since 1.0.0
     *
     * @package CollingMedia\Tenstreet
     */
    class Tenstreet
    {
    
        /**
         * The fields used in the creation
         * of a lead, or reading of a lead.
         *
         * @var array
         */
        private $fields = [];
    
        /**
         * The API Key provided from Tenstreet.
         *
         * @var string|null
         */
        private $api_key = null;
    
        /**
         * The Company ID provided from Tenstreet.
         *
         * @var integer|null
         */
        private $company_id = null;
    
        /**
         * The source that is approved by Tenstreet.
         *
         * @var string|null
         */
        private $source = null;
    
        /**
         * Tenstreet constructor.
         *
         * @return void
         * @since 1.0.0
         *
         */
        public function __construct ()
        {
            $this->fields = config('tenstreet.fields');
            $this->api_key = config('tenstreet.api_key');
            $this->company_id = config('tenstreet.company_id');
            $this->source = config('tenstreet.source');
        }
    
        /**
         * Set Source
         *
         * Set the source of the lead to send.
         *
         * @param string $source
         *
         * @return \CollingMedia\Tenstreet\Tenstreet
         *
         * @since 1.0.0
         *
         */
        public function setSource (string $source)
        {
            $this->source = $source;
            return $this;
        }
    
        /**
         * Parse Request
         *
         * Parses out the request passed to it
         * for the fields provided in the config.
         *
         * Validates all fields, if a field fails
         * validation, it returns the validation
         * errors.
         *
         * @since 1.0.0
         *
         * @param \Illuminate\Http\Request $request
         */
        public function parseRequest (Request $request)
        {
        
        }
    }