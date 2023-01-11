<?php

namespace App\Enums;

enum EndpointFrequency: int
{
    case ONE_MINUTE = 1 * 60;
    case FIVE_MINUTES = 5 * 60;
    case THIRTY_MINUTES = 30 * 60;
    case ONE_MINUTES = 60 * 60;
}