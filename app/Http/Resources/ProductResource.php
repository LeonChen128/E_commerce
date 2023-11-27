<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Model\Product;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'price' => $this->price,
            'img' => config('app.user_root') . '/' . $this->user_id . '/' . $this->img,
            'date' => $this->updated_at->format('Y/m/d h:i:s'),
        ];
    }
}