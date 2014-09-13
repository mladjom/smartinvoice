<?php

class ClientsController extends \BaseController {

    /**
     * Client Model
     * @var Client
     */
    protected $client;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Client $client
     * @param User $user
     */
    public function __construct(Client $client, User $user) {
        parent::__construct();
        $this->client = $client;
        $this->user = $user;
    }

    /**
     * Display a listing of clients
     *
     * @return Response
     */
    public function index() {

        $user = Auth::user()->id;

        // Grab all the user clients
        $clients = $this->client->where('user_id', $user)->get();
        //Include  deleted clients
        if (Input::get('withTrashed')) {
            
        } else if (Input::get('onlyTrashed')) {

            $clients = $this->client->onlyTrashed()->where('user_id', $user)->get();
        }

        return View::make('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client
     *
     * @return Response
     */
    public function create() {
        $countries = Country::all();
        return View::make('clients.create', compact('countries'));
    }

    /**
     * Store a newly created client in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = Validator::make($data = Input::all(), Client::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        // store the client data
        $this->client->name = Input::get('name');
        $this->client->address_1 = Input::get('address_1');
        $this->client->address_2 = Input::get('address_2');
        $this->client->city = Input::get('city');
        $this->client->zip = Input::get('zip');
        $this->client->state = Input::get('state');
        $this->client->country_id = Input::get('country_id');
        $this->client->phone = Input::get('phone');
        $this->client->mobile = Input::get('mobile');
        $this->client->fax = Input::get('fax');
        $this->client->email = Input::get('email');
        $this->client->web = Input::get('web');
        $this->client->user_id = $user->id;

        if (Input::hasFile('logo')) {

            $file = Input::file('logo');
            $thumbnail = Image::make($file->getRealPath())->fit(240);

            $destinationPath = 'uploads/' . $user->username . "/clients/";
            $filename_string = sha1(time() . time() . $file->getClientOriginalName());
            $filename = $filename_string . "." . $file->getClientOriginalExtension();
            $filename_thumb = $filename_string . "_thumb" . "." . $file->getClientOriginalExtension();

            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $upload_success = Input::file('logo')->move($destinationPath, $filename) && $thumbnail->save($destinationPath . "/" . $filename_thumb);

            if ($upload_success) {
                $this->client->image_name = $file->getClientOriginalName();
                $this->client->image_path = $destinationPath . $filename;
                $this->client->image_path_thumbnail = $destinationPath . $filename_thumb;
            }
        }

        $this->client->user_id = $user->id;
        $this->client->save();

        return Redirect::route('clients.index');
    }

    /**
     * Display the specified client.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $client = Client::findOrFail($id);
        if (Request::ajax()) {
            return Response::json(array(
                'status' => 'success',
                'info' => $client,
                'country' => $client->country->name
                )
            );
        }
        return View::make('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $countries = Country::all();
        $client = Client::find($id);
        return View::make('clients.edit', compact('client', 'countries'));
    }

    /**
     * Update the specified client in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $client = Client::findOrFail($id);
        $user = Auth::getUser();

        $validator = Validator::make($data = Input::all(), Client::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $client->name = Input::get('name');
        $client->address_1 = Input::get('address_1');
        $client->address_2 = Input::get('address_2');
        $client->city = Input::get('city');
        $client->zip = Input::get('zip');
        $client->state = Input::get('state');
        $client->country_id = Input::get('country_id');
        $client->phone = Input::get('phone');
        $client->mobile = Input::get('mobile');
        $client->fax = Input::get('fax');
        $client->email = Input::get('email');
        $client->web = Input::get('web');

        if (Input::hasFile('logo')) {

            File::delete($client->image_path, $client->image_path_thumbnail);
            
            $file = Input::file('logo');
            $thumbnail = Image::make($file->getRealPath())->fit(200);

            $destinationPath = 'uploads/' . $user->username . "/clients/";
            $filename_string = sha1(time() . time() . $file->getClientOriginalName());
            $filename = $filename_string . "." . $file->getClientOriginalExtension();
            $filename_thumb = $filename_string . "_thumb" . "." . $file->getClientOriginalExtension();

            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $upload_success = Input::file('logo')->move($destinationPath, $filename) && $thumbnail->save($destinationPath . "/" . $filename_thumb);
            if ($upload_success) {
                $client->image_name = $file->getClientOriginalName();
                $client->image_path = $destinationPath . $filename;
                $client->image_path_thumbnail = $destinationPath . $filename_thumb;
            }
        }

        $client->save();

        return Redirect::to('clients/' . $client->id . '/edit')->with('success', Lang::get('clients.message.success.update'));
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        Client::destroy($id);

        return Redirect::route('clients.index');
    }

    /**
     * Restore the specified client to the storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id) {
  
        Client::withTrashed()->where('id', $id)->restore();

        return Redirect::route('clients.index');
    }    
    
    /**
     * Force remove the specified client from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {
        
        Client::withTrashed()->where('id', $id)->forceDelete();

        return Redirect::route('clients.index');
    }  
    
}
