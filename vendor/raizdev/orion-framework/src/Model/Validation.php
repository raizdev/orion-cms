<?php declare(strict_types=1);

namespace Orion\Framework\Model;

use Orion\Framework\Exception\ValidationException;
use Rakit\Validation\Validator;

/**
 * Class ValidatorService
 *
 * @package Ares\Framework\Service
 */
class Validation
{
    /**
     * @var array $errors
     */
    private array $errors = [];

    public function __construct() {
        $this->validator = new Validator();
    }
    /**
     * Validates the given data and returns an Exception if Validator fails
     *
     * @param mixed $data
     * @param array $rules
     *
     * @return void
     * @throws ValidationException
     */
    public function validate(mixed $data, array $rules)
    {
        if ($data === null || empty($rules)) {
           throw new ValidationException(__('Please provide a right data set'));
        }

        $validator = $this->validator->make($data, $rules);
        $validator->validate();

        if ($validator->fails()) {
            $fields = $validator->errors()->toArray();

            $errors = [];

            foreach ($fields as $key => $messages) {
                foreach ($messages as $message) {
                    $errors[] = [
                        'field' => $key,
                        'message' => __($message, [ucfirst($key)])
                    ];
                }
            }

            $this->setErrors($errors);

            $validationException = new ValidationException('', 422);
            $validationException->setErrors($this->getErrors());
            throw $validationException;
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param mixed $error
     */
    public function setErrors(mixed $error): void
    {
        $this->errors = $error;
    }
}