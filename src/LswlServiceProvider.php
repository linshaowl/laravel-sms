<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\SmsHelper;

use Illuminate\Support\ServiceProvider;

class LswlServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $smsConfigPath;

    public function boot()
    {
        $this->smsConfigPath = __DIR__ . '/../config/lswl-sms.php';

        // 合并配置
        $this->mergeConfig();

        // 发布文件
        $this->publishFiles();
    }

    /**
     * 合并配置
     */
    protected function mergeConfig()
    {
        // 合并 sms 配置
        $this->mergeConfigFrom(
            $this->smsConfigPath,
            'lswl-sms'
        );
    }

    /**
     * 发布文件
     */
    protected function publishFiles()
    {
        // 发布配置文件
        $this->publishes(
            [
                $this->smsConfigPath => config_path('lswl-sms.php'),
            ],
            'lswl-sms'
        );
    }
}
