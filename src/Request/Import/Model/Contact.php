<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\Enum\Gender;
use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
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
     * @var \SmartEmailing\Sdk\ApiV3Client\Enum\Gender|null
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

        $contact = new self(PrimitiveTypes::extractString($array, 'emailaddress'));

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

    public function setName(?string $name = null): void
    {
        $this->name = $name;
    }

    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    public function setTitlesBefore(?string $titlesBefore): void
    {
        $this->titlesBefore = $titlesBefore;
    }

    public function setTitlesAfter(?string $titlesAfter): void
    {
        $this->titlesAfter = $titlesAfter;
    }

    public function setSalutation(?string $salutation): void
    {
        $this->salutation = $salutation;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function setTown(?string $town): void
    {
        $this->town = $town;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function setCellPhone(?string $cellPhone): void
    {
        $this->cellPhone = $cellPhone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function setGender(?Gender $gender): void
    {
        $this->gender = $gender;
    }

    public function setBlackListed(?bool $blackListed): void
    {
        $this->blackListed = $blackListed;
    }

    public function setNameday(?DateTimeImmutable $nameday): void
    {
        $this->nameday = $nameday;
    }

    public function setBirthday(?DateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function addContactList(ContactContactlist $contactlist): void
    {
        $this->contactLists[] = $contactlist->toArray();
    }

    public function addCustomField(ContactCustomField $customfield): void
    {
        $this->customFields[] = $customfield->toArray();
    }

    public function addPurpose(ContactPurpose $purpose): void
    {
        $this->purposes[] = $purpose->toArray();
    }

}
