<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'		=>	$this->id,
            'title'		=>	$this->title,
            'location'	=> $this->location,
            'penyelenggara' => $this->penyelenggara,
            'peserta'	=> $this->peserta,
            'start'		=>	$this->start,
            'end'		=>	$this->end,
        ];
    }
}
