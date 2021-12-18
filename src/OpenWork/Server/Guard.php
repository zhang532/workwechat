<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenWork\Server;

use WorkWechat\Kernel\Encryptor;
use WorkWechat\Kernel\ServerGuard;

/**
 * Guard.
 *
 * @author xiaomin <keacefull@gmail.com>
 */
class Guard extends ServerGuard
{
    /**
     * @var bool
     */
    protected $alwaysValidate = true;

    /**
     * @return $this
     */
    public function validate()
    {
        return $this;
    }

    protected function shouldReturnRawResponse(): bool
    {
        return !is_null($this->app['request']->get('echostr'));
    }

    protected function isSafeMode(): bool
    {
        return true;
    }

    /**
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     */
    protected function decryptMessage(array $message)
    {
        $encryptor = new Encryptor($message['ToUserName'], $this->app['config']->get('token'), $this->app['config']->get('aes_key'));

        return $message = $encryptor->decrypt(
            $message['Encrypt'],
            $this->app['request']->get('msg_signature'),
            $this->app['request']->get('nonce'),
            $this->app['request']->get('timestamp')
        );
    }
}
