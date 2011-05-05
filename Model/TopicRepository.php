<?php
namespace Model;
use Doctrine\ORM\EntityManager;

class TopicRepository
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function add(Topic $topic)
    {
        $this->em->persist($topic);
    }

    public function findById($id)
    {
        return $this->em->find('Model\Topic', $id);
    }
}
