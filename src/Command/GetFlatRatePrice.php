<?php namespace Anomaly\FlatRateShippingMethodExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\ShippingModule\Method\Extension\MethodExtension;
use Anomaly\Streams\Platform\Support\Currency;
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
     * The method extension.
     *
     * @var MethodExtension
     */
    protected $extension;

    /**
     * The shipping parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create a new GetFlatRatePrice instance.
     *
     * @param MethodExtension $extension
     * @param array $parameters
     */
    public function __construct(MethodExtension $extension, array $parameters = [])
    {
        $this->extension  = $extension;
        $this->parameters = $parameters;
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
        );
    }
}
