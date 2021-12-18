<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\Card;

use WorkWechat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author overtrue <i@overtrue.me>
 *
 * @property \WorkWechat\OfficialAccount\Card\CodeClient          $code
 * @property \WorkWechat\OfficialAccount\Card\MeetingTicketClient $meeting_ticket
 * @property \WorkWechat\OfficialAccount\Card\MemberCardClient    $member_card
 * @property \WorkWechat\OfficialAccount\Card\GeneralCardClient   $general_card
 * @property \WorkWechat\OfficialAccount\Card\MovieTicketClient   $movie_ticket
 * @property \WorkWechat\OfficialAccount\Card\CoinClient          $coin
 * @property \WorkWechat\OfficialAccount\Card\SubMerchantClient   $sub_merchant
 * @property \WorkWechat\OfficialAccount\Card\BoardingPassClient  $boarding_pass
 * @property \WorkWechat\OfficialAccount\Card\JssdkClient         $jssdk
 * @property \WorkWechat\OfficialAccount\Card\GiftCardClient      $gift_card
 * @property \WorkWechat\OfficialAccount\Card\GiftCardOrderClient $gift_card_order
 * @property \WorkWechat\OfficialAccount\Card\GiftCardPageClient  $gift_card_page
 * @property \WorkWechat\OfficialAccount\Card\InvoiceClient       $invoice
 */
class Card extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["card.{$property}"])) {
            return $this->app["card.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No card service named "%s".', $property));
    }
}
