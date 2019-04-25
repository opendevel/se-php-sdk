<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use DateTimeImmutable;
use SmartEmailing\Sdk\Status\ContactListStatus;
use SmartEmailing\Sdk\Status\GenderStatus;
use SmartEmailing\Sdk\TestCase;

final class ContactTest extends TestCase
{

    public function testCreateMinimum(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
        ];

        $contact = new Contact('john.doe@example.com');

        // ACT

        // ASSERT
        $this->assertSame($output, $contact->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
            'name' => 'John',
            'surname' => 'Doe',
            'titlesbefore' => 'Mr.',
            'titlesafter' => 'PhD',
            'salution' => 'John Doe',
            'company' => 'ACME',
            'street' => 'Place Saint-Gervais 4',
            'town' => 'Paris',
            'postalcode' => '75004',
            'country' => 'France',
            'cellphone' => '+33 123 456 789',
            'phone' => '+33 987 654 321',
            'language' => 'cz_CZ',
            'notes' => 'Lorem ipsum',
            'gender' => 'M',
            'blacklisted' => 0,
            'nameday' => '2020-12-31 00:00:00',
            'birthday' => '2020-12-31 00:00:00',
        ];

        $contact = new Contact('john.doe@example.com');
        $contact->setName('John');
        $contact->setSurname('Doe');
        $contact->setTitlesBefore('Mr.');
        $contact->setTitlesAfter('PhD');
        $contact->setSalutation('John Doe');
        $contact->setCompany('ACME');
        $contact->setStreet('Place Saint-Gervais 4');
        $contact->setTown('Paris');
        $contact->setPostalCode('75004');
        $contact->setCountry('France');
        $contact->setCellPhone('+33 123 456 789');
        $contact->setPhone('+33 987 654 321');
        $contact->setLanguage('cz_CZ');
        $contact->setNotes('Lorem ipsum');
        $contact->setGender(GenderStatus::from('M'));
        $contact->setBlackListed(false);
        $contact->setNameday(new DateTimeImmutable('2020-12-31 00:00:00'));
        $contact->setBirthday(new DateTimeImmutable('2020-12-31 00:00:00'));

        // ACT

        // ASSERT
        $this->assertSame($output, $contact->toArray());
    }

    public function testCreateFromArrayMinimum(): void
    {
        // ARRANGE
        $input = [
            'emailaddress' => 'john.doe@example.com',
        ];

        $output = [
            'emailaddress' => 'john.doe@example.com',
        ];

        $contact = Contact::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertSame($output, $contact->toArray());
    }

    public function testCreateFromArrayFull(): void
    {
        // ARRANGE
        $input = [
            'emailaddress' => 'john.doe@example.com',
            'name' => 'John',
            'surname' => 'Doe',
            'titlesBefore' => 'Mr.',
            'titlesAfter' => 'PhD',
            'salutation' => 'John Doe',
            'company' => 'ACME',
            'street' => 'Place Saint-Gervais 4',
            'town' => 'Paris',
            'postalCode' => '75004',
            'country' => 'France',
            'cellPhone' => '+33 123 456 789',
            'phone' => '+33 987 654 321',
            'language' => 'cz_CZ',
            'notes' => 'Lorem ipsum',
            'gender' => 'M',
            'blackListed' => false,
            'nameday' => '2020-12-31 00:00:00',
            'birthday' => '2020-12-31 00:00:00',
            'contactlists' => [
                [
                    'id' => 1,
                    'status' => 'confirmed',
                ],
            ],
            'customfields' => [
                [
                    'id' => 1,
                    'options' => [
                        1,
                        3,
                    ],
                ],
                [
                    'id' => 8,
                    'value' => '2016-01-10 13:53:03',
                ],
            ],
            'purposes' => [
                [
                    'id' => 2,
                ],
                [
                    'id' => 3,
                    'valid_from' => '2018-01-11 10:30:00',
                    'valid_to' => '2023-01-11 10:30:00',
                ],
            ],
        ];

        $output = [
            'emailaddress' => 'john.doe@example.com',
            'name' => 'John',
            'surname' => 'Doe',
            'titlesbefore' => 'Mr.',
            'titlesafter' => 'PhD',
            'salution' => 'John Doe',
            'company' => 'ACME',
            'street' => 'Place Saint-Gervais 4',
            'town' => 'Paris',
            'postalcode' => '75004',
            'country' => 'France',
            'cellphone' => '+33 123 456 789',
            'phone' => '+33 987 654 321',
            'language' => 'cz_CZ',
            'notes' => 'Lorem ipsum',
            'gender' => 'M',
            'blacklisted' => 0,
            'nameday' => '2020-12-31 00:00:00',
            'birthday' => '2020-12-31 00:00:00',
            'contactlists' => [
                [
                    'id' => 1,
                    'status' => 'confirmed',
                ],
            ],
            'customfields' => [
                [
                    'id' => 1,
                    'options' => [
                        1,
                        3,
                    ],
                ],
                [
                    'id' => 8,
                    'value' => '2016-01-10 13:53:03',
                ],
            ],
            'purposes' => [
                [
                    'id' => 2,
                ],
                [
                    'id' => 3,
                    'valid_from' => '2018-01-11 10:30:00',
                    'valid_to' => '2023-01-11 10:30:00',
                ],
            ],
        ];

        $contact = Contact::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertSame($output, $contact->toArray());
    }

    public function testAddContactList(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
            'contactlists' => [
                [
                    'id' => 1,
                    'status' => 'confirmed',
                ],
            ],
        ];

        $contact = new Contact('john.doe@example.com');

        // ACT
        $contact->addContactList(new ContactContactlist(1, ContactListStatus::from('confirmed')));

        // ASSERT
        $this->assertSame($output, $contact->toArray());
    }

    public function testAddCustomField(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
            'customfields' => [
                [
                    'id' => 1,
                ],
            ],
        ];

        $contact = new Contact('john.doe@example.com');

        // ACT
        $contact->addCustomField(new ContactCustomField(1));

        // ASSERT
        $this->assertSame($output, $contact->toArray());
    }

    public function testAddPurpose(): void
    {
        // ARRANGE
        $output = [
            'emailaddress' => 'john.doe@example.com',
            'purposes' => [
                [
                    'id' => 1,
                ],
            ],
        ];

        $contact = new Contact('john.doe@example.com');

        // ACT
        $contact->addPurpose(new ContactPurpose(1));

        // ASSERT
        $this->assertSame($output, $contact->toArray());
    }

}
