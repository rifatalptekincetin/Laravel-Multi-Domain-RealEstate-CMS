<?php

namespace App\Http\Controllers\Sub;
use App\Http\Controllers\Controller;


use App\Models\Listing;
use App\Models\ListingCategory;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use App\Models\Site;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request, string $subdomain)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        if($request->district){
            return redirect()->route('sub.listing.district',['subdomain'=>$site->subdomain,'slug'=>$request->district,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->city){
            return redirect()->route('sub.listing.city',['subdomain'=>$site->subdomain,'slug'=>$request->city,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->state){
            return redirect()->route('sub.listing.state',['subdomain'=>$site->subdomain,'slug'=>$request->state,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->category){
            return redirect()->route('sub.listing.category',['subdomain'=>$site->subdomain,'slug'=>$request->category, 'option'=>$request->option]);
        }

        $listings = Listing::where('status', 'published')
            ->where('site_id',$site->id)
            ->orderBy($request->order_by ?? 'id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
            ->where("parent_id",0)
            ->get();
        $states = State::where('status', 'published')->get();

        return view('sub.listing.index',[
            'listings' => $listings,
            'categories' => $categories,
            'states'=>$states,
            'title'=>'Tüm İlanlar',
            'meta_title'=>'Tüm İlanlar - Grand Gayrimenkul',
            'meta_description'=>'Keşfetmek istediğiniz tüm gayrimenkul ilanlarına Grand Gayrimenkul üzerinden ulaşabilirsiniz. Geniş bir portföyden seçim yapın ve hayalinizdeki evi bulun.',
            'futured_image'=>Null,
        ]);

    }

    public function category(Request $request, string $subdomain, string $slug)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $category = ListingCategory::where('slug', $slug)->where('status','published')->firstOrFail();
        $listings = Listing::where('status', 'published')
            ->where('site_id',$site->id)
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('sub.listing.index', [
            'listings' => $listings,
            'category' => $category,
            'categories' => $categories,
            'states'=>$states,
            'title'=>$category->titleWithParent().' Kategorisindeki İlanlar',
            'meta_title'=>$category->meta_title,
            'meta_description'=>$category->meta_description,
            'futured_image'=>$category->image ? $category->image->medium_url : Null,
        ]);
    }

    public function state(Request $request, string $subdomain, string $slug, $category_slug=null)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $state = State::where('slug', $slug)->firstOrFail();
        $cities = $state->cities;
        $listings = Listing::where('status', 'published')
            ->where('site_id', $site->id)
            ->where('state_id', $state->id);
        
        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }

        $listings = $listings->orderBy('id', 'desc')
            ->paginate(12);

        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();


        $states = State::where('status', 'published')->get();

        return view('sub.listing.index', [
            'listings' => $listings,
            'state' => $state,
            'categories' => $categories,
            'category' => $category,
            'states'=>$states,
            'cities'=>$cities,
            'title'=>$state->title.' İlindeki İlanlar',
            'meta_title'=>$state->meta_title,
            'meta_description'=>$state->meta_description,
            'futured_image'=> Null,
        ]);
    }

    public function city(Request $reqeust, string $subdomain, string $city_slug,$category_slug=null)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $city = City::where('slug', $city_slug)->firstOrFail();
        $state = $city->state;
        $cities = $state->cities;
        $districts = $city->districts;

        $listings = Listing::where('status', 'published')
            ->where('site_id',$site->id)
            ->where('state_id', $state->id)
            ->where('city_id', $city->id);

        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }

        $listings = $listings->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('sub.listing.index', [
            'listings' => $listings,
            'state' => $state,
            'city' => $city,
            'categories' => $categories,
            'category' => $category,
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'title'=>$city->state->title.' / '.$city->title.' İlçesindeki İlanlar',
            'meta_title'=>$city->meta_title,
            'meta_description'=>$city->meta_description,
            'futured_image'=> Null,
        ]);
    }

    public function district(Request $request, string $subdomain, string $district_slug, $category_slug=null)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $district = District::where('slug', $district_slug)->firstOrFail();
        $city = $district->city;
        $state = $city->state;
        $cities = $state->cities;
        $districts = $city->districts;

        $listings = Listing::where('status', 'published')
            ->where('site_id',$site->id)
            ->where('state_id', $state->id)
            ->where('city_id', $city->id)
            ->where('district_id', $district->id);

        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }
        
        $listings = $listings->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('sub.listing.index', [
            'listings' => $listings,
            'state' => $state,
            'city' => $city,
            'district' => $district,
            'categories' => $categories,
            'category' => $category,
            'states'=>$states,
            'cities'=>$cities,
            'districts'=>$districts,
            'title'=>$district->city->state->title.' / '.$district->city->title. ' / '.$district->title.' Mahallesindeki İlanlar',
            'meta_title'=>$district->meta_title,
            'meta_description'=>$district->meta_description,
            'futured_image'=> Null,
        ]);
    }

    public function show(string $subdomain, string $slug)
    {
        $site = Site::where('subdomain',$subdomain)->firstOrFail();
        $listing = Listing::where('site_id',$site->id)->where('slug', $slug)->firstOrFail();
        return view('sub.listing.show', [
            'listing' => $listing,
            'meta_title'=>$listing->meta_title,
            'meta_description'=>$listing->meta_description,
            'futured_image'=>$listing->image ? $listing->image->medium_url : Null,
        ]);
    }

    public function shortData(Request $request, string $subdomain){
        $listings = Listing::where('status','published')->whereIn('slug', explode(',',$request->slugs))->get();
        $listings = $listings->mapWithKeys(function($listing,$key){
            return [$listing->slug => [
                'image' => $listing->image->thumbnail_url ?? null,
                'title' => $listing->title,
                'url' => $listing->url(get_subdomain()),
                'price' => number_format($listing->price,2,',','.') . " ₺ " . ($listing->price_type=="yearly" ? "/ Yıl" : "") . ($listing->price_type=="monthly" ? "/ Ay" : ""),
                'city' => $listing->city->title,
                'state' => $listing->state->title,
                'district' => $listing->district->title,
                'categories' => $listing->categories()->orderBy('parent_id')->pluck('title')->toArray()
                ]
            ];
        });
        return response()->json($listings);
    }

    public function suggest(Request $request, string $subdomain)
    {
        // suggest listings, listing categories, states, cities, districts
        $listings = Listing::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($listing) {
                return [
                    'title' => $listing->title,
                    'url' => $listing->url(get_subdomain())
                ];
            });
        
        $categories = ListingCategory::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($category) {
                return [
                    'title' => $category->title,
                    'url' => $category->url(get_subdomain())
                ];
            });
        
        $states = State::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($state) {
                return [
                    'title' => $state->title,
                    'url' => $state->url(get_subdomain())
                ];
            });
        
        $cities = City::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($city) {
                return [
                    'title' => $city->state->title . ' ' . $city->title,
                    'url' => $city->url(get_subdomain())
                ];
            });
        
        $districts = District::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($district) {
                return [
                    'title' => $district->city->state->title . ' ' . $district->city->title . ' ' . $district->title,
                    'url' => $district->url(get_subdomain())
                ];
            });

        return response()->json([
            'listings' => $listings,
            'categories' => $categories,
            'states' => $states,
            'cities' => $cities,
            'districts' => $districts
        ]);

    }
}
