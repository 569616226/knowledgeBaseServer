<?php

/**
 * Part of the Stripe package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Stripe
 * @version    2.1.4
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2018, Cartalyst LLC
 * @link       http://cartalyst.com
 */

namespace Cartalyst\Stripe\Api;

class UsageRecords extends Api
{
    /**
     * Create a usage record.
     *
     * @param  string  $itemId
     * @param  array  $parameters
     * @return void
     */
    public function create($itemId, array $parameters)
    {
        return $this->_post("subscription_items/{$itemId}/usage_records", $parameters);
    }
}
