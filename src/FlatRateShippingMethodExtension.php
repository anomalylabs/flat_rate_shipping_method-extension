<?php namespace Anomaly\FlatRateShippingMethodExtension;

use Anomaly\FlatRateShippingMethodExtension\Command\GetFlatRatePrice;
use Anomaly\OrdersModule\Order\Contract\OrderInterface;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;

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
     * Return a quote for an order.
     *
     * @param OrderInterface $order
     * @throws \Exception
     * @return float
     */
    public function quote(OrderInterface $order)
    {
        return $this->dispatch(new GetFlatRatePrice($order));
    }
}
