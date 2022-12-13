<?php
include 'Connection.php';
class Sign_in extends Connection{
    public function sign_in($email , $password){
        
        try{
        $req_sql = 'SELECT * from Client where email = :e and password = :p and validation = :v limit 1';
        $statment = $this->connection->prepare($req_sql);
        $statment->execute([':e'=>$email , ':p'=>$password ,':v'=>1]);
        $user = $statment->fetchAll(PDO::FETCH_OBJ);
        if(!empty($user)){
            session_start();
            foreach($user as $User_information){
                
                $_session['name'] = $User_information->name;
                $_session['first_name'] = $User_information->first_name;
                $_session['email'] = $User_information->email;
                $_session['nationality'] = $User_information->nationality;
                $_session['url_address_client'] = $User_information->url_address_client;
            }
            return 1 ;
        }else return 0;
        }catch(PDOException $e){
            print_r($e->getMessage());
        }
    }
}