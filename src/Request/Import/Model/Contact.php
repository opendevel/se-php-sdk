<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Request\AbstractModel;
use SmartEmailing\Sdk\Status\GenderStatus;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\PrimitiveTypes;

final class Contact extends AbstractModel
{

    /**
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $emailAddress;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $surname = null;

    /**
     * @var string|null
     */
    private $titlesBefore = null;

    /**
     * @var string|null
     */
    private $titlesAfter = null;

    /**
     * @var string|null
     */
    private $salutation = null;

    /**
     * @var string|null
     */
    private $company = null;

    /**
     * @var string|null
     */
    private $street = null;

    /**
     * @var string|null
     */
    private $town = null;

    /**
     * @var string|null
     */
    private $postalCode = null;

    /**
     * @var string|null
     */
    private $country = null;

    /**
     * @var string|null
     */
    private $cellPhone = null;

    /**
     * @var string|null
     */
    private $phone = null;

    /**
     * @var string|null
     */
    private $language = null;

    /**
     * @var string|null
     */
    private $notes = null;

    /**
     * @var string|null
     */
    private $gender = null;

    /**
     * @var bool|null
     */
    private $blackListed = null;

    /**
     * @var \DateTimeImmutable|null
     */
    private $nameday = null;

    /**
     * @var \DateTimeImmutable|null
     */
    private $birthday = null;

    /**
     * Contactlists presence of imported contacts.
     * Any contactlist presence unlisted in imported data will be untouched.
     * Unsubscribed contacts will stay unsubscribed if settings.preserve_unsubscribed=1
     *
     * @var array|null
     */
    private $contactLists = null;

    /**
     * Customfields assigned to contact
     * Customfields unlisted in imported data will be untouched.
     *
     * @var array|null
     */
    private $customFields = null;

    /**
     * Processing purposes assigned to contact. Every purpose may be assigned multiple times for different time intervals. Exact duplicities will be silently skipped.
     *
     * @var array|null
     */
    private $purposes = null;

    /**
     * Contact constructor.
     * @param string $emailaddress
     */
    public function __construct(string $emailaddress)
    {
        $this->emailAddress = Emailaddress::from($emailaddress);
    }

    public function toArray(): array
    {
        return [
            'emailaddress' => $this->emailAddress->getValue(),
            'name' => $this->name,
            'surname' => $this->surname,
            'titlesbefore' => $this->titlesBefore,
            'titlesafter' => $this->titlesAfter,
            'salution' => $this->salutation,
            'company' => $this->company,
            'street' => $this->street,
            'town' => $this->town,
            'postalcode' => $this->postalCode,
            'country' => $this->country,
            'cellphone' => $this->cellPhone,
            'phone' => $this->phone,
            'language' => $this->language,
            'notes' => $this->notes,
            'gender' => $this->gender,
            'blacklisted' => !is_null(PrimitiveTypes::getBoolOrNull($this->blackListed)) ? (int)$this->blackListed : null,
            'nameday' => !empty($this->nameday) ? $this->nameday->format('Y-m-d H:i:s') : null,
            'birthday' => !empty($this->birthday) ? $this->birthday->format('Y-m-d H:i:s') : null,
            'contactlists' => $this->contactLists,
            'customfields' => $this->customFields,
            'purposes' => $this->purposes,
        ];
    }

    public function setName(?string $name = null): Contact
    {
        $this->name = $name;
        return $this;
    }

    public function setSurname(?string $surname): Contact
    {
        $this->surname = $surname;
        return $this;
    }

    public function setTitlesBefore(?string $titlesBefore): Contact
    {
        $this->titlesBefore = $titlesBefore;
        return $this;
    }

    public function setTitlesAfter(?string $titlesAfter): Contact
    {
        $this->titlesAfter = $titlesAfter;
        return $this;
    }

    public function setSalutation(?string $salutation): Contact
    {
        $this->salutation = $salutation;
        return $this;
    }

    public function setCompany(?string $company): Contact
    {
        $this->company = $company;
        return $this;
    }

    public function setStreet(?string $street): Contact
    {
        $this->street = $street;
        return $this;
    }

    public function setTown(?string $town): Contact
    {
        $this->town = $town;
        return $this;
    }

    public function setPostalCode(?string $postalCode): Contact
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCountry(?string $country): Contact
    {
        $this->country = $country;
        return $this;
    }

    public function setCellPhone(?string $cellPhone): Contact
    {
        $this->cellPhone = $cellPhone;
        return $this;
    }

    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    public function setLanguage(?string $language): Contact
    {
        $this->language = $language;
        return $this;
    }

    public function setNotes(?string $notes): Contact
    {
        $this->notes = $notes;
        return $this;
    }

    public function setGender(?string $gender): Contact
    {
        if (!is_null($gender)) {
            GenderStatus::checkValue($gender);
            $this->gender = $gender;
        } else {
            $this->gender = null;
        }

        return $this;
    }

    public function setBlackListed(?bool $blackListed): Contact
    {
        $this->blackListed = $blackListed;
        return $this;
    }

    public function setNameday(?DateTimeImmutable $nameday): Contact
    {
        $this->nameday = $nameday;
        return $this;
    }

    public function setBirthday(?DateTimeImmutable $birthday): Contact
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function addContactList(ContactsContactlist $contactlist): Contact
    {
        $this->contactLists[] = array_filter($contactlist->toArray());
        return $this;
    }

    public function addCustomField(ContactCustomField $customfield): Contact
    {
        $this->customFields[] = array_filter($customfield->toArray());
        return $this;
    }

    public function addPurpose(ContactPurpose $purpose): Contact
    {
        $this->purposes[] = array_filter($purpose->toArray());
        return $this;
    }

}
