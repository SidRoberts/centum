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

    protected array $data;



    public function __construct(Request $request, Form $form)
    {
        $this->request = $request;
        $this->form    = $form;

        $this->status = $form->validate(
            $request->getData()
        );

        $this->data = $form->getFilteredValues(
            $request->getData()
        );
    }



    public function get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    public function getData(): array
    {
        return $this->data;
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
        foreach ($this->data as $key => $value) {
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
