<?php

namespace BlueMedia\OnlinePayments\Model;

use BlueMedia\OnlinePayments\Action\ITN\Transformer;
use BlueMedia\OnlinePayments\Util\Formatter;
use BlueMedia\OnlinePayments\Util\Validator;
use DateTime;
use DomainException;

class ItnIn extends AbstractModel
{
    const PAYMENT_STATUS_PENDING = 'PENDING';
    const PAYMENT_STATUS_SUCCESS = 'SUCCESS';
    const PAYMENT_STATUS_FAILURE = 'FAILURE';

    const PAYMENT_STATUS_DETAILS_AUTHORIZED = 'AUTHORIZED';
    const PAYMENT_STATUS_DETAILS_ACCEPTED = 'ACCEPTED';
    const PAYMENT_STATUS_DETAILS_INCORRECT_AMOUNT = 'INCORRECT_AMOUNT';
    const PAYMENT_STATUS_DETAILS_EXPIRED = 'EXPIRED';
    const PAYMENT_STATUS_DETAILS_CONFIRMED = 'CONFIRMED';
    const PAYMENT_STATUS_DETAILS_CANCELLED = 'CANCELLED';
    const PAYMENT_STATUS_DETAILS_ANOTHER_ERROR = 'ANOTHER_ERROR';
    const PAYMENT_STATUS_DETAILS_REJECTED = 'REJECTED';
    const PAYMENT_STATUS_DETAILS_REJECTED_BY_USER = 'REJECTED_BY_USER';
    const PAYMENT_STATUS_ERROR_TX_NOT_FOUND = 'ER_TX_NOTFOUND';

    const CONFIRMATION_CONFIRMED = 'CONFIRMED';
    const CONFIRMATION_NOT_CONFIRMED = 'NOTCONFIRMED';

    const VERIFICATION_STATUS_PENDING = 'PENDING';
    const VERIFICATION_STATUS_POSITIVE = 'POSITIVE';
    const VERIFICATION_STATUS_NEGATIVE = 'NEGATIVE';

    const VERIFICATION_STATUS_REASON_NAME = 'NAME';
    const VERIFICATION_STATUS_REASON_NRB = 'NRB';
    const VERIFICATION_STATUS_REASON_TITLE = 'TITLE';
    const VERIFICATION_STATUS_REASON_STREET = 'STREET';
    const VERIFICATION_STATUS_REASON_HOUSE_NUMBER = 'HOUSE_NUMBER';
    const VERIFICATION_STATUS_REASON_STAIRCASE = 'STAIRCASE';
    const VERIFICATION_STATUS_REASON_PREMISE_NUMBER = 'PREMISE_NUMBER';
    const VERIFICATION_STATUS_REASON_POSTAL_CODE = 'POSTAL_CODE';
    const VERIFICATION_STATUS_REASON_CITY = 'CITY';
    const VERIFICATION_STATUS_REASON_BLACKLISTED = 'BLACKLISTED';
    const VERIFICATION_STATUS_REASON_SHOP_FORMAL_REQUIREMENTS = 'SHOP_FORMAL_REQUIREMENTS';
    const VERIFICATION_STATUS_REASON_NEED_FEEDBACK = 'NEED_FEEDBACK';

    const CARD_DATA_ISSUER_VISA = 'VISA';
    const CARD_DATA_ISSUER_MASTERCARD = 'MASTERCARD';
    const CARD_DATA_ISSUER_MAESTRO = 'MAESTRO';
    const CARD_DATA_ISSUER_AMERICAN_EXPRESS = 'AMERICAN EXPRESS';
    const CARD_DATA_ISSUER_DISCOVER = 'DISCOVER';
    const CARD_DATA_ISSUER_DINERS = 'DINERS';

    /**
     * Service id.
     *
     * @var int
     */
    protected $serviceId;

    /**
     * Payment order id.
     *
     * @var string
     */
    protected $orderId = '';

    /**
     * Payment remote id.
     *
     * @var string
     */
    protected $remoteId = '';

    /**
     * Payment amount.
     *
     * @var float
     */
    protected $amount;

    /**
     * Payment currency.
     *
     * @var string
     */
    protected $currency = '';

    /**
     * Payment gateway id.
     *
     * @var int
     */
    protected $gatewayId;

    /**
     * Payment date.
     *
     * @var DateTime | null
     */
    protected $paymentDate;

    /**
     * Payment status.
     *
     * @var string
     */
    protected $paymentStatus = '';

    /**
     * Payment status details.
     *
     * @var string
     */
    protected $paymentStatusDetails = '';

    /**
     * Customer IP address.
     *
     * @var string
     */
    protected $addressIp = '';

    /**
     * Tytuł wpłaty.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Imię płatnika.
     *
     * @var string
     */
    protected $customerDatafName = '';

    /**
     * Nazwisko płatnika.
     *
     * @var string
     */
    protected $customerDatalName = '';

    /**
     * Nazwa ulicy płatnika.
     *
     * @var string
     */
    protected $customerDataStreetName = '';

    /**
     * Numer domu płatnika.
     *
     * @var string
     */
    protected $customerDataStreetHouseNo = '';

    /**
     * Numer klatki płatnika.
     *
     * @var string
     */
    protected $customerDataStreetStaircaseNo = '';

    /**
     * Numer lokalu płatnika.
     *
     * @var string
     */
    protected $customerDataStreetPremiseNo = '';

    /**
     * Kod pocztowy adresu płatnika.
     *
     * @var string
     */
    protected $customerDataPostalCode = '';

    /**
     * Customer address - city.
     *
     * @var string
     */
    protected $customerDataCity = '';

    /**
     * Customer bank account number.
     *
     * @var string
     */
    protected $customerDataNrb = '';

    /**
     * Transaction authorisation date.
     *
     * @var DateTime | null
     */
    protected $transferDate;

    /**
     * Transaction authorisation status.
     *
     * @var string
     */
    protected $transferStatus = '';

    /**
     * Transaction authorisation details.
     *
     * @var string
     */
    protected $transferStatusDetails = '';

    /**
     * Transaction receiver bank.
     *
     * @var string
     */
    protected $receiverBank = '';

    /**
     * Transaction receiver bank account number.
     *
     * @var string
     */
    protected $receiverNRB = '';

    /**
     * Transaction receiver name.
     *
     * @var string
     */
    protected $receiverName = '';

    /**
     * Transaction receiver address.
     *
     * @var string
     */
    protected $receiverAddress = '';

    /**
     * Transaction sender bank.
     *
     * @var string
     */
    protected $senderBank = '';

    /**
     * Transaction sender account bank.
     *
     * @var string
     */
    protected $senderNRB = '';

    /**
     * Hash.
     *
     * @var string
     */
    protected $hash = '';

    /**
     * Payment remote out id.
     *
     * @var string
     */
    protected $remoteOutID = '';

    /**
     * Numer dokumentu finansowego w Serwisie.
     *
     * @var string
     */
    protected $invoiceNumber = '';

    /**
     * Numer Klienta w Serwisie.
     *
     * @var string
     */
    protected $customerNumber = '';

    /**
     * Adres email Klienta.
     *
     * @var string
     */
    protected $customerEmail = '';

    /**
     * Numer telefonu Klienta.
     *
     * @var string
     */
    protected $customerPhone = '';

    /**
     * Dane płatnika w postaci niepodzielonej.
     *
     * @var string
     */
    protected $customerDataSenderData = '';

    /**
     * Status weryfikacji płatnika.
     *
     * @var string
     */
    protected $verificationStatus = '';

    /**
     * Lista zawierająca powody negatywnej, lub oczekującej weryfikacji.
     *
     * @var array
     */
    protected $verificationStatusReasons = [];

    /**
     * Kwota początkowa transakcji.
     *
     * @var float
     */
    protected $startAmount;

    /**
     * Akcja w procesie płatności automatycznej.
     *
     * @var string
     */
    protected $recurringDataRecurringAction = '';

    /**
     * Identyfikator płatności automatycznej generowany przez BM.
     *
     * @var string
     */
    protected $recurringDataClientHash = '';

    /**
     * Index karty.
     *
     * @var string
     */
    protected $cardDataIndex = '';

    /**
     * Ważność karty w formacie YYYY.
     *
     * @var string
     */
    protected $cardDataValidityYear = '';

    /**
     * Ważność karty w formacie mm.
     *
     * @var string
     */
    protected $cardDataValidityMonth = '';

    /**
     * Typ karty.
     *
     * @var string
     */
    protected $cardDataIssuer = '';

    /**
     * Pierwsze 6 cyfr numeru karty.
     *
     * @var string
     */
    protected $cardDataBin = '';

    /**
     * Ostatnie 4 cyfry numeru karty.
     *
     * @var string
     */
    protected $cardDataMask = '';

    /**
     * Sets addressIp.
     *
     * @param string $addressIp
     *
     * @return $this
     */
    public function setAddressIp($addressIp): self
    {
        Validator::validateIP($addressIp);
        $this->addressIp = (string)$addressIp;

        return $this;
    }

    /**
     * Returns addressIp.
     *
     * @return string
     */
    public function getAddressIp(): string
    {
        return $this->addressIp;
    }

    /**
     * Sets amount.
     *
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount): self
    {
        Validator::validateAmount($amount);
        $this->amount = $amount;

        return $this;
    }

    /**
     * Returns amount.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return Formatter::formatAmount($this->amount);
    }

    /**
     * Sets currency.
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency): self
    {
        Validator::validateCurrency($currency);
        $this->currency = (string)$currency;

        return $this;
    }

    /**
     * Returns currency.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Sets customerDataCity.
     *
     * @param string $customerDataCity
     *
     * @return $this
     */
    public function setCustomerDataCity($customerDataCity): self
    {
        $this->customerDataCity = (string)$customerDataCity;

        return $this;
    }

    /**
     * Returns customerDataCity.
     *
     * @return string
     */
    public function getCustomerDataCity(): string
    {
        return $this->customerDataCity;
    }

    /**
     * Sets customerDataNrb.
     *
     * @param string $customerDataNrb
     *
     * @return $this
     */
    public function setCustomerDataNrb($customerDataNrb): self
    {
        Validator::validateNrb($customerDataNrb);
        $this->customerDataNrb = (string)$customerDataNrb;

        return $this;
    }

    /**
     * Returns customerDataNrb.
     *
     * @return string
     */
    public function getCustomerDataNrb(): string
    {
        return $this->customerDataNrb;
    }

    /**
     * Sets customerDataPostalCode.
     *
     * @param string $customerDataPostalCode
     *
     * @return $this
     */
    public function setCustomerDataPostalCode($customerDataPostalCode): self
    {
        $this->customerDataPostalCode = (string)$customerDataPostalCode;

        return $this;
    }

    /**
     * Returns customerDataPostalCode.
     *
     * @return string
     */
    public function getCustomerDataPostalCode(): string
    {
        return $this->customerDataPostalCode;
    }

    /**
     * Sets customerDataStreetHouseNo.
     *
     * @param string $customerDataStreetHouseNo
     *
     * @return $this
     */
    public function setCustomerDataStreetHouseNo($customerDataStreetHouseNo): self
    {
        $this->customerDataStreetHouseNo = (string)$customerDataStreetHouseNo;

        return $this;
    }

    /**
     * Returns customerDataStreetHouseNo.
     *
     * @return string
     */
    public function getCustomerDataStreetHouseNo(): string
    {
        return $this->customerDataStreetHouseNo;
    }

    /**
     * Sets customerDataStreetName.
     *
     * @param string $customerDataStreetName
     *
     * @return $this
     */
    public function setCustomerDataStreetName($customerDataStreetName): self
    {
        $this->customerDataStreetName = (string)$customerDataStreetName;

        return $this;
    }

    /**
     * Returns customerDataStreetName.
     *
     * @return string
     */
    public function getCustomerDataStreetName(): string
    {
        return $this->customerDataStreetName;
    }

    /**
     * Sets customerDataStreetPremiseNo.
     *
     * @param string $customerDataStreetPremiseNo
     *
     * @return $this
     */
    public function setCustomerDataStreetPremiseNo($customerDataStreetPremiseNo): self
    {
        $this->customerDataStreetPremiseNo = (string)$customerDataStreetPremiseNo;

        return $this;
    }

    /**
     * Returns customerDataStreetPremiseNo.
     *
     * @return string
     */
    public function getCustomerDataStreetPremiseNo(): string
    {
        return $this->customerDataStreetPremiseNo;
    }

    /**
     * Sets customerDataStreetStaircaseNo.
     *
     * @param string $customerDataStreetStaircaseNo
     *
     * @return $this
     */
    public function setCustomerDataStreetStaircaseNo($customerDataStreetStaircaseNo): self
    {
        $this->customerDataStreetStaircaseNo = (string)$customerDataStreetStaircaseNo;

        return $this;
    }

    /**
     * Returns customerDataStreetStaircaseNo.
     *
     * @return string
     */
    public function getCustomerDataStreetStaircaseNo(): string
    {
        return $this->customerDataStreetStaircaseNo;
    }

    /**
     * Sets customerDatafName.
     *
     * @param string $customerDatafName
     *
     * @return $this
     */
    public function setCustomerDatafName($customerDatafName): self
    {
        $this->customerDatafName = (string)$customerDatafName;

        return $this;
    }

    /**
     * Returns customerDatafName.
     *
     * @return string
     */
    public function getCustomerDatafName(): string
    {
        return $this->customerDatafName;
    }

    /**
     * Sets customerDatalName.
     *
     * @param string $customerDatalName
     *
     * @return $this
     */
    public function setCustomerDatalName($customerDatalName): self
    {
        $this->customerDatalName = (string)$customerDatalName;

        return $this;
    }

    /**
     * Returns customerDatalName.
     *
     * @return string
     */
    public function getCustomerDatalName(): string
    {
        return $this->customerDatalName;
    }

    /**
     * Sets gatewayId.
     *
     * @param int $gatewayId
     *
     * @return $this
     */
    public function setGatewayId($gatewayId): self
    {
        Validator::validateGatewayId($gatewayId);
        $this->gatewayId = (int)$gatewayId;

        return $this;
    }

    /**
     * Returns gatewayId.
     *
     * @return int|null
     */
    public function getGatewayId(): ?int
    {
        return $this->gatewayId;
    }

    /**
     * Sets hash.
     *
     * @param string $hash
     *
     * @return $this
     */
    public function setHash($hash): self
    {
        Validator::validateHash($hash);
        $this->hash = (string)$hash;

        return $this;
    }

    /**
     * Returns hash.
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * Sets orderId.
     *
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId): self
    {
        Validator::validateOrderId($orderId);
        $this->orderId = (string)$orderId;

        return $this;
    }

    /**
     * Returns orderId.
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * Sets paymentDate.
     *
     * @param DateTime $paymentDate
     *
     * @return $this
     */
    public function setPaymentDate(DateTime $paymentDate): self
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Returns paymentDate.
     *
     * @return DateTime | null
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Sets paymentStatus.
     *
     * @param string $paymentStatus
     *
     * @return $this
     */
    public function setPaymentStatus($paymentStatus): self
    {
        $this->paymentStatus = (string)$paymentStatus;

        return $this;
    }

    /**
     * Returns paymentStatus.
     *
     * @return string
     */
    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * Sets paymentStatusDetails.
     *
     * @param string $paymentStatusDetails
     *
     * @return $this
     */
    public function setPaymentStatusDetails($paymentStatusDetails): self
    {
        $this->paymentStatusDetails = (string)$paymentStatusDetails;

        return $this;
    }

    /**
     * Returns paymentStatusDetails.
     *
     * @return string
     */
    public function getPaymentStatusDetails(): string
    {
        return $this->paymentStatusDetails;
    }

    /**
     * Sets remoteId.
     *
     * @param string $remoteId
     *
     * @return $this
     */
    public function setRemoteId($remoteId): self
    {
        $this->remoteId = (string)$remoteId;

        return $this;
    }

    /**
     * Returns remoteId.
     *
     * @return string
     */
    public function getRemoteId(): string
    {
        return $this->remoteId;
    }

    /**
     * Sets serviceId.
     *
     * @param int $serviceId
     *
     * @return $this
     */
    public function setServiceId($serviceId): self
    {
        Validator::validateServiceId($serviceId);
        $this->serviceId = (int)$serviceId;

        return $this;
    }

    /**
     * Returns serviceId.
     *
     * @return int
     */
    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    /**
     * Sets tytuł wpłaty.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title): self
    {
        Validator::validateTitle($title);
        $this->title = (string)$title;

        return $this;
    }

    /**
     * Returns tytuł wpłaty.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets receiverAddress.
     *
     * @param string $receiverAddress
     *
     * @return $this
     */
    public function setReceiverAddress($receiverAddress): self
    {
        $this->receiverAddress = (string)$receiverAddress;

        return $this;
    }

    /**
     * Returns receiverAddress.
     *
     * @return string
     */
    public function getReceiverAddress(): string
    {
        return $this->receiverAddress;
    }

    /**
     * Sets receiverBank.
     *
     * @param string $receiverBank
     *
     * @return $this
     */
    public function setReceiverBank($receiverBank): self
    {
        $this->receiverBank = (string)$receiverBank;

        return $this;
    }

    /**
     * Returns receiverBank.
     *
     * @return string
     */
    public function getReceiverBank(): string
    {
        return $this->receiverBank;
    }

    /**
     * Sets receiverNRB.
     *
     * @param string $receiverNRB
     *
     * @return $this
     */
    public function setReceiverNRB($receiverNRB): self
    {
        $this->receiverNRB = (string)$receiverNRB;

        return $this;
    }

    /**
     * Returns receiverNRB.
     *
     * @return string
     */
    public function getReceiverNRB(): string
    {
        return $this->receiverNRB;
    }

    /**
     * Sets receiverName.
     *
     * @param string $receiverName
     *
     * @return $this
     */
    public function setReceiverName($receiverName): self
    {
        $this->receiverName = (string)$receiverName;

        return $this;
    }

    /**
     * Returns receiverName.
     *
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    /**
     * Sets senderBank.
     *
     * @param string $senderBank
     *
     * @return $this
     */
    public function setSenderBank($senderBank): self
    {
        $this->senderBank = (string)$senderBank;

        return $this;
    }

    /**
     * Returns senderBank.
     *
     * @return string
     */
    public function getSenderBank(): string
    {
        return $this->senderBank;
    }

    /**
     * Sets senderNRB.
     *
     * @param string $senderNRB
     *
     * @return $this
     */
    public function setSenderNRB($senderNRB): self
    {
        $this->senderNRB = (string)$senderNRB;

        return $this;
    }

    /**
     * Returns senderNRB.
     *
     * @return string
     */
    public function getSenderNRB(): string
    {
        return $this->senderNRB;
    }

    /**
     * Sets transferDate.
     *
     * @param DateTime $transferDate
     *
     * @return $this
     */
    public function setTransferDate(DateTime $transferDate): self
    {
        $this->transferDate = $transferDate;

        return $this;
    }

    /**
     * Returns transferDate.
     *
     * @return DateTime | null
     */
    public function getTransferDate()
    {
        return $this->transferDate;
    }

    /**
     * Sets transferStatus.
     *
     * @param string $transferStatus
     *
     * @return $this
     */
    public function setTransferStatus($transferStatus): self
    {
        $this->transferStatus = (string)$transferStatus;

        return $this;
    }

    /**
     * Returns transferStatus.
     *
     * @return string
     */
    public function getTransferStatus(): string
    {
        return $this->transferStatus;
    }

    /**
     * Sets transferStatusDetails.
     *
     * @param string $transferStatusDetails
     *
     * @return $this
     */
    public function setTransferStatusDetails($transferStatusDetails): self
    {
        $this->transferStatusDetails = (string)$transferStatusDetails;

        return $this;
    }

    /**
     * Returns transferStatusDetails.
     *
     * @return string
     */
    public function getTransferStatusDetails(): string
    {
        return $this->transferStatusDetails;
    }

    /**
     * @return string
     */
    public function getRemoteOutID(): string
    {
        return $this->remoteOutID;
    }

    /**
     * @param string $remoteOutID
     *
     * @return ItnIn
     */
    public function setRemoteOutID($remoteOutID): ItnIn
    {
        $this->remoteOutID = $remoteOutID;

        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     *
     * @return ItnIn
     */
    public function setInvoiceNumber($invoiceNumber): ItnIn
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    /**
     * @param string $customerNumber
     *
     * @return ItnIn
     */
    public function setCustomerNumber($customerNumber): ItnIn
    {
        $this->customerNumber = $customerNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     *
     * @return ItnIn
     */
    public function setCustomerEmail($customerEmail): ItnIn
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     *
     * @return ItnIn
     */
    public function setCustomerPhone($customerPhone): ItnIn
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerDataSenderData(): string
    {
        return $this->customerDataSenderData;
    }

    /**
     * @param string $customerDataSenderData
     *
     * @return ItnIn
     */
    public function setCustomerDataSenderData($customerDataSenderData): ItnIn
    {
        $this->customerDataSenderData = $customerDataSenderData;

        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationStatus(): string
    {
        return $this->verificationStatus;
    }

    /**
     * @param string $verificationStatus
     *
     * @return ItnIn
     */
    public function setVerificationStatus($verificationStatus): ItnIn
    {
        $this->verificationStatus = $verificationStatus;

        return $this;
    }

    /**
     * @return array
     */
    public function getVerificationStatusReasons(): array
    {
        return $this->verificationStatusReasons;
    }

    /**
     * @param array $verificationStatusReasons
     *
     * @return ItnIn
     */
    public function setVerificationStatusReasons($verificationStatusReasons): ItnIn
    {
        $this->verificationStatusReasons = $verificationStatusReasons;

        return $this;
    }

    /**
     * Returns kwotę początkową transakcji.
     *
     * @return float | null
     */
    public function getStartAmount()
    {
        return $this->startAmount;
    }

    /**
     * Sets kwotę początkową transakcji.
     *
     * @param float $startAmount
     *
     * @return ItnIn
     */
    public function setStartAmount($startAmount): ItnIn
    {
        $this->startAmount = $startAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecurringDataRecurringAction(): string
    {
        return $this->recurringDataRecurringAction;
    }

    /**
     * @param string $recurringDataRecurringAction
     *
     * @return ItnIn
     */
    public function setRecurringDataRecurringAction($recurringDataRecurringAction): ItnIn
    {
        $this->recurringDataRecurringAction = $recurringDataRecurringAction;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecurringDataClientHash(): string
    {
        return $this->recurringDataClientHash;
    }

    /**
     * @param string $recurringDataClientHash
     *
     * @return ItnIn
     */
    public function setRecurringDataClientHash($recurringDataClientHash): ItnIn
    {
        $this->recurringDataClientHash = $recurringDataClientHash;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataIndex(): string
    {
        return $this->cardDataIndex;
    }

    /**
     * @param string $cardDataIndex
     *
     * @return ItnIn
     */
    public function setCardDataIndex($cardDataIndex): ItnIn
    {
        $this->cardDataIndex = $cardDataIndex;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataValidityYear(): string
    {
        return $this->cardDataValidityYear;
    }

    /**
     * @param string $cardDataValidityYear
     *
     * @return ItnIn
     */
    public function setCardDataValidityYear($cardDataValidityYear): ItnIn
    {
        $this->cardDataValidityYear = $cardDataValidityYear;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataValidityMonth(): string
    {
        return $this->cardDataValidityMonth;
    }

    /**
     * @param string $cardDataValidityMonth
     *
     * @return ItnIn
     */
    public function setCardDataValidityMonth($cardDataValidityMonth): ItnIn
    {
        $this->cardDataValidityMonth = $cardDataValidityMonth;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataIssuer(): string
    {
        return $this->cardDataIssuer;
    }

    /**
     * @param string $cardDataIssuer
     *
     * @return ItnIn
     */
    public function setCardDataIssuer($cardDataIssuer): ItnIn
    {
        $this->cardDataIssuer = $cardDataIssuer;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataBin(): string
    {
        return $this->cardDataBin;
    }

    /**
     * @param string $cardDataBin
     *
     * @return ItnIn
     */
    public function setCardDataBin($cardDataBin): ItnIn
    {
        $this->cardDataBin = $cardDataBin;

        return $this;
    }

    /**
     * @return string
     */
    public function getCardDataMask(): string
    {
        return $this->cardDataMask;
    }

    /**
     * @param string $cardDataMask
     *
     * @return ItnIn
     */
    public function setCardDataMask($cardDataMask): ItnIn
    {
        $this->cardDataMask = $cardDataMask;

        return $this;
    }

    /**
     * Validates model.
     *
     * @return void
     */
    public function validate()
    {
        if (empty($this->serviceId)) {
            throw new DomainException('ServiceId cannot be empty');
        }
        if (empty($this->orderId)) {
            throw new DomainException('OrderId cannot be empty');
        }
        if (empty($this->remoteId)) {
            throw new DomainException('RemoteId cannot be empty');
        }
        if (empty($this->amount)) {
            throw new DomainException('Amount cannot be empty');
        }
        if (!($this->amount === $this->getAmount())) {
            throw new DomainException('Amount in wrong format');
        }
        if (empty($this->currency)) {
            throw new DomainException('Currency cannot be empty');
        }
        if (empty($this->paymentDate)) {
            throw new DomainException('PaymentDate cannot be empty');
        }
        if (empty($this->paymentStatus)) {
            throw new DomainException('PaymentStatus cannot be empty');
        }
        switch ($this->paymentStatus) {
            case self::PAYMENT_STATUS_PENDING:
            case self::PAYMENT_STATUS_SUCCESS:
            case self::PAYMENT_STATUS_FAILURE:
                break;

            default:
                throw new DomainException(sprintf('PaymentStatus="%s" not supported', $this->paymentStatus));
                break;
        }
        if (empty($this->hash)) {
            throw new DomainException('Hash cannot be empty');
        }
    }

    /**
     * Returns object data as array.
     *
     * @return array
     * @deprecated Use Transformer::objectToArray()
     */
    public function toArray(): array
    {
        trigger_error(
            __METHOD__.'() is deprecated. Use Transformer::objectToArray() instead.',
            E_USER_DEPRECATED
        );

        return Transformer::modelToArray($this);
    }
}
