<?php

namespace App\Model;

use App\DAO\LivroDAO;
use Exception;

/**
 * A camada model é responsável por transportar os dados da Controller até a DAO e vice-versa.
 * Também é atribuído a Model a validação dos dados da View e controle de acesso aos métodos
 * da DAO.
 */
final class Livro extends Model
{
    /**
     * Declaração das propriedades conforme campos da tabela no banco de dados.
     * para saber mais sobre Propriedades de Classe, leia: https://www.php.net/manual/pt_BR/language.oop5.properties.php
     */
    public ?int $Id = null;

    public array $rows_categorias = [];
    public array $rows_autores = [];

    public $Id_Categoria;

    public $Id_Autores = [];

    public ?string $Titulo
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Título deve ter no mínimo 3 caracteres.");

            $this->Titulo = $value;
        }

        get => $this->Titulo ?? null;
    }

    public ?string $Isbn
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("ISBN deve ter no mínimo 3 caracteres.");

            $this->Isbn = $value;
        }

        get => $this->Isbn ?? null;
    }

    public ?string $Editora
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Editora deve ter no mínimo 3 caracteres.");

            $this->Editora = $value;
        }

        get => $this->Editora ?? null;
    }

    public ?string $Ano
    {
        set
        {
            if(strlen($value) < 3)
                throw new Exception("Ano deve ter no mínimo 3 caracteres.");

            $this->Ano = $value;
        }

        get => $this->Ano ?? null;
    }


    /**
     * Declaração do método save que chamará a DAO para gravar no banco de dados
     * o model preenchido.
     */
    function save() : Livro
    {
        /**
         * Note que os objetos da classe AlunoDAO estão sendo criados de forma anônima.
         * Fazemos isso quando podemos descartar o objeto logo apos o uso, ou seja,
         * não sendo necessário armazenar o objeto em uma variável.
         * Leia sobre: https://www.php.net/manual/pt_BR/language.oop5.anonymous.php
         */
        return new LivroDAO()->save($this);
    }


    /**
     * Método que encapsula o acesso ao método selectById da camada DAO
     * O método recebe um parâmetro do tipo inteiro que é o id do registro
     * a ser recuperado do MySQL, via camada DAO.
     */
    function getById(int $id) : ?Livro
    {
        return new LivroDAO()->selectById($id);
    }


    /**
     * Método que encapsula a chamada a DAO e que abastecerá a propriedade rows;
     * Esse método é importante pois como a model é "vista" na View a propriedade
     * $rows será acessada e possibilitará listar os registros vindos do banco de dados
     */
    function getAllRows() : array
    {
        $this->rows = new LivroDAO()->select();

        return $this->rows;
    }


    /**
     * Método que encapsula o acesso a DAO do método delete.
     * O método recebe um parâmetro do tipo inteiro que é o id do registro
     * que será excluido da tabela no MySQL, via camada DAO.
     */
    function delete(int $id) : bool
    {
        return new LivroDAO()->delete($id);
    }
}
