<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
/**
* @OA\Info(title="API rick-and-morty", version="1.0")
*
* @OA\Server(url="http://rick-and-morty.test")
*/
class PersonController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/persons",
    *     summary="Mostrar Personajes",
    *     @OA\Parameter(
    *         name="page",
    *         in="query",
    *         description="Paginacion",
    *         required=false,
    *      ),
    *     @OA\Response(
    *         response=200,
    *         description="Mostrar todos los personajes.",
    *          @OA\MediaType(
    *              mediaType="application/json",
    *          )
    *     ),
    *     @OA\Response(
    *         response="default",
    *         description="Ha ocurrido un error."
    *     )
    * )
    */
    public function index()
    {
        if(isset($_GET['page'])) {
            $person = Person::paginate(5);
        }else{
            $person = Person::paginate(request()->all());
        }
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
            'gender.required' => 'Debe ingresar un gener0',
        ];
        $input = [
            'name' => 'required',
            'detail' => 'required',
            'gender' => 'required',
        ];
        $response = array('data' => '', 'success'=>false,'message'=>'');
        $validator = Validator::make($request->all(), $input,$messages);

        if ($validator->fails()) {
            $response['message'] = $validator->messages();

        } else {
            $person = new Person;
            $person->name = $request->name;
            $person->detail = $request->detail;
            $person->gender_id = $request->gender;
            $person->save();

            $response['success'] = true;
            $response['message'] = "Personaje creado satisfactoriamente.";
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
    public function show(Request $request)
    {
        $response = array('data' => '', 'success'=>false,'message'=>'');
        $arrayWhere = [];
        if(isset($_GET['name'])) {
            $arrayWhere = array_merge($arrayWhere,['name' => $_GET['name']]);
            $response['success'] = true;
            $response['message'] = "Persona encontrado.";
        }
        if(isset($_GET['gender'])) {
            $arrayWhere = array_merge($arrayWhere,['gender_id' => $_GET['gender']]);
            $response['success'] = true;
            $response['message'] = "Persona encontrado.";
        }
        if(isset($_GET['id'])) {
            $arrayWhere = array_merge($arrayWhere,['id' => $_GET['id']]);
            $response['success'] = true;
            $response['message'] = "Persona encontrado.";
        }
        if (count($arrayWhere) > 0){
            $person = Person::where($arrayWhere)
                ->orderBy('id')
                ->get();
            $response['data'] = $person;
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return $person;
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
        $response = array('data' => '', 'success'=>false,'message'=>'');
        $messages = [
            'name.required' => 'Debe ingresar un nombre',
            'detail.required' => 'Debe ingresar un nombre',
            'gender.required' => 'Debe ingresar un genero',
        ];
        $input = [
            'name' => 'required',
            'detail' => 'required',
            'gender' => 'required',
        ];
        $validator = Validator::make($request->all(), $input,$messages);
        if ($validator->fails()) {
            $response['message'] = $validator->messages();
        } else {
            $person1 = Person::find($person);

            $person1->name =  $request['name'];
            $person1->detail = $request['detail'];
            $person1->gender_id = $request['gender'];
            $person1->save();
            $response['success'] = true;
            $response['message'] = "Persona actualizada.";
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $id)
    {
        $stock = Person::find($id);
        $stock->delete(); // Easy right?

        return redirect('/stocks')->with('success', 'Stock removed.');  // -> resources/views/stocks/index.blade.php
    }
}
