<?php

namespace BlueMedia\OnlinePayments\Util;

use function array_key_exists;
use function strtolower;

class Sorter
{
    /**
     * @param array $params
     *
     * @return array
     */
    public static function sortTransactionParams(array $params): array
    {
        $transactionParamsInOrder = [
            'ServiceID',
            'OrderID',
            'Amount',
            'Description',
            'GatewayID',
            'Currency',
            'CustomerEmail',
            'CustomerNRB',
            'TaxCountry',
            'CustomerIP',
            'Title',
            'ReceiverName',
            'Products',
            'BlikUIDKey',
            'BlikUIDLabel',
            'BlikAMKey',
            'ReturnURL',
            'ValidityTime',
            'LinkValidityTime',
            'receiverNRB',
            'receiverAddress',
            'remoteID',
            'bankHref',
            'AuthorizationCode',
            'ScreenType',
	        'DefaultRegulationAcceptanceState',
	        'DefaultRegulationAcceptanceID',
            'Hash',
        ];

        $result              = [];
        $lowercaseKeysParams = array_change_key_case($params, CASE_LOWER);

        foreach ($transactionParamsInOrder as $paramName) {
            $lowercaseParamName = strtolower($paramName);

            if (array_key_exists($lowercaseParamName, $lowercaseKeysParams)) {
                $result[$paramName] = $lowercaseKeysParams[$lowercaseParamName];
            }
        }
        
        return $result;
    }
}
