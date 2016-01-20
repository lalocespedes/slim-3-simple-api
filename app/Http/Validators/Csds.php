<?php

namespace ly\Http\Validators;

use Respect\Validation\Exceptions\NestedValidationException;
use \Respect\Validation\Validator as V;

/**
 * Validator for csds
 * return exceptions errors array
 */
class Csds
{

    /**
     * List of constraints
     *
     * @var array
     */
    protected $rules = [];

    /**
     * List of customized messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * List of returned errors in case of a failing assertion
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Construct
     * @return void
     */
    function __construct()
    {
        $this->initRules();
        $this->initMessages();
    }

    /**
     * Set items constraints
     *
     * @return void
     */
    public function initRules()
    {
        $this->rules['no_certificado'] = V::numeric()->noWhitespace()->setName('Numero de certificado');
        $this->rules['clave'] = V::notEmpty()->noWhitespace()->setName('Contraseña de la llave privada');

    }

    /**
     * Set user custom error messages
     *
     * @return void
     */
    public function initMessages()
    {
        $this->messages = [
            'numeric'     => '{{name}} Debe ser numerico',
            'noWhitespace' => '{{name}} Espacios en blanco',
            'notEmpty' => '{{name}} Campo Requerido.'
        ];
    }

    /**
     * Assert validation rules.
     *
     * @param array $inputs
     *   The inputs to validate.
     * @return boolean
     *   True on success; otherwise, false.
     */
    public function assert(array $inputs)
    {
        foreach ($this->rules as $rule => $validator) {

            try {

                $input = isset($inputs[$rule]) ? $inputs[$rule] : '';

                $validator->assert($input);

            } catch (NestedValidationException $ex) {

                $this->errors = $ex->findMessages($this->messages);

                return false;
            }
        }

        return true;
    }

    /**
     * Return errors
     */
    public function errors()
    {
        return $this->errors;
    }
}
