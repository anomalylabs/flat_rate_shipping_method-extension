<?php namespace Anomaly\FlatRateShippingMethodExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;
use Anomaly\StoreModule\Contract\AddressInterface;
use Anomaly\Streams\Platform\Support\Currency;

/**
 * Class GetFlatRatePrice
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetFlatRatePrice
{

    /**
     * The method extension.
     *
     * @var MethodExtension
     */
    protected $extension;

    /**
     * The shipping address.
     *
     * @var array
     */
    protected $address;

    /**
     * Create a new GetFlatRatePrice instance.
     *
     * @param MethodExtension $extension
     * @param AddressInterface $address
     * @internal param array $address
     */
    public function __construct(MethodExtension $extension, AddressInterface $address)
    {
        $this->extension = $extension;
        $this->address   = $address;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @param Currency $currency
     * @return float
     */
    public function handle(ConfigurationRepositoryInterface $configuration, Currency $currency)
    {
        $method = $this->extension->getMethod();

        return $currency->normalize(
            $configuration->value('anomaly.extension.flat_rate_shipping_method::price', $method->getId())
            + $method->getHandlingFee()
        );
    }
}
