<?php

namespace App\Http\Controllers;

use App\Models\carrinho;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarrinhoControler extends Controller
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

    public function todosusuario($idusuario,$idloja)
    {
        $pesquisaCarrinho = DB::table('carrinhos')
        ->leftJoin('produtos', 'produtos.idproduto', '=', 'carrinhos.idproduto')
        ->select('carrinhos.*', 'produtos.*')
        ->where([
            ['idusuario', '=', $idusuario],
            ['idloja', '=', $idloja],
            ['idstatus', '=', 1]
        ])
        ->get();

        if ($pesquisaCarrinho) {

            return $this->successResponseJson(json_encode($pesquisaCarrinho));

        } else {

            return $this->errorResponse("Erro ao Buscar");

        }

    }

    public function todospedidosloja($idloja)
    {
        $pesquisaCarrinho = DB::table('carrinhos')
        ->leftJoin('usuarios', 'usuarios.idusuario', '=', 'carrinhos.idusuario')
        // ->select('usuarios.nome', 'usuarios.telefone')
        ->select('usuarios.*')
        ->where([
            ['idloja', '=', $idloja],
            ['idstatus', '=', 2]
        ])
        ->groupBy('usuarios.idusuario')
        ->get();

        if ($pesquisaCarrinho) {

            return $this->successResponseJson(json_encode($pesquisaCarrinho));

        } else {

            return $this->errorResponse("Erro ao Buscar");

        }

        if ($pesquisaCarrinho) {

            return $this->successResponseJson(json_encode($pesquisaCarrinho));

        } else {

            return $this->errorResponse("Erro ao Buscar");

        }

    }


    public function ativar($idusuario,$idloja)
    {
        $pedido = new Pedidos;
        $pedido->idloja = $idloja;
        $pedido->idusuario = $idusuario;
        $pedido->save();

        $dados = carrinho::select(DB::raw('*'))
        ->where([
            ['idusuario', '=', $idusuario],
            ['idloja', '=', $idloja],
            ['idstatus', '=', 1]
        ])
        ->get();

        if (!!$dados) {

            foreach($dados as $dado) {
                $dado->update([
                    'idstatus' => 2,
                    'idpedido' => $pedido->idpedido
                ]);
            }

            return $this->successResponse($dado->idpedido);

        }

        return $this->errorResponse("Error ao Realizar Alteração!");

    }

    public function confirmar($idpedido)
    {
        $dados = carrinho::select(DB::raw('*'))
        ->where([
            ['idpedido', '=', $idpedido]
        ])
        ->get();

        if (!!$dados) {

            foreach($dados as $dado) {
                $dado->update([
                    'idstatus' => 4
                ]);
            }

            return $this->successResponse($dado->idpedido);

        }

        return $this->errorResponse("Error ao Realizar Alteração!");

    }

    public function finaliza($idpedido)
    {
        $dados = carrinho::select(DB::raw('*'))
        ->where([
            ['idpedido', '=', $idpedido]
        ])
        ->get();

        if (!!$dados) {

            foreach($dados as $dado) {
                $dado->update([
                    'idstatus' => 5
                ]);
            }
            return $this->successResponse($dado->idpedido);
        }
        return $this->errorResponse("Error ao Realizar Alteração!");
    }

    public function recusar($idpedido)
    {
        $dados = carrinho::select(DB::raw('*'))
        ->where([
            ['idpedido', '=', $idpedido]
        ])
        ->get();

        $pedido = Pedidos::find($idpedido);
        if (!!$pedido) {
            $pedido->delete();
        }
        
        if (!!$dados) {

            foreach($dados as $dado) {
                $dado->delete();
            }

            return $this->successResponse($idpedido);
        }

        return $this->errorResponse("Error ao Realizar exclusao!");

    }

    public function verificaProdutoIgual($idusuario,$idloja,$idproduto)
    {
        $pesquisaCarrinho = DB::table('carrinhos')
        ->select(DB::raw('quantidade'))
        ->where([
            ['idusuario', '=', $idusuario],
            ['idloja', '=', $idloja],
            ['idproduto', '=', $idproduto],
            ['idstatus', '=', 1]
        ])
        ->first();

        if ($pesquisaCarrinho !== null) {

            $pesquisaCarrinho = DB::table('carrinhos')
            ->select(DB::raw('quantidade'))
            ->where([
                ['idusuario', '=', $idusuario],
                ['idloja', '=', $idloja],
                ['idproduto', '=', $idproduto]
            ])
            ->first()->quantidade;

            return $this->successResponseJson(json_encode($pesquisaCarrinho));

        } else {

            return 0;

        }

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
            carrinho::create($dados);

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
    public function update(Request $request)
    {

        $dados = carrinho::select(DB::raw('*'))
        ->where([
            ['idusuario', '=', $request->idusuario],
            ['idloja', '=', $request->idloja],
            ['idproduto', '=', $request->idproduto]
        ])
        ->first();

        if (!!$dados) {

            $dados->update([
                'quantidade' => $request->quantidade
            ]);

            return $this->successResponse("Carrinho item Alterado com Sucesso!");

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
        $loja = carrinho::find($id);

        if (!!$loja) {
            $loja->delete();
            return $this->successResponse("Item Deletado com Sucesso!");
        }

        return $this->errorResponse("Error ao Deletar o Perfil!");
    }
}
