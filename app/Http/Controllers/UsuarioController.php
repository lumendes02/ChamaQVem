<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!!$usuario) {
            return $this->successResponseJson(json_encode($usuario));
        }

        return $this->errorResponse("Tipo usuario não existe.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dados = Usuario::find($id);

        if (!!$dados) {

            $dados->update([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->telefone,
                'login' => $request->login,
                'cpf' => $request->cpf
            ]);

            return $this->successResponse("Usuario alterado com Sucesso!");

        }

        return $this->errorResponse("Error ao Realizar Alteração!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function desativar($id)
    {
        $dados = Usuario::find($id);

        if (!!$dados) {

            $dados->update([
                'idtipousuario' => 2 
            ]);

            return $this->successResponse("usuario desativado com Sucesso!");

        }

        return $this->errorResponse("Error ao Realizar Alteração!");
    }
}

