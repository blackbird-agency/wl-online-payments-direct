<?php
declare(strict_types=1);

namespace Worldline\Payment\HostedCheckout\Vault;

use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Payment\Gateway\Command;
use Magento\Payment\Gateway\Config\ValueHandlerPoolInterface;
use Magento\Payment\Gateway\ConfigFactoryInterface;
use Magento\Payment\Gateway\ConfigInterface;
use Magento\Payment\Model\MethodInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Sales\Api\Data\OrderPaymentExtensionInterfaceFactory;
use Magento\Vault\Api\PaymentTokenManagementInterface;
use Magento\Vault\Model\Method\Vault as MagentoVault;
use Worldline\Payment\HostedCheckout\UI\ConfigProvider;
use Worldline\Payment\Model\Method\Vault\Validation;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Vault extends MagentoVault
{
    /**
     * @var Validation
     */
    private $vaultValidation;

    /**
     * @param ConfigInterface $config
     * @param ConfigFactoryInterface $configFactory
     * @param ObjectManagerInterface $objectManager
     * @param MethodInterface $vaultProvider
     * @param ManagerInterface $eventManager
     * @param ValueHandlerPoolInterface $valueHandlerPool
     * @param Command\CommandManagerPoolInterface $commandManagerPool
     * @param PaymentTokenManagementInterface $tokenManagement
     * @param OrderPaymentExtensionInterfaceFactory $paymentExtensionFactory
     * @param Validation $vaultValidation
     * @param string $code
     * @param Json|null $jsonSerializer
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        ConfigInterface $config,
        ConfigFactoryInterface $configFactory,
        ObjectManagerInterface $objectManager,
        MethodInterface $vaultProvider,
        ManagerInterface $eventManager,
        ValueHandlerPoolInterface $valueHandlerPool,
        Command\CommandManagerPoolInterface $commandManagerPool,
        PaymentTokenManagementInterface $tokenManagement,
        OrderPaymentExtensionInterfaceFactory $paymentExtensionFactory,
        Validation $vaultValidation,
        string $code,
        Json $jsonSerializer = null
    ) {
        parent::__construct(
            $config,
            $configFactory,
            $objectManager,
            $vaultProvider,
            $eventManager,
            $valueHandlerPool,
            $commandManagerPool,
            $tokenManagement,
            $paymentExtensionFactory,
            $code,
            $jsonSerializer
        );
        $this->vaultValidation = $vaultValidation;
    }

    /**
     * @param CartInterface|null $quote
     * @return bool
     */
    public function isAvailable(CartInterface $quote = null): bool
    {
        if ($quote === null) {
            return parent::isAvailable($quote);
        }

        if (!$this->vaultValidation->guestQuoteValidation($quote)) {
            return false;
        }

        if (!$this->vaultValidation->customerHasTokensValidation($quote, ConfigProvider::HC_CODE)) {
            return false;
        }

        return parent::isAvailable($quote);
    }
}