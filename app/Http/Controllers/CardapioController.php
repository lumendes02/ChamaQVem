<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cardapio = Cardapio::get();

        if (!!$cardapio) {
            return $this->successResponseJson(json_encode($cardapio));
        }

        return $this->errorResponse("Error ao Buscar Cardapios.");
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
            Cardapio::create($dados);

            return $this->successResponse("Cadastro Realizado com Sucesso!");
        }

        return $this->errorResponse("Error ao Realizar Cadastro!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idusuario
     * @param  int  $idloja
     * @return \Illuminate\Http\Response
     */
    public function verifica($idusuario, $idloja)
    {
        $cardapio = Cardapio::select("cardapios.*")
        ->leftJoin('lojas', 'lojas.idloja', '=', 'cardapios.idloja')
        ->leftJoin('usuarios', 'lojas.idusuario', '=', 'usuarios.idusuario')
        ->where('lojas.idusuario', $idusuario)
        ->where('lojas.idloja', $idloja)
        ->get();

        if (!!$cardapio) {
            return $this->successResponseJson(json_encode($cardapio));
        }

        return $this->errorResponse("não existe.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cardapio = Cardapio::find($id);

        if (!!$cardapio) {
            return $this->successResponseJson(json_encode($cardapio));
        }

        return $this->errorResponse("Cidade não existe.");
    }

    public function todosloja($id)
    {
        $pesquisaCliente = Cardapio::select("*")
        ->where('idloja', $id)
        ->get();

        if ($pesquisaCliente) {

            return $this->successResponseJson(json_encode($pesquisaCliente));

        } else {

            return $this->errorResponse("Erro ao Buscar a Pesquisa por Cliente!");

        }
        
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
        $dados = Cardapio::find($id);

        if (!!$dados) {

            $dados->update([
                'idloja' => $request->idloja,
                'fantasia' => $request->fantasia
            ]);

            return $this->successResponse("Cardapio Alterado com Sucesso!");

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
        $cardapio = Cardapio::find($id);

        if (!!$cardapio) {
            $cardapio->delete();
            return $this->successResponse("Cardapio Deletado com Sucesso!");
        } 
        
        return $this->errorResponse("Error ao Deletar o Perfil!");
    }
}
