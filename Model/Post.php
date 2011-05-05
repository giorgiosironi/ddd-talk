<?php
namespace Model;

/**
 * @Entity
 */
class Post
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Model\Topic", inversedBy="posts")
     */
    private $topic;

    public function internalSetTopic(Topic $topic)
    {
        $this->topic = $topic;
    }
}
