<?php
/**
 * ControllerPayment
 * @version V 0.1
 * @author Alberto Vara (C) Copyright 2014
 * @package OLIF.ControllerPayment
 *
 * @desc
 */
namespace Olif;

require_once CORE_ROOT . CONTROLLERS . DIRECTORY_SEPARATOR . "ControllerORM.php";

class ControllerUsers extends ControllerORM
{

    /**
     * table: tabla del objecto seleccionado
     *
     * @var unknown
     */
    protected $table = TABLE_USERS;

    /**
     * table_prefix: prefijo tabla del objecto seleccionado
     *
     * @var unknown
     */
    protected $table_prefix = "C";

    /**
     * fields: campos del objecto seleccionado
     *
     * @var unknown
     */
    protected $fields = "";

    /**
     * joins: uniones que intervienen en la query del objecto seleccionado
     *
     * @var unknown
     */
    protected $joins = "";

    /**
     * $conds: condiciones que intervienen con el objecto seleccionado
     *
     * @var unknown
     */
    protected $conds = "C.STATUS = '1' ";

    public function __construct()
    {
        $this->fields = (TABLE_USERS_FIELDS);
        $this->joins = "";
        parent::__construct();
    }

    public function __set($name, $value)
    {
        if (strtoupper($name) == "PASS" && strlen($value) == 0) {
            return false;
        }
        if (strtoupper($name) == "PASS") {
            $value = sha1($value);
        }
        parent::__set($name, $value);
    }

    public function setSessionRol()
    {
        $this->getControllerSession();
        $this->getControllerAccess();
        $this->access->setSessionID($this->id); // userID
        $this->access->setSessionSec($this->rol_user); // userSec
    }
}
