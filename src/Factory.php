<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat;

/**
 * Class Factory.
 *
 * @method static \WorkWechat\Payment\Application            payment(array $config)
 * @method static \WorkWechat\MiniProgram\Application        miniProgram(array $config)
 * @method static \WorkWechat\OpenPlatform\Application       openPlatform(array $config)
 * @method static \WorkWechat\OfficialAccount\Application    officialAccount(array $config)
 * @method static \WorkWechat\BasicService\Application       basicService(array $config)
 * @method static \WorkWechat\Work\Application               work(array $config)
 * @method static \WorkWechat\OpenWork\Application           openWork(array $config)
 * @method static \WorkWechat\MicroMerchant\Application      microMerchant(array $config)
 */
class Factory
{
    /**
     * @param string $name
     *
     * @return \WorkWechat\Kernel\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\WorkWechat\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
