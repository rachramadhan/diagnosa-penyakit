<?php

namespace App\Repositories;

use App\Models\Disease;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DiseaseRepository
 * @package App\Repositories
 * @version January 5, 2019, 12:23 pm UTC
 *
 * @method Disease findWithoutFail($id, $columns = ['*'])
 * @method Disease find($id, $columns = ['*'])
 * @method Disease first($columns = ['*'])
*/
class DiseaseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'description',
        'diagnose'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Disease::class;
    }
}
