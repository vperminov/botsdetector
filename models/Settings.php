<?php namespace Alexis\Botdetector\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'alexis_bodetector_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];

}