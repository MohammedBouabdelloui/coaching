<?php
include 'Connection.php';
class Verification extends Connection{

    public function Verification_url($email , $url_validation){
        
        try{
            $req_sql = 'SELECT url_validation from Client where url_validation = :urlV and email = :e';
            $statement = $this->connection->prepare($req_sql);
            $statement->execute([":urlV"=>$url_validation , ':e'=>$email]);
            $user = $statement->fetchAll(PDO::FETCH_OBJ);
            if(empty($user)){
                return 0;
            }else{
                try{

                    $req_sql = 'UPDATE Client SET validation = 1 where email = :e';
                    $statement = $this->connection->prepare($req_sql);
                    $statement->execute([':e'=>$email]);
                    return 1;
                }catch(PDOException $e){
                print_r($e->getMessage());
                }
                
            }
        }catch(PDOException $e){
            print_r($e->getMessage());
        }

    }
}

?>