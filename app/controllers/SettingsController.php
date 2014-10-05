<?php

class SettingsController extends \BaseController {

    /**
     * Setting Model
     * @var Setting
     */
    protected $setting;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Setting $setting
     * @param User $user
     */
    public function __construct(Setting $setting, User $user) {
        parent::__construct();
        $this->setting = $setting;
        $this->user = $user;
    }

    /**
     * Display a listing of settings
     *
     * @return Response
     */
    public function getIndex() {

        $user = Auth::user()->id;
        // Grab user settings
        $setting = User::find($user)->setting;
        $countries = Country::all();

        return View::make('settings.index', compact('setting', 'countries'));
    }

    public function postIndex() {
        //dd(Input::all());
        $user = Auth::user()->id;
        $setting = Setting::findOrFail(Input::get('id'));

        $validator = Validator::make($data = Input::all(), Setting::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $settings = array(
            'language' => Input::get('language'),
            'currency_id' => Input::get('country_id'),

        );

        $item = Setting::where('id', '=', Input::get('id'))->update($settings);



        
        

        return Redirect::to('settings')->with('success', Lang::get('settings.message.success.update'));
    }

}
