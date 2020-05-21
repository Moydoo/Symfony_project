<?php
/**
 * Contact fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ContactFixtures.
 */
class ContactFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $contact = new Contact();
            $contact->setName($this->faker->word);
            $contact->setSurname($this->faker->word);
            $contact->setAddress($this->faker->address);
            $contact->setPhone($this->faker->phoneNumber);
            $this->manager->persist($contact);
        }

        $manager->flush();
    }
}