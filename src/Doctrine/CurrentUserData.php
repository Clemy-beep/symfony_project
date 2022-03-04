<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class CurrentUserData implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private Security $security;


    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    // public function addWhere(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null)
    // {
    //     if ($resourceClass === Article::class) {
    // if (in_array('ROLE_ADMIN', $this->security->getRoles())) {
    //     return;
    // }
    //         $aliasTable = $queryBuilder->getRootAliases()[0];
    //         $queryBuilder->andWhere("$aliasTable.author = :userId");
    //         $queryBuilder->setParameter("userId", $this->security->getUser()->getId());
    //     }
    // }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?string $operationName = null)
    {
        if ($resourceClass === Article::class) {
            $aliasTable = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere("$aliasTable.author = :userId");
            $queryBuilder->setParameter("userId", $this->security->getUser()->getId());
        }
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?string $operationName = null, array $context = [])
    {
        if ($resourceClass === Article::class) {
            $aliasTable = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere("$aliasTable.author = :userId");
            $queryBuilder->setParameter("userId", $this->security->getUser()->getId());
        }
    }
}
