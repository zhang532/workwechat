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

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \WorkWechat\MiniProgram\Mall\OrderClient   $order
 * @property \WorkWechat\MiniProgram\Mall\CartClient    $cart
 * @property \WorkWechat\MiniProgram\Mall\ProductClient $product
 * @property \WorkWechat\MiniProgram\Mall\MediaClient   $media
 */
class ForwardsMall
{
    /**
     * @var \WorkWechat\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @param \WorkWechat\Kernel\ServiceContainer $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->app["mall.{$property}"];
    }
}
