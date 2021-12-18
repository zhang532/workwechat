<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount;

use WorkWechat\BasicService;
use WorkWechat\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \WorkWechat\BasicService\Media\Client                     $media
 * @property \WorkWechat\BasicService\Url\Client                       $url
 * @property \WorkWechat\BasicService\QrCode\Client                    $qrcode
 * @property \WorkWechat\BasicService\Jssdk\Client                     $jssdk
 * @property \WorkWechat\OfficialAccount\Auth\AccessToken              $access_token
 * @property \WorkWechat\OfficialAccount\Server\Guard                  $server
 * @property \WorkWechat\OfficialAccount\User\UserClient               $user
 * @property \WorkWechat\OfficialAccount\User\TagClient                $user_tag
 * @property \WorkWechat\OfficialAccount\Menu\Client                   $menu
 * @property \WorkWechat\OfficialAccount\TemplateMessage\Client        $template_message
 * @property \WorkWechat\OfficialAccount\Material\Client               $material
 * @property \WorkWechat\OfficialAccount\CustomerService\Client        $customer_service
 * @property \WorkWechat\OfficialAccount\CustomerService\SessionClient $customer_service_session
 * @property \WorkWechat\OfficialAccount\Semantic\Client               $semantic
 * @property \WorkWechat\OfficialAccount\DataCube\Client               $data_cube
 * @property \WorkWechat\OfficialAccount\AutoReply\Client              $auto_reply
 * @property \WorkWechat\OfficialAccount\Broadcasting\Client           $broadcasting
 * @property \WorkWechat\OfficialAccount\Card\Card                     $card
 * @property \WorkWechat\OfficialAccount\Device\Client                 $device
 * @property \WorkWechat\OfficialAccount\ShakeAround\ShakeAround       $shake_around
 * @property \WorkWechat\OfficialAccount\POI\Client                    $poi
 * @property \WorkWechat\OfficialAccount\Store\Client                  $store
 * @property \WorkWechat\OfficialAccount\Base\Client                   $base
 * @property \WorkWechat\OfficialAccount\Comment\Client                $comment
 * @property \WorkWechat\OfficialAccount\OCR\Client                    $ocr
 * @property \WorkWechat\OfficialAccount\Goods\Client                  $goods
 * @property \Overtrue\Socialite\Providers\WeChatProvider              $oauth
 * @property \WorkWechat\OfficialAccount\WiFi\Client                   $wifi
 * @property \WorkWechat\OfficialAccount\WiFi\CardClient               $wifi_card
 * @property \WorkWechat\OfficialAccount\WiFi\DeviceClient             $wifi_device
 * @property \WorkWechat\OfficialAccount\WiFi\ShopClient               $wifi_shop
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        User\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        Menu\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        Material\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        Semantic\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        POI\ServiceProvider::class,
        AutoReply\ServiceProvider::class,
        Broadcasting\ServiceProvider::class,
        Card\ServiceProvider::class,
        Device\ServiceProvider::class,
        ShakeAround\ServiceProvider::class,
        Store\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Base\ServiceProvider::class,
        OCR\ServiceProvider::class,
        Goods\ServiceProvider::class,
        WiFi\ServiceProvider::class,
        // Base services
        BasicService\QrCode\ServiceProvider::class,
        BasicService\Media\ServiceProvider::class,
        BasicService\Url\ServiceProvider::class,
        BasicService\Jssdk\ServiceProvider::class,
    ];
}
