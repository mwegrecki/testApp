<?php

namespace ApiBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ArticleRepository
 * @package ApiBundle\Entity\Repository
 */
class ArticleRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findArticlesWithNewNotifications()
    {
        $lastPeriod = (new \DateTime())->modify('-24 HOURS');

        return $this->createQueryBuilder('a')
            ->leftJoin('a.answers', 'ans')
            ->leftJoin('a.ratings', 'rat')
            ->where('ans.createdAt < :lastPeriod')
            ->orWhere('rat.createdAt < :lastPeriod')
            ->setParameters(
                [
                    'lastPeriod' => $lastPeriod->format('Y-m-d H:i:s')
                ]
            )
            ->getQuery()
            ->getResult();
    }
} 