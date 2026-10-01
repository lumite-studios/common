<?php

namespace LumiteStudios\Common\Action;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Action as BaseAction;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\WithAttributes;
use Illuminate\Auth\Access\AuthorizationException;

/**
 * @method bool  hasMethod(string $method)
 * @method array validate(array $attributes = [])
 * @method mixed validateCommand(Command $command, Closure $validate, ?Closure $loop = null)
 * @method array validateStaff(array $attributes = [])
 * @method void  addError(string $field, string $message, array $parameters = [])
 */
class Action extends BaseAction
{
    use WithAttributes;

    public string $authorizeMessage = 'You are not authorized to access this page.';

    public function hasMethod(string $method): bool
    {
        return method_exists($this, $method);
    }

    public function validate(array $attributes = [], ?array $only = null): array
    {
        if ($this->hasMethod('authorize') && ! $this->authorize()) {
            throw new AuthorizationException($this->authorizeMessage);
        }

        $validated = $attributes;

        if ($this->hasMethod('rules')) {
            $validator = Validator::make(
                $attributes,
                $only ? Arr::only($this->rules(), $only) : $this->rules(),
                method_exists($this, 'getValidationMessages') ? $this->getValidationMessages() : []
            );

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $validated = $validator->validated();
        }

        if ($this->hasMethod('errors')) {
            $this->errors($validated);
        }

        return $validated;
    }

    public function validateCommand(Command $command, Closure $validate, ?Closure $loop = null): mixed
    {
        try {
            $state = $validate();
            if ($state === false) {
                return $this->validateCommand($command, $loop ?? $validate);
            }

            return $state;
        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $error) {
                $command->error($error[0]);
            }

            return $this->validateCommand($command, $loop ?? $validate);
        }
    }

    public function validateStaff(array $attributes = []): array
    {
        if ($this->hasMethod('authorizeStaff') && ! $this->authorizeStaff()) {
            throw new AuthorizationException;
        }

        $validated = $attributes;

        if ($this->hasMethod('rulesStaff')) {
            $validator = Validator::make(
                $attributes,
                $this->rulesStaff(),
                method_exists($this, 'getValidationMessages') ? $this->getValidationMessages() : []
            );

            if ($validator->fails()) {
                throw (new ValidationException($validator))
                    ->errorBag($validator);
            }

            $validated = $validator->validated();
        }

        if ($this->hasMethod('errors')) {
            $this->errors($validated);
        }

        return $validated;
    }

    protected function addError(string $field, string $message, array $parameters = []): void
    {
        throw ValidationException::withMessages([
            $field => __($message, $parameters),
        ]);
    }
}
