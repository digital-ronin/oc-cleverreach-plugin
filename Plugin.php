<?php namespace DigitalRonin\CleverReach;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'CleverReach',
            'description' => 'Provides CleverReach integration services.',
            'author'      => 'Daniel-Bruni Ziermann',
            'icon'        => 'icon-envelope',
            'homepage'    => ''
        ];
    }

    public function registerComponents()
    {
        return [
            'DigitalRonin\CleverReach\Components\Signup' => 'mailSignup'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'CleverReach',
                'icon'        => 'icon-envelope',
                'description' => 'Configure CleverReach API access.',
                'class'       => 'DigitalRonin\CleverReach\Models\Settings',
                'order'       => 600
            ]
        ];
    }
}
