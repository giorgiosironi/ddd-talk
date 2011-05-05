<?php
namespace Test;
use Model\Topic,
    Model\Post,
    Model\Country,
    Model\City;

class AggregateTest extends BaseTestCase
{
    public function testAggregateRootPersistenceIsPropagatedToAllAggregateObjects()
    {
        $topic = new Topic;
        $topic->addPost(new Post);
        $topic->addPost(new Post);
        $this->em->persist($topic);
        $this->em->flush();
        $this->assertEquals(1, $topic->getId());

        $this->em->clear();
        $retrieved = $this->em->find('Model\Topic', 1);
        $this->assertEquals(2, count($retrieved->getPosts()));
    }

    public function testAggregateRootRemovalIsPropagatedToAllAggregateObjects()
    {
        $topic = new Topic;
        $topic->addPost(new Post);
        $topic->addPost(new Post);
        $this->em->persist($topic);
        $this->em->flush();

        $this->em->clear();
        $retrieved = $this->em->find('Model\Topic', 1);
        $this->em->remove($retrieved);
        $this->em->flush();

        $this->em->clear();
        $this->assertTrue($this->em->find('Model\Post', 1) === null, 'Posts are not removed with Topic.');
    }
    
    public function testUnlinkingAnObjectInternalToAnAggregateCausesItsRemoval()
    {
        $topic = new Topic;
        $topic->addPost($post = new Post);
        $this->em->persist($topic);
        $this->em->flush();

        $topic->removePost(0);
        $this->em->flush();

        $this->assertTrue($this->em->find('Model\Post', 1) === null, 'Post is not removed but left orphan.');
    }

    public function testRelationshipsMayAvoidMandatoryForeignKeyByUsingAnAssociativeTable()
    {
        $italy = new Country();
        $italy->addCity(new City("Rome"));
        $italy->addCity(new City("Venice"));

        $this->em->persist($italy);
        $this->em->flush();

        $this->em->clear();
        $italy = $this->em->find('Model\Country', 1);
        $this->assertEquals(2, count($italy->getCities()));
    }
}
