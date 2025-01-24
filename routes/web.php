<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// ana site controller
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProductController;

// subsite controller
use App\Http\Controllers\Sub\PageController as SubPageController;
use App\Http\Controllers\Sub\ListingController as SubListingController;
use App\Http\Controllers\Sub\AgencyController as SubAgencyController;
use App\Http\Controllers\Sub\BlogController as SubBlogController;

use App\Models\ListingCategory;
use App\Models\Listing;
use App\Models\State;
use App\Models\City;
use App\Models\District;

#ana site
Route::domain(config('app.domain'))->group(function () {
    
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'home')
        ->name('home');

        Route::get('/{slug}', 'show')
        ->where('slug', '^((?!home|blog|blog-kategori|blog-etiket|ilanlar|ajax|gayrimenkul-danismanlari|gayrimenkul-ofisleri|form|talep|egitim|seminer|kongre).)*$')
        ->name('page.show');

        Route::get('/talep', 'talep')
        ->name('page.talep');
    });

    
    Route::controller(ProductController::class)->group(function () {
        Route::get('egitimler', 'training')
        ->name('product.training.index');
        Route::get('seminerler', 'seminar')
        ->name('product.seminar.index');
        Route::get('kongreler', 'congress')
        ->name('product.congress.index');

        Route::get('egitimler/{slug}', 'showTraining')
        ->name('product.training.show');
        Route::get('seminerler/{slug}', 'showSeminar')
        ->name('product.seminar.show');
        Route::get('kongreler/{slug}', 'showCongress')
        ->name('product.congress.show');

    });

    Route::controller(AgencyController::class)->group(function () {
        Route::get('gayrimenkul-danismanlari', 'agents')
        ->name('agency.agents');

        Route::get('gayrimenkul-danismanlari/{id}', 'agent')
        ->name('agency.agent');

        Route::get('gayrimenkul-ofisleri', 'sites')
        ->name('agency.agencies');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('blog/', 'index')
        ->name('blog.index');

        Route::get('blog/{slug}', 'show')
        ->name('blog.show');

        Route::get('blog-kategori/{slug}', 'showCategory')
        ->name('blog.show.category');

        Route::get('blog-etiket/{slug}', 'showTag')
        ->name('blog.show.tag');
    });

    Route::controller(ListingController::class)->group(function () {
        Route::get('ilanlar', 'index')
        ->name('listing.index');

        Route::get('ajax/ilanlar/suggest', 'suggest')
        ->name('listing.ajax.suggest');

        if(Schema::hasTable('categories')){
            Route::get('ilanlar/{slug}-kategorisi', 'category')
            ->whereIn('slug', Cache::rememberForever('categories.slug', function () {
                return ListingCategory::where('status','published')->pluck('slug')->toArray();
            }))
            ->name('listing.category');

            Route::get('ilanlar/{slug}-ili/{category_slug?}', 'state')
            ->whereIn('slug', Cache::rememberForever('states.slug', function () {
                return State::where('status','published')->pluck('slug')->toArray();
            }))
            ->name('listing.state');
        }

        Route::get('ilanlar/ilce/{slug}/{category_slug?}', 'city')->name('listing.city');

        Route::get('ilanlar/mahalle/{slug}/{category_slug?}', 'district')
        ->name('listing.district');

        Route::get('ilanlar/onizleme/{slug}', 'preview')
        ->name('listing.preview')->middleware('auth');

        Route::get('ilanlar/{slug}', 'show')
        ->name('listing.show');

        Route::get('ajax/short-data', 'shortData')
        ->name('listing.ajax.short-data');
    });

    Route::controller(FormController::class)->group(function () {
        Route::post('form/submit', 'submit')
        ->name('form.submit');
        
        Route::get('form/test', 'test')
        ->name('form.test');
    });
    
});

#subdomainler
Route::domain('{subdomain}.'.config('app.domain'))->group(function () {
    Route::controller(SubPageController::class)->group(function () {
        Route::get('/', 'home')
        ->name('sub.home');

        Route::get('/{slug}', 'show')
        ->where('slug', '^((?!home|blog|blog-kategori|blog-etiket|ilanlar|ajax|gayrimenkul-danismanlari|gayrimenkul-ofisleri|talep).)*$')
        ->name('sub.page.show');
    });

    Route::controller(SubBlogController::class)->group(function () {
        Route::get('blog/', 'index')
        ->name('sub.blog.index');

        Route::get('blog/{slug}', 'show')
        ->name('sub.blog.show');

        Route::get('blog-kategori/{slug}', 'showCategory')
        ->name('sub.blog.show.category');

        Route::get('blog-etiket/{slug}', 'showTag')
        ->name('sub.blog.show.tag');
    });

    Route::controller(SubListingController::class)->group(function () {
        Route::get('ilanlar', 'index')
        ->name('sub.listing.index');

        Route::get('ajax/ilanlar/suggest', 'suggest')
        ->name('sub.listing.ajax.suggest');

        if(Schema::hasTable('categories')){
            Route::get('ilanlar/{slug}-kategorisi', 'category')
            ->whereIn('slug', Cache::rememberForever('categories.slug', function () {
                return ListingCategory::where('status','published')->pluck('slug')->toArray();
            }))
            ->name('sub.listing.category');

            Route::get('ilanlar/{slug}-ili/{category_slug?}', 'state')
            ->whereIn('slug', Cache::rememberForever('states.slug', function () {
                return State::where('status','published')->pluck('slug')->toArray();
            }))
            ->name('sub.listing.state');
        }

        Route::get('ilanlar/ilce/{slug}/{category_slug?}', 'city')->name('sub.listing.city');

        Route::get('ilanlar/mahalle/{slug}/{category_slug?}', 'district')
        ->name('sub.listing.district');

        Route::get('ilanlar/{slug}', 'show')
        ->name('sub.listing.show');

        Route::get('ajax/short-data', 'shortData')
        ->name('sub.listing.ajax.short-data');
    });

    Route::controller(SubAgencyController::class)->group(function () {
        Route::get('gayrimenkul-danismanlari', 'agents')
        ->name('sub.agency.agents');

        Route::get('gayrimenkul-danismanlari/{id}', 'agent')
        ->name('sub.agency.agent');
    });

    Route::controller(FormController::class)->group(function () {
        Route::post('form/submit', 'submit')
        ->name('sub.form.submit');
    });

});
