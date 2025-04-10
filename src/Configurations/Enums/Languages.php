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
        switch ($language) {
            case self::es_CL: {
                return _i('Spanish');
            }
            case self::en_US: {
                return _i('English');
            }
        }
    }
}
