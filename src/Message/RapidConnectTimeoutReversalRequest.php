<?php

namespace Omnipay\FirstData\Message;

use Omnipay\FirstData\Model\RapidConnect\Common as RCCommon;
use Omnipay\FirstData\Exception\RapidConnect as RCException;
use Omnipay\FirstData\Model\RapidConnect as RCModels;

class RapidConnectTimeoutReversalRequest extends RapidConnectAbstractRequest
{
    private $originalRequest;

    final public static function fromRequest(RapidConnectAbstractRequest $request)
    {
        $common = $request->getCommonGroup();

        $settlementIndicator = $common->getSettlementIndicator();
        $transactionType = $common->getTransactionType();

        if (
            $settlementIndicator == RCCommon\SettlementIndicator::COMPASS_BATCH_SETTLEMENT

        ) {
            throw new RCException\ResendOriginalWithModificationException(
                "Resend original transaction with incremented STAN"
            );
        }

        if (
            $transactionType == RCModels\TransactionType::BALANCE_INQUIRY ||
            $transactionType == RCModels\TransactionType::VERIFICATION
        ) {
            throw new RCException\TimeoutReversalUnsupportedException();
        }

        $timeoutRequest = new RapidConnectTimeoutReversalRequest(
            $request->getHttpClient(),
            $request->getHttpRequest()
        );

        // Copy the original transaction
        $timeoutRequest->initialize($request->getParameters());

        // Setup common group fields
        $timeoutRequest->setCommonGroup(
            $timeoutRequest->getCommonGroup()
                ->setTransactionType(RCModels\TransactionType::AUTHORIZATION)
                ->setReversalReasonCode(RCModels\Common\ReversalReasonCode::TIMEOUT)
        );

        // Set account number from track data if present
        $accountNumber = null;

        $track1PAN = $timeoutRequest->getCardGroup()
            ->getAccountNumberFromTrack1Data();
        $track2PAN = $timeoutRequest->getCardGroup()
            ->getAccountNumberFromTrack2Data();

        if ($track1PAN != null) {
            $accountNumber = $track1PAN;
        } else {
            if ($track2PAN != null) {
                $accountNumber = $track2PAN;
            }
        }

        if ($accountNumber !== null) {
            $timeoutRequest->setCardGroup(
                $timeoutRequest->getCardGroup()
                    ->setAccountNumber($accountNumber)
            );
        }

        // Remove card group fields
        $timeoutRequest->setCardGroup(
            $timeoutRequest->getCardGroup()
                ->setCCVData(null)
                ->setCCVIndicator(null)
                ->setTrack1Data(null)
                ->setTrack2Data(null)
        );

        // Remove PINGroup
        $timeoutRequest->setPINGroup(null);

        return $timeoutRequest;
    }

    /**
     * @return mixed
     */
    public function getOriginalRequest()
    {
        return $this->originalRequest;
    }

    /**
     * @param mixed $originalRequest
     */
    public function setOriginalRequest($originalRequest)
    {
        $this->originalRequest = $originalRequest;
    }
}