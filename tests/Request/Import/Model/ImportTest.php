<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\TestCase;

final class ImportTest extends TestCase
{

    public function testCreateMinimum(): void
    {
        // ARRANGE
        $output = [
            'settings' => [
                'update' => true,
                'add_namedays' => true,
                'add_genders' => true,
                'add_salutions' => true,
                'preserve_unsubscribed' => true,
                'skip_invalid_emails' => false,
                'confirmation_request' => null,
            ],
            'data' => [
            ],
        ];

        $import = new Import();

        // ACT

        // ASSERT
        $this->assertSame($output, $import->toArray());
    }

    public function testCreateFull(): void
    {
        // ARRANGE
        $output = [
            'settings' => [
                'update' => true,
                'add_namedays' => true,
                'add_genders' => true,
                'add_salutions' => true,
                'preserve_unsubscribed' => true,
                'skip_invalid_emails' => false,
                'confirmation_request' => null,
            ],
            'data' => [
            ],
        ];

        $import = new Import(new Settings());

        // ACT

        // ASSERT
        $this->assertSame($output, $import->toArray());
    }

    public function testCreateFromArrayDataFull(): void
    {
        // ARRANGE

        $input = [
            [
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
            ],
        ];

        $output = [
            'settings' => [
                'update' => true,
                'add_namedays' => true,
                'add_genders' => true,
                'add_salutions' => true,
                'preserve_unsubscribed' => true,
                'skip_invalid_emails' => false,
                'confirmation_request' => null,
            ],
            'data' => [
                [
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
                            'valid_from' => null,
                            'valid_to' => null,
                        ],
                        [
                            'id' => 3,
                            'valid_from' => '2018-01-11 10:30:00',
                            'valid_to' => '2023-01-11 10:30:00',
                        ],
                    ],
                ],
            ],
        ];

        $import = Import::fromArray($input);

        // ACT

        // ASSERT
        $this->assertInstanceOf(Import::class, $import);
        $this->assertSame($output, $import->toArray());
    }

    public function testCreateFromArrayDataFullWithSettings(): void
    {
        // ARRANGE

        $input = [
            [
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
            ],
        ];

        $output = [
            'settings' => [
                'update' => true,
                'add_namedays' => true,
                'add_genders' => true,
                'add_salutions' => true,
                'preserve_unsubscribed' => true,
                'skip_invalid_emails' => false,
                'confirmation_request' => null,
            ],
            'data' => [
                [
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
                            'valid_from' => null,
                            'valid_to' => null,
                        ],
                        [
                            'id' => 3,
                            'valid_from' => '2018-01-11 10:30:00',
                            'valid_to' => '2023-01-11 10:30:00',
                        ],
                    ],
                ],
            ],
        ];

        $settings = new Settings();
        $settings->setUpdate(true);
        $settings->setAddNamedays(true);
        $settings->setAddGenders(true);
        $settings->setAddSalutions(true);
        $settings->setPreserveUnsubscribed(true);
        $settings->setSkipInvalidemails(false);

        $import = Import::fromArray($input, $settings);

        // ACT

        // ASSERT
        $this->assertInstanceOf(Import::class, $import);
        $this->assertSame($output, $import->toArray());
    }

    public function testCreateFromArrayException2(): void
    {
        $data = [
            [],
        ];

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        Import::fromArray($data);
    }

    public function testCreateFromArrayException3(): void
    {
        $data = [
            'key' => 'val',
        ];

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        Import::fromArray($data);
    }

    public function testCreateFromArrayException4(): void
    {
        $data = [
            [
                'key' => 'val',
            ],
        ];

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        Import::fromArray($data);
    }

    public function testCreateFromArrayException5(): void
    {
        $data = [
            null,
        ];

        $this->expectException(\SmartEmailing\Types\InvalidTypeException::class);
        Import::fromArray($data);
    }

    public function testAddContact(): void
    {
        // ARRANGE
        $output = [
            'settings' =>
                [
                    'update' => true,
                    'add_namedays' => true,
                    'add_genders' => true,
                    'add_salutions' => true,
                    'preserve_unsubscribed' => true,
                    'skip_invalid_emails' => false,
                    'confirmation_request' => null,
                ],
            'data' =>
                [
                    [
                        'emailaddress' => 'john.doe@example.com',
                        'name' => null,
                        'surname' => null,
                        'titlesbefore' => null,
                        'titlesafter' => null,
                        'salution' => null,
                        'company' => null,
                        'street' => null,
                        'town' => null,
                        'postalcode' => null,
                        'country' => null,
                        'cellphone' => null,
                        'phone' => null,
                        'language' => null,
                        'notes' => null,
                        'gender' => null,
                        'blacklisted' => 0,
                        'nameday' => null,
                        'birthday' => null,
                        'contactlists' => [],
                        'customfields' => [],
                        'purposes' => [],
                    ],
                ],
        ];

        $import = new Import();

        // ACT
        $import->addContact(new Contact('john.doe@example.com'));

        // ASSERT
        $this->assertSame($output, $import->toArray());
    }

    public function testSetSettings(): void
    {
        // ARRANGE
        $import = new Import();
        $settings = new Settings();

        // ACT
        $import->setSettings($settings);

        // ASSERT
        $this->assertInstanceOf(Settings::class, $import->getSettings());
        $this->assertSame($settings, $import->getSettings());
    }

}
