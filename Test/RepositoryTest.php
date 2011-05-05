<?php
namespace Test;
use Model\Topic,
    Model\Post,
    Model\TopicRepository;

class RepositoryTest extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->repository = new TopicRepository($this->em);
    }

    public function testARepositoryShouldStoreANewAggregate()
    {
        $topic = new Topic();
        $topic->addPost(new Post);
        $this->repository->add($topic);
        $this->em->flush();

        $this->em->clear();
        $topic = $this->repository->findById(1);
        $this->assertEquals(1, count($topic->getPosts()));
    }
}
