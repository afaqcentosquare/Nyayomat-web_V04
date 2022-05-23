<?php

namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Auth;
use App\Account;
use Carbon\Carbon;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Events\Shop\ShopCreated;
use App\Events\User\UserCreated;
use App\Jobs\CreateShopForMerchant;
use App\Http\Controllers\Controller;
use App\Repositories\Merchant\MerchantRepository;
use App\Http\Requests\Validations\CreateMerchantRequest;
use App\Http\Requests\Validations\UpdateMerchantRequest;

class MerchantController extends Controller
{
    use Authorizable;

    private $model_name;

    private $merchant;

    /**
     * construct.
     *
     * @param MerchantRepository $merchant
     */
    public function __construct(MerchantRepository $merchant)
    {
        parent::__construct();

        $this->model_name = trans('app.model.merchant');

        $this->merchant = $merchant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = $this->merchant->all();

        $trashes = $this->merchant->trashOnly();

        return view('admin.merchant.index', compact('merchants', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.merchant._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMerchantRequest $request)
    {
        // echo "<pre>"; print_r($request->all()); echo "</pre>"; exit();
        // Start transaction!
        DB::beginTransaction();

        try {
            $merchant = $this->merchant->store($request);

            // Dispatching Shop create job
            CreateShopForMerchant::dispatch($merchant, $request->all());
        } catch (\Exception $e) {
            // rollback the transaction and log the error
            DB::rollback();
            Log::error('Vendor Creation Failed: ' . $e->getMessage());

            // add your error messages:
            $error = new \Illuminate\Support\MessageBag();
            $error->add('success', trans('messages.created', ['model' => $this->model_name]));

            return back()->withErrors($error);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        // Trigger user created event
        event(new UserCreated($merchant, auth()->user()->getName(), $request->get('password')));

        // Trigger shop created event
        event(new ShopCreated($merchant->owns));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = $this->merchant->find($id);

        return view('admin.merchant._show', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merchant = $this->merchant->find($id);

        return view('admin.merchant._edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantRequest $request, $id)
    {
        if (env('APP_DEMO') == true && $id <= config('system.demo.users', 3)) {
            return back()->with('warning', trans('messages.demo_restriction'));
        }

        $this->merchant->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if (env('APP_DEMO') == true && $id <= config('system.demo.users', 3)) {
            return back()->with('warning', trans('messages.demo_restriction'));
        }

        $this->merchant->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->merchant->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->merchant->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function allmerchantTransaction()
    {
        $today_total_amount = Account::whereDate('created_at', Carbon::today())->sum("amount");
        $today_total_transaction = Account::whereDate('created_at', Carbon::today())->count();
        $today_merchant_transactions = Account::select("accounts.user_id", "users.name")
        ->join("users", "users.id", "accounts.user_id")
        ->selectRaw('sum(amount) as sum, count(*) as transaction_count')->whereDate('accounts.created_at', Carbon::today())->groupBy('user_id')->get();


        $yesterday_total_amount = Account::whereDate('created_at', Carbon::yesterday())->sum("amount");
        $yesterday_total_transaction = Account::whereDate('created_at', Carbon::yesterday())->count();
        $yesterday_merchant_transactions = Account::select("accounts.user_id", "users.name")
        ->join("users", "users.id", "accounts.user_id")
        ->selectRaw('sum(amount) as sum, count(*) as transaction_count')->whereDate('accounts.created_at', Carbon::yesterday())->groupBy('user_id')->get();

        $this_week_total_amount = Account::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum("amount");
        $this_week_total_transaction = Account::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $this_week_merchant_transactions = Account::select("accounts.user_id", "users.name")
        ->join("users", "users.id", "accounts.user_id")
        ->selectRaw('sum(amount) as sum, count(*) as transaction_count')->whereBetween('accounts.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->groupBy('user_id')->get();


        $month_total_amount = Account::whereMonth('created_at', Carbon::now()->month)->sum("amount");
        $month_total_transaction = Account::whereMonth('created_at', Carbon::now()->month)->count();
        $month_merchant_transactions = Account::select("accounts.user_id", "users.name")
        ->join("users", "users.id", "accounts.user_id")
        ->selectRaw('sum(amount) as sum, count(*) as transaction_count')->whereMonth('accounts.created_at', Carbon::now()->month)->groupBy('user_id')->get();

        $all_total_amount = Account::sum("amount");
        $all_total_transaction = Account::count();
        $all_merchant_transactions = Account::select("accounts.user_id", "users.name")
        ->join("users", "users.id", "accounts.user_id")
        ->selectRaw('sum(amount) as sum, count(*) as transaction_count')->groupBy('user_id')->get();

        $merchant_orders = Account::select("accounts.*", "payment_methods.name as payment_method_name")
        ->join("orders", "orders.id", "order_id")
        ->join("payment_methods", "payment_methods.id", "orders.payment_method_id")
        ->get();
       
        return view('pages.backend.admin.transactions')
        ->with("today_merchant_transactions", $today_merchant_transactions)
        ->with("today_total_amount", $today_total_amount)
        ->with("today_total_transaction", $today_total_transaction)
        ->with("yesterday_merchant_transactions", $yesterday_merchant_transactions)
        ->with("yesterday_total_amount", $yesterday_total_amount)
        ->with("yesterday_total_transaction", $yesterday_total_transaction)
        ->with("this_week_merchant_transactions", $this_week_merchant_transactions)
        ->with("this_week_total_amount", $this_week_total_amount)
        ->with("this_week_total_transaction", $this_week_total_transaction)
        ->with("month_merchant_transactions", $month_merchant_transactions)
        ->with("month_total_amount", $month_total_amount)
        ->with("month_total_transaction", $month_total_transaction)
        ->with("all_merchant_transactions", $all_merchant_transactions)
        ->with("all_total_amount", $all_total_amount)
        ->with("all_total_transaction", $all_total_transaction)
        ->with("merchant_orders", $merchant_orders);
    }
}
