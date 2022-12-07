<?php
include 'Connection.php';
class Client
{
    private $url_address_client;
    private $nom;
    private $prenom;
    private $nationality;
    private $email;
    private $password_Client;

    public function __construct($nom,$prenom,$email,$password)
    {
        $this->url_address_client = $this->get_random_string_max(99);
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->nationality =  $this->get_nationality(); ;
        $this->email = $email;
        $this->password_Client = $password;
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
        
        return $ch['geoplugin_countryName'];     
    }

    public function add_client(){

        try{
            $con = new Connection();
            $connection = $con->connection;
            $req = "INSERT INTO Client (url_address_client , nom , prenom , nation , email , password) values(?,?,?,?,?,?)";
            $statement = $connection->prepare($req);
            
            //$statement = $this->conn->prepare($sql);
            
            $statement->execute([$this->url_address_client , $this->nom , $this->prenom , $this->nationality , $this->email ,$this->password_Client]);
        }catch(Exception $e){
            print_r($e->getMessage());
        }
            
    }
}
$obj = new Client("bouabdelloui" , "mohammed" , "mohammed@gmail.com","azertty");
$obj->add_client();
?>