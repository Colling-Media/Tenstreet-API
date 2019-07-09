<?php
    
    namespace CollingMedia\Tenstreet;
    
    use CollingMedia\Tenstreet\Exceptions\InvalidDataException;
    use CollingMedia\Tenstreet\Exceptions\ValidationFailedException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use GuzzleHttp\Client;

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
         * The endpoint used for posting.
         *
         * @var string|null
         */
        private $endpoint = null;
    
        /**
         * The mode used for posting.
         * DEV is for development
         * PROD is for production
         *
         * @var string|null
         */
        private $mode = null;
    
        /**
         * The submissing return used
         * as defined and explained
         * in the config file.
         *
         * @var string|null
         */
        private $submission_return = null;
    
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
            $this->endpoint = config('tenstreet.endpoint');
            $this->mode = config('tenstreet.mode');
            $this->submission_return = config('tenstreet.submission_return');
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
        public function setSource (string $source): self
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
         * @param bool                     $submit
         *
         * @return array
         * @throws \CollingMedia\Tenstreet\Exceptions\ValidationFailedException
         * @throws \CollingMedia\Tenstreet\Exceptions\InvalidDataException
         * @since 1.0.0
         */
        public function parseRequest (Request $request, $submit = false): array
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
            if($submit) {
                return $this->submitLead($validator->validated());
            } else {
                return $validator->validated();
            }
            
        }
    
        /**
         * Submit Lead
         *
         * Submit the lead to Tenstreet!
         *
         *
         * This takes an array if you would
         * like to bypass the parsing
         * and validation that is built
         * into the package.
         *
         * You will still need to put the
         * correct keys in place though, in
         * reference to the config file
         * under tenstreet.fields.
         *
         * The key names are specific due
         * to Tenstreet's API being temperamental
         * about how exactly the whole thing is
         * laid out.
         *
         * You have the option to also pass
         * an XML string or SimpleXML object.
         * If you pass XML directly, we post
         * exactly what you have given straight
         * to Tenstreet, without correcting or
         * parsing anything.
         *
         * @param array|string|\SimpleXMLElement $data
         *
         * @return array|string
         * @throws \CollingMedia\Tenstreet\Exceptions\InvalidDataException
         * @since 1.0.0
         */
        public function submitLead($data): mixed
        {
            
            // ARRAY LOGIC
            if (is_array($data))
            {
                // TODO:: Implement the Array to XML then Post
            }
            
            // STRING LOGIC
            if (is_string($data))
            {
                // TODO:: Implement the String post
            }
            
            // SIMPLEXML LOGIC
            if (get_class($data) == \SimpleXMLElement::class)
            {
                // TODO:: Implement the SimpleXML Post
            }
            
            throw new InvalidDataException();
        }
    
        /**
         * Post
         *
         * Post the provided data to
         * Tenstreet with the correct
         * headers set.
         *
         * @param string $data
         * @param array  $options !!Not Yet Implemented!!
         *
         * @return \Psr\Http\Message\ResponseInterface
         * @since 1.0.0
         */
        protected  function post(string $data, $options = [])
        {
            $client = new Client();
            $response = $client->post($this->endpoint, [
                'headers' => [
                    'Content-Type' => 'text/xml; charset=utf8'
                ],
                'body' => $data,
            ]);
            return $response;
        }
    }