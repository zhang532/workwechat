<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MiniProgram\Mall;

use WorkWechat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class MediaClient extends BaseClient
{
    /**
     * 更新或导入媒体信息.
     *
     * @param array $params
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import($params)
    {
        return $this->httpPostJson('mall/importmedia', $params);
    }
}
