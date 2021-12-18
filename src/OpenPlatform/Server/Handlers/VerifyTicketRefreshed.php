<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenPlatform\Server\Handlers;

use WorkWechat\Kernel\Contracts\EventHandlerInterface;
use WorkWechat\OpenPlatform\Application;

/**
 * Class VerifyTicketRefreshed.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class VerifyTicketRefreshed implements EventHandlerInterface
{
    /**
     * @var \WorkWechat\OpenPlatform\Application
     */
    protected $app;

    /**
     * Constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}.
     */
    public function handle($payload = null)
    {
        if (!empty($payload['ComponentVerifyTicket'])) {
            $this->app['verify_ticket']->setTicket($payload['ComponentVerifyTicket']);
        }
    }
}
