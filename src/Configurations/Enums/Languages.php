<?php

namespace RogerSites\Configurations\Enums;

enum Languages: string
{
    case ES_CL = 'es_CL';

    case EN_US = 'en_US';

    /**
     * Get name
     *
     * @param $language
     * @return string
     */
    public function getName($language): string
    {
        return match ($language) {
            self::ES_CL => _i('Spanish'),
            self::EN_US => _i('English')
        };
    }
}
