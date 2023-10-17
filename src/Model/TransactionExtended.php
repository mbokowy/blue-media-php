<?php

namespace BlueMedia\OnlinePayments\Model;

use BlueMedia\OnlinePayments\Gateway;
use BlueMedia\OnlinePayments\Util\Sorter;
use BlueMedia\OnlinePayments\Util\Validator;
use DateTime;

class TransactionExtended extends TransactionStandard
{

    protected $products = [];

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProductsAsXML(){
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('productList');
        /** @var Product $product */
        foreach($this->products as $product) {
            $xml->startElement('product');
                $xml->writeElement("subAmount", $product->getSubamount());
                $xml->startElement('params');
                /** @var ProductParam $param */
                foreach ($product->getParams() as $param){
                    $xml->startElement('param');
                    $xml->writeAttribute('name', $param->getName());
                    $xml->writeAttribute('value', $param->getValue());
                    $xml->endElement();
                }
                $xml->endElement();
            $xml->endElement();
        }
        $xml->endElement();

        return $xml->outputMemory();
    }

    /**
     * Return object data as array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $result = parent::toArray();
        if(!empty($this->products)){
            $xml = $this->getProductsAsXML();
            $result['Products'] = base64_encode($xml);
        }

        return Sorter::sortTransactionParams($result);
    }
}
