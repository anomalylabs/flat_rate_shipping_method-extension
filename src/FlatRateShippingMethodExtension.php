<?php namespace Anomaly\FlatRateShippingMethodExtension;

use Anomaly\FlatRateShippingMethodExtension\Command\GetFlatRatePrice;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;
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
     * @param array $parameters
     * @return float
     */
    public function quote(ShippableInterface $shippable, array $parameters = [])
    {
        return $this->dispatch(new GetFlatRatePrice($this, $parameters));
    }
}
