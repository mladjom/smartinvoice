<?php

class InvoicesController extends \BaseController {

    /**
     * Invoice Model
     * @var Invoice
     */
    protected $invoice;

    /**
     * Client Model
     * @var Client
     */
    protected $client;

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
     * TaxRate Model
     * @var TaxRate
     */
    protected $tax_rate;

    /**
     * Item Model
     * @var Item
     */
    protected $item;

    /**
     * Inject the models.
     * @param Client $client
     * @param User $user
     */
    public function __construct(Invoice $invoice, Client $client, Biller $biller, User $user, TaxRate $tax_rate, Item $item) {
        parent::__construct();
        $this->invoice = $invoice;
        $this->biller = $biller;
        $this->client = $client;
        $this->user = $user;
        $this->item = $item;
        $this->tax_rate = $tax_rate;
    }

    /**
     * Display a listing of the resource.
     * GET /invoices
     *
     * @return Response
     */
    public function index() {

        $user = Auth::user()->id;

        // Grab all the user invoices
        $invoices = $this->invoice->where('user_id', $user)->get();

        $tax_rates = TaxRate::where('user_id', $user)->get();
        $items = $this->invoice->item;

        //Include  deleted invoices
        if (Input::get('withTrashed')) {
            
        } else if (Input::get('onlyTrashed')) {

            $invoices = $this->client->onlyTrashed()->where('user_id', $user)->get();
        }

        return View::make('invoices.index', compact('invoices', 'tax_rates'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /invoices/create
     *
     * @return Response
     */
    public function create() {

        $user = Auth::getUser();
        $clients = $user->client;
        $billers = $user->biller;
        $tax_rates = TaxRate::where('user_id', $user->id)->get();

        return View::make('invoices.create', compact('clients', 'billers', 'tax_rates'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /invoices
     *
     * @return Response
     */
    public function store() {
        $validator = Validator::make($data = Input::all(), Invoice::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $this->invoice->biller_id = Input::get('biller_id');
        $this->invoice->client_id = Input::get('client_id');
        $this->invoice->number = Input::get('number');
        $this->invoice->user_id = $user->id;
 
        //dd($data);

        if(  $this->invoice->save()) {
            
        }

        return Redirect::route('invoices.index');
    }

    /**
     * Display the specified resource.
     * GET /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /invoices/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
