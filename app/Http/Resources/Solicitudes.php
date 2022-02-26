<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Solicitudes extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return[
            'id' => $this->id,
            'Total' => $this->Total,
            'Horario_Renta' => $this->Horario_Renta,
            'Usuario_Id' => $this->Usuario_Id,
            'Servicio_Id' => $this->Servicio_Id,
        ];
    }
}
