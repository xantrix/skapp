<?php
namespace User\Model\Validator;

class NoIdentityExists extends AbstractIdentityValidator
{
    public function isValid($value)
    {
        $valid = true;
        $this->setValue($value);
        $result = $this->findIdentity($value);
        if ($result) {
            $valid = false;
            $this->error(self::ERROR_RECORD_FOUND);
        }
        return $valid;
    }
}