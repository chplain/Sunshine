<?php

namespace App\Component\Attribute;

interface AttributeValueInterface
{
    public const FORM_TEXT = 'TextType';
    public const FORM_TEXTAREA = 'TextareaType';
    public const FORM_BOOLEAN = 'ChoiceType';
    public const FORM_DATE = 'DateType';
    public const FORM_INTEGER = 'IntegerType';

    public const STORAGE_TEXT = 'string';
    public const STORAGE_TEXTAREA = 'text';
}
