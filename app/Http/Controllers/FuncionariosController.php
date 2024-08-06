<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionariosFormRequest;
use App\Http\Requests\funcionarioUpdateFormRequest;
use App\Models\Funcionario;
use App\Models\FuncionariosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionariosController extends Controller
{
    public function store (FuncionariosFormRequest $request)
    {
        $funcionario = Funcionario::create([
            'nome' => $request->nome,
            'email'=> $request->email,
            'cpf' => $request-> cpf,
            'password'=>Hash::make($request->password),
            'funcao'=> $request-> funcao,
            'telefone'=> $request-> telefone,
            'salario'=>$request->salario,
        ]);
        if (isset($funcionario)) {
            return response()->json([
                "status"=>true,
                'title'=> 'Cadastrando',
                "massage"=> "Funcionario Cadastrado com sucesso",
                "data"=>$funcionario
            ], 200);
        }
    }
    public function excluir($id){
        $funcionario = Funcionario:: find($id);


        if (!isset($funcionario)){
            return response()->json([
                'status'=> false,
                'message'=> "Cadastro não encontrado"
            ]);
        }
        $funcionario->delete();


        return response()->json([
            'status'=>true,
            'message'=>"cadastro Excluido com sucesso"
        ]);

    }
     public function retornarTodos()
     {
        $funcionario = Funcionario::all();

        if(count($funcionario)  > 0) {
            return response()->json([
                'status'=> true,
                'data'=> $funcionario
            ]);
       }
       return response()->json([
        'status'=> false,
        'message'=> "Nenhum Funcionario cadastrado"
       ]);
     }
     public function editarFuncionario(funcionarioUpdateFormRequest $request)
     {
        $funcionario= Funcionario::find($request->id);
        if(!isset($funcionario))  {
            return response()->json([
                'status'=> false,
                'message'=> "Funcionario não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $funcionario->nome = $request->nome;
        }
        if (isset($request->email)) {
            $funcionario->email = $request->email;
        }
        if (isset($request->cpf)) {
            $funcionario->cpf = $request->cpf;
        }
        if (isset($request->password)) {
            $funcionario->password = $request->password;
        }
        if (isset($request->funcao)) {
            $funcionario->funcao = $request->funcao;
        }
        if (isset($request->telefone)) {
            $funcionario->telefone = $request->telefone;
        }
        if (isset($request->salario)) {
            $funcionario->salario = $request->salario;
        }
        

        $funcionario->update();

        return response ()->json([
            'status'=> true,
            'message'=>'funcionario atualizado.'
        ]);
     }

// pesquisa


public function pesquisarPorNome(Request $request)
{
    $funcionario = Funcionario::where('nome','like','%'. $request->nome . '%')->get();



    if(count($funcionario) > 0){
        return response()->json([
            'status'=>true,
            'data'=>$funcionario
        ]);
    }
    return response()->json([
        'status'=> false,
        'message'=>"Nome não encontrado"
    ]);
}
     public function pesquisarPorCpf(Request $request)
     {
        $funcionario =Funcionario::where('cpf','=',$request->cpf)->first();
        

        if (isset($funcionario)){
            return response()->json([
                'status'=> true,
                'message'=> $funcionario
            ]);
        }
        return response()->json([
            'status'=> false,
            'message'=> "CPF não encontrado"
        ]);
     }
     public function update(Request $request){
        $funcionario= Funcionario::find($request->id);

        if(!isset($funcionario)){
            return response()->json([
                'status'=>false,
                'message'=>"Cadastro não encontrado"
            ]);
        }
        if (isset($request->nome)) {
            $funcionario->nome = $request->nome;
        }
        if (isset($request->email)) {
            $funcionario->email = $request->email;
        }
        if (isset($request->cpf)) {
            $funcionario->cpf = $request->cpf;
        }
        if (isset($request->senha)) {
            $funcionario->senha = $request->senha;
        }
        if (isset($request->funcao)) {
            $funcionario->funcao = $request->funcao;
        }
        if (isset($request->telefone)) {
            $funcionario->telefone = $request->telefone;
        }
        if (isset($request->salario)) {
            $funcionario->salario = $request->salario;
        }

        return response()->json([
            'status'=>true,
            'message'=>" Cadastro atualizado"
        ]);
     }

}

