<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hotels;
use Illuminate\Support\Facades\Http;

class HotelsController extends Controller
{
    public function index()
    {
        return hotels::all();
    }

    public function infoHotel(Request $request, $placeID)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/details/json?placeid=' . $placeID . '&key=' . env('GOOGLE_PLACES_API_KEY');
        $peticion = Http::get($url);
    
        $image = $peticion['result']['photos'][0]['photo_reference'] ?? 'https://th.bing.com/th/id/R.513ad2d5392142b449b6f86efb4442fa?rik=Q%2b9ExJCJMWeVYg&pid=ImgRaw&r=0';
        $urlImage = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $image . '&key=' . env('GOOGLE_PLACES_API_KEY');
    
        $hotelData = [
            'name' => $peticion['result']['name']?? "null", 
            'location' => $peticion['result']['formatted_address']?? "null", 
            'cellphone' => $peticion['result']['formatted_phone_number']?? "null", 
            'rating' => $peticion['result']['rating']?? "null", 
            'website' => $peticion['result']['website']?? "no website",
            'is_open' => $peticion['result']['opening_hours']['open_now']?? "null", 
            'image' => $urlImage,
            'zone' => "1",
            'zone_name' => "San jose del cabo"
        ];
    
        foreach ($hotelData as $key => $value) {
            if ($value === null) {
                $hotelData[$key] = "null";
            }
        }
    
        $create = hotels::create($hotelData);
        $create->save();
    
        return $hotelData;
    }

    public function showHotelsZone($zone){
        $hotels = hotels::where('zone', $zone)->get();
        return $hotels;
    }
    public function hotelsByName($name){
        $hotels = hotels::where('name', 'like', '%'.$name.'%')->get();
        return $hotels;
    }

    public function hotels_name(){
        $hotels = hotels::orderBy('name')->pluck('name');
        return $hotels;
    }

    public function hotel_id($id){
        $hotel = hotels::where('id', $id)->first();
        return ['name' => $hotel->name];
    }

    public function pay_destine(Request $request)
    {
        $data = $request->json()->all();
        $destine1 = $data['destine1'];
        $destine2 = $data['destine2'] ?? null; 
    
        $zona1 = hotels::where('name', $destine1)->value('zone');
        $zona2 = $destine2 ? hotels::where('name', $destine2)->value('zone') : null;
    
        $price = $this->calculatePrice($zona1, $zona2);
    
        return $price;
    }
    
    private function calculatePrice($zona1, $zona2)
    {
        $roundTripMultiplier = $zona2 ? 2 : 1;
    
        switch ($zona1) {
            case 1:
                return ['price' => 70 * $roundTripMultiplier];
            case 2:
                return ['price' => 80 * $roundTripMultiplier];
            case 3:
                return ['price' => 90 * $roundTripMultiplier];
            case 4:
                return ['price' => 110 * $roundTripMultiplier];
            default:
                return ['price' => 0]; 
        }
    }
    
    

}
