<?php namespace Digitalronin\Cleverreach;

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
          'Digitalronin\Cleverreach\Components\Signup' => 'mailSignup'
      ];
    }

    public function registerSettings()
    {
      return [
          'settings' => [
              'label'       => 'CleverReach',
              'icon'        => 'icon-envelope',
              'description' => 'Configure CleverReach API access.',
              'class'       => 'Digitalronin\Cleverreach\Models\Settings',
              'order'       => 600
          ]
      ];
    }
}
