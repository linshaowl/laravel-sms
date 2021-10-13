<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\SmsHelper;

use Illuminate\Redis\Connections\PhpRedisConnection;
use Lswl\Sms\Contracts\CacheInterface;
use Lswl\Support\Helper\RedisConnectionHelper;
use Lswl\Support\Traits\InstanceTrait;

class SmsCache implements CacheInterface
{
    use InstanceTrait;

    /**
     * @var PhpRedisConnection
     */
    protected $connection;

    public function __construct()
    {
        $this->connection = RedisConnectionHelper::getPhpRedis();
    }

    /**
     * @inheritDoc
     */
    public function get(string $key): array
    {
        return $this->connection->hGetAll($key);
    }

    /**
     * @inheritDoc
     */
    public function set(string $key, array $data): bool
    {
        return $this->connection->hMSet($key, $data);
    }

    /**
     * @inheritDoc
     */
    public function expire(string $key, int $ttl): bool
    {
        return $this->connection->expire($key, $ttl);
    }

    /**
     * @inheritDoc
     */
    public function exists(string $key): bool
    {
        return !!$this->connection->exists($key);
    }

    /**
     * @inheritDoc
     */
    public function del(string $key): bool
    {
        return !!$this->connection->del($key);
    }

    /**
     * @inheritDoc
     */
    public function lock(string $key): bool
    {
        return $this->connection->command('set', [
            $key,
            1,
            [
                'nx',
                'ex' => config('lswl-sms.send_lock_seconds', 5),
            ]
        ]);
    }

    /**
     * @inheritDoc
     */
    public function unlock(string $key): bool
    {
        return $this->del($key);
    }
}
