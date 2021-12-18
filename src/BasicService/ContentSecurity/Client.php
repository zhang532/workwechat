<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\BasicService\ContentSecurity;

use WorkWechat\Kernel\BaseClient;
use WorkWechat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author tianyong90 <412039588@qq.com>
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $baseUri = 'https://api.weixin.qq.com/wxa/';

    /**
     * Text content security check.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkText(string $text)
    {
        $params = [
            'content' => $text,
        ];

        return $this->httpPostJson('msg_sec_check', $params);
    }

    /**
     * Image security check.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkImage(string $path)
    {
        return $this->httpUpload('img_sec_check', ['media' => $path]);
    }

    /**
     * Media security check.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     */
    public function checkMediaAsync(string $mediaUrl, int $mediaType)
    {
        /*
         * 1:音频;2:图片
         */
        $mediaTypes = [1, 2];

        if (!in_array($mediaType, $mediaTypes, true)) {
            throw new InvalidArgumentException('media type must be 1 or 2');
        }

        $params = [
            'media_url' => $mediaUrl,
            'media_type' => $mediaType,
        ];

        return $this->httpPostJson('media_check_async', $params);
    }

    /**
     * Image security check async.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkImageAsync(string $mediaUrl)
    {
        return $this->checkMediaAsync($mediaUrl, 2);
    }

    /**
     * Audio security check async.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkAudioAsync(string $mediaUrl)
    {
        return $this->checkMediaAsync($mediaUrl, 1);
    }
}
