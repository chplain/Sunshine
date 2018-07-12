<?php

namespace App\Component\Attribute\AttributeType;

interface AttributeTypeInterface
{
    public function getStorageType(): string;

    public function getType(): string;

    public function validate(): void;
}