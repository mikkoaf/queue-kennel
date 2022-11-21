<?php

namespace App\Enums;

/**
 * This could be an enum if PHP8.1 was used...
 */
class FoodCatalog
{
    /**
     * Allowed foods
     */

    public const BACON = 'bacon';

    public const KIBBLES = 'kibbles';

    public const MEATBALLS = 'meatballs';


    /**
     * Dangerous - causes an exception
     */
    public const CHOCOLATE = 'chocolate';

    /**
     * Missing - causes weight loss
     */
    public const LASAGNA = 'lasagna';
}
