<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\BasicService;

use WorkWechat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \WorkWechat\BasicService\Jssdk\Client           $jssdk
 * @property \WorkWechat\BasicService\Media\Client           $media
 * @property \WorkWechat\BasicService\QrCode\Client          $qrcode
 * @property \WorkWechat\BasicService\Url\Client             $url
 * @property \WorkWechat\BasicService\ContentSecurity\Client $content_security
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Jssdk\ServiceProvider::class,
        QrCode\ServiceProvider::class,
        Media\ServiceProvider::class,
        Url\ServiceProvider::class,
        ContentSecurity\ServiceProvider::class,
    ];
}
