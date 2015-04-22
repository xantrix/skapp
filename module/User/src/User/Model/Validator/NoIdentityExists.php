<?php
namespace User\Model\Validator;

class NoIdentityExists extends AbstractIdentityValidator
{
    public function isValid($value, $context = null)
    {
        $valid = true;
        $this->setValue($value);
        $result = $this->findIdentity($value,$context);
        if ($result) {
            $valid = false;
            $this->error(self::ERROR_RECORD_FOUND);
        }
        return $valid;
    }
}