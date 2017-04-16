<?php namespace Alexis\Botdetector\Models;

use Model;

/**
 * Model
 */
class Visits extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alexis_botdetector_visits';
}