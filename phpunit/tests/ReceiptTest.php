<?php
namespace TDD\Test;
require __DIR__  . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Receipt;

class ReceiptTest extends TestCase {

    public function setUp()
    {
        $this->Receipt = new Receipt();
    }

    public function tearDown()
    {
        unset($this->Receipt);
    }

    /**
     * @dataProvider provideTotal
     */
    public function testTotal($items, $expected) {

        $coupon = null;
        $output = $this->Receipt->total($items, $coupon);

        $this->assertEquals($expected, $output, "When summing total should be {$expected}");

    }

    public function provideTotal() {
        return [
            'ints totalling 16' => [[1,2,5,8], 16],
            [[1,5,8], 14],
            [[-1,2,5,8], 14],
        ];
    }

    public function testTotalAndCoupon() {

        $input = [0,4,8,3];
        $coupon = 0.20;
        $output = $this->Receipt->total($input, $coupon);

        $this->assertEquals(12, $output, 'When summing total should be 12');

    }

    public function testTotalException() {

        $input = [0,4,8,3];
        $coupon = 1.20;
        $this->expectException('BadMethodCallException');
        $this->Receipt->total($input, $coupon);
    }

    public function testPostTaxTotal() {

        $items = [1,2,5,8];
        $tax = 0.20;
        $coupon = null;

        $receipt = $this->getMockBuilder('TDD\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();

        $receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));

        $receipt->expects($this->once())
            ->method('tax')
            ->with(10.00, $tax)
            ->will($this->returnValue(1.00));

        $result = $receipt->postTaxTotal([1,2,5,8], 0.20, null);

        $this->assertEquals(11.00, $result);

    }



    public function testTax() {

        $amount = 10.00;
        $tax = 0.10;

        $output = $this->Receipt->tax($amount, $tax);

        $this->assertEquals(1.00, $output, "The tax should equal to 1.00");
    }
}