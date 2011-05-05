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

}
