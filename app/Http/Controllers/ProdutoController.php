<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::get();
        if (!!$produtos) {
            return $this->successResponseJson(json_encode($produtos));
        }

        return $this->errorResponse("Error ao Buscar itens.");
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
            Produto::create($dados);

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
        $produto = Produto::find($id);

        if (!!$produto) {
            return $this->successResponseJson(json_encode($produto));
        }

        return $this->errorResponse("Cidade não existe.");
    }

    public function todosproduto($id)
    {
        $produtosCardapio = Produto::select("*")
        ->where('idcardapio', $id)
        ->get();

        if ($produtosCardapio) {

            return $this->successResponseJson(json_encode($produtosCardapio));

        } else {

            return $this->errorResponse("Erro ao Buscar a Pesquisa por Cardapio!");

        }
    }

    public function todosprodutousuario($idusuario,$idloja,$idpedido)
    {
        $pesquisaCarrinho = DB::table('produtos')
        ->leftJoin('carrinhos', 'carrinhos.idproduto', '=', 'produtos.idproduto')
        ->select('produtos.*', 'carrinhos.*')
        ->where([
            ['idusuario', '=', $idusuario],
            ['idloja', '=', $idloja],
            ['carrinhos.idpedido', '=', $idpedido]
        ])
        ->whereNotIn('idstatus', [1,3])
        ->get();

        if ($pesquisaCarrinho) {

            return $this->successResponseJson(json_encode($pesquisaCarrinho));

        } else {

            return $this->errorResponse("Erro ao Buscar a Pesquisa por Cardapio!");

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
        $dados = Produto::find($id);

        if (!!$dados) {

            $dados->update([
                'idcardapio' => $request->idcardapio,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'desconto' => $request->desconto
            ]);

            return $this->successResponse("Produto Alterado com Sucesso!");

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
        $produto = Produto::find($id);

        if (!!$produto) {
            $produto->delete();
            return $this->successResponse("Produto Deletado com Sucesso!");
        } 
        
        return $this->errorResponse("Error ao Deletar o Perfil!");
    }
}
