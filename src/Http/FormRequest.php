<?php

namespace Centum\Http;

use Centum\Forms\Form;
use Centum\Forms\Status;
use Exception;
use ReflectionClass;

class FormRequest
{
    protected Request $request;

    protected Form $form;

    protected Status $status;

    protected array $parameters;



    public function __construct(Request $request, Form $form)
    {
        $this->request = $request;
        $this->form    = $form;

        $this->status = $form->validate(
            $request->getParameters()
        );

        $this->parameters = $form->getFilteredValues(
            $request->getParameters()
        );
    }



    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function isValid(): bool
    {
        return $this->status->isValid();
    }



    public function bind(object $object): void
    {
        $reflectionClass = new ReflectionClass($object);

        /**
         * @var string $key
         * @var mixed $value
         */
        foreach ($this->parameters as $key => $value) {
            $setter = "set" . ucfirst($key);

            if ($reflectionClass->hasMethod($setter)) {
                /** @psalm-suppress MixedMethodCall */
                $object->{$setter}($value);
            } elseif ($reflectionClass->hasProperty($key)) {
                $property = $reflectionClass->getProperty($key);

                $property->setValue($object, $value);
            } else {
                throw new Exception(
                    sprintf(
                        "'%s' property does not exist on %s.",
                        $key,
                        get_class($object)
                    )
                );
            }
        }
    }
}
