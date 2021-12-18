<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\Server;

use WorkWechat\Kernel\ServerGuard;

/**
 * Class Guard.
 *
 * @author overtrue <i@overtrue.me>
 */
class Guard extends ServerGuard
{
    /**
     * @return $this
     */
    public function validate()
    {
        return $this;
    }

    /**
     * Check the request message safe mode.
     */
    protected function isSafeMode(): bool
    {
        return true;
    }

    protected function shouldReturnRawResponse(): bool
    {
        return !is_null($this->app['request']->get('echostr'));
    }
}
