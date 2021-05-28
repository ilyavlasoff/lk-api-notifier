<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class ReceiverRepository extends EntityRepository
{
    public function getRegisteredReceiversPreferences(array $persons) {
        $qb = $this->createQueryBuilder('rc');
        return $qb
            ->select('rc.muteDiscussionMessages as dsc, rc.mutePrivateMessages as prv, ud.fcmKey as fcm')
            ->join('rc.devices', 'ud', Join::WITH, 'ud.user = rc.id')
            ->where($qb->expr()->in('rc.id', ':prs'))
            ->setParameter('prs', $persons)
            ->getQuery()
            ->execute();
    }
}