<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MicroMerchant\Media;

use WorkWechat\Kernel\Exceptions\InvalidArgumentException;
use WorkWechat\MicroMerchant\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2019-06-10 14:50
 */
class Client extends BaseClient
{
    /**
     * Upload material.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\InvalidSignException
     */
    public function upload(string $path)
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidArgumentException(sprintf("File does not exist, or the file is unreadable: '%s'", $path));
        }

        $form = [
            'media_hash' => strtolower(md5_file($path)),
            'sign_type' => 'HMAC-SHA256',
        ];

        return $this->httpUpload('secapi/mch/uploadmedia', ['media' => $path], $form);
    }
}
