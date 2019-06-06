<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\Enum\Gender;
use SmartEmailing\Types\Arrays;
use SmartEmailing\Types\DatesImmutable;
use SmartEmailing\Types\DateTimesImmutable;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\Guid;
use SmartEmailing\Types\PrimitiveTypes;
use SmartEmailing\Types\UrlType;

/**
 * Contact
 */
final class Contact
{

    /**
     * Unique ID of Contact
     *
     * @var int
     */
    private $id;

    /**
     * UID of Contact
     *
     * @var \SmartEmailing\Types\Guid
     */
    private $guid;

    /**
     * Email address of Contact
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $emailAddress;

    /**
     * First name
     *
     * @var string|null
     */
    private $name = null;

    /**
     * Last name
     *
     * @var string|null
     */
    private $surname = null;

    /**
     * Titles before name
     *
     * @var string|null
     */
    private $titlesBefore = null;

    /**
     * Titles after name
     *
     * @var string|null
     */
    private $titlesAfter = null;

    /**
     * Salution
     *
     * @var string|null
     */
    private $salution = null;

    /**
     * Company
     *
     * @var string|null
     */
    private $company = null;

    /**
     * Street
     *
     * @var string|null
     */
    private $street = null;

    /**
     * Town
     *
     * @var string|null
     */
    private $town = null;

    /**
     * Postal/ZIP code
     *
     * @var string|null
     */
    private $postalCode = null;

    /**
     * Country
     *
     * @var string|null
     */
    private $country = null;

    /**
     * Cellphone number
     *
     * @var string|null
     */
    private $cellPhone = null;

    /**
     * Phone number
     *
     * @var string|null
     */
    private $phone = null;

    /**
     * Language in POSIX format, eg. cz_CZ
     *
     * @var string|null
     */
    private $language = null;

    /**
     * Custom notes
     *
     * @var string|null;
     */
    private $notes = null;

    /**
     * Gender
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Enum\Gender|null
     */
    private $gender = null;

    /**
     * Date and time of Contact creation
     *
     * @var \DateTimeImmutable|null
     */
    private $created = null;

    /**
     * Date and time of update Contact's properties
     *
     * @var \DateTimeImmutable|null
     */
    private $updated = null;

    /**
     * Date and time of Contact's last click in one of your emails
     *
     * @var \DateTimeImmutable|null
     */
    private $lastClicked = null;

    /**
     * Date and time of Contact's last open of one of your emails
     *
     * @var \DateTimeImmutable|null
     */
    private $lastOpened = null;

    /**
     * Time of Contact's prefered delivery time based on it's opening history
     *
     * @var \DateTimeImmutable|null
     */
    private $preferredDeliveryTime = null;

    /**
     * Count of softbounces in a row. Open or click in email resets this counter back to 0
     *
     * @var int|null
     */
    private $softBounced = null;

    /**
     * 0 if Contact is OK, 1 if Contact has permanent delivery failure.
     *
     * @var bool|null
     */
    private $hardBounced = null;

    /**
     * 0 if Contact is OK, 1 if Contact does not want any of your e-mails anymore
     *
     * @var bool|null
     */
    private $blackListed = null;

    /**
     * Date of Contact's nameday
     *
     * @var \DateTimeImmutable|null
     */
    private $nameDay = null;

    /**
     * Date of Contact's birthday
     *
     * @var \DateTimeImmutable|null
     */
    private $birthDay = null;

    /**
     * URL of Customfield values endpoint. Can ve expanded into customfields property
     *
     * @var \SmartEmailing\Types\UrlType|null
     */
    private $customFieldsUrl;

    /**
     * @var string|null
     */
    private $domain = null;

    /**
     * @var bool|null
     */
    private $isConfirmed = null;

    /**
     * @var string|null
     */
    private $realName = null;

    /**
     * @var string|null
     */
    private $salutionUserName = null;

    /**
     * @var string|null
     */
    private $salutionGender = null;

    /**
     * @var string|null
     */
    private $salutionGenderTitle = null;

    /**
     * @var string|null
     */
    private $affilId = null;

    /**
     * Contactlists collection
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\ContactList[]
     */
    private $contactLists = [];

    /**
     * Contact constructor.
     * @param int $id
     * @param \SmartEmailing\Types\Guid $guid
     * @param \SmartEmailing\Types\Emailaddress $emailAddress
     */
    public function __construct(
        int $id,
        Guid $guid,
        Emailaddress $emailAddress
    ) {
        $this->id = $id;
        $this->guid = $guid;
        $this->emailAddress = $emailAddress;
    }

    /**
     * @param mixed[] $array
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\Contact
     */
    public static function fromArray(array $array): self
    {
        $self = new self(
            PrimitiveTypes::extractInt($array, 'id'),
            Guid::extract($array, 'guid'),
            Emailaddress::extract($array, 'emailaddress')
        );
        $self->name = PrimitiveTypes::extractStringOrNull($array, 'name');
        $self->surname = PrimitiveTypes::extractStringOrNull($array, 'surname');
        $self->titlesBefore = PrimitiveTypes::extractStringOrNull($array, 'titlesbefore');
        $self->titlesAfter = PrimitiveTypes::extractStringOrNull($array, 'titlesafter');
        $self->salution = PrimitiveTypes::extractStringOrNull($array, 'salution');
        $self->company = PrimitiveTypes::extractStringOrNull($array, 'company');
        $self->street = PrimitiveTypes::extractStringOrNull($array, 'street');
        $self->town = PrimitiveTypes::extractStringOrNull($array, 'town');
        $self->postalCode = PrimitiveTypes::extractStringOrNull($array, 'postalcode');
        $self->country = PrimitiveTypes::extractStringOrNull($array, 'country');
        $self->cellPhone = PrimitiveTypes::extractStringOrNull($array, 'cellphone');
        $self->phone = PrimitiveTypes::extractStringOrNull($array, 'phone');
        $self->language = PrimitiveTypes::extractStringOrNull($array, 'language');
        $self->notes = PrimitiveTypes::extractStringOrNull($array, 'notes');

        $self->gender = Gender::extractOrNull($array, 'gender');

        $self->created = DateTimesImmutable::extractOrNull($array, 'created');
        $self->updated = DateTimesImmutable::extractOrNull($array, 'updated');
        $self->lastClicked = DateTimesImmutable::extractOrNull($array, 'last_clicked');
        $self->lastOpened = DateTimesImmutable::extractOrNull($array, 'last_opened');
        $self->preferredDeliveryTime = DateTimesImmutable::extractOrNull($array, 'preferredDeliveryTime');

        $self->softBounced = PrimitiveTypes::extractIntOrNull($array, 'softbounced');
        $self->hardBounced = PrimitiveTypes::extractBoolOrNull($array, 'hardbounced');
        $self->blackListed = PrimitiveTypes::extractBoolOrNull($array, 'blacklisted');

        $self->nameDay = DatesImmutable::extractOrNull($array, 'nameday');
        $self->birthDay = DatesImmutable::extractOrNull($array, 'birthday');

        $self->customFieldsUrl = UrlType::extractOrNull($array, 'customfields_url');

        $self->domain = PrimitiveTypes::extractStringOrNull($array, 'domain');
        $self->isConfirmed = PrimitiveTypes::extractBoolOrNull($array, 'is_confirmed');
        $self->realName = PrimitiveTypes::extractStringOrNull($array, 'realname');
        $self->salutionUserName = PrimitiveTypes::extractStringOrNull($array, 'salutionsurname');
        $self->salutionGender = PrimitiveTypes::extractStringOrNull($array, 'salutiongender');
        $self->salutionGenderTitle = PrimitiveTypes::extractStringOrNull($array, 'salution_gender_title');
        $self->affilId = PrimitiveTypes::extractStringOrNull($array, 'affilid');

        $contactLists = Arrays::extractArrayOrNull($array, 'contactlists');
        if (is_array($contactLists)) {
            foreach ($contactLists as $contactList) {
                $objContactList = ContactList::fromArray($contactList);
                $self->contactLists[$objContactList->getContactListId()] = $objContactList;
            }
        }

        return $self;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getGuid(): Guid
    {
        return $this->guid;
    }

    public function getEmailAddress(): Emailaddress
    {
        return $this->emailAddress;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getTitlesBefore(): ?string
    {
        return $this->titlesBefore;
    }

    public function getTitlesAfter(): ?string
    {
        return $this->titlesAfter;
    }

    public function getSalution(): ?string
    {
        return $this->salution;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCellPhone(): ?string
    {
        return $this->cellPhone;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function getCreated(): ?DateTimeImmutable
    {
        return $this->created;
    }

    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->updated;
    }

    public function getLastClicked(): ?DateTimeImmutable
    {
        return $this->lastClicked;
    }

    public function getLastOpened(): ?DateTimeImmutable
    {
        return $this->lastOpened;
    }

    public function getPreferredDeliveryTime(): ?DateTimeImmutable
    {
        return $this->preferredDeliveryTime;
    }

    public function getSoftBounced(): ?int
    {
        return $this->softBounced;
    }

    public function getHardBounced(): ?bool
    {
        return $this->hardBounced;
    }

    public function getBlackListed(): ?bool
    {
        return $this->blackListed;
    }

    public function getNameDay(): ?DateTimeImmutable
    {
        return $this->nameDay;
    }

    public function getBirthDay(): ?DateTimeImmutable
    {
        return $this->birthDay;
    }

    public function getCustomFieldsUrl(): ?UrlType
    {
        return $this->customFieldsUrl;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function getIsConfirmed(): ?bool
    {
        return $this->isConfirmed;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function getSalutionUserName(): ?string
    {
        return $this->salutionUserName;
    }

    public function getSalutionGender(): ?string
    {
        return $this->salutionGender;
    }

    public function getSalutionGenderTitle(): ?string
    {
        return $this->salutionGenderTitle;
    }

    public function getAffilId(): ?string
    {
        return $this->affilId;
    }

    /**
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\ContactList[]
     */
    public function getContactLists(): array
    {
        return $this->contactLists;
    }

}
