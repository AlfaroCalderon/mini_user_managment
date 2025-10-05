<?php 
namespace Ralfaro\UserManagement;
use Ralfaro\UserManagement\Conn;

class AccommodationsManagement {
    private Conn $conn;

    public function __construct() {
        $this->conn = new Conn();
    }

    public function createAccommodation(AccommodationsInterface $accommodation) {
        $statement = $this->conn->getConn()->prepare("INSERT INTO accommodations (name, type, description, img_url, address, price_per_night, capacity, available) VALUES (:name, :type, :description, :img_url, :address, :price_per_night, :capacity, :available); ");
        $statement->execute([
            ":name" => $accommodation->getName(),
            ":type" => $accommodation->getType(),
            ":description" => $accommodation->getDescription(),
            ":img_url" => $accommodation->getImgUrl(),
            ":address" => $accommodation->getAddress(),
            ":price_per_night" => $accommodation->getPricePerNight(),
            ":capacity" => $accommodation->getCapacity(),
            ":available" => 1
        ]);

        if($statement->rowCount() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function showAllAvailableAccommodations(){
        $statement = $this->conn->getConn()->prepare("SELECT * FROM accommodations WHERE available = 1;");
        $statement->execute();

        $answer = $statement->fetchAll(mode: \PDO::FETCH_ASSOC);
        return $answer;
    }

    public function addAccommodationToUser($user_id, $accommodation_id) {
        $statement = $this->conn->getConn()->prepare("INSERT INTO user_selected_accommodations (user_id, accommodation_id) VALUES (:user_id, :accommodation_id); ");
        $statement->execute([
            ":user_id" => $user_id,
            ":accommodation_id" => $accommodation_id
        ]);

        if($statement->rowCount() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function removeAccommodationFromUser($user_id, $accommodation_id) {
        $statement = $this->conn->getConn()->prepare("UPDATE user_selected_accommodations SET deleted = true WHERE user_id = :user_id AND accommodation_id = :accommodation_id;");
        $statement->execute([
            ":user_id" => $user_id,
            ":accommodation_id" => $accommodation_id
        ]);

        if($statement->rowCount() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function showAllAccommodationsPerUser(int $userId) {
        $statement = $this->conn->getConn()->prepare("SELECT u.accommodation_id as accomodation_id, a.name as accomodation_name, a.type, a.description, a.img_url, a.address, a.price_per_night, a.capacity, a.available, a.created_at, u.user_id as user_id FROM user_selected_accommodations u LEFT JOIN accommodations a ON u.accommodation_id = a.accommodation_id WHERE u.user_id = :user_id AND u.deleted = false;");
        $statement->execute([
            ":user_id" => $userId
        ]);

        $answer = $statement->fetchAll(mode: \PDO::FETCH_ASSOC);
        return $answer;
    }

    public function getAccommodationById(int $id) {
        $statement = $this->conn->getConn()->prepare("SELECT * FROM accommodations WHERE accommodation_id = :accommodation_id;");
        $statement->execute([
            ":accommodation_id" => $id
        ]);

        $answer = $statement->fetch(\PDO::FETCH_ASSOC);
        return $answer;
    }


    public function getAccommodation(string $name, string $type) {
        $parameters = [];
        $where = '1=1';

        if(!empty($name)){
            $parameters[":name"] = "%$name%";
            $where .= " AND name LIKE :name";
        }

        if(!empty($type)){
            $parameters[":type"] = "%$type%";
            $where .= " AND type LIKE :type";
        }

        $statement = $this->conn->getConn()->prepare("SELECT * FROM accommodations WHERE $where;");
        $statement->execute($parameters);

        $answer = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $answer;
    }

    public function updateAccommodation(AccommodationsInterface $accommodation){
        $statement = $this->conn->getConn()->prepare("UPDATE accommodations SET name = :name, type = :type, description = :description, img_url = :img_url, address = :address, price_per_night = :price_per_night, capacity = :capacity, available = :available WHERE accommodation_id = :accommodation_id;");
        $statement->execute([
            ":name" => $accommodation->getName(),
            ":type" => $accommodation->getType(),
            ":description" => $accommodation->getDescription(),
            ":img_url" => $accommodation->getImgUrl(),
            ":address" => $accommodation->getAddress(),
            ":price_per_night" => $accommodation->getPricePerNight(),
            ":capacity" => $accommodation->getCapacity(),
            ":available" => $accommodation->isAvailable() ? 1 : 0,
            ":accommodation_id" => $accommodation->getAccommodationId()
        ]);

        if($statement->rowCount() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function deleteAccommodation(int $id){
        $statement = $this->conn->getConn()->prepare("DELETE FROM accommodations WHERE accommodation_id = :accommodation_id;");
        $statement->execute([
            ":accommodation_id" => $id
        ]);

        if($statement->rowCount() > 0){
            return 'true';
        }else{
            return 'false';
        }
    }
}

?>