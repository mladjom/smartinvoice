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

            $invoices = $this->invoice->onlyTrashed()->where('user_id', $user)->get();
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

        $user = Auth::user();
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
        $this->invoice->subtotal = floatval(Input::get('subtotal'));
        $this->invoice->tax_rate_id = Input::get('tax_rate');
        $this->invoice->tax_total = floatval(Input::get('invoice_total_tax'));
        $this->invoice->total = floatval(Input::get('total'));
        $this->invoice->paid = floatval(Input::get('invoice_total_paid'));
        $total = floatval(Input::get('total'));
        $paid = floatval(Input::get('invoice_total_paid'));
        $this->invoice->balance = $total - $paid;
        $this->invoice->user_id = $user->id;

        if (Input::has('date')) {
            $this->invoice->date = Input::get('date');
        }
        if (Input::has('due_date')) {
            $this->invoice->due_date = Input::get('due_date');
        }
        if ($this->invoice->save()) {

            $item_id = Input::get('item_id');
            $name = Input::get('item_name');
            $description = Input::get('item_description');
            $price = Input::get('item_price');
            $quantity = Input::get('item_qty');

            $keys = array('item_id', 'name', 'description', 'price', 'quantity');
            $items = array();
            foreach (array_map(null, $item_id, $name, $description, $price, $quantity) as $key => $value) {
                $items[] = array_combine($keys, $value);
            }

            foreach ($items as $item) {

                $itemRecord = array(
                    'invoice_id' => $this->invoice->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => floatval($item['price']),
                    'quantity' => floatval($item['quantity']),
                    'total' => floatval($item['price']) * floatval($item['quantity']),
                );
//                $item = new Item;
//                $item->invoice_id = $this->invoice->id;
//                $item->name = $item['name'];
//                $item->description = $item['description'];
//                $item->price = floatval($item['price']);
//                $item->quantity = floatval($item['quantity']);
//                $item->total = floatval($item['price']) * floatval($item['quantity']);
//
//                $item->save();
                Item::create($itemRecord);
                //$this->invoice->item()->create(array($itemRecord));
            }
            return Redirect::to('invoices/' . $this->invoice->id . '/edit')->with('success', Lang::get('invoices.message.success.create'));
        }
    }

    /**
     * Display the specified resource.
     * GET /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $invoice = Invoice::find($id);

        $user = Auth::user();
        $clients = $user->client;
        $billers = $user->biller;
        //$tax_rates = TaxRate::where('user_id', $user->id)->get();
        $items = $invoice->item;

        return View::make('invoices.show', compact('invoice', 'clients', 'billers', 'items'));
    }

    /**
     * Download pdf invoice.
     *
     * @param  int  $id
     * @return Response
     */
    public function download($id) {

        $html = '<html><body>'
                . '<p>Put your html here, or generate it with your favourite '
                . 'templating system.</p>'
                . '</body></html>';
        
        return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
    }

    /**
     * Show the form for editing the specified resource.
     * GET /invoices/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $invoice = Invoice::find($id);

        $user = Auth::user();
        $clients = $user->client;
        $billers = $user->biller;
        $tax_rates = TaxRate::where('user_id', $user->id)->get();
        $items = $invoice->item;

        return View::make('invoices.edit', compact('invoice', 'clients', 'billers', 'tax_rates', 'items'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /invoices/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {

        $user = Auth::user();
        $invoice = Invoice::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Invoice::$rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $invoice->biller_id = Input::get('biller_id');
        $invoice->client_id = Input::get('client_id');
        $invoice->number = Input::get('number');
        $invoice->subtotal = floatval(Input::get('subtotal'));
        $invoice->tax_rate_id = Input::get('tax_rate');
        $invoice->tax_total = floatval(Input::get('invoice_total_tax'));
        $invoice->total = floatval(Input::get('total'));
        $invoice->paid = floatval(Input::get('invoice_total_paid'));
        $invoice->balance = $invoice->total - $invoice->paid;
        $invoice->user_id = $user->id;
        if (Input::has('date')) {
            $invoice->date = Input::get('date');
        }
        if (Input::has('due_date')) {
            $invoice->due_date = Input::get('due_date');
        }

        if ($invoice->save()) {

            $item_id = Input::get('item_id');
            $name = Input::get('item_name');
            $description = Input::get('item_description');
            $price = Input::get('item_price');
            $quantity = Input::get('item_qty');

            $old_items = $invoice->item->lists('id');
            $diff = array_diff($old_items, $item_id);
            if (!empty($diff)) {
                Item::destroy($diff);
            }

            $keys = array('item_id', 'name', 'description', 'price', 'quantity');
            $items = array();
            foreach (array_map(null, $item_id, $name, $description, $price, $quantity) as $key => $value) {
                $items[] = array_combine($keys, $value);
            }

            foreach ($items as $item) {
                $itemRecord = array(
                    'invoice_id' => $invoice->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => floatval($item['price']),
                    'quantity' => floatval($item['quantity']),
                    'total' => floatval($item['price']) * floatval($item['quantity']),
                );

                if (empty($item['item_id'])) {
                    $item = Item::create($itemRecord);
                    //$invoice->item()->create($itemRecord);
                } else {
                    // print($item['item_id']);
                    $item = Item::where('id', '=', $item['item_id'])->update($itemRecord);
                    //$invoice->item()->update($itemRecord);
                }
            }
            return Redirect::to('invoices/' . $invoice->id . '/edit')->with('success', Lang::get('invoices.message.success.update'));
        }
    }

    /**
     * Remove the specified biller from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        Invoice::destroy($id);

        return Redirect::route('invoices.index');
    }

    /**
     * Restore the specified invoice to the storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore($id) {

        Invoice::withTrashed()->where('id', $id)->restore();

        return Redirect::route('invoices.index');
    }

    /**
     * Force remove the specified invoice from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id) {

        Invoice::withTrashed()->where('id', $id)->forceDelete();
        Item::withTrashed()->where('invoice_id', $id)->forceDelete();

        return Redirect::route('invoices.index');
    }

}
