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

/**
 * Default implementation of JsonSerializable::jsonSerialize().
 */
trait Jsonable
{
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
