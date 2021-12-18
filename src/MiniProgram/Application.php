<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MiniProgram;

use WorkWechat\BasicService;
use WorkWechat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \WorkWechat\MiniProgram\Auth\AccessToken           $access_token
 * @property \WorkWechat\MiniProgram\DataCube\Client            $data_cube
 * @property \WorkWechat\MiniProgram\AppCode\Client             $app_code
 * @property \WorkWechat\MiniProgram\Auth\Client                $auth
 * @property \WorkWechat\OfficialAccount\Server\Guard           $server
 * @property \WorkWechat\MiniProgram\Encryptor                  $encryptor
 * @property \WorkWechat\MiniProgram\TemplateMessage\Client     $template_message
 * @property \WorkWechat\OfficialAccount\CustomerService\Client $customer_service
 * @property \WorkWechat\MiniProgram\Plugin\Client              $plugin
 * @property \WorkWechat\MiniProgram\Plugin\DevClient           $plugin_dev
 * @property \WorkWechat\MiniProgram\UniformMessage\Client      $uniform_message
 * @property \WorkWechat\MiniProgram\ActivityMessage\Client     $activity_message
 * @property \WorkWechat\MiniProgram\Express\Client             $logistics
 * @property \WorkWechat\MiniProgram\NearbyPoi\Client           $nearby_poi
 * @property \WorkWechat\MiniProgram\OCR\Client                 $ocr
 * @property \WorkWechat\MiniProgram\Soter\Client               $soter
 * @property \WorkWechat\BasicService\Media\Client              $media
 * @property \WorkWechat\BasicService\ContentSecurity\Client    $content_security
 * @property \WorkWechat\MiniProgram\Mall\ForwardsMall          $mall
 * @property \WorkWechat\MiniProgram\SubscribeMessage\Client    $subscribe_message
 * @property \WorkWechat\MiniProgram\RealtimeLog\Client         $realtime_log
 * @property \WorkWechat\MiniProgram\Search\Client              $search
 * @property \WorkWechat\MiniProgram\Live\Client                $live
 * @property \WorkWechat\MiniProgram\Broadcast\Client           $broadcast
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        AppCode\ServiceProvider::class,
        Server\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        UniformMessage\ServiceProvider::class,
        ActivityMessage\ServiceProvider::class,
        OpenData\ServiceProvider::class,
        Plugin\ServiceProvider::class,
        Base\ServiceProvider::class,
        Express\ServiceProvider::class,
        NearbyPoi\ServiceProvider::class,
        OCR\ServiceProvider::class,
        Soter\ServiceProvider::class,
        Mall\ServiceProvider::class,
        SubscribeMessage\ServiceProvider::class,
        RealtimeLog\ServiceProvider::class,
        Search\ServiceProvider::class,
        Live\ServiceProvider::class,
        Broadcast\ServiceProvider::class,
        // Base services
        BasicService\Media\ServiceProvider::class,
        BasicService\ContentSecurity\ServiceProvider::class,
    ];

    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
