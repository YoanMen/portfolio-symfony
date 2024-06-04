<?php

namespace App\Document;

use DateTime;
use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(collection: "visitors")]

class Visitors
{
  #[ODM\Id]
  private string  $id;


  #[ODM\Field(type: Type::INT)]
  private int $number;

  #[ODM\Field(type: Type::DATE_IMMUTABLE)]
  private DateTimeImmutable $date;
  /**
   * Get the value of id
   */
  public function getId(): string
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId(int $id): self
  {
    $this->id = $id;

    return $this;
  }
  /**
   * Get the value of number
   */
  public function getNumber(): int
  {
    return $this->number;
  }

  /**
   * Set the value of number
   */
  public function setNumber(int $number): self
  {
    $this->number = $number;

    return $this;
  }

  /**
   * Get the value of date
   */
  public function getDate(): string
  {
    return $this->date->format('d/m/Y');
  }

  /**
   * Set the value of date
   */
  public function setDate(DateTimeImmutable $date): self
  {
    $this->date = $date;

    return $this;
  }
}
