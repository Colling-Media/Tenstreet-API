<?php
    
    namespace CollingMedia\Tenstreet;
    
    use CollingMedia\Tenstreet\Exceptions\ValidationFailedException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

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
         * @return \CollingMedia\Tenstreet\Tenstreet
         * @since 1.0.0
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
         * @param \Illuminate\Http\Request $request
         * @return array
         * @throws \CollingMedia\Tenstreet\Exceptions\ValidationFailedException
         * @since 1.0.0
         */
        public function parseRequest (Request $request)
        {
            // Setup the variables for the function
            $validations = [];
            $displayFields = [];
            $customQuestions = [];
            
            // Loop through the fields from the config and parse out the custom questions and display fields
            foreach ($this->fields AS $field => $validation) {
                $check = explode($validation, '|');
                foreach ($check AS $item) {
                    if(strpos($item, 'customQuestion') !== false) {
                        $cq = explode($item, ':');
                        $customQuestions[$field] = [
                            'id' => $cq[1],
                            'question' => $cq[2]
                        ];
                        unset($check[$item]);
                    }
                    if(strpos($item, 'displayField') !== false) {
                        $df = explode($item, ':');
                        $displayFields[$field] = [
                            'name' => $df[1],
                        ];
                        unset($check[$item]);
                    }
                }
                $validations[$field] = implode($check, '|');
            }
            
            $validator = Validator::make($request->all(), $validations);
            
            if($validator->fails()) {
                throw new ValidationFailedException($validator->errors()->toArray());
            }
            
            return $validator->validated();
        }
    }