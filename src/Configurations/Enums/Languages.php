<?php

namespace RogerSites\Configurations\Enums;

enum Languages: string
{
    case ES_CL = 'es_CL';

    case EN_US = 'en_US';

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return match ($this) {
            self::ES_CL => _i('Spanish'),
            self::EN_US => _i('English')
        };
    }
}
