<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenPlatform\Authorizer\MiniProgram\Code;

use WorkWechat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function commit(int $templateId, string $extJson, string $version, string $description)
    {
        return $this->httpPostJson('wxa/commit', [
            'template_id' => $templateId,
            'ext_json' => $extJson,
            'user_version' => $version,
            'user_desc' => $description,
        ]);
    }

    /**
     * @return \WorkWechat\Kernel\Http\Response
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getQrCode(string $path = null)
    {
        return $this->requestRaw('wxa/get_qrcode', 'GET', [
            'query' => ['path' => $path],
        ]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function getCategory()
    {
        return $this->httpGet('wxa/get_category');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function getPage()
    {
        return $this->httpGet('wxa/get_page');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function submitAudit(array $data, string $feedbackInfo = null, string $feedbackStuff = null)
    {
        if (isset($data['item_list'])) {
            return $this->httpPostJson('wxa/submit_audit', $data);
        }

        return $this->httpPostJson('wxa/submit_audit', [
            'item_list' => $data,
            'feedback_info' => $feedbackInfo,
            'feedback_stuff' => $feedbackStuff,
        ]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAuditStatus(int $auditId)
    {
        return $this->httpPostJson('wxa/get_auditstatus', [
            'auditid' => $auditId,
        ]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function getLatestAuditStatus()
    {
        return $this->httpGet('wxa/get_latest_auditstatus');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function release()
    {
        return $this->httpPostJson('wxa/release');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function withdrawAudit()
    {
        return $this->httpGet('wxa/undocodeaudit');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function rollbackRelease()
    {
        return $this->httpGet('wxa/revertcoderelease');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function changeVisitStatus(string $action)
    {
        return $this->httpPostJson('wxa/change_visitstatus', [
            'action' => $action,
        ]);
    }

    /**
     * ???????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function grayRelease(int $grayPercentage)
    {
        return $this->httpPostJson('wxa/grayrelease', [
            'gray_percentage' => $grayPercentage,
        ]);
    }

    /**
     * ?????????????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function revertGrayRelease()
    {
        return $this->httpGet('wxa/revertgrayrelease');
    }

    /**
     * ?????????????????????????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function getGrayRelease()
    {
        return $this->httpGet('wxa/getgrayreleaseplan');
    }

    /**
     * ??????????????????????????????????????????????????????????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSupportVersion()
    {
        return $this->httpPostJson('cgi-bin/wxopen/getweappsupportversion');
    }

    /**
     * ???????????????????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setSupportVersion(string $version)
    {
        return $this->httpPostJson('cgi-bin/wxopen/setweappsupportversion', [
            'version' => $version,
        ]);
    }

    /**
     * ???????????????????????????????????????quota??????????????????.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function queryQuota()
    {
        return $this->httpGet('wxa/queryquota');
    }

    /**
     * ??????????????????.
     *
     * @param int $auditId ?????????ID
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function speedupAudit(int $auditId)
    {
        return $this->httpPostJson('wxa/speedupaudit', [
            'auditid' => $auditId,
        ]);
    }
}
