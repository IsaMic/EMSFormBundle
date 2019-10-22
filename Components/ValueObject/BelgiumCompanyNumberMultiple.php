<?php

namespace EMS\FormBundle\Components\ValueObject;

class BelgiumCompanyNumberMultiple
{
    /** @var NumberValue */
    private $number;

    public function __construct(string $companyNumbers)
    {
        $this->number = new NumberValue($companyNumbers);

        if (!$this->validate()) {
            throw new \Exception(sprintf('At least one company registration number data: %s', $companyNumbers));
        }
    }

    public function validate(): bool
    {
        $valid = false;
        if (strlen($this->number->getDigits()) % 10 == 0) {
            $numbers = str_split($this->number->getDigits(), 10);
            foreach ($numbers as $number) {
                try {
                    new BelgiumCompanyNumber($number);
                    $valid = true;
                } catch (\Exception $exception) {
                    return false;
                }
            }
        }
        return $valid;
    }
}