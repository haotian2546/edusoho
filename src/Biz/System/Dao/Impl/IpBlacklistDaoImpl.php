<?php

namespace Biz\System\Dao\Impl;

use Biz\System\Dao\IpBlacklistDao;
use Codeages\Biz\Framework\Dao\GeneralDaoImpl;

class IpBlacklistDaoImpl extends GeneralDaoImpl implements IpBlacklistDao
{
    protected $table = 'ip_blacklist';

    public function getByIpAndType($ip, $type)
    {
        return $this->getByFields(array('ip' => $ip, 'type' => $type));
    }

    public function findByTypeAndExpiredTimeLessThan($type, $time, $start, $limit)
    {
        $sql = "SELECT * FROM {$this->getTable()} WHERE type = ? AND expiredTime <= ? LIMIT {$start}, {$limit}";
        return $this->db()->fetchAll($sql, array($type, $time));
    }

    public function increaseIpCounter($id, $counter)
    {
        return $this->wave(array($id), array('counter' => 1));
    }

    public function declares()
    {
    }
}
