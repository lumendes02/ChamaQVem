<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipousuario = TipoUsuario::get();
        // dd($tipousuario);exit;
        if (!!$tipousuario) {
            return $this->successResponseJson(json_encode($tipousuario));
        }

        return $this->errorResponse("Error ao Buscar TipoUsuario.");
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
        $dados = $request->all();
        if (!!$dados) {
            TipoUsuario::create($dados);

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
        $tipousuario = TipoUsuario::find($id);

        if (!!$tipousuario) {
            return $this->successResponseJson(json_encode($tipousuario));
        }

        return $this->errorResponse("Tipo usuario não existe.");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pegatipo($idusuario)
    {
        $dado = Usuario::select(DB::raw('*'))
        ->where([
            ['idusuario', '=', $idusuario]
        ])
        ->get();

        if (!!$dado) {
            return $this->successResponseJson(json_encode($dado->idtipousuario));
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
        $dados = TipoUsuario::find($id);

        if (!!$dados) {

            $dados->update([
                'cargo' => $request->cargo
            ]);

            return $this->successResponse("Tipo usuario alterado com Sucesso!");

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
        $produto = TipoUsuario::find($id);

        if (!!$produto) {
            $produto->delete();
            return $this->successResponse("Tipo usuario Deletado com Sucesso!");
        } 
        
        return $this->errorResponse("Error ao Deletar o Perfil!");
    }
}
