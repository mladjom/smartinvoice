<?php

class TaxRatesController extends \BaseController {

    /**
     * TaxRate Model
     * @var TaxRate
     */
    protected $tax_rate;

    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Inject the models.
     * @param TaxRate $tax_rate
     * @param User $user
     */
    public function __construct(TaxRate $tax_rate, User $user) {
        parent::__construct();
        $this->tax_rate = $tax_rate;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     * GET /tax_rates
     *
     * @return Response
     */
    public function index() {
        $user = Auth::user()->id;

        // Grab all the user billers
        $tax_rates = $this->tax_rate->where('user_id', $user)->get();


        return View::make('tax_rates.index', compact('tax_rates'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /tax_rates/create
     *
     * @return Response
     */
    public function create() {

        $validator = Validator::make($data = Input::all(), TaxRate::$rules);

        $user = Auth::user();

        if ($validator->passes()) {

            $this->tax_rate->name = Input::get('name');
            $this->tax_rate->rate = Input::get('rate');
            $this->tax_rate->user_id = Auth::user()->id;

            if ($this->tax_rate->save()) {
                if (Request::ajax()) {
                    return Response::json(array(
                                'status' => 'success',
                                'message' => trans('tax_rates.success.create'),
                                'id' => $this->tax_rate->id,
                                'name' => $this->tax_rate->name,
                                'rate' => $this->tax_rate->rate,
                    ));
                }
                return Redirect::route('tax_rates.index');
            }
        }
        if (Request::ajax()) {
            return Response::json(array('status' => 'error', 'errors' => $validator->errors()->toArray()));
        }
        return Redirect::back()->withErrors($validator)->withInput();
    }

    /**
     * Store a newly created resource in storage.
     * POST /tax_rates
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     * GET /tax_rates/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /tax_rates/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /tax_rates/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /tax_rates/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        TaxRate::destroy($id);

        return Redirect::route('tax_rates.index');
    }

}
