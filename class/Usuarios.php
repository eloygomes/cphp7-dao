<?php

class Usuarios
{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    // IDUSUARIOS
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function setIdusuario($value)
    {
        $this->idusuario = $value;
    }

    // DESLOGIN
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    public function setDeslogin($value)
    {
        $this->deslogin = $value;
    }

    // DESSENHA
    public function getDessenha()
    {
        return $this->dessenha;
    }

    public function setDessenha($value)
    {
        $this->dessenha = $value;
    }

    // DTCADASTRO
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    public function setDtcadastro($value)
    {
        $this->dtcadastro = $value;
    }

    public function loadById($id)
    {
        $sql = new sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));

        if (count($results) > 0) {

            $this->setData($results[0]);
        }
    }

    public static function getList()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login)
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%" . $login . "%"
        ));
    }

    public function login($login, $password)
    {
        $sql = new sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD" => $password
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        } else {
            throw new Exception("Provavelmente tu ta cabaleante das pernas e dos dedos, e por isso errou(like a Big Fausto) o Login e/ou a Senha, try again! MOTHERFUCKER");
        }
    }

    public function insert()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            "LOGIN" => $this->getDeslogin(),
            "PASSWORD" => $this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function setData($data)
    {
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function update($login, $password)
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuarios = :ID", array(
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDessenha(),
            ':ID' => $this->getIdusuario()
        ));
    }

    public function delete()
    {
        $sql = new Sql();

        $sql->query("DELETE * FROM tb_usuarios WHERE idusuarios = :ID", array(
            ':ID' => $this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());
    }



    public function __construct($login = "", $password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuarios" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()/*->format("d/m/Y H:i:s")*/
        ));
    }
}
