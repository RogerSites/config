<?php

namespace RogerSites\Configurations\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PAM
 *
 * This class allows to interact with pams table
 *
 * @package RogerSites\Configurations\Entities
 * @author  Eborio Linárez
 */
class PAM extends Model
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'pams';

    /**
     * Get data attribute
     *
     * @param string $data JSON data
     * @return mixed
     */
    public function getDataAttribute($data)
    {
        return json_decode($data);
    }
}
