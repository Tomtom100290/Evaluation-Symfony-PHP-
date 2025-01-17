<?php

namespace App\Tests\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EvenementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $evenementRepository;
    private string $path = '/evenement/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->evenementRepository = $this->manager->getRepository(Evenement::class);

        foreach ($this->evenementRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evenement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'evenement[NomEvent]' => 'Testing',
            'evenement[NbPartMax]' => 'Testing',
            'evenement[Organisateur]' => 'Testing',
            'evenement[Participants]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->evenementRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setNomEvent('My Title');
        $fixture->setNbPartMax('My Title');
        $fixture->setOrganisateur('My Title');
        $fixture->setParticipants('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evenement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setNomEvent('Value');
        $fixture->setNbPartMax('Value');
        $fixture->setOrganisateur('Value');
        $fixture->setParticipants('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'evenement[NomEvent]' => 'Something New',
            'evenement[NbPartMax]' => 'Something New',
            'evenement[Organisateur]' => 'Something New',
            'evenement[Participants]' => 'Something New',
        ]);

        self::assertResponseRedirects('/evenement/');

        $fixture = $this->evenementRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNomEvent());
        self::assertSame('Something New', $fixture[0]->getNbPartMax());
        self::assertSame('Something New', $fixture[0]->getOrganisateur());
        self::assertSame('Something New', $fixture[0]->getParticipants());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setNomEvent('Value');
        $fixture->setNbPartMax('Value');
        $fixture->setOrganisateur('Value');
        $fixture->setParticipants('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/evenement/');
        self::assertSame(0, $this->evenementRepository->count([]));
    }
}
