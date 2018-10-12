<?php
/**
 * Created by PhpStorm.
 * User: Arindam
 * Date: 08-07-2018
 * Time: 05:55
 */

namespace App;
use App\Item;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class Bill
{
    private $logo;
    private $address;
    private $phone;
    private $gst;

    private $billNumber;
    private $billDate;

    private $customerDetails;
    private $restaurantInfo;

    private $items;

    private $netAmount;
    private $discount;
    private $grandTotal;

    private $additionalInfo;

    public function __construct($jsonObj)
    {
        $this->logo = $jsonObj->logo;
        $this->address = $jsonObj->address;
        $this->phone = $jsonObj->phone;
        $this->gst = $jsonObj->gst;
        $this->billNumber = $jsonObj->billNumber;
        $this->billDate = $jsonObj->billDate;
        $this->customerDetails = $jsonObj->customerDetails;
        $this->restaurantInfo = $jsonObj->restaurantInfo;

        $this->items = array();
        foreach($jsonObj->items as $item)
        {
            $this->items[] = new Item($item);

        }

        $this->netAmount = $jsonObj->netAmount;
        $this->discount = $jsonObj->discount;
        $this->grandTotal = $jsonObj->grandTotal;
        $this->additionalInfo = $jsonObj->additionalInfo;


    }

    public function print()
    {
        /* Open the printer; this will change depending on how it is connected */
        $connector = new WindowsPrintConnector("thermal1");
        $printer = new Printer($connector);

        $logo = EscposImage::load($this->logo, false);

        /* Print top logo */
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->graphics($logo);

        /* Name of shop */
        $printer->text($this->address."\n");
        $printer->text("Phone ".$this->phone."\n");
        $printer->text("GST IN ".$this->gst."\n");


        $printer->text("-----------------------------------------------\n");
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->setEmphasis(true);
        $printer->text("ORIGINAL COPY \n");
        $printer->setEmphasis(false);
        $printer->selectPrintMode();
        $printer->text("-----------------------------------------------\n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);

        $printer->text(str_pad("Bill No: ". $this->billNumber, 26, ' ', STR_PAD_RIGHT) . str_pad("Bill Date: ".$this->billDate, 22, ' ', STR_PAD_LEFT) ."\n");
        $printer->text("-----------------------------------------------\n");

        $printer->text("Name: " . $this->customerDetails->name . "\n");
        $printer->text("Mobile: " . $this->customerDetails->mobile . "\n");
        $printer->text("Address: " . $this->customerDetails->address . "\n");

        $printer->text("-----------------------------------------------\n");
        $printer->text("Restaurant: " . $this->restaurantInfo->name . "\n");
        if(($this->restaurantInfo->no) == "0"){
            $printer->text("Parcel Order ". "\n");
        }
        else{
            $printer->text("Table No: " . $this->restaurantInfo->no . "\n");
        }
        // $printer->text("No: " . $this->restaurantInfo->no . "\n");
        $printer->text("-----------------------------------------------\n");

        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text("Item Details \n");
        $printer->selectPrintMode();
        $printer->text("-----------------------------------------------\n");

        $printer->text("\n");

        foreach($this->items as $item)
        {
            $printer->text($item);
        }
        $printer->text("-----------------------------------------------\n");

        $printer->text(str_pad("Grand Total: ", 33, ' ', STR_PAD_RIGHT) . str_pad($this->grandTotal, 13, ' ', STR_PAD_LEFT) ."\n");
        $printer->text(str_pad("Discount: ", 33, ' ', STR_PAD_RIGHT) . str_pad($this->discount, 13, ' ', STR_PAD_LEFT) ."\n");
        $printer->text("-----------------------------------------------\n");

        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->setEmphasis(true);
        $printer->text(str_pad("Net Billed: ", 33, ' ', STR_PAD_RIGHT) . str_pad($this->netAmount, 13, ' ', STR_PAD_LEFT) ."\n");
        $printer->setEmphasis(false);
        $printer->selectPrintMode();

        $printer->text("-----------------------------------------------\n\n");

        $printer->setJustification(Printer::JUSTIFY_CENTER);

        $printer->text("-----------------------------------------------\n");
        $printer->selectPrintMode(Printer::MODE_UNDERLINE);
        $printer->setEmphasis(true);
        $printer->text($this->additionalInfo->header."\n");
        $printer->setEmphasis(false);
        $printer->selectPrintMode();
        $printer->text($this->additionalInfo->body."\n");
        $printer->text("-----------------------------------------------\n\n");

        $printer->setJustification(Printer::JUSTIFY_LEFT);

        $printer->text("-----------------------------------------------\n");
        $printer->setEmphasis(true);
        $printer->text("Printed On:". date('d/m/Y')." | " . "Powered By TechBongo.com\n");
        $printer->setEmphasis(false);
        $printer->feed();

        /* Cut the receipt and open the cash drawer */
        $printer -> cut();

        $printer -> close();
    }
}

