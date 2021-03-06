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

/**
 * Class Text.
 *
 * @property string $title
 * @property string $description
 * @property string $url
 */
class TextCard extends Message
{
    /**
     * Messages type.
     *
     * @var string
     */
    protected $type = 'textcard';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'title',
        'description',
        'url',
    ];
}
