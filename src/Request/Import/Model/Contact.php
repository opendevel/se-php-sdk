<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Sdk\Status\GenderStatus;
use SmartEmailing\Types\DateTimeFormatter;
use SmartEmailing\Types\DateTimesImmutable;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\PrimitiveTypes;

final class Contact implements ToArrayInterface
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
    private $language = null;   //@todo Language in POSIX format, eg. cz_CZ

    /**
     * @var string|null
     */
    private $notes = null;

    /**
     * @var \SmartEmailing\Sdk\Status\GenderStatus|null
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
     * @var array
     */
    private $contactLists = [];

    /**
     * Customfields assigned to contact
     * Customfields unlisted in imported data will be untouched.
     *
     * @var array
     */
    private $customFields = [];

    /**
     * Processing purposes assigned to contact. Every purpose may be assigned multiple times for different time intervals. Exact duplicities will be silently skipped.
     *
     * @var array
     */
    private $purposes = [];

    public function __construct(string $emailaddress)
    {
        $this->emailAddress = Emailaddress::from($emailaddress);
    }

    public static function fromArray(array $array): self
    {
        $array = array_change_key_case($array, CASE_LOWER);

        $contact = new self(Emailaddress::extract($array, 'emailaddress')->getValue());

        $contact->setName(PrimitiveTypes::extractStringOrNull($array, 'name', true));
        $contact->setSurname(PrimitiveTypes::extractStringOrNull($array, 'surname', true));
        $contact->setTitlesBefore(PrimitiveTypes::extractStringOrNull($array, 'titlesbefore', true));
        $contact->setTitlesAfter(PrimitiveTypes::extractStringOrNull($array, 'titlesafter', true));
        $contact->setSalutation(PrimitiveTypes::extractStringOrNull($array, 'salutation', true));
        $contact->setCompany(PrimitiveTypes::extractStringOrNull($array, 'company', true));
        $contact->setStreet(PrimitiveTypes::extractStringOrNull($array, 'street', true));
        $contact->setTown(PrimitiveTypes::extractStringOrNull($array, 'town', true));
        $contact->setPostalCode(PrimitiveTypes::extractStringOrNull($array, 'postalcode', true));
        $contact->setCountry(PrimitiveTypes::extractStringOrNull($array, 'country', true));
        $contact->setCellPhone(PrimitiveTypes::extractStringOrNull($array, 'cellphone', true));
        $contact->setPhone(PrimitiveTypes::extractStringOrNull($array, 'phone', true));
        $contact->setLanguage(PrimitiveTypes::extractStringOrNull($array, 'language', true));
        $contact->setNotes(PrimitiveTypes::extractStringOrNull($array, 'notes', true));
        $contact->setGender(GenderStatus::fromOrNull(PrimitiveTypes::extractStringOrNull($array, 'gender', true)));
        $contact->setBlackListed(PrimitiveTypes::extractBoolOrNull($array, 'blacklisted', true));
        $contact->setNameday(DateTimesImmutable::extractOrNull($array, 'nameday', true));
        $contact->setBirthday(DateTimesImmutable::extractOrNull($array, 'birthday', true));

        $arrayContactLists = PrimitiveTypes::extractArrayOrNull($array, 'contactlists');
        if (is_array($arrayContactLists)) {
            /** @var array $arrayContactList */
            foreach ($arrayContactLists as $arrayContactList) {
                $contact->addContactList(ContactContactlist::fromArray($arrayContactList));
            }
        }

        $arrayCustomFields = PrimitiveTypes::extractArrayOrNull($array, 'customfields');
        if (is_array($arrayCustomFields)) {
            /** @var array $arrayCustomField */
            foreach ($arrayCustomFields as $arrayCustomField) {
                $contact->addCustomField(ContactCustomField::fromArray($arrayCustomField));
            }
        }

        $arrayPurposes = PrimitiveTypes::extractArrayOrNull($array, 'purposes');
        if (is_array($arrayPurposes)) {
            /** @var array $arrayPurpose */
            foreach ($arrayPurposes as $arrayPurpose) {
                $contact->addPurpose(ContactPurpose::fromArray($arrayPurpose));
            }
        }

        return $contact;
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
            'gender' => !is_null($this->gender) ? $this->gender->getValue() : null,
            'blacklisted' => !is_null(PrimitiveTypes::getBoolOrNull($this->blackListed)) ? (int)$this->blackListed : null,
            'nameday' => DateTimeFormatter::formatOrNull($this->nameday),
            'birthday' => DateTimeFormatter::formatOrNull($this->birthday),
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

    public function setGender(?GenderStatus $gender): Contact
    {
        $this->gender = $gender;
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

    public function addContactList(ContactContactlist $contactlist): Contact
    {
        $this->contactLists[] = $contactlist->toArray();
        return $this;
    }

    public function addCustomField(ContactCustomField $customfield): Contact
    {
        $this->customFields[] = $customfield->toArray();
        return $this;
    }

    public function addPurpose(ContactPurpose $purpose): Contact
    {
        $this->purposes[] = $purpose->toArray();
        return $this;
    }

}
