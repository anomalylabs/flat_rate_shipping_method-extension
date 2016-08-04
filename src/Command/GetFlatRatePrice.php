<?php namespace Anomaly\FlatRateShippingMethodExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\OrdersModule\Order\Contract\OrderInterface;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetFlatRatePrice
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\FlatRateShippingMethodExtension\Command
 */
class GetFlatRatePrice implements SelfHandling
{

    /**
     * The order instance.
     *
     * @var OrderInterface
     */
    protected $order;

    /**
     * Create a new GetFlatRatePrice instance.
     *
     * @param MethodExtension $extension
     * @param OrderInterface  $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @return \Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter|null
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        $method = $this->order->getShippingMethod();

        return $configuration->value('anomaly.extension.flat_rate_shipping_method::price', $method->getSlug());
    }
}
