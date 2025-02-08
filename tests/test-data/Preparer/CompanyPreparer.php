<?php

declare(strict_types=1);

namespace Struct\TestData\Preparer;

use DateTime;
use DateTimeZone;
use Struct\DataType\Date;
use Struct\Struct\Factory\StructFactory;
use Struct\TestData\Fixtures\Struct\Address;
use Struct\TestData\Fixtures\Struct\Company;
use Struct\TestData\Fixtures\Struct\Contact;
use Struct\TestData\Fixtures\Struct\Enum\Category;
use Struct\TestData\Fixtures\Struct\Person;
use Struct\TestData\Fixtures\Struct\Reference;
use Struct\TestData\Fixtures\Struct\Role;
use Struct\TestData\Fixtures\Struct\Tag;
use Struct\TestData\Fixtures\Struct\Technology;

class CompanyPreparer
{
    public function buildCompany(): Company
    {
        $company = StructFactory::create(Company::class);
        $company->name = 'Musterfirma';
        $company->foundingDate = new DateTime('2000-02-05 14:35:12', new DateTimeZone('Europe/Berlin'));

        $address = new Address();
        $address->street = 'Musterstraße';
        $address->houseNumber = '99';
        $address->zip = '99999';
        $address->city = 'Musterdorf';

        $company->address = $address;

        $company->isActive = true;
        $company->category = Category::Technology;

        $company->refactorDate = new Date(2024, 05, 03);

        $company->properties = [
            'turnover' => '20m',
            'employees' => '100',
            'foundingYear' => '2000'
        ];

        $company->tags = [
            'industry',
            'middle size',
            new Tag('one man'),
        ];

        $tag1 = new Tag('industry');
        $tag2 = new Tag('middle size');
        $company->tagCollection[] = $tag1;
        $company->tagCollection[] = $tag2;

        $person01 = new Person();
        $person01->title = 'Geschäftsführer';
        $person01->firstName = 'Max';
        $person01->middleName = 'Maier';
        $person01->lastName = 'Mustermann';

        $person02 = new Person();
        $person02->title = 'Developer';
        $person02->firstName = 'Kai';
        $person02->lastName = 'Kaul';

        $company->persons = [
            $person01,
            $person02
        ];

        $contact = new Contact(
            'phone',
            '+499999999'
        );

        $person02->contacts = [
            $contact
        ];

        $role01 = new Role();
        $role02 = new Role();
        $role03 = new Role();

        $role01->name = 'blue';
        $role02->name = 'green';
        $role03->name = 'white';

        $company->roles = [
            'first' => $role01,
            'second' => $role02,
            'third' => $role03
        ];

        $company->roleCollection[] = $role01;
        $company->roleCollection[] = $role02;

        $company->latitude = 48.25652;
        $company->longitude = 8.0;

        $technology = new Technology(
            'One CMS',
            'Germany'
        );

        $reference01 = new Reference();
        $reference01->title = 'Website Blue GmbH';
        $reference01->technologies = [
            $technology,
        ];

        $reference02 = new Reference();
        $reference02->title = 'Website Green GmbH';
        $reference02->technologies = null;

        $company->references = [
            $reference01,
            $reference02
        ];

        $company->arrayKeyMixed = [
            'extras' => [
                'configurationNamespace' => 'my/namespace'
            ],
        ];

        $company->arrayListMixed = [
            'green',
            2,
            [
                'PHP' => 'is cool',
            ],
        ];

        return $company;
    }
}
