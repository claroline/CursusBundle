<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\CursusBundle\Repository;

use Claroline\CoreBundle\Entity\User;
use Claroline\CursusBundle\Entity\CourseSession;
use Doctrine\ORM\EntityRepository;

class CourseSessionUserRepository extends EntityRepository
{
    public function findOneSessionUserBySessionAndUserAndType(
        CourseSession $session,
        User $user,
        $userType,
        $executeQuery = true
    )
    {
        $dql = '
            SELECT csu
            FROM Claroline\CursusBundle\Entity\CourseSessionUser csu
            WHERE csu.session = :session
            AND csu.user = :user
            AND csu.userType = :userType
        ';
        $query = $this->_em->createQuery($dql);
        $query->setParameter('session', $session);
        $query->setParameter('user', $user);
        $query->setParameter('userType', $userType);

        return $executeQuery ? $query->getOneOrNullResult() : $query;
    }

    public function findSessionUsersBySession(
        CourseSession $session,
        $executeQuery = true
    )
    {
        $dql = '
            SELECT csu
            FROM Claroline\CursusBundle\Entity\CourseSessionUser csu
            WHERE csu.session = :session
            ORDER BY csu.registrationDate DESC
        ';
        $query = $this->_em->createQuery($dql);
        $query->setParameter('session', $session);

        return $executeQuery ? $query->getResult() : $query;
    }

    public function findUnregisteredUsersBySession(
        CourseSession $session,
        $userType,
        $orderedBy = 'firstName',
        $order = 'ASC',
        $executeQuery = true
    )
    {
        $dql = "
            SELECT DISTINCT u
            FROM Claroline\CoreBundle\Entity\User u
            WHERE u.isEnabled = true
            AND NOT EXISTS (
                SELECT csu
                FROM Claroline\CursusBundle\Entity\CourseSessionUser csu
                WHERE csu.session = :session
                AND csu.user = u
                AND csu.userType = :userType
            )
            ORDER BY u.{$orderedBy} {$order}
        ";
        $query = $this->_em->createQuery($dql);
        $query->setParameter('session', $session);
        $query->setParameter('userType', $userType);

        return $executeQuery ? $query->getResult() : $query;
    }

    public function findSearchedUnregisteredUsersBySession(
        CourseSession $session,
        $userType,
        $search = '',
        $orderedBy = 'firstName',
        $order = 'ASC',
        $executeQuery = true
    )
    {
        $dql = "
            SELECT DISTINCT u
            FROM Claroline\CoreBundle\Entity\User u
            WHERE u.isEnabled = true
            AND
            (
                UPPER(u.firstName) LIKE :search
                OR UPPER(u.lastName) LIKE :search
                OR UPPER(u.username) LIKE :search
            )
            AND NOT EXISTS (
                SELECT csu
                FROM Claroline\CursusBundle\Entity\CourseSessionUser csu
                WHERE csu.session = :session
                AND csu.user = u
                AND csu.userType = :userType
            )
            ORDER BY u.{$orderedBy} {$order}
        ";
        $query = $this->_em->createQuery($dql);
        $query->setParameter('session', $session);
        $query->setParameter('userType', $userType);
        $upperSearch = strtoupper($search);
        $query->setParameter('search', "%{$upperSearch}%");

        return $executeQuery ? $query->getResult() : $query;
    }
}