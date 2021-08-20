<?php
declare(strict_types=1);

namespace App\ValueObject;

use Assert\Assertion;

class Role
{
    /**
     * @var string
     */
    private $role;

    /**
     * @param string $value
     * @return \App\ValueObject\Role
     */
    public static function fromString(string $value): self
    {
        $role = new self;
        Assertion::inArray($value, ["ROLE_USER", "ROLE_ADMIN", "ROLE_SUPER_ADMIN"], "error.role_miss-configured");

        $role->role = $value;

        return $role;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return (string) $this->role;
    }
}
