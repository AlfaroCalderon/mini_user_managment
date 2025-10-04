<?php 
namespace Ralfaro\UserManagement;

class Accommodations implements AccommodationsInterface {
    private int $accommodation_id;
    private string $name;
    private string $type;
    private string $description;
    private string $img_url;
    private string $address;
    private float $price_per_night;
    private int $capacity;
    private bool $available;

    public function getAccommodationId(): int {
        return $this->accommodation_id;
    }

    public function setAccommodationId(int $accommodation_id): void {
        $this->accommodation_id = $accommodation_id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getImgUrl(): string {
        return $this->img_url;
    }

    public function setImgUrl(string $img_url): void {
        $this->img_url = $img_url;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getPricePerNight(): float {
        return $this->price_per_night;
    }

    public function setPricePerNight(float $price_per_night): void {
        $this->price_per_night = $price_per_night;
    }

    public function getCapacity(): int {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void {
        $this->capacity = $capacity;
    }

    public function isAvailable(): bool {
        return $this->available;
    }

    public function setAvailable(bool $available): void {
        $this->available = $available;
    }
}

?>

?>