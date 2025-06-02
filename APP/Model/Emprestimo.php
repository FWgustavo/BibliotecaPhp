<?php

namespace App\Model;

use App\DAO\EmprestimoDAO;
use Exception;

/**
 * A camada model é responsável por transportar os dados da Controller até a DAO e vice-versa.
 * Também é atribuído a Model a validação dos dados da View e controle de acesso aos métodos
 * da DAO.
 */
final class Emprestimo extends Model
{
    /**
     * Declaração das propriedades conforme campos da tabela no banco de dados.
     * para saber mais sobre Propriedades de Classe, leia: https://www.php.net/manual/pt_BR/language.oop5.properties.php
     */
    public ?int $Id = null;
    public ?int $Id_Usuario = null;
    public ?int $Id_Livro = null;
    public ?int $Id_Aluno = null;

    public ?string $Data_Devolucao = null;
    public ?string $Data_Emprestimo = null;

    public ?Aluno $Dados_Aluno = null;
    public ?Livro $Dados_Livro = null;

    public array $rows_livros = [];
    public array $rows_alunos = [];

    
    /**
     * Declaração do método save que chamará a DAO para gravar no banco de dados
     * o model preenchido.
     */
    function save() : Emprestimo
    {
        /**
         * Note que os objetos da classe AlunoDAO estão sendo criados de forma anônima.
         * Fazemos isso quando podemos descartar o objeto logo apos o uso, ou seja,
         * não sendo necessário armazenar o objeto em uma variável.
         * Leia sobre: https://www.php.net/manual/pt_BR/language.oop5.anonymous.php
         */
        return new EmprestimoDAO()->save($this);
    }


    /**
     * Método que encapsula o acesso ao método selectById da camada DAO
     * O método recebe um parâmetro do tipo inteiro que é o id do registro
     * a ser recuperado do MySQL, via camada DAO.
     */
    function getById(int $id) : ?Emprestimo
    {
        return new EmprestimoDAO()->selectById($id);
    }


    /**
     * Método que encapsula a chamada a DAO e que abastecerá a propriedade rows;
     * Esse método é importante pois como a model é "vista" na View a propriedade
     * $rows será acessada e possibilitará listar os registros vindos do banco de dados
     */
    function getAllRows() : array
    {
        $this->rows = new EmprestimoDAO()->select();

        return $this->rows;
    }


    /**
     * Método que encapsula o acesso a DAO do método delete.
     * O método recebe um parâmetro do tipo inteiro que é o id do registro
     * que será excluido da tabela no MySQL, via camada DAO.
     */
    function delete(int $id) : bool
    {
        return new EmprestimoDAO()->delete($id);
    }
}