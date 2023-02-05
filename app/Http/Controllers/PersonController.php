<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
/**
* @OA\Info(title="API personas", version="1.0")
*
* @OA\Server(url="http://rick-and-morty.test")
*/
class PersonController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/person",
    *     summary="Mostrar Personajes",
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los personajes."
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        $person = Person::all();
        return response()->json([
                "success" => true,
                "message" => "Listado de personas",
                "data" => $person
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $messages = [
            'name.required' => 'Debe ingresar un nombre',
            'detail.required' => 'Debe ingresar un nombre',
        ];
        $input = [
            'name' => 'required',
            'detail' => 'required',
        ];
        $response = array('data' => '', 'success'=>false,'message'=>'');
        $validator = Validator::make($request->all(), $input,$messages);

        if ($validator->fails()) {
            $response['message'] = $validator->messages();

        } else {
            $person = new Person;
            $person->name = $request->name;
            $person->detail = $request->detail;
            $person->save();

            $response['success'] = true;
            $response['message'] = "Product created successfully.";
            $response['data'] = $person;
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $id)
    {
        $person = person::find($id);
        if (is_null($person)) {
            return $this->sendError('person not found.');
        }
        return response()->json([
            "success" => true,
            "message" => "Product retrieved successfully.",
            "data" => $person
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
