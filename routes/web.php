<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeagueController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\Admin\MaxstakeController;
use App\Http\Controllers\Admin\MultibetController;
use App\Http\Controllers\Admin\OddController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TipsterController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect( route('home'));
});

Auth::routes();

Route::get('/home',    [HomeController::class, 'index'])->name('home');
Route::get('/about',   [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/subscribe/{id}', [SubscriptionController::class, 'showTipster'])->name('subscribe');


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

/* Jquery form Validation */
Route::get('checkUserEmailExists', [HomeController::class,'checkUserEmailExists'])->name('checkUserEmailExists');
Route::get('checkUserPasswordMatches', [AccountController::class,'checkUserPasswordMatches'])->name('checkUserPasswordMatches');

Route::get('logout', [LoginController::class,'logout'])->name('logOut');

Route::group(['middleware' => ['auth']], function(){

    Route::get('paid-tips', [PremiumTipsController::class,'premiumTips'])->name('paidTips');
    Route::get('multibets', [PremiumTipsController::class,'getMultibets'])->name('multibets');
    Route::get('maxstakes', [PremiumTipsController::class,'getMaxstakes'])->name('maxstakes');
    Route::get('getPlans', [HomeController::class,'getPlans'])->name('getPlans');

    Route::get('account', [AccountController::class,'index'])->name('account.index');
    Route::post('account/update-profile', [AccountController::class,'updateProfile'])->name('account.updateProfile');
    Route::post('account/update-password', [AccountController::class,'updatePassword'])->name('account.updatePassword');
    Route::post('account/make-payment', [AccountController::class,'makePayment'])->name('account.makePayment');
    Route::post('account/delete', [AccountController::class,'delete'])->name('account.delete');

    //'role:administrator'
    Route::group(['middleware' => []], function() {

        Route::get('admin/dashboard', [DashboardController::class,'index'])->name('admin.dashboard');

        Route::get('admin/users', [UserController::class,'index'])->name('admin.users');
        Route::get('admin/tipsters', [TipsterController::class,'index'])->name('admin.tipsters');
        Route::get('admin/create-user', [UserController::class,'create'])->name('admin.createUser');
        Route::get('admin/edit-user/{user_id}', [UserController::class,'edit'])->name('admin.editUser');
        Route::post('admin/save-user', [UserController::class,'saveUser'])->name('admin.saveUser');
        Route::post('admin/delete-user', [UserController::class,'delete'])->name('admin.deleteUser');

        Route::get('admin/countries', [CountryController::class,'index'])->name('admin.countries');
        Route::get('admin/edit-country/{country_id}', [CountryController::class,'edit'])->name('admin.editCountry');
        Route::post('admin/save-country', [CountryController::class,'saveCountry'])->name('admin.saveCountry');
        Route::post('admin/delete-country', [CountryController::class,'delete'])->name('admin.deleteCountry');
        Route::get('admin/countries/get-data', [CountryController::class,'getData'])->name('countries.getData');
      
        Route::get('admin/leagues', [LeagueController::class,'index'])->name('leagues.index');
        Route::get('admin/leagues/edit', [LeagueController::class,'edit'])->name('leagues.edit');
        Route::post('admin/leagues/store', [LeagueController::class,'store'])->name('leagues.store');
        Route::post('admin/leagues/delete', [LeagueController::class,'delete'])->name('leagues.delete');
        Route::get('admin/leagues/get-data', [LeagueController::class,'getData'])->name('leagues.getData');
        Route::get('admin/leagues/get-leagues-under-country', [LeagueController::class,'getLeaguesUnderCountry'])->name('leagues.leagueCountry');
       
        Route::get('admin/teams', [TeamController::class,'index'])->name('teams.index');
        Route::get('admin/teams/edit', [TeamController::class,'edit'])->name('teams.edit');
        Route::post('admin/teams/store', [TeamController::class,'store'])->name('teams.store');
        Route::post('admin/teams/delete', [TeamController::class,'delete'])->name('teams.delete');
        Route::get('admin/teams/get-teams-under-league', [TeamController::class,'getTeamsUnderLeague'])->name('teams.teamLeague');
              
        Route::get('admin/odds', [OddController::class,'index'])->name('odds.index');
        Route::get('admin/odds/edit', [OddController::class,'edit'])->name('odds.edit');
        Route::post('admin/odds/store', [OddController::class,'store'])->name('odds.store');
        Route::post('admin/odds/delete', [OddController::class,'delete'])->name('odds.delete');
        Route::get('admin/odds/get-data', [OddController::class,'getData'])->name('odds.getData');
       
        Route::get('admin/matches', [MatchController::class,'index'])->name('matches.index');
        Route::get('admin/matches/edit', [MatchController::class,'edit'])->name('matches.edit');
        Route::post('admin/matches/store', [MatchController::class,'store'])->name('matches.store');
        Route::post('admin/matches/delete', [MatchController::class,'delete'])->name('matches.delete');
        Route::post('admin/matches/delete-selected', [MatchController::class,'deleteSelected'])->name('matches.deleteSelected');
        Route::post('admin/matches/make-supersingle', [MatchController::class,'makeSupersingle'])->name('matches.makeSupersingle');

        Route::get('admin/multibets', [MultibetController::class,'index'])->name('multibets.index');
        Route::post('admin/multibets/store', [MultibetController::class,'store'])->name('multibet.store');
        Route::post('admin/multibets/delete', [MultibetController::class,'delete'])->name('multibet.delete');
        Route::post('admin/multibets/delete-selected', [MultibetController::class,'deleteSelected'])->name('multibet.deleteSelected');

        Route::get('admin/maxstake', [MaxstakeController::class,'index'])->name('maxstake.index');
        Route::post('admin/maxstake/store', [MaxstakeController::class,'store'])->name('maxstake.store');
        Route::post('admin/maxstake/delete', [MaxstakeController::class,'delete'])->name('maxstake.delete');
        Route::post('admin/maxstake/delete-selected', [MaxstakeController::class,'deleteSelected'])->name('maxstake.deleteSelected');

        Route::get('admin/plans', [PlanController::class,'index'])->name('plans.index');
        Route::get('admin/plans/edit', [PlanController::class,'edit'])->name('plans.edit');
        Route::post('admin/plans/store', [PlanController::class,'store'])->name('plans.store');
        Route::post('admin/plans/delete', [PlanController::class,'delete'])->name('plans.delete');
    });
});
