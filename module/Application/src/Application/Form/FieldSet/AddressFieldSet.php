<?php
namespace Application\Form\FieldSet;

use Application\Model\Object\Address\AddressObject;
use Zend\Form\Element;
use Zend\Form\Fieldset;

/**
 * Class AddressFieldSet
 *
 *
 * @package Application\Form\FieldSet
 */
class AddressFieldSet extends Fieldset
{
    const NAME = 'address';

    const INPUT_NAME_COUNTRY     = 'address_country';
    const INPUT_NAME_LOCALITY    = 'address_locality';
    const INPUT_NAME_REGION      = 'address_region';
    const INPUT_NAME_STREET      = 'street_address';
    const INPUT_NAME_POSTAL_CODE = 'postal_code';

    /**
     *
     */
    public function __construct(array $config = [])
    {
        parent::__construct(self::NAME);
        $this->setObject(new AddressObject());

        $this->addAddressCountry()
            ->addAddressLocality()
            ->addAddressRegion()
            ->addStreetAddress()
            ->addPostalCode();
    }

    public function setAllowedCountries(array $contryCodes)
    {
        $valueOptions = [];
        foreach ($contryCodes as $countryCode) {
            $key = strtoupper($countryCode);
            $valueOptions[$key] = \Locale::getDisplayName('_' . $key);
        }

        $this->get(self::INPUT_NAME_COUNTRY)->setValueOptions($valueOptions);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addAddressCountry()
    {
        //$elementSelect = new Element\Select(self::INPUT_NAME_COUNTRY);
        $elementText = new Element\Text(self::INPUT_NAME_COUNTRY);
        $this->add($elementText);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addAddressLocality()
    {
        $elementText = new Element\Text(self::INPUT_NAME_LOCALITY);
        $this->add($elementText);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addAddressRegion()
    {
        $elementText = new Element\Text(self::INPUT_NAME_REGION);
        $this->add($elementText);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addStreetAddress()
    {
        $elementText = new Element\Text(self::INPUT_NAME_STREET);
        $this->add($elementText);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addPostalCode()
    {
        $elementText = new Element\Text(self::INPUT_NAME_POSTAL_CODE);
        $this->add($elementText);
        return $this;
    }
}
