<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\BasicService\Media;

use WorkWechat\Kernel\BaseClient;
use WorkWechat\Kernel\Exceptions\InvalidArgumentException;
use WorkWechat\Kernel\Http\StreamResponse;

/**
 * Class Client.
 *
 * @author overtrue <i@overtrue.me>
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $baseUri = 'https://api.weixin.qq.com/cgi-bin/';

    /**
     * Allow media type.
     *
     * @var array
     */
    protected $allowTypes = ['image', 'voice', 'video', 'thumb'];

    /**
     * Upload image.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadImage($path)
    {
        return $this->upload('image', $path);
    }

    /**
     * Upload video.
     *
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadVideo($path)
    {
        return $this->upload('video', $path);
    }

    /**
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadVoice($path)
    {
        return $this->upload('voice', $path);
    }

    /**
     * @param string $path
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadThumb($path)
    {
        return $this->upload('thumb', $path);
    }

    /**
     * Upload temporary material.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function upload(string $type, string $path)
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidArgumentException(sprintf("File does not exist, or the file is unreadable: '%s'", $path));
        }

        if (!in_array($type, $this->allowTypes, true)) {
            throw new InvalidArgumentException(sprintf("Unsupported media type: '%s'", $type));
        }

        return $this->httpUpload('media/upload', ['media' => $path], ['type' => $type]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadVideoForBroadcasting(string $path, string $title, string $description)
    {
        $response = $this->uploadVideo($path);
        /** @var array $arrayResponse */
        $arrayResponse = $this->detectAndCastResponseToType($response, 'array');

        if (!empty($arrayResponse['media_id'])) {
            return $this->createVideoForBroadcasting($arrayResponse['media_id'], $title, $description);
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createVideoForBroadcasting(string $mediaId, string $title, string $description)
    {
        return $this->httpPostJson('media/uploadvideo', [
            'media_id' => $mediaId,
            'title' => $title,
            'description' => $description,
        ]);
    }

    /**
     * Fetch item from WeChat server.
     *
     * @return \WorkWechat\Kernel\Http\StreamResponse|\Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $mediaId)
    {
        $response = $this->requestRaw('media/get', 'GET', [
            'query' => [
                'media_id' => $mediaId,
            ],
        ]);

        if (false !== stripos($response->getHeaderLine('Content-disposition'), 'attachment')) {
            return StreamResponse::buildFromPsrResponse($response);
        }

        return $this->castResponseToType($response, $this->app['config']->get('response_type'));
    }

    /**
     * @return array|\WorkWechat\Kernel\Http\Response|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getJssdkMedia(string $mediaId)
    {
        $response = $this->requestRaw('media/get/jssdk', 'GET', [
            'query' => [
                'media_id' => $mediaId,
            ],
        ]);

        if (false !== stripos($response->getHeaderLine('Content-disposition'), 'attachment')) {
            return StreamResponse::buildFromPsrResponse($response);
        }

        return $this->castResponseToType($response, $this->app['config']->get('response_type'));
    }
}