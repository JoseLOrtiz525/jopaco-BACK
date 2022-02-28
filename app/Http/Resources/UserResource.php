<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'Nombre' => $this->Nombre,
            'Apellido_Paterno' => $this->Apellido_Paterno,
            'Apellido_Materno' => $this->Apellido_Materno,
            'Fecha_Nacimiento' => $this->Fecha_Nacimiento,
            'Tipo_Usuario' => $this->Tipo_Usuario,
            'Email' => $this->Email,
            'Password' => $this->Password,
        ];
    }
}
