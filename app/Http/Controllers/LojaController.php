<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loja = Loja::get();
        // dd($tipousuario);exit;
        if (!!$loja) {
            return $this->successResponseJson(json_encode($loja));
        }

        return $this->errorResponse("Error ao Buscar lojas.");
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
        $dados = $request->all();
        if (!!$dados) {
            Loja::create($dados);

            return $this->successResponse("Cadastro Realizado com Sucesso!");
        }

        return $this->errorResponse("Error ao Realizar Cadastro!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loja = Loja::find($id);
        if (!!$loja) {
            return $this->successResponseJson(json_encode($loja));
        }

        return $this->errorResponse("Error ao Buscar loja.");
        
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
        $dados = Loja::find($id);

        if (!!$dados) {

            $dados->update([
                'idcidade' => $request->idcidade,
                'fantasia' => $request->fantasia,
                'endereco' => $request->endereco,
                'cnpj' => $request->cnpj,
                'cep' => $request->cep,
            ]);

            return $this->successResponse("Loja Alterado com Sucesso!");

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
        $loja = Loja::find($id);

        if (!!$loja) {
            $loja->delete();
            return $this->successResponse("Loja Deletado com Sucesso!");
        } 
        
        return $this->errorResponse("Error ao Deletar o Perfil!");
    }
}
