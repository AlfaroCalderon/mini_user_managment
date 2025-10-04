<?php
namespace Ralfaro\UserManagement;

interface AccommodationsInterface
{
    public function getAccommodationId(): int;
    public function setAccommodationId(int $accommodation_id): void;

    public function getName(): string;
    public function setName(string $name): void;

    public function getType(): string;
    public function setType(string $type): void;

    public function getDescription(): string;
    public function setDescription(string $description): void;

    public function getImgUrl(): string;
    public function setImgUrl(string $img_url): void;

    public function getAddress(): string;
    public function setAddress(string $address): void;

    public function getPricePerNight(): float;
    public function setPricePerNight(float $price_per_night): void;

    public function getCapacity(): int;
    public function setCapacity(int $capacity): void;

    public function isAvailable(): bool;
    public function setAvailable(bool $available): void;
}
?>