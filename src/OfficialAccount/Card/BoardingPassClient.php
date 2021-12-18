<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\Card;

/**
 * Class BoardingPassClient.
 *
 * @author overtrue <i@overtrue.me>
 */
class BoardingPassClient extends Client
{
    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkin(array $params)
    {
        return $this->httpPostJson('card/boardingpass/checkin', $params);
    }
}
