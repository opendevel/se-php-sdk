<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model;

use SmartEmailing\Sdk\ApiV3Client\TestCase;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\Guid;

final class ContactTest extends TestCase
{

    public function testCreateFromArrayMin(): void
    {
        $input = [
            'id' => 5,
            'guid' => '14633550-c429-4ef4-8679-773c224d68ea',
            'emailaddress' => 'john.doe@example.com',
        ];

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

    public function testCreateFromArrayFull(): void
    {
        //@todo
//        $input = [
//            'id' => 5,
//            'guid' => '14633550-c429-4ef4-8679-773c224d68ea',
//            'emailaddress' => 'john.doe@example.com',
//        ];
//
//        $contact = Contact::fromArray($input);
//
//        $this->assertInstanceOf(Contact::class, $contact);
//        $this->assertInstanceOf(Guid::class, $contact->getGuid());
//        $this->assertInstanceOf(Emailaddress::class, $contact->getEmailAddress());
//
//        $this->assertSame($input['id'], $contact->getId());
//        $this->assertSame($input['guid'], $contact->getGuid()->getValue());
//        $this->assertSame($input['emailaddress'], $contact->getEmailAddress()->getValue());
//
//        $this->assertSame(null, $contact->getName());
//        $this->assertSame(null, $contact->getSurname());
//        $this->assertSame(null, $contact->getTitlesBefore());
//        $this->assertSame(null, $contact->getTitlesAfter());
//        $this->assertSame(null, $contact->getSalution());
//        $this->assertSame(null, $contact->getCompany());
//        $this->assertSame(null, $contact->getStreet());
//        $this->assertSame(null, $contact->getTown());
//        $this->assertSame(null, $contact->getPostalCode());
//        $this->assertSame(null, $contact->getCountry());
//        $this->assertSame(null, $contact->getCellPhone());
//        $this->assertSame(null, $contact->getPhone());
//        $this->assertSame(null, $contact->getLanguage());
//        $this->assertSame(null, $contact->getNotes());
//        $this->assertSame(null, $contact->getGender());
//        $this->assertSame(null, $contact->getCreated());
//        $this->assertSame(null, $contact->getUpdated());
//        $this->assertSame(null, $contact->getLastClicked());
//        $this->assertSame(null, $contact->getLastOpened());
//        $this->assertSame(null, $contact->getPreferredDeliveryTime());
//        $this->assertSame(null, $contact->getSoftBounced());
//        $this->assertSame(null, $contact->getHardBounced());
//        $this->assertSame(null, $contact->getBlackListed());
//        $this->assertSame(null, $contact->getNameDay());
//        $this->assertSame(null, $contact->getBirthDay());
//        $this->assertSame(null, $contact->getCustomFieldsUrl());
//        $this->assertSame([], $contact->getContactLists());
    }

}
