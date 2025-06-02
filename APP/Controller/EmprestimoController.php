<?php

/**
 * Declaração de namespaces com sub-namespaces:
 * https://www.php.net/manual/pt_BR/language.namespaces.nested.php
 */
namespace App\Controller;

/**
 * Definimos aqui que nossa classe precisa incluir uma classe de outro subnamespace
 * do projeto, no caso a classe Aluno do sub-namespace Model
 */
use App\Model\{ Emprestimo, Aluno, Livro };
use Exception;

/**
 * Classes Controller são responsáveis por processar as requisições do usuário.
 * Isso significa que toda vez que um usuário chama uma rota, um método (função)
 * de uma classe Controller é chamado.
 * O método poderá devolver uma View (fazendo um include), acessar uma Model (para
 * buscar algo no banco de dados), redirecionar o usuário de rota, ou mesmo,
 * chamar outra Controller.
 * Uma classe definida como final não pode ter filhos, ou seja, nenhuma outra classe
 * pode fazer o extends dela, por exemplo: class Teste extends AlunoController.
 * Veja mais sobre final aqui: https://www.php.net/manual/pt_BR/language.oop5.final.php
 */
final class EmprestimoController extends Controller
{
    public static function index() : void
    {
        parent::isProtected(); 

        $model = new Emprestimo();
        
        try {
            $model->getAllRows();

        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os emprestimos:");
            $model->setError($e->getMessage());
        }

        parent::render('Emprestimo/lista_emprestimo.php', $model); 
    } 

    /**
     * Declaração de membros de classe estáticos:
     * https://www.php.net/manual/pt_BR/language.oop5.static.php
     * Note o tipo de retorno void, ou seja, esse método
     * é um procedimento e não tem retorno.
     */
    public static function cadastro() : void
    {
        parent::isProtected(); 

        $model = new Emprestimo();
        
        try
        {
            if(parent::isPost())
            {
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                $model->Id_Aluno = $_POST['id_aluno'];
                $model->Id_Livro = $_POST['id_livro'];
                $model->Id_Usuario = LoginController::getUsuario()->Id;
                $model->Data_Emprestimo = $_POST['data_emprestimo'];
                $model->Data_Devolucao = $_POST['data_devolucao'];           
                $model->save();

                parent::redirect("/emprestimo");

            } else {
    
                if(isset($_GET['id']))
                {              
                    $model = $model->getById( (int) $_GET['id'] );
                }
            }

        } catch(Exception $e) {

            $model->setError($e->getMessage());
        }

        $model->rows_alunos = new Aluno()->getAllRows();
        $model->rows_livros = new Livro()->getAllRows();

        parent::render('Emprestimo/form_emprestimo.php', $model);        
    } 
    
    public static function delete() : void
    {
        parent::isProtected(); 

        $model = new Emprestimo();
        
        try 
        {
            $model->delete( (int) $_GET['id']);
            parent::redirect("/emprestimo");

        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o emprestimo:");
            $model->setError($e->getMessage());
        } 
        
        parent::render('Emprestimo/lista_emprestimo.php', $model);  
    }
}
