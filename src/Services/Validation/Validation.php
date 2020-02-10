<?php

namespace App\Services\Validation;

class Validation
{
    /**
     * Available validation rules:
     *
     * required
     * numeric
     * email
     * boolean
     * url
     * length       E.g. 'required|length:10'
     * string
     * skip         If need skip validation process for the certain field.
     *
     */

    use ValidationBag;

    /**
     * @var array
     */
    private $validData = [];

    /**
     * Array of alerts submitted during validation.
     *
     * @var array
     */
    private $errors = [];

    /**
     * List of alert messages.
     *
     * @var array
     */
    private $errorAlertsTexts = [
        'required'      => 'Field cannot be empty',
        'email'         => 'Field should be consistent with example@domain.com',
        'url'           => 'Field should be consistent with http://faqs.org/rfcs/rfc2396',
        'numeric'       => 'Invalid value. Numeric type only',
        'boolean'       => 'Invalid value. Boolean type only',
        'string'        => 'Invalid value. String type only',
        'length'        => 'Invalid length of value',
    ];

    /**
     * Get the attributes and values that were validated.
     *
     * @return array
     */
    public function getValidData(): array
    {
        return $this->validData;
    }

    /**
     * Get the texts of messages that were submitted during validation.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Run the validator's rules against its data.
     *
     * @param array $data
     * @param array $rules
     */
    public function validate(array $data, array $rules)
    {
        /**
         * Parse rules as 'price' => 'required|isNumber|isLength:10'
         */
        foreach ($rules as $field => $rule) {
            $this->validateField($field, $data[$field], $rule, $data);
        }
    }

    /**
     * Start validation by field.
     *
     * @param string    $field      The parameter, e.g. 'price'
     * @param mixed     $value      The value of parameter
     * @param string    $rule       The rule, e.g. 'required|isNumber|isLength:10'
     * @param array     $data       An array of data received at the endpoint.
     */
    protected function validateField(string $field, $value, string $rule, array $data = [])
    {
        $rule = $this->parseRule($rule);

        foreach ($rule as $validator => $args) {
            $vars = array_merge([$value, $data], $args);
            $bool = $this->$validator($vars);

            if ($bool) {
                $this->validData[$field] = $value;
            } else {
                $this->errors[$field] = $this->errorAlertsTexts[$validator];
            }
        }
    }

    /**
     * Parse the rule string, converting dots to =>.
     *
     * @param string $rule
     *
     * @return array
     */
    protected function parseRule(string $rule): array
    {
        $result = [];
        $rules = explode('|', $rule);

        foreach ($rules as $rule) {
            $frags = explode(':', $rule);
            $name = $frags[0];
            $args = isset($frags[1]) ? explode(',', $frags[1]) : [];
            $result[$name] = $args;
        }

        return $result;
    }
}