<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiciosResource extends JsonResource
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

        return [
            'id' => $this->id,
            'Nombre_Servicio' => $this->Nombre_Servicio,
            'Costo' => $this->Costo,
            'Tiempo_Estimado' => $this->Tiempo_Estimado,
            'Foto' => $this->Foto,
            'Negocio_Id' => $this->Negocio_Id

        ];
    }
}
