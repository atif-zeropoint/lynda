<?php
namespace TDD\test;
require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase{

    public function setUp()
    {
        $this->receipt = new Receipt();
    }

    public function tearDown()
    {
        unset($this->receipt);
    }

    public  function testTotal() {

        $input = [0,2,3,5];
        $output = $this->receipt->total($input);

        $this->assertEquals(
            10,
            $output,
            'When summing the total should be 10'
        );
    }

    public function testTax()
    {
        $inputAmount =  10.00;
        $taxAmount = 0.10;
        $output = $this->receipt->tax($inputAmount, $taxAmount);

        $this->assertEquals(
            1.00,
            $output,
            "The tax calculation should equal to 1.00"
        );
    }
}
