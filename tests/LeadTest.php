<?php
    
    use Faker\Factory;
    use Faker\Provider\Person;
    use PHPUnit\Framework\TestCase;
    
    /**
     * Class LeadTest
     *
     * PHP Unit Test information for
     * Lead parsing.
     *
     * @since 1.0.0
     */
    final class LeadTest extends TestCase
    {
        public function testCanParseRequest(): void
        {
            $faker = Factory::create();
            
            $tenstreet = new \CollingMedia\Tenstreet\Tenstreet();
    
        }
    }
