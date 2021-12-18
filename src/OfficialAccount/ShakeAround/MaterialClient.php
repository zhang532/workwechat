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

use WorkWechat\Kernel\BaseClient;
use WorkWechat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class MaterialClient.
 *
 * @author allen05ren <allen05ren@outlook.com>
 */
class MaterialClient extends BaseClient
{
    /**
     * Upload image material.
     *
     * @return string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage(string $path, string $type = 'icon')
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidArgumentException(sprintf('File does not exist, or the file is unreadable: "%s"', $path));
        }

        return $this->httpUpload('shakearound/material/add', ['media' => $path], [], ['type' => strtolower($type)]);
    }
}
