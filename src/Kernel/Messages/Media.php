<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Kernel\Messages;

use WorkWechat\Kernel\Contracts\MediaInterface;
use WorkWechat\Kernel\Support\Str;

/**
 * Class Media.
 */
class Media extends Message implements MediaInterface
{
    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['media_id'];

    /**
     * @var array
     */
    protected $required = [
        'media_id',
    ];

    /**
     * MaterialClient constructor.
     *
     * @param string $type
     */
    public function __construct(string $mediaId, $type = null, array $attributes = [])
    {
        parent::__construct(array_merge(['media_id' => $mediaId], $attributes));

        !empty($type) && $this->setType($type);
    }

    /**
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     */
    public function getMediaId(): string
    {
        $this->checkRequiredAttributes();

        return $this->get('media_id');
    }

    public function toXmlArray()
    {
        return [
            Str::studly($this->getType()) => [
                'MediaId' => $this->get('media_id'),
            ],
        ];
    }
}
