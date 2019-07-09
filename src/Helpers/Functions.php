<?php
    
    if (!function_exists('format_phone'))
    {
        /**
         * Format Phone
         *
         * A quick and dirty helper function
         * to clean up phone numbers to the
         * correct format for Tenstreet.
         *
         * @param $dirtyPhone
         *
         * @return string
         */
        function format_phone($dirtyPhone)
        {
            $cleanPhone = preg_replace("/[^0-9]/", "", $dirtyPhone);
            preg_match("/^[0-9]?([0-9]{3})([0-9]{3})([0-9]{4})$/", $cleanPhone, $matches);
            array_shift($matches);
            return implode("-", $matches);
        }
    }