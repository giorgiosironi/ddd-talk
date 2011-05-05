<?php
namespace Test;
use Model\Topic,
    Model\Post;

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

}
