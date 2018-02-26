<?php
namespace TDD;

use BadMethodCallException;
class Receipt{

    /**
     * @param array $items
     * @param $coupon
     * @return float|int
     */
    public function total(array $items = [], $coupon) {
        if($coupon > 1.00){
            throw new BadMethodCallException('Coupon must be or equal to 1.00');
        }
        $sum = array_sum($items);
        return !is_null($coupon) ? $sum - ($sum * $coupon) : $sum;
    }

    /**
     * @param $amount
     * @param $tax
     * @return float|int
     */
    public function tax($amount, $tax) {
        return ($amount * $tax);
    }

    /**
     * @param $items
     * @param $tax
     * @param $coupon
     * @return float|int
     */
    public function postTaxTotal($items, $tax, $coupon) {
        $subTotal = $this->total($items, $coupon);
        return $subTotal + $this->tax($subTotal, $tax);
    }

}