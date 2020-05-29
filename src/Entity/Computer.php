<?php

namespace App\Entity;

use App\Repository\ComputerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ComputerRepository::class)
 */
class Computer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank(message="Le modèle ne peut pas être null")
    * @Assert\Length(
    *      min = 2,
    *      max = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
    *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
    *      allowEmptyString = false
    * )
    */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $buyPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $sellPrice;

    /**
     * @ORM\Column(type="date")
     */
    private $dateEnterStock;

    /**
    * Computer constructor.
    * @param $model
    * @param $brand
    * @param $type
    * @param $category
    * @param $buyPrice
    * @param $sellPrice
    * @param $dateEnterStock
    */
    public function __construct($model =  null, $brand = null, $type = null, $category = null, $buyPrice = null, $sellPrice = null, $dateEnterStock = null)
    {
        $this->model = $model;
        $this->brand = $brand;
        $this->type = $type;
        $this->category = $category;
        $this->buyPrice = $buyPrice;
        $this->sellPrice = $sellPrice;
        $this->dateEnterStock = $dateEnterStock;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getBuyPrice(): ?int
    {
        return $this->buyPrice;
    }

    public function setBuyPrice(int $buyPrice): self
    {
        $this->buyPrice = $buyPrice;

        return $this;
    }

    public function getSellPrice(): ?int
    {
        return $this->sellPrice;
    }

    public function setSellPrice(int $sellPrice): self
    {
        $this->sellPrice = $sellPrice;

        return $this;
    }

    public function getDateEnterStock()
    {
        return $this->dateEnterStock;
    }

    public function setDateEnterStock($dateEnterStock): self
    {
        $this->dateEnterStock = $dateEnterStock;

        return $this;
    }

    public function toArray(){
        return[
            'id' => $this->id,
            'model' => $this->model,
            'brand' => $this->brand,
            'type' => $this->type,
            'category' => $this->category,
            'buyPrice' => $this->buyPrice,
            'sellPrice' => $this->sellPrice,
            'dateEnterStock' => $this->dateEnterStock,
        ];
    }
}
