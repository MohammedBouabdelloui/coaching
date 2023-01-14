<?php
include 'Connection.php';
class Client
{
    private $url_address_client;
    private $name;
    private $first_name;
    private $nationality;
    private $email;
    private $password_Client;
    private $url_validation;
    private $validation;
    public function __construct($name,$first_name,$email,$password,$url_validation,)
    {
        $this->url_address_client = $this->get_random_string_max(99);
        $this->name = $name;
        $this->first_name = $first_name;
        $this->nationality =  $this->get_nationality(); ;
        $this->email = $email;
        $this->password_Client = $password;
        $this->url_validation = $url_validation;
        $this->validation = 0;
    }

    private function get_random_string_max($length){
        $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':',';','<','>','?','[',']','~','`','.',',',' ','    ');
        $text = "";

        $length = rand(4, $length);

        for($i = 0; $i < $length; $i++){
            $text .= $array[rand(0, count($array) - 1)];
        }

        return $text;
    }

    public function get_nationality(){

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $IP = $_SERVER['HTTP_CLIENT_IP'];
          } 
          else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
           else {
            $IP = $_SERVER['REMOTE_ADDR']; 
          }
        // create curl resource
        $ch =  (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=105.157.12.77')));
        if($ch !=  ''){

            return $ch['geoplugin_countryName'];     
        }
        else return "Earth";
        
    }

    public function add_client(){
        $existing = 1;
        try{
            $con = new Connection();
            $connection = $con->connection;
            $req = "SELECT  email from Client where email = :e";
            $statement = $connection->prepare($req);
            $statement->execute([ ':e'=>$this->email]);
            $user = $statement->fetchAll(PDO::FETCH_OBJ);

            if(!empty($user)){
                return 0;
            }else{

                try{
                    $con = new Connection();
                    $connection = $con->connection;
                    $req = "INSERT INTO Client (url_address_client , name , first_name , nationality , email , password,validation,url_validation) values(?,?,?,?,?,?,?,?)";
                    $statement = $connection->prepare($req);
                    
                    //$statement = $this->conn->prepare($sql);
                    
                    $statement->execute([$this->url_address_client , $this->name , $this->first_name , $this->nationality , $this->email ,$this->password_Client,$this->validation,$this->url_validation]);
                    return 1;
                }catch(Exception $e){
                    print_r($e->getMessage());
                }
            }
        }catch(PDOException $e){
            print_r($e->getMessage());
        }
        
        
                
        
    }
}
//$obj = new Client("bouabdelloui" , "mohammed" , "simo2@gmail.com","azertty","kuheds");
//echo $obj->add_client();
?>
