<?php

namespace RogerSites\Configurations\Enums;

enum Languages: string
{
    case es_CL = 'es_CL';

    case en_US = 'en_US';

    /**
     * Get name
     *
     * @param $language
     * @return string
     */
    public static function getName($language): string
    {
        return match ($language) {
            self::es_CL => _i('Spanish'),
            self::en_US => _i('English')
        };
    }
}
