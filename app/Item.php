<?php
/**
 * Created by PhpStorm.
 * User: Arindam
 * Date: 08-07-2018
 * Time: 05:57
 */

namespace App;



class Item
{
    private $name;
    private $quantity;
    private $rate;
    private $total;

    public function __construct($item)
    {
        $this->name = $item->name;
        $this->quantity = $item->quantity;
        $this->rate = $item->rate;
        $this->total = $item->total;
    }
    public function blank()
    {
        $this->name = null;
        $this->quantity = $item->quantity;
        $this->rate = $item->rate;
        $this->total = $item->total;
    }

    public function __toString()
    {
        $ratePadlength = 16;
        $quantityPadLength = 12;
        $totalStringPadlength = 6;
        $totalValuePadlength = 12;

        $rateString = str_pad('Rate:'.$this->rate, $ratePadlength, ' ', STR_PAD_RIGHT) ;
        $quantityString = str_pad('Qty: '.$this->quantity, $quantityPadLength, ' ', STR_PAD_RIGHT) ;
        $totalString = str_pad('Total:', $totalStringPadlength, ' ', STR_PAD_RIGHT) . str_pad($this->total, $totalValuePadlength, ' ', STR_PAD_LEFT);

        return strtoupper($this->name)."\n$rateString$quantityString$totalString\n";
    }
}