<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\SmsHelper;

use Lswl\Sms\Sms;

class SmsHelper
{
    /**
     * 获取发送短信实例
     * @return Sms
     */
    public static function getSms()
    {
        return new Sms(
            SmsCache::getInstance(),
            config('lswl-sms', [])
        );
    }

    /**
     * 获取发送短信缓存
     * @return \Lswl\Sms\Utils\SmsCache
     */
    public static function getSmsCache()
    {
        return new \Lswl\Sms\Utils\SmsCache(SmsCache::getInstance());
    }
}
