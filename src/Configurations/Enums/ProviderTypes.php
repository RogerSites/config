<?php

namespace RogerSites\Configurations\Enums;

enum ProviderTypes: int
{
    case INTERNAL = 1;

    case PAYMENT = 2;

    case CASINO = 3;

    case LIVE_CASINO = 4;

    case VIRTUAL = 5;

    case SPORTS = 6;

    case HORSES = 7;

    case POKER = 8;

    case ADJUSTMENTS = 9;

    case BONUS = 10;

    case AGENTS = 11;

    case STORE = 12;

}