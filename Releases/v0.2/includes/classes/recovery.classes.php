<?php

class RecoveryService extends db{
    protected $_email;
    protected $_recovery;

    public function __construct(){
        $this->_email=strtolower($_POST['recovery-email']);
        $this->_recovery=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"),0, 32);
    }

    public function recovery(){
        $this->_checkCredentials();
        setcookie("alert", "<span style=\"color:lawngreen;\">link: config/email.txt</span>", time() + 5, "/");
        file_put_contents("../../config/email.txt", "reset.php?id-email={$this->_email}&id-recovery={$this->_recovery}\n");
        header("location: ../../index.php");
        exit();
    }

    protected function _checkCredentials(){
        if(empty($this->_email)){
            setcookie("alert", "<span style=\"color:red;\">user not found</span>", time() + 5, "/");
            header("location: ../../index.php");
            exit();
        }
        $stmt=$this->connect()->prepare("SELECT recovery.`id-user` FROM `recovery` INNER JOIN `status` ON recovery.`id-user`=status.`id-user` 
        WHERE recovery.`id-user` IN (SELECT `id-user` FROM `users` WHERE `email`=?) AND `id-recovery` IS NULL AND `status`=\"active\";");
        $stmt->execute(array($this->_email));
        if($stmt->rowCount()==0){
            setcookie("alert", "<span style=\"color:red;\">user not found</span>", time() + 5, "/");
            header("location: ../../index.php");
            exit();
        }
        $stmt=$this->connect()->prepare("UPDATE `recovery` SET `id-recovery`=? WHERE `id-user` IN (SELECT `id-user` FROM `users` WHERE `email`=?);");
        $stmt->execute(array(hash("sha3-512", $this->_recovery), $this->_email));
        $stmt=null;
    }
}
?>