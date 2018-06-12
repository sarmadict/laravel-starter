<?php

namespace App\Services\Settings;


use anlutro\LaravelSettings\DatabaseSettingStore;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Connection;


class IntelligentDatabaseStore extends DatabaseSettingStore
{
    protected $cache;

    protected $cacheKey = 'settings';

    protected $cacheTimeout = 1440;

    public function __construct(Connection $connection, $table = null, $keyColumn = null, $valueColumn = null, Cache $cache)
    {
        parent::__construct($connection, $table, $keyColumn, $valueColumn);

        $this->cache = $cache;
    }

    public function load($force = false)
    {
        if (!$this->loaded || $force) {
            $this->data = $force
                ? $this->read()
                : $this->cache->remember($this->cacheKey, $this->cacheTimeout, function () {
                    return $this->read();
                });

            $this->loaded = true;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function write(array $data)
    {
        $itemsQuery = $this->newQuery();

        $items = $itemsQuery->pluck($this->valueColumn, $this->keyColumn);

        $insertData = array_filter(array_dot($data));
        $updateData = array();
        $deleteKeys = array();

        foreach ($items as $key => $value) {
            if (isset($insertData[$key])) {
                if ($insertData[$key] != $value) {
                    $updateData[$key] = $insertData[$key];
                }
            } else {
                $deleteKeys[] = $key;
            }
            unset($insertData[$key]);
        }

        foreach ($updateData as $key => $value) {
            $this->newQuery()
                ->where($this->keyColumn, '=', $key)
                ->update(array($this->valueColumn => $value));
        }

        if ($insertData) {
            $this->newQuery(true)
                ->insert($this->prepareInsertData($insertData));
        }

        if ($deleteKeys) {
            $this->newQuery()
                ->whereIn($this->keyColumn, $deleteKeys)
                ->delete();
        }
    }
}