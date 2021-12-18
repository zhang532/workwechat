<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\ExternalContact;

use WorkWechat\Kernel\BaseClient;

/**
 * Class StatisticsClient.
 *
 * @author milkmeowo <milkmeowo@gmail.com>
 */
class StatisticsClient extends BaseClient
{
    /**
     * 获取员工行为数据.
     *
     * @see https://work.weixin.qq.com/api/doc#90000/90135/91580
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function userBehavior(array $userIds, string $from, string $to)
    {
        $params = [
            'userid' => $userIds,
            'start_time' => $from,
            'end_time' => $to,
        ];

        return $this->httpPostJson('cgi-bin/externalcontact/get_user_behavior_data', $params);
    }
}
