<?php

namespace App\Providers;

use App\User;
use App\Models\Region;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class GlobalTemplateServiceProvider extends ServiceProvider
{
    public $users;
    public function __construct()
    {
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.layouts.topbar'], function($view){
            $view->with('wholesalers', $this->getWholeslers());
        });

        view()->composer(['admin.layouts.topbar'], function($view){
            $view->with('retailpo', $this->retailerPurchaseOrders());
        });

        view()->composer(['admin.layouts.topbar'], function($view){
            $view->with('wholesalerpo', $this->wholesalerPurchaseOrders());
        });


        view()->composer(['admin.layouts.topbar', 'admin.settings.proformainvoicenotifypo'], function($view){
            $view->with('retailerInv', $this->retailerInvoices());
        });

        view()->composer(['admin.layouts.topbar'], function($view){
            $view->with('retailers', $this->getRetailers());
        });

        view()->composer(['admin.pages.register.wholesaler', 'auth.login'], function($view){
            $view->with('locations', $this->getLocations());
            // in_array()
        });

        view()->composer(['admin.pages.register.wholesaler', 'auth.login'], function($view){
            $view->with('regions', $this->getRegions());
            // in_array()
        });

    }

    public function getWholeslers()
    {
        // $wholesalers = $this->users->isWholeSaler()->get();
        $wholesalers = User::where('type', 'wholesaler')->get();
        return $wholesalers;
    }

    public function getRetailers()
    {
        // $retailers = $this->users->isRetailer()->get();
        $retailers = User::where('type', 'retailer')->get();;
        return $retailers;
    }

    public function getLocations()
    {
        // $retailers = $this->users->isRetailer()->get();
        $locations = Location::all();
        return $locations;
    }

    public function getRegions()
    {
        $regions=Region::all();
        return $regions;
    }


    public function retailerPurchaseOrders () {
        $user = Auth::user();
        // $purchaseInvoices = $user->retailer_orders->where('invoice', '!=', '');
        $up = $user->retailer_orders;
        // $approvedPurchaseOrders = $this->purchaseOrders::where('retailer_id', $retailer)->where('status', 'approved')->get();
        // $invoiceReceived = $this->purchaseOrders::where('retailer_id', $retailer)->where('invoice', '!=', null)->get();
        return $up;

        // $proforminvoices = collect($user->retailer_orders)->where('order_type', 'pro_forma');
    }

    public function wholesalerPurchaseOrders () {
        $user = Auth::user();
        // $purchaseInvoices = $user->retailer_orders->where('invoice', '!=', '');
        $up = $user->wholesaler_orders;
        // $approvedPurchaseOrders = $this->purchaseOrders::where('retailer_id', $retailer)->where('status', 'approved')->get();
        // $invoiceReceived = $this->purchaseOrders::where('retailer_id', $retailer)->where('invoice', '!=', null)->get();
        return $up;

        // $proforminvoices = collect($user->retailer_orders)->where('order_type', 'pro_forma');
    }

    public function retailerInvoices () {
        $user = Auth::user();
        $reailerinv = $user->retailer_orders->where('order_type', '=', 'pro_forma');
        return $reailerinv;

    }
}
