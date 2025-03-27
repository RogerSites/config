<?php

namespace RogerSites\Configurations;

use RogerSites\Configurations\Enums\Components;
use RogerSites\Configurations\Repositories\PAMsRepo;

class Configurations
{
    /**
     * Get component configuration
     *
     * @param int $pam PAM ID
     * @param int $component Component ID
     * @return mixed
     */
    public static function getComponentConfiguration(int $pam, int $component): mixed
    {
        $pamsRepo = new PAMsRepo();
        return $pamsRepo->getConfigurationByPAMAndComponent($pam, $component)->data;
    }

    /**
     * Get configurations by domain
     *
     * @param string $domain PAM ID
     * @return mixed
     */
    public static function getConfigurationsBySiteURL(string $domain): mixed
    {
        $pamsRepo = new PAMsRepo();
        return $pamsRepo->getConfigurationsBySiteURL($domain);
    }

    /**
     * Get currencies
     *
     * @return mixed
     */
    public static function getCurrencies(): mixed
    {
        $configurations = config('pam.configurations');
        return $configurations[Components::INTERNATIONALIZATION->value - 1]->data->currencies->active;
    }

    /**
     * Get default language
     *
     * @return mixed
     */
    public static function getDefaultLanguage(): mixed
    {
        $configurations = config('pam.configurations');
        $configuration = $configurations[Components::INTERNATIONALIZATION->value - 1]->data;
        return $configuration->languages->default;
    }

    /**
     * Get favicon
     *
     * @return string|null
     */
    public static function getFavicon(): ?string
    {
        $configurations = config('pam.configurations');
        $configuration = $configurations[Components::DESIGN->value - 1]->data;
        $favicon = null;

        if (!is_null($configuration->favicon)) {
            $favicon = s3_asset("commons/{$configuration->favicon}");
        }
        return $favicon;
    }

    /**
     * Get languages
     *
     * @return mixed
     */
    public static function getLanguages(): mixed
    {
        $configurations = config('pam.configurations');
        return $configurations[Components::INTERNATIONALIZATION->value - 1]->data->languages->active;
    }

    /**
     * Get logo
     *
     * @param bool $mobile Mobile device
     * @param integer|null $pam PAM ID
     * @return string
     */
    public static function getLogo(bool $mobile = false, int $pam = null): string
    {
        if (!is_null($pam)) {
            $configuration = self::getComponentConfiguration($pam, Components::DESIGN->value);

        } else {
            $configurations = config('pam.configurations');
            $configuration = $configurations[Components::DESIGN->value - 1]->data;
        }

        $logo = $mobile ? $configuration->logo->mobile_logo : $configuration->logo->desktop_logo;

        if (!is_null($logo)) {
            $logo = s3_asset("commons/$logo", $pam);

        } else {
            $path = "logos/logo.png";
            $logo = global_asset($path);
        }
        return $logo;
    }

    /**
     * Get multiple currency
     *
     * @return mixed
     */
    public static function getMultipleCurrency(): mixed
    {
        $configurations = config('pam.configurations');
        return $configurations[Components::INTERNATIONALIZATION->value - 1]->data->currencies->multiple;
    }

    /**
     * Get PAM
     *
     * @return mixed
     */
    public static function getPAM(): mixed
    {
        $configurations = config('pam.configurations');
        return $configurations[0]->pam_id;
    }

    /**
     * Get PAM legal name
     *
     * @return mixed
     */
    public static function getPAMLegalName(): mixed
    {
        $configurations = config('pam.configurations');
        return $configurations[0]->legal_name;
    }

    /**
     * Get PAM description
     *
     * @param int|null $pam PAM ID
     * @return mixed
     */
    public static function getPAMPublicName(int $pam = null): mixed
    {
        if (!is_null($pam)) {
            $pamsRepo = new PAMsRepo();
            $configurations = $pamsRepo->getConfigurationsByPAM($pam);

        } else {
            $configurations = config('pam.configurations');
        }
        return $configurations[0]->public_name;
    }

    /**
     * Get PWA
     *
     * @return mixed
     */
    public static function getPWA()
    {
        $configurations = config('pam.configurations');
        $configuration = $configurations[Components::SERVICES->value - 1]->data;
        return $configuration->pwa->active;
    }

    /**
     * Get site URL
     *
     * @param int|null $pam
     * @return string
     */
    public static function getSiteURL(int $pam = null): string
     {
         if (!is_null($pam)) {
             $pamsRepo = new PAMsRepo();
             $configurations = $pamsRepo->getConfigurationsByPAM($pam);

         } else {
             $configurations = config('pam.configurations');
         }
         return $configurations[0]->site_url;
     }

    /**
     * Set email
     *
     * @param null|int $pam Whitelabel ID
     */
    public static function setEmail($pam = null): void
    {
        if (!is_null($pam)) {
            $configuration = self::getComponentConfiguration($pam, Components::SERVICES->value);

        } else {
            $configurations = config('pam.configurations');
            $configuration = $configurations[Components::SERVICES->value - 1]->data;
        }
        $email = $configuration->email;
        config(['mail.mailers.smtp.host' => $email->host]);
        config(['mail.mailers.smtp.port' => $email->port]);
        config(['mail.mailers.smtp.encryption' => $email->encryption]);
        config(['mail.mailers.smtp.username' => $email->username]);
        config(['mail.mailers.smtp.password' => $email->password]);
        config(['mail.default' => $email->mailer]);
        config(['mail.from.address' => $email->username]);
        config(['mail.from.name' => self::getPAMPublicName($pam)]);
        config(['services.mailgun.domain' => $email->mailgun_domain]);
    }
}
