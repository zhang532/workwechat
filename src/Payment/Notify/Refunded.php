<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Payment\Notify;

use Closure;
use WorkWechat\Kernel\Support\XML;

class Refunded extends Handler
{
    protected $check = false;

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \WorkWechat\Kernel\Exceptions\Exception
     */
    public function handle(Closure $closure)
    {
        $this->strict(
            \call_user_func($closure, $this->getMessage(), $this->reqInfo(), [$this, 'fail'])
        );

        return $this->toResponse();
    }

    /**
     * Decrypt the `req_info` from request message.
     *
     * @return array
     *
     * @throws \WorkWechat\Kernel\Exceptions\Exception
     */
    public function reqInfo()
    {
        return XML::parse($this->decryptMessage('req_info'));
    }
}
