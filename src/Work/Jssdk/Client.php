<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\Jssdk;

use WorkWechat\BasicService\Jssdk\Client as BaseClient;
use WorkWechat\Kernel\Exceptions\RuntimeException;
use WorkWechat\Kernel\Support;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    protected $ticketEndpoint = 'https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket';

    /**
     * @return string
     */
    protected function getAppId()
    {
        return $this->app['config']->get('corp_id');
    }

    /**
     * @param array       $apis
     * @param             $agentId
     * @param bool        $debug
     * @param bool        $beta
     * @param array       $openTagList
     * @param string|null $url
     *
     * @return array|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getAgentConfigArray(array $apis, $agentId, bool $debug = false, bool $beta = false, array $openTagList = [], string $url = null)
    {
        return $this->buildAgentConfig($apis, $agentId, $debug, $beta, false, $openTagList, $url);
    }

    /**
     * @param array       $jsApiList
     * @param             $agentId
     * @param bool        $debug
     * @param bool        $beta
     * @param bool        $json
     * @param array       $openTagList
     * @param string|null $url
     *
     * @return array|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function buildAgentConfig(array $jsApiList, $agentId, bool $debug = false, bool $beta = false, bool $json = true, array $openTagList = [], string $url = null)
    {
        $config = array_merge(compact('debug', 'beta', 'jsApiList', 'openTagList'), $this->agentConfigSignature($agentId, $url));

        return $json ? json_encode($config) : $config;
    }

    /**
     * @param             $agentId
     * @param string|null $url
     * @param string|null $nonce
     * @param null        $timestamp
     *
     * @return array
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function agentConfigSignature($agentId, string $url = null, string $nonce = null, $timestamp = null): array
    {
        $url = $url ?: $this->getUrl();
        $nonce = $nonce ?: Support\Str::quickRandom(10);
        $timestamp = $timestamp ?: time();

        return [
            'corpid' => $this->getAppId(),
            'agentid' => $agentId,
            'nonceStr' => $nonce,
            'timestamp' => $timestamp,
            'url' => $url,
            'signature' => $this->getTicketSignature($this->getAgentTicket()['ticket'], $nonce, $timestamp, $url),
        ];
    }

    /**
     * Get js ticket.
     *
     * @param bool   $refresh
     * @param string $type
     *
     * @return array
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getTicket(bool $refresh = false, string $type = 'config'): array
    {
        $cacheKey = sprintf('WorkWechat.work.jssdk.ticket.%s.%s', $type, $this->getAppId());

        if (!$refresh && $this->getCache()->has($cacheKey)) {
            return $this->getCache()->get($cacheKey);
        }

        /** @var array<string, mixed> $result */
        $result = $this->castResponseToType(
            $this->requestRaw($this->ticketEndpoint, 'GET'),
            'array'
        );

        $this->getCache()->set($cacheKey, $result, $result['expires_in'] - 500);

        if (!$this->getCache()->has($cacheKey)) {
            throw new RuntimeException('Failed to cache jssdk ticket.');
        }

        return $result;
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|mixed|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws RuntimeException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getAgentTicket(bool $refresh = false, string $type = 'agent_config')
    {
        $cacheKey = sprintf('WorkWechat.work.jssdk.ticket.%s.%s', $type, $this->getAppId());

        if (!$refresh && $this->getCache()->has($cacheKey)) {
            return $this->getCache()->get($cacheKey);
        }

        /** @var array<string, mixed> $result */
        $result = $this->castResponseToType(
            $this->requestRaw('cgi-bin/ticket/get', 'GET', ['query' => ['type' => $type]]),
            'array'
        );

        $this->getCache()->set($cacheKey, $result, $result['expires_in'] - 500);

        if (!$this->getCache()->has($cacheKey)) {
            throw new RuntimeException('Failed to cache jssdk ticket.');
        }

        return $result;
    }
}
