<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Kernel\Events;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class ServerGuardResponseCreated.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ServerGuardResponseCreated
{
    /**
     * @var \Symfony\Component\HttpFoundation\Response
     */
    public $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
