<?php

namespace BlueMedia\OnlinePayments\Model;

use BlueMedia\OnlinePayments\Util\Formatter;

class Product{
    protected $subamount;
    protected $params;

    /**
     * @return mixed
     */
    public function getSubamount()
    {
        return Formatter::formatAmount($this->subamount);
    }

    /**
     * @param mixed $subamount
     */
    public function setSubamount($subamount): void
    {
        $this->subamount = $subamount;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }
}