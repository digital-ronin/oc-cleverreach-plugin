<?php namespace DigitalRonin\CleverReach\Components;

use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use DigitalRonin\CleverReach\Models\Settings;
use DigitalRonin\CleverReach\Classes\CleverReach;

class Signup extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Signup Form',
            'description' => 'Sign up a new person to a mailing list.'
        ];
    }

    public function defineProperties()
    {
        return [
            'list' => [
                'title'       => 'CleverReach List ID',
                'description' => 'In CleverReach account, select List and click on a List > Settings > General and look for a List ID.',
                'type'        => 'string'
            ]
        ];
    }

    public function onSignup()
    {
        $settings = Settings::instance();
        if($settings->api_key == false)
        {
            throw new ApplicationException('CleverReach API key is not configured.');
        }

        /*
         * Validate input
         */
        $data = post();

        $rules = [
            'email' => 'required|email|min:2|max:64',
        ];

        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /*
         * Sign up to CleverReach via the API
         */
        $api = new CleverReach($settings->api_key);

        $this->page['error'] = null;

        if ($api->listSubscribe($this->property('list'), post('email'))) {
            $this->page['error'] = $api->errorMessage;
        }

    }

}