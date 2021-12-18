<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\ShakeAround;

use WorkWechat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \WorkWechat\OfficialAccount\ShakeAround\DeviceClient   $device
 * @property \WorkWechat\OfficialAccount\ShakeAround\GroupClient    $group
 * @property \WorkWechat\OfficialAccount\ShakeAround\MaterialClient $material
 * @property \WorkWechat\OfficialAccount\ShakeAround\RelationClient $relation
 * @property \WorkWechat\OfficialAccount\ShakeAround\StatsClient    $stats
 */
class ShakeAround extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["shake_around.{$property}"])) {
            return $this->app["shake_around.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No shake_around service named "%s".', $property));
    }
}
