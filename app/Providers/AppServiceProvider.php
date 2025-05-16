<?php

namespace App\Providers;
use Laravel\Cashier\Cashier;
use App\Actions\Webshop\MigrateSessionCart;
use App\Factories\CartFactory;
use Money\Money;
use \NumberFormatter;
use Laravel\Fortify\Fortify;
use Money\Currencies\ISOCurrencies;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Money\Formatter\IntlMoneyFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Cashier::calculateTaxes();

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
        
            if ($user && Hash::check($request->password, $user->password)) {
                // Ensure the user has a cart or create a new one
                $userCart = $user->cart ?? $user->cart()->create();
        
                // Migrate session cart to user's cart
                (new MigrateSessionCart)->migrate(CartFactory::make(), $userCart);
                
                return $user;
            }
        });

        Blade::stringable(function (Money $money) {
            $curriencies = new ISOCurrencies();
            $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
            $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $curriencies);
            return $moneyFormatter->format($money);
        });

 
    }
}
