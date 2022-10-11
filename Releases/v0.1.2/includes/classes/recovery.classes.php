<?php

class RecoveryService extends db{
    protected $_date;
    protected $_email;
    protected $_recovery;

    public function __construct(){
        $this->_date=date("d M Y H:i:s");
        $this->_email=strtolower($_POST['recovery-email']);
        $this->_recovery=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0, 50);
    }

    public function recovery(){
        $this->_checkCredentials();
        setcookie("alert", "<span style=\"color:lawngreen;\">link: reset.php?id={$this->_recovery}</span>", time() + 5, "/");
        header("location: ../../index.php");
        exit();
    }

    protected function _checkCredentials(){
        if(empty($this->_email)){
            setcookie("alert", "<span style=\"color:red;\">user not found</span>", time() + 5, "/");
            header("location: ../../recovery.php");
            exit();
        }
        $stmt=$this->connect()->prepare("SELECT recovery.`id-user` FROM `recovery` INNER JOIN `users` ON recovery.`id-user`=users.`id-user` 
        INNER JOIN `status` ON users.`id-user`=status.`id-user` WHERE `email`=? AND `status`=\"active\";");
        $stmt->execute(array($this->_email));
        if($stmt->rowCount()==0){
            setcookie("alert", "<span style=\"color:red;\">user not found</span>", time() + 5, "/");
            header("location: ../../recovery.php");
            exit();
        }
        $stmt=$this->connect()->prepare("UPDATE `recovery` SET `id-recovery`=? WHERE `id-user` IN (SELECT `id-user` FROM `users` WHERE `email`=?);");
        $stmt->execute(array($this->_recovery, $this->_email));
        $stmt=null;
    }
}
?>