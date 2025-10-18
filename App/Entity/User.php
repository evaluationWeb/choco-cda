<?php

namespace App\Entity;

use App\Validation\Attributes\Email;
use App\Validation\Attributes\Length;
use App\Validation\Attributes\NotBlank;
use App\Validation\Validator;

class User implements EntityInterface
{
    private ?int $id = null;

    #[NotBlank]
    #[Length(min: 2, max: 50)]
    private ?string $firstname = null;

    #[NotBlank]
    #[Length(min: 2, max: 50)]
    private ?string $lastname = null;

    #[NotBlank]
    #[Length(min: 2, max: 30)]
    private ?string $pseudo = null;

    #[NotBlank]
    #[Email]
    private ?string $email = null;

    #[NotBlank]
    #[Length(min: 8, max: 255)]
    private ?string $password = null;

    private ?string $img = null;

    /**
     * @var array<int, string>
     */
    private array $grants = [];

    private bool $status = false;

    public function __construct(array $data = [], ?bool $autoValidate = null)
    {
        $this->hydrate($data);

        $shouldValidate = $autoValidate ?? ($data !== []);

        if ($shouldValidate) {
            (new Validator())->validate($this);
        }
    }

    private function hydrate(array $data): void
    {
        $this->id = $data['id'] ?? $this->id;
        $this->firstname = $data['firstname'] ?? $this->firstname;
        $this->lastname = $data['lastname'] ?? $this->lastname;
        $this->pseudo = $data['pseudo'] ?? $this->pseudo;
        $this->email = $data['email'] ?? $this->email;
        $this->password = $data['password'] ?? $this->password;
        $this->img = $data['img'] ?? $this->img;
        $this->grants = $data['grants'] ?? $this->grants;
        $this->status = $data['status'] ?? $this->status;
    }
}
