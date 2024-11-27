<?php

namespace App\Core;

class UserValidator
{
    public bool $firstnameValidation;
    public bool $lastnameValidation;
    public bool $emailValidation;
    public bool $passwordValidation;
    public bool $countryValidation;

    public array $errors;
    public array $lastData;

    public function cleanAndCheckFirstname(string &$firstname): void
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $this->lastData['firstname'] = $firstname;

        if (strlen($firstname) >= 2 && strlen($firstname) <= 50) {
            $this->firstnameValidation = true;
        } else {
            $this->firstnameValidation = false;
            $this->errors['firstname'] = "Le prénom doit avoir entre 2 et 50 caractères";
        }
    }

    public function cleanAndCheckLastname(string &$lastname): void
    {
        $lastname = ucfirst(trim($lastname));
        $this->lastData['lastname'] = $lastname;

        if (strlen($lastname) >= 2 && strlen($lastname) <= 50) {
            $this->lastnameValidation = true;
        } else {
            $this->lastnameValidation = false;
            $this->errors['lastname'] = "Le nom doit avoir entre 2 et 50 caractères";
        }
    }

    public function cleanAndCheckEmail(string &$email): void
    {
        $email = strtolower(trim($email));
        $this->lastData['email'] = $email;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->emailValidation = true;
        } else {
            $this->emailValidation = false;
            $this->errors['email'] = "Le email n'est pas valide";

        }
    }

    public function checkPassword(string $password, string $passwordConfirmation): void
    {
        if (strlen($password) > 1 && $password === $passwordConfirmation) {
            $this->passwordValidation = true;
        } else {
            $this->passwordValidation = false;
            $this->errors['password'] = "Les mots de passe ne correspondent pas";
        }
    }

    public function cleanAndCheckCountry(string &$country): void
    {
        $country = strtoupper(trim($country));
        $this->lastData['country'] = $country;

        if (strlen($country) == 2) {
            $this->countryValidation = true;
        } else {
            $this->countryValidation = false;
            $this->errors['country'] = "Le pays n'est pas valide";

        }
    }
}