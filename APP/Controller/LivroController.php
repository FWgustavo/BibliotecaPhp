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

use App\Model\{ Categoria, Livro, Autor };
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
final class LivroController extends Controller
{
    public static function index() : void
    {
        parent::isProtected(); 

        $model = new Livro();
        
        try {
            $model->getAllRows();

        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os livros:");
            $model->setError($e->getMessage());
        }

        parent::render('Livro/lista_livro.php', $model); 
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

        $model = new Livro();

        echo "Estou onde quero";

        var_dump($model->Id_Autores);
        
        try
        {
            if(parent::isPost())
            {
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                $model->Titulo = $_POST['titulo'];
                $model->Id_Categoria = $_POST['id_categoria'];
                $model->Isbn = $_POST['isbn'];
                $model->Ano = $_POST['ano'];
                $model->Editora = $_POST['editora'];
                $model->Id_Autores = $_POST['autor'];
                $model->save();

                parent::redirect("/livro");

            } else {
    
                if(isset($_GET['id']))
                {              
                    $model = $model->getById( (int) $_GET['id'] );
                }
            }

        } catch(Exception $e) {

            $model->setError($e->getMessage());
        }

        /**
         * Obtendo a lista de categorias
         */
        $model->rows_categorias = new Categoria()->getAllRows();

        /**
         * Obtendo a lista de autores
         */
        $model->rows_autores = new Autor()->getAllRows();

        parent::render('Livro/form_livro.php', $model);        
    } 
    
    public static function delete() : void
    {
        parent::isProtected(); 

        $model = new Livro();
        
        try 
        {
            $model->delete( (int) $_GET['id']);
            parent::redirect("/livro");

        } catch(Exception $e) {
            $model->setError("Ocorreu um erro ao excluir o livro:");
            $model->setError($e->getMessage());
        } 
        
        parent::render('Livro/lista_livro.php', $model);  
    }
}