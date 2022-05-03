<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    use ApiResponseHelpers;

    public function index()
    {
        return Client::whereLike(['name', 'phone_number'], \request('search'))
            ->paginate(20);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|max:100|unique:clients,name',
            'phone_number' => 'max:100'
        ],
            [
                'name.unique' => 'Bu mijoz nomi oldin kiritilgan !',
                'name.required' => 'Iltimos, mijoz nomini kiriting !',
                'name.max' => 'Iltimos, nom 100 ta belgidan oshmasin !',
                'phone_number.max' => 'Iltimos, tavsif 100 ta belgidan oshmasin !',
            ]
        );

        $client = Client::create($request->only('name', 'phone_number'));

        return $this->respondWithSuccess(['success' => 'Mijoz qo\'shildi.', 'id' => $client->id, 'name' => $client->name]);;
    }
}
