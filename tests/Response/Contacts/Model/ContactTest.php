<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\Enum\Gender;
use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\Guid;
use SmartEmailing\Types\UrlType;

final class ContactTest extends TestCase
{

    public function testCreateFromJsonMin(): void
    {
        $json = '{
    "status": "ok",
    "meta": [],
    "data": {
        "guid": "30264890-5c84-11e9-9620-06b3ea2053b4",
        "emailaddress": "john.doe@example.com",
        "id": 42
    }
}
';

        $array = json_decode($json, true);
        $input = $array['data'];

        $contact = Contact::fromArray($input);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertInstanceOf(Guid::class, $contact->getGuid());
        $this->assertInstanceOf(Emailaddress::class, $contact->getEmailAddress());

        $this->assertSame($input['id'], $contact->getId());
        $this->assertSame($input['guid'], $contact->getGuid()->getValue());
        $this->assertSame($input['emailaddress'], $contact->getEmailAddress()->getValue());

        $this->assertSame(null, $contact->getName());
        $this->assertSame(null, $contact->getSurname());
        $this->assertSame(null, $contact->getTitlesBefore());
        $this->assertSame(null, $contact->getTitlesAfter());
        $this->assertSame(null, $contact->getSalution());
        $this->assertSame(null, $contact->getCompany());
        $this->assertSame(null, $contact->getStreet());
        $this->assertSame(null, $contact->getTown());
        $this->assertSame(null, $contact->getPostalCode());
        $this->assertSame(null, $contact->getCountry());
        $this->assertSame(null, $contact->getCellPhone());
        $this->assertSame(null, $contact->getPhone());
        $this->assertSame(null, $contact->getLanguage());
        $this->assertSame(null, $contact->getNotes());
        $this->assertSame(null, $contact->getGender());
        $this->assertSame(null, $contact->getCreated());
        $this->assertSame(null, $contact->getUpdated());
        $this->assertSame(null, $contact->getLastClicked());
        $this->assertSame(null, $contact->getLastOpened());
        $this->assertSame(null, $contact->getPreferredDeliveryTime());
        $this->assertSame(null, $contact->getSoftBounced());
        $this->assertSame(null, $contact->getHardBounced());
        $this->assertSame(null, $contact->getBlackListed());
        $this->assertSame(null, $contact->getNameDay());
        $this->assertSame(null, $contact->getBirthDay());
        $this->assertSame(null, $contact->getCustomFieldsUrl());
        $this->assertSame([], $contact->getContactLists());
    }

    public function testCreateFromJsonFull(): void
    {
        $json = '{
    "status": "ok",
    "meta": [],
    "data": {
        "guid": "30264890-5c84-11e9-9620-06b3ea2053b4",
        "language": "cs_CZ",
        "created": "2019-04-11 20:04:02",
        "updated": "2019-05-06 16:13:05",
        "blacklisted": 0,
        "emailaddress": "john.doe@example.com",
        "is_confirmed": 0,
        "domain": "example.com",
        "name": "John",
        "surname": "Doe",
        "titlesbefore": "Mr.",
        "titlesafter": "Bc.",
        "birthday": "2019-01-01",
        "nameday": "2019-02-02",
        "salution": "John",
        "salutionsurname": "Doe",
        "salutiongender": "Dear Sir",
        "salution_gender_title": "Sir",
        "company": "ACME company",
        "street": "Street 1",
        "town": "City",
        "country": "USA",
        "postalcode": "111 00",
        "notes": "Notes",
        "phone": "+420111222333",
        "cellphone": "+420123456789",
        "affilid": "123",
        "gender": "M",
        "softbounced": 0,
        "hardbounced": 1,
        "last_opened": "2019-04-11 20:04:02",
        "last_clicked": "2019-04-11 20:04:02",
        "preferredDeliveryTime": "2019-04-11 20:04:02",
        "id": 42,
        "realname": null,
        "customfields_url": "https://app.smartemailing.cz/api/v3/contact-customfields?contact_id=42",
        "contactlists": [
            {
                "id": 6,
                "contact_id": 42,
                "contactlist_id": 1,
                "status": "confirmed",
                "added": "2019-04-11 20:04:02",
                "updated": "2019-04-11 20:04:02",
                "score_opens": null,
                "score_clicks": null,
                "contact_blacklisted": 0,
                "contact_bounced": 1
            }
        ]
    }
}
';

        $array = json_decode($json, true);
        $input = $array['data'];

        $contact = Contact::fromArray($input);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertInstanceOf(Guid::class, $contact->getGuid());
        $this->assertInstanceOf(Emailaddress::class, $contact->getEmailAddress());

        $this->assertIsArray($contact->getContactLists());

        $this->assertSame($input['id'], $contact->getId());
        $this->assertSame($input['guid'], $contact->getGuid()->getValue());
        $this->assertSame($input['emailaddress'], $contact->getEmailAddress()->getValue());

        $this->assertSame('John', $contact->getName());
        $this->assertSame('Doe', $contact->getSurname());
        $this->assertSame('Mr.', $contact->getTitlesBefore());
        $this->assertSame('Bc.', $contact->getTitlesAfter());
        $this->assertSame('John', $contact->getSalution());
        $this->assertSame('ACME company', $contact->getCompany());
        $this->assertSame('Street 1', $contact->getStreet());
        $this->assertSame('City', $contact->getTown());
        $this->assertSame('111 00', $contact->getPostalCode());
        $this->assertSame('USA', $contact->getCountry());
        $this->assertSame('+420123456789', $contact->getCellPhone());
        $this->assertSame('+420111222333', $contact->getPhone());
        $this->assertSame('cs_CZ', $contact->getLanguage());
        $this->assertSame('Notes', $contact->getNotes());
        $this->assertSame(Gender::from('M'), $contact->getGender());

        $this->assertEquals(new DateTimeImmutable('2019-04-11 20:04:02'), $contact->getCreated());
        $this->assertEquals(new DateTimeImmutable('2019-05-06 16:13:05'), $contact->getUpdated());
        $this->assertEquals(new DateTimeImmutable('2019-04-11 20:04:02'), $contact->getLastClicked());
        $this->assertEquals(new DateTimeImmutable('2019-04-11 20:04:02'), $contact->getLastOpened());
        $this->assertEquals(new DateTimeImmutable('2019-04-11 20:04:02'), $contact->getPreferredDeliveryTime());
        $this->assertEquals(new DateTimeImmutable('2019-02-02'), $contact->getNameDay());
        $this->assertEquals(new DateTimeImmutable('2019-01-01'), $contact->getBirthDay());

        $this->assertSame(0, $contact->getSoftBounced());
        $this->assertSame(true, $contact->getHardBounced());
        $this->assertSame(false, $contact->getBlackListed());

        $this->assertEquals(UrlType::from('https://app.smartemailing.cz/api/v3/contact-customfields?contact_id=42'), $contact->getCustomFieldsUrl());
        $this->assertSame('example.com', $contact->getDomain());
        $this->assertSame(false, $contact->getIsConfirmed());
        $this->assertSame(null, $contact->getRealName());
        $this->assertSame('Doe', $contact->getSalutionUserName());
        $this->assertSame('Dear Sir', $contact->getSalutionGender());
        $this->assertSame('Sir', $contact->getSalutionGenderTitle());
        $this->assertSame('123', $contact->getAffilId());
    }

}
