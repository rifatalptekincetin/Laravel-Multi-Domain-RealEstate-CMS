<?php

namespace App\Http\Controllers;


use App\Models\Listing;
use App\Models\ListingCategory;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        if($request->district){
            return redirect()->route('listing.district',['slug'=>$request->district,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->city){
            return redirect()->route('listing.city',['slug'=>$request->city,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->state){
            return redirect()->route('listing.state',['slug'=>$request->state,'category_slug'=>$request->category, 'option'=>$request->option]);
        }elseif($request->category){
            return redirect()->route('listing.category',['slug'=>$request->category, 'option'=>$request->option]);
        }

        $listings = Listing::where('status', 'published')
            ->orderBy($request->order_by ?? 'id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
            ->where("parent_id",0)
            ->get();
        $states = State::where('status', 'published')->get();

        return view('listing.index',[
            'listings' => $listings,
            'categories' => $categories,
            'states'=>$states,
            'title'=>'Tüm İlanlar',
            'meta_title'=>'Tüm İlanlar - Grand Gayrimenkul',
            'meta_description'=>'Keşfetmek istediğiniz tüm gayrimenkul ilanlarına Grand Gayrimenkul üzerinden ulaşabilirsiniz. Geniş bir portföyden seçim yapın ve hayalinizdeki evi bulun.',
            'futured_image'=>Null,
        ]);
    }

    public function category(Request $request,$slug)
    {
        $category = ListingCategory::where('slug', $slug)->where('status','published')->firstOrFail();
        $listings = Listing::where('status', 'published')
            ->search($request)
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('listing.index', [
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

    public function state(Request $request,$slug,$category_slug=null)
    {
        $state = State::where('slug', $slug)->firstOrFail();
        $cities = $state->cities;
        $listings = Listing::where('status', 'published');
        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }
        $listings = $listings->where('state_id', $state->id)
            ->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('listing.index', [
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

    public function city(Request $reqeust,$city_slug,$category_slug=null)
    {
        $city = City::where('slug', $city_slug)->firstOrFail();
        $state = $city->state;
        $cities = $state->cities;
        $districts = $city->districts;
        $listings = Listing::where('status', 'published');
        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }
        $listings = $listings->where('state_id', $state->id)
            ->where('city_id', $city->id)
            ->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('listing.index', [
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

    public function district(Request $request,$district_slug,$category_slug=null)
    {
        $district = District::where('slug', $district_slug)->firstOrFail();
        $city = $district->city;
        $state = $city->state;
        $cities = $state->cities;
        $districts = $city->districts;
        $listings = Listing::where('status', 'published');
        $category = Null;
        if($category_slug){
            $category = ListingCategory::where('slug', $category_slug)->where('status','published')->firstOrFail();
            $listings = $listings->whereHas('categories', function ($query) use ($category) {
                $query->where('listing_category_id', $category->id);
            });
        }
        $listings = $listings->where('state_id', $state->id)
            ->where('city_id', $city->id)
            ->where('district_id', $district->id)
            ->orderBy('id', 'desc')
            ->paginate(12);
        $categories = ListingCategory::where('status', 'published')
        ->where("parent_id",0)
        ->get();
        $states = State::where('status', 'published')->get();
        return view('listing.index', [
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

    public function show($slug)
    {
        $listing = Listing::where('status','published')->where('slug', $slug)->firstOrFail();
        if(!$listing) $listing = Listing::where('id', $slug)->first();
        return view('listing.show', [
            'listing' => $listing,
            'meta_title'=>$listing->meta_title,
            'meta_description'=>$listing->meta_description,
            'futured_image'=>$listing->image ? $listing->image->medium_url : Null,
        ]);
    }

    public function preview($id)
    {
        $listing = Listing::where('id', $id)->firstOrFail();
        return view('listing.show', [
            'listing' => $listing,
            'meta_title'=>$listing->meta_title,
            'meta_description'=>$listing->meta_description,
            'futured_image'=>$listing->image ? $listing->image->medium_url : Null,
        ]);
    }

    public function shortData(Request $request){
        $listings = Listing::where('status','published')->whereIn('slug', explode(',',$request->slugs))->get();
        $listings = $listings->mapWithKeys(function($listing,$key){
            return [$listing->slug => [
                'image' => $listing->image->thumbnail_url ?? null,
                'title' => $listing->title,
                'url' => $listing->url(),
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

    public function suggest(Request $request)
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
                    'url' => $listing->url()
                ];
            });
        
        $categories = ListingCategory::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($category) {
                return [
                    'title' => $category->title,
                    'url' => $category->url()
                ];
            });
        
        $states = State::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($state) {
                return [
                    'title' => $state->title,
                    'url' => $state->url()
                ];
            });
        
        $cities = City::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($city) {
                return [
                    'title' => $city->state->title . ' ' . $city->title,
                    'url' => $city->url()
                ];
            });
        
        $districts = District::where('status', 'published')
            ->where('title', 'like', '%' . $request->q . '%')
            ->limit(5)
            ->get()
            ->map(function ($district) {
                return [
                    'title' => $district->city->state->title . ' ' . $district->city->title . ' ' . $district->title,
                    'url' => $district->url()
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
