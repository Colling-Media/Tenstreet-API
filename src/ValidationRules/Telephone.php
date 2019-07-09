<?php
    namespace CollingMedia\Tenstreet\ValidationRules;
    
    use Illuminate\Contracts\Validation\Rule;

    /**
     * Class Telephone
     *
     * Handles the validation for
     * form fields to confirm they
     * are formatted properly for
     * Tenstreet.
     *
     * @package CollingMedia\Tenstreet\ValidationRules
     */
    class Telephone implements Rule
    {
        /**
         * Determine if the validation rule passes.
         *
         * @param  string  $attribute
         * @param  mixed  $value
         * @return bool
         */
        public function passes($attribute, $value)
        {
            // TODO:: Implement the logic to handle detecting a properly formatted phone number
        }
        
        /**
         * Get the validation error message.
         *
         * @return string
         */
        public function message()
        {
            return 'The :attribute must be a in a valid phone number format.';
        }
    }