<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Request;
use App\User;
use App\Dashboard;
use App\Inventory;
use App\Location;
use App\Account;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SecretLoginRequest;

class DashboardController extends Controller
{
    use Authorizable;

    /**
     * construct.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }

    /**
     * Display Dashboard of the logged in users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isFromPlatform()) {
            return view('admin.dashboard.platform');
        } else {
            $user_id = Auth::user()->id;

            $get_shop = DB::table('users')->where('id', $user_id)->get();

            $my_pay = DB::table('shop_payment_methods')->where('shop_id', $get_shop[0]->shop_id)->get();

            if (count($my_pay) == 0) {
                $array6 = [
                    'payment_method_id' => '6',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array1 = [
                    'payment_method_id' => '1',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array2 = [
                    'payment_method_id' => '2',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array3 = [
                    'payment_method_id' => '3',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array4 = [
                    'payment_method_id' => '4',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array5 = [
                    'payment_method_id' => '5',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $array7 = [
                    'payment_method_id' => '7',
                    'shop_id' => $get_shop[0]->shop_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $insert_shop_payment_method1 = DB::table('shop_payment_methods')->insert($array1);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array2);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array3);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array4);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array5);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array6);
                $insert_shop_payment_method12 = DB::table('shop_payment_methods')->insert($array7);

                $array11 = [
                    'active' => '1',
                ];

                $update = DB::table('shops')->where('id', $get_shop[0]->shop_id)->update($array11);
            }

            return view('admin.dashboard.merchant');
        }
    }

    /**
     * Display the secret_login.
     *
     * @return \Illuminate\Http\Response
     *
     * @param SecretLoginRequest $request
     * @param mixed $id
     */
    public function secretLogin(SecretLoginRequest $request, $id)
    {
        session(['impersonated' => $id, 'secretUrl' => \URL::previous()]);

        return redirect()->route('admin.admin.dashboard')->with('success', trans('messages.secret_logged_in'));
    }

    /**
     * Display the secret_login.
     *
     * @return \Illuminate\Http\Response
     */
    public function secretLogout()
    {
        $secret_url = Request::session()->get('secretUrl');

        Request::session()->forget('impersonated', 'secretUrl');

        return $secret_url ?
            redirect()->to($secret_url)->with('success', trans('messages.secret_logged_out')) :
            redirect()->route('admin.admin.dashboard');
    }

    /**
     * Toggle Configuration of the current user, Its uses the ajax middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $node
     *
     * @return \Illuminate\Http\Response
     */
    public function toggleConfig(Request $request, $node)
    {
        $config = Dashboard::findOrFail(Auth::user()->id);

        $config->$node = !$config->$node;

        if ($config->save()) {
            return response('success', 200);
        }

        return response('error', 405);
    }


    public function showDashboard()
    {
        $all_total_amount = Account::sum("amount");
        $merchant_count = User::where("role_id", 3)->count();
        //return response()->json($merchant_count);
        $stockout_count = Inventory::where("stock_quantity", "<=", 10)->groupBy("inventories.shop_id")->selectRaw('count(*) as shop_id')->get();
        $location_count = Location::count();
       
        return view('pages.backend.admin.ecommerce-dashboard')
        ->with("all_total_amount", $all_total_amount)
        ->with("merchant_count", $merchant_count)
        ->with("stockout_count", $stockout_count)
        ->with("location_count", $location_count);
    }


}
