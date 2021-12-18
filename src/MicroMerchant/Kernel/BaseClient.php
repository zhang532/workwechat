<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MicroMerchant\Kernel;

use WorkWechat\Kernel\Exceptions\InvalidArgumentException;
use WorkWechat\Kernel\Support;
use WorkWechat\MicroMerchant\Application;
use WorkWechat\MicroMerchant\Kernel\Exceptions\EncryptException;
use WorkWechat\Payment\Kernel\BaseClient as PaymentBaseClient;

/**
 * Class BaseClient.
 *
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2019-07-10  12:06
 */
class BaseClient extends PaymentBaseClient
{
    /**
     * @var string
     */
    protected $certificates;

    /**
     * BaseClient constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->setHttpClient($this->app['http_client']);
    }

    /**
     * Extra request params.
     *
     * @return array
     */
    protected function prepends()
    {
        return [];
    }

    /**
     * httpUpload.
     *
     * @param bool $returnResponse
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\InvalidSignException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpUpload(string $url, array $files = [], array $form = [], array $query = [], $returnResponse = false)
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        $base = [
            'mch_id' => $this->app['config']['mch_id'],
        ];

        $form = array_merge($base, $form);

        $form['sign'] = $this->getSign($form);

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        $options = [
            'query' => $query,
            'multipart' => $multipart,
            'connect_timeout' => 30,
            'timeout' => 30,
            'read_timeout' => 30,
            'cert' => $this->app['config']->get('cert_path'),
            'ssl_key' => $this->app['config']->get('key_path'),
        ];

        $this->pushMiddleware($this->logMiddleware(), 'log');

        $response = $this->performRequest($url, 'POST', $options);

        $result = $returnResponse ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
        // auto verify signature
        if ($returnResponse || 'array' !== ($this->app->config->get('response_type') ?? 'array')) {
            $this->app->verifySignature($this->castResponseToType($response, 'array'));
        } else {
            $this->app->verifySignature($result);
        }

        return $result;
    }

    /**
     * request.
     *
     * @param string $method
     * @param bool   $returnResponse
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\InvalidSignException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request(string $endpoint, array $params = [], $method = 'post', array $options = [], $returnResponse = false)
    {
        $base = [
            'mch_id' => $this->app['config']['mch_id'],
        ];

        $params = array_merge($base, $this->prepends(), $params);
        $params['sign'] = $this->getSign($params);
        $options = array_merge([
            'body' => Support\XML::build($params),
        ], $options);

        $this->pushMiddleware($this->logMiddleware(), 'log');
        $response = $this->performRequest($endpoint, $method, $options);
        $result = $returnResponse ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
        // auto verify signature
        if ($returnResponse || 'array' !== ($this->app->config->get('response_type') ?? 'array')) {
            $this->app->verifySignature($this->castResponseToType($response, 'array'));
        } else {
            $this->app->verifySignature($result);
        }

        return $result;
    }

    /**
     * processing parameters contain fields that require sensitive information encryption.
     *
     * @return array
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\EncryptException
     */
    protected function processParams(array $params)
    {
        $serial_no = $this->app['config']->get('serial_no');
        if (null === $serial_no) {
            throw new InvalidArgumentException('config serial_no connot be empty.');
        }

        $params['cert_sn'] = $serial_no;
        $sensitive_fields = $this->getSensitiveFieldsName();
        foreach ($params as $k => $v) {
            if (in_array($k, $sensitive_fields, true)) {
                $params[$k] = $this->encryptSensitiveInformation($v);
            }
        }

        return $params;
    }

    /**
     * To id card, mobile phone number and other fields sensitive information encryption.
     *
     * @return string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\EncryptException
     */
    protected function encryptSensitiveInformation(string $string)
    {
        $certificates = $this->app['config']->get('certificate');
        if (null === $certificates) {
            throw new InvalidArgumentException('config certificate connot be empty.');
        }

        $encrypted = '';
        $publicKeyResource = openssl_get_publickey($certificates);
        $f = openssl_public_encrypt($string, $encrypted, $publicKeyResource);
        openssl_free_key($publicKeyResource);
        if ($f) {
            return base64_encode($encrypted);
        }

        throw new EncryptException('Encryption of sensitive information failed');
    }

    /**
     * get sensitive fields name.
     *
     * @return array
     */
    protected function getSensitiveFieldsName()
    {
        return [
            'id_card_name',
            'id_card_number',
            'account_name',
            'account_number',
            'contact',
            'contact_phone',
            'contact_email',
            'legal_person',
            'mobile_phone',
            'email',
        ];
    }

    /**
     * getSign.
     *
     * @return string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     */
    protected function getSign(array $params)
    {
        $params = array_filter($params);

        $key = $this->app->getKey();

        $encryptMethod = Support\get_encrypt_method(Support\Arr::get($params, 'sign_type', 'MD5'), $key);

        return Support\generate_sign($params, $key, $encryptMethod);
    }
}