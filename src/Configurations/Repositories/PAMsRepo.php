<?php

namespace RogerSites\Configurations\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use RogerSites\Configurations\Entities\PAM;

/**
 * Class PAMsRepo
 *
 * This class allows to interact with PAM entity
 *
 * @package RogerSites\Configurations\Repositories
 * @author  Eborio Linárez
 */
class PAMsRepo
{
    /**
     * Get configuration by PAM and component
     *
     * @param int $pam PAM ID
     * @param int $component Component ID
     */
    public function getConfigurationByPAMAndComponent(int $pam, int $component)
    {
        return PAM::on(config('configurations.replica'))
            ->select('configurations.data')
            ->join('configurations', 'pams.id', '=', 'configurations.pam_id')
            ->where('configurations.pam_id', $pam)
            ->where('configurations.component_id', $component)
            ->orderBy('component_id', 'ASC')
            ->first();
    }

    /**
     * Get configurations by site URL
     *
     * @param string $siteURL PAM site URL
     * @return Builder[]|Collection
     */
    public function getConfigurationsBySiteURL(string $siteURL): Collection|array
    {
        return PAM::on(config('configurations.replica'))
            ->select('id AS pam_id', 'internal_name', 'public_name', 'legal_name', 'pam_status_id', 'site_url',
                'backoffice_url', 'configurations.pam_id', 'configurations.data')
            ->join('configurations', 'pams.id', '=', 'configurations.pam_id')
            ->where('site_url', $siteURL)
            ->orderBy('component_id', 'ASC')
            ->get();
    }

    /**
     * Get configurations by PAM
     *
     * @param int $pam PAM ID
     * @return Builder[]|Collection
     */
    public function getConfigurationsByPAM(int $pam): Collection|array
    {
        return PAM::on(config('configurations.replica'))
            ->select('id AS pam_id', 'internal_name', 'public_name', 'legal_name', 'pam_status_id', 'site_url',
                'backoffice_url', 'configurations.pam_id', 'configurations.data')
            ->join('configurations', 'pams.id', '=', 'configurations.pam_id')
            ->where('pams.id', $pam)
            ->orderBy('component_id', 'ASC')
            ->get();
    }
}