<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'name'=>$this->name,
            'descrption'=>$this->details,
            'price'=>$this->price,
            'stock'=>$this->stock==0 ? "Out of Stock":$this->stock,
            'rating'=>$this->reviews->count() >0 ?round($this->reviews->sum('star')/$this->reviews->count()) : "No rating Yet",
            'discount'=>$this->discount,
            'totalPrice'=>round((1-$this->discount/100)*$this->price,2),
            'href'=>[
                'reviews'=>route('review.index',$this->id)
            ]
        ];
    }
}
