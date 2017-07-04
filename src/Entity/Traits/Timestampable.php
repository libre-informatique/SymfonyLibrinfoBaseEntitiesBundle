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

namespace Blast\BaseEntitiesBundle\Entity\Traits;

use DateTime;

trait Timestampable
{
    /**
     * @var DateTime
     */
    private $createdAt = null;

    /**
     * @var DateTime
     */
    private $updatedAt = null;

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return Timestampable
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $lastUpdatedAt
     *
     * @return Timestampable
     */
    public function setUpdatedAt(DateTime $lastUpdatedAt)
    {
        $this->updatedAt = $lastUpdatedAt;

        return $this;
    }
}
