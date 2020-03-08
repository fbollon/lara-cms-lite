<?php

namespace Fbollon\LaraCmsLite;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fbollon\LaraCmsLite\Skeleton\SkeletonClass
 */
class LaraCmsLiteFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lara-cms-lite';
    }
}
