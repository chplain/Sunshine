<?php

namespace App\Component\Templates\Generator;

/**
 * Interface of template generator
 */
interface GeneratorInterface
{
    public function generate($target, $content);
}
