<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\ConfigurableProduct\Test\Constraint;

use Magento\ConfigurableProduct\Test\Fixture\ConfigurableProduct;
use Magento\Sales\Test\Constraint\AssertProductInItemsOrderedGrid;
use Magento\Mtf\Fixture\FixtureInterface;

/**
 * Class AssertConfigurableProductInItemsOrderedGrid
 * Assert configurable product was added to Items Ordered grid in customer account on Order creation page backend
 */
class AssertConfigurableProductInItemsOrderedGrid extends AssertProductInItemsOrderedGrid
{
    /**
     * Get configurable product price
     *
     * @param FixtureInterface $product
     * @throws \Exception
     * @return int
     */
    protected function getProductPrice(FixtureInterface $product)
    {
        $price = $product->getPrice();
        if (!$this->productsIsConfigured) {
            return $price;
        }
        if (!$product instanceof ConfigurableProduct) {
            throw new \Exception("Product '$product->getName()' is not configurable product.");
        }
        $checkoutData = $product->getCheckoutData();
        if ($checkoutData === null) {
            return 0;
        }

        return $price;
    }
}
