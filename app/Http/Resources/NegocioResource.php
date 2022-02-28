<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NegocioResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'Nombre_Negocio' => $this->Nombre_Negocio,
            'Direccion' => $this->Direccion,
            'Horario_Servicio' => $this->Horario_Servicio,
            'Dias_Servicio' => $this->Dias_Servicio,
            'Descripcion_Del_Negocio' => $this->Descripcion_Del_Negocio,
            'Usuario_Id' => $this->Usuario_Id,
        ];
    }
}
