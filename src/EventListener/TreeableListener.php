<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blast\BaseEntitiesBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Blast\BaseEntitiesBundle\EventListener\Traits\ClassChecker;
use Psr\Log\LoggerAwareInterface;
use Blast\BaseEntitiesBundle\EventListener\Traits\Logger;

class TreeableListener implements LoggerAwareInterface, EventSubscriber
{
    use ClassChecker, Logger;

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'loadClassMetadata',
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();

        $reflectionClass = $metadata->getReflectionClass();

        if (!$reflectionClass || !$this->hasTrait($reflectionClass, 'Blast\BaseEntitiesBundle\Entity\Traits\Treeable')) {
            return;
        } // return if current entity doesn't use Treeable trait

        $this->logger->debug(
            '[TreeableListener] Entering TreeableListener for « loadClassMetadata » event'
        );

        if (!$metadata->hasField('materializedPath')) {
            $metadata->mapField([
                'fieldName' => 'materializedPath',
                'type'      => 'string',
                'length'    => 2048,
            ]);
        }

        if (!$metadata->hasField('sortMaterializedPath')) {
            $metadata->mapField([
                'fieldName' => 'sortMaterializedPath',
                'type'      => 'string',
                'length'    => 2048,
            ]);
        }

        if (!$metadata->customRepositoryClassName) {
            $metadata->setCustomRepositoryClass('Blast\BaseEntitiesBundle\Entity\Repository\TreeableRepository');
        }
    }
}
