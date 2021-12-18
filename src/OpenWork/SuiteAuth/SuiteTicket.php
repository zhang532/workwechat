<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenWork\SuiteAuth;

use WorkWechat\Kernel\Exceptions\RuntimeException;
use WorkWechat\Kernel\Traits\InteractsWithCache;
use WorkWechat\OpenWork\Application;

/**
 * SuiteTicket.
 *
 * @author xiaomin <keacefull@gmail.com>
 */
class SuiteTicket
{
    use InteractsWithCache;

    /**
     * @var Application
     */
    protected $app;

    /**
     * SuiteTicket constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return $this
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function setTicket(string $ticket)
    {
        $this->getCache()->set($this->getCacheKey(), $ticket, 1800);

        if (!$this->getCache()->has($this->getCacheKey())) {
            throw new RuntimeException('Failed to cache suite ticket.');
        }

        return $this;
    }

    /**
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getTicket(): string
    {
        if ($cached = $this->getCache()->get($this->getCacheKey())) {
            return $cached;
        }

        throw new RuntimeException('Credential "suite_ticket" does not exist in cache.');
    }

    protected function getCacheKey(): string
    {
        return 'WorkWechat.open_work.suite_ticket.'.$this->app['config']['suite_id'];
    }
}
