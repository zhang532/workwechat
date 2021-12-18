<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work;

use WorkWechat\Kernel\ServiceContainer;
use WorkWechat\Work\MiniProgram\Application as MiniProgram;

/**
 * Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \WorkWechat\Work\OA\Client                        $oa
 * @property \WorkWechat\Work\Auth\AccessToken                 $access_token
 * @property \WorkWechat\Work\Agent\Client                     $agent
 * @property \WorkWechat\Work\Department\Client                $department
 * @property \WorkWechat\Work\Media\Client                     $media
 * @property \WorkWechat\Work\Menu\Client                      $menu
 * @property \WorkWechat\Work\Message\Client                   $message
 * @property \WorkWechat\Work\Message\Messenger                $messenger
 * @property \WorkWechat\Work\User\Client                      $user
 * @property \WorkWechat\Work\User\TagClient                   $tag
 * @property \WorkWechat\Work\Server\Guard                     $server
 * @property \WorkWechat\Work\Jssdk\Client                     $jssdk
 * @property \Overtrue\Socialite\Providers\WeWorkProvider      $oauth
 * @property \WorkWechat\Work\Invoice\Client                   $invoice
 * @property \WorkWechat\Work\Chat\Client                      $chat
 * @property \WorkWechat\Work\ExternalContact\Client           $external_contact
 * @property \WorkWechat\Work\ExternalContact\ContactWayClient $contact_way
 * @property \WorkWechat\Work\ExternalContact\StatisticsClient $external_contact_statistics
 * @property \WorkWechat\Work\ExternalContact\MessageClient    $external_contact_message
 * @property \WorkWechat\Work\GroupRobot\Client                $group_robot
 * @property \WorkWechat\Work\GroupRobot\Messenger             $group_robot_messenger
 * @property \WorkWechat\Work\Calendar\Client                  $calendar
 * @property \WorkWechat\Work\Schedule\Client                  $schedule
 *
 * @method mixed getCallbackIp()
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        OA\ServiceProvider::class,
        Auth\ServiceProvider::class,
        Base\ServiceProvider::class,
        Menu\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        User\ServiceProvider::class,
        Agent\ServiceProvider::class,
        Media\ServiceProvider::class,
        Message\ServiceProvider::class,
        Department\ServiceProvider::class,
        Server\ServiceProvider::class,
        Jssdk\ServiceProvider::class,
        Invoice\ServiceProvider::class,
        Chat\ServiceProvider::class,
        ExternalContact\ServiceProvider::class,
        GroupRobot\ServiceProvider::class,
        Calendar\ServiceProvider::class,
        Schedule\ServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [
        // http://docs.guzzlephp.org/en/stable/request-options.html
        'http' => [
            'base_uri' => 'https://qyapi.weixin.qq.com/',
        ],
    ];

    /**
     * Creates the miniProgram application.
     */
    public function miniProgram(): MiniProgram
    {
        return new MiniProgram($this->getConfig());
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this['base']->$method(...$arguments);
    }
}
