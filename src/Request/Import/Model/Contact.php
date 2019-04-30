<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Enum\Gender;
use SmartEmailing\Sdk\ToArrayInterface;
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
     * @var \SmartEmailing\Sdk\Enum\Gender|null
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

        $contact->setName(PrimitiveTypes::extractStringOrNull($array, 'name'));
        $contact->setSurname(PrimitiveTypes::extractStringOrNull($array, 'surname'));
        $contact->setTitlesBefore(PrimitiveTypes::extractStringOrNull($array, 'titlesbefore'));
        $contact->setTitlesAfter(PrimitiveTypes::extractStringOrNull($array, 'titlesafter'));
        $contact->setSalutation(PrimitiveTypes::extractStringOrNull($array, 'salutation'));
        $contact->setCompany(PrimitiveTypes::extractStringOrNull($array, 'company'));
        $contact->setStreet(PrimitiveTypes::extractStringOrNull($array, 'street'));
        $contact->setTown(PrimitiveTypes::extractStringOrNull($array, 'town'));
        $contact->setPostalCode(PrimitiveTypes::extractStringOrNull($array, 'postalcode'));
        $contact->setCountry(PrimitiveTypes::extractStringOrNull($array, 'country'));
        $contact->setCellPhone(PrimitiveTypes::extractStringOrNull($array, 'cellphone'));
        $contact->setPhone(PrimitiveTypes::extractStringOrNull($array, 'phone'));
        $contact->setLanguage(PrimitiveTypes::extractStringOrNull($array, 'language'));
        $contact->setNotes(PrimitiveTypes::extractStringOrNull($array, 'notes'));
        $contact->setGender(Gender::fromOrNull(PrimitiveTypes::extractStringOrNull($array, 'gender')));
        $contact->setBlackListed(PrimitiveTypes::extractBoolOrNull($array, 'blacklisted'));
        $contact->setNameday(DateTimesImmutable::extractOrNull($array, 'nameday'));
        $contact->setBirthday(DateTimesImmutable::extractOrNull($array, 'birthday'));

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
            'gender' => $this->gender !== null ? $this->gender->getValue() : null,
            'blacklisted' => PrimitiveTypes::getBoolOrNull($this->blackListed) !== null ? (int)$this->blackListed : 0,  // blacklisted must not be null
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

    public function setGender(?Gender $gender): Contact
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
