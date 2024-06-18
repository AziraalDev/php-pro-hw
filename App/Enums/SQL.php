<?php

namespace App\Enums;

enum SQL: string
{
    case IS = 'IS';
    case IS_NOT = 'IS NOT';
    case IN = 'IN';
    case NOT_IN = 'NOT IN';
    case EQUAL = '=';
    case LESS = '<';
    case LESS_EQUAL = '<=';
    case NOT_EQUAL = '!=';
    case MORE = '>';
    case MORE_EQUAL = '>=';
    case LIKE = 'LIKE';
    case NOT_LIKE = 'NOT LIKE';
}
