<?php

namespace App\Http\Controllers;

use App\Models\mensagens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MensagemControler extends Controller
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
        $dados = $request->all();
        if (!!$dados) {
            mensagens::create($dados);

            return $this->successResponse("Cadastro Realizado com Sucesso!");
        }

        return $this->errorResponse("Error ao Realizar Cadastro!");
    }

    public function todosusuario($idusuario)
    {
        $pesquisaMensagem = DB::table('mensagens')
        ->leftJoin('lojas', 'lojas.idloja', '=', 'mensagens.idloja')
        ->select('mensagens.*', 'lojas.fantasia')
        ->where([
            ['mensagens.idusuario', '=', $idusuario],
            ['idstatus', '<>', 1]
        ])
        ->orderBy('mensagens.created_at', 'desc')
        ->get();

        if ($pesquisaMensagem) {

            return $this->successResponseJson(json_encode($pesquisaMensagem));

        } else {

            return $this->errorResponse("Erro ao Buscar");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
}
