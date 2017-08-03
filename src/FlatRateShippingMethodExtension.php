<?php namespace Anomaly\FlatRateShippingMethodExtension;

use Anomaly\FlatRateShippingMethodExtension\Command\GetFlatRatePrice;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;
use Anomaly\StoreModule\Contract\AddressInterface;
use Anomaly\StoreModule\Contract\ShippableInterface;

/**
 * Class FlatRateShippingMethodExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FlatRateShippingMethodExtension
 */
class FlatRateShippingMethodExtension extends MethodExtension
{

    /**
     * This extension provides the flat rate
     * shipping method for the Shipping module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.shipping::method.flat_rate';

    /**
     * Return a shipping quote.
     *
     * @param ShippableInterface $shippable
     * @param AddressInterface $address
     * @return float
     */
    public function quote(ShippableInterface $shippable, AddressInterface $address)
    {
        return $this->dispatch(new GetFlatRatePrice($this, $address));
    }
}
