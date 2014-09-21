<?php

class BillersController extends \BaseController {

    /**
     * Biller Model
     * @var Biller
     */
    protected $biller;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param Biller $biller
     * @param User $user
     */
    public function __construct(Biller $biller, User $user) {
        parent::__construct();
        $this->biller = $biller;
        $this->user = $user;
    }

    /**
     * Display a listing of billers
     *
     * @return Response
     */
    public function index() {

        $user = Auth::user()->id;

        // Grab all the user billers
        $billers = $this->biller->where('user_id', $user)->get();
        //Include  deleted billers
        if (Input::get('withTrashed')) {
            
        } else if (Input::get('onlyTrashed')) {

            $billers = $this->biller->onlyTrashed()->where('user_id', $user)->get();
        }

        return View::make('billers.index', compact('billers'));
    }

    /**
     * Show the form for creating a new biller
     *
     * @return Response
     */
    public function create() {
        $countries = Country::all();
        return View::make('billers.create', compact('countries'));
    }

    /**
     * Store a newly created biller in storage.
     *
     * @return Response
     */
    public function store() {

        $validator = Validator::make($data = Input::all(), Biller::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        // store the biller data
        $this->biller->name = Input::get('name');
        $this->biller->address_1 = Input::get('address_1');
        $this->biller->address_2 = Input::get('address_2');
        $this->biller->city = Input::get('city');
        $this->biller->zip = Input::get('zip');
        $this->biller->state = Input::get('state');
        $this->biller->country_id = Input::get('country_id');
        $this->biller->phone = Input::get('phone');
        $this->biller->mobile = Input::get('mobile');
        $this->biller->fax = Input::get('fax');
        $this->biller->email = Input::get('email');
        $this->biller->web = Input::get('web');
        $this->biller->user_id = $user->id;

        if (Input::hasFile('logo')) {

            $file = Input::file('logo');
            $thumbnail = Image::make($file->getRealPath())->crop(240, 80);

            $destinationPath = 'uploads/' . $user->username . "/billers/";
            $filename_string = sha1(time() . time() . $file->getClientOriginalName());
            $filename = $filename_string . "." . $file->getClientOriginalExtension();
            $filename_thumb = $filename_string . "_thumb" . "." . $file->getClientOriginalExtension();

            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $upload_success = Input::file('logo')->move($destinationPath, $filename) && $thumbnail->save($destinationPath . "/" . $filename_thumb);

            if ($upload_success) {
                $this->biller->image_name = $file->getClientOriginalName();
                $this->biller->image_path = $destinationPath . $filename;
                $this->biller->image_path_thumbnail = $destinationPath . $filename_thumb;
            }
        }

        $this->biller->user_id = $user->id;
        $this->biller->save();

        return Redirect::route('billers.index');
    }

    /**
     * Display the specified biller.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $biller = Biller::findOrFail($id);
        if (Request::ajax()) {
            return Response::json(array(
                        'status' => 'success',
                        'info' => $biller,
                        'country' => $biller->country->name,
                        'image_name' => $biller->image_name,
                        'image_path_thumbnail' => asset($biller->image_path_thumbnail),
                            )
            );
        }
        return View::make('billers.show', compact('biller'));
    }

    /**
     * Show the form for editing the specified biller.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $biller = Biller::findOrFail($id); 

//        if ($biller->user_id != Auth::user()->id) {
//            return Redirect::route('billers.index')->withError('Unable to access that biller');
//        }

        $countries = Country::all();
        return View::make('billers.edit', compact('biller', 'countries'));
    }

    /**
     * Update the specified biller in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $biller = Biller::findOrFail($id);
        $user = Auth::getUser();

        $validator = Validator::make($data = Input::all(), Biller::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $biller->name = Input::get('name');
        $biller->address_1 = Input::get('address_1');
        $biller->address_2 = Input::get('address_2');
        $biller->city = Input::get('city');
        $biller->zip = Input::get('zip');
        $biller->state = Input::get('state');
        $biller->country_id = Input::get('country_id');
        $biller->phone = Input::get('phone');
        $biller->mobile = Input::get('mobile');
        $biller->fax = Input::get('fax');
        $biller->email = Input::get('email');
        $biller->web = Input::get('web');

        if (Input::hasFile('logo')) {

            File::delete($biller->image_path, $biller->image_path_thumbnail);

            $file = Input::file('logo');
            $thumbnail = Image::make($file->getRealPath())->crop(240, 80);

            $destinationPath = 'uploads/' . $user->username . "/billers/";
            $filename_string = sha1(time() . time() . $file->getClientOriginalName());
            $filename = $filename_string . "." . $file->getClientOriginalExtension();
            $filename_thumb = $filename_string . "_thumb" . "." . $file->getClientOriginalExtension();

            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $upload_success = Input::file('logo')->move($destinationPath, $filename) && $thumbnail->save($destinationPath . "/" . $filename_thumb);
            if ($upload_success) {
                $biller->image_name = $file->getClientOriginalName();
                $biller->image_path = $destinationPath . $filename;
                $biller->image_path_thumbnail = $destinationPath . $filename_thumb;
            }
        }

        $biller->save();

        return Redirect::to('billers/' . $biller->id . '/edit')->with('success', Lang::get('billers.message.success.update'));
    }

    /**
     * Remove the specified biller from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        Biller::destroy($id);

        return Redirect::route('billers.index');
    }

    /**
     * Restore the specified biller to the storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id) {

        Biller::withTrashed()->where('id', $id)->restore();

        return Redirect::route('billers.index');
    }

    /**
     * Force remove the specified biller from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {

        Biller::withTrashed()->where('id', $id)->forceDelete();

        return Redirect::route('billers.index');
    }

}
