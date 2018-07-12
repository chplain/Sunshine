<?php

namespace App\Component\Attribute;

interface AttributeValueInterface
{
    public const STORAGE_Text = 'TextType';
    public const STORAGE_TEXTAREA = 'TextareaType';
    public const STORAGE_BOOLEAN = 'ChoiceType';
    public const STORAGE_DATE = 'DateType';
    public const STORAGE_INTEGER = 'IntegerType';
}