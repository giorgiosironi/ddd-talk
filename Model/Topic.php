<?php
namespace Model;

/**
 * @Entity
 */
class Topic
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue
     */
    private $id;

    /**
     * @OneToMany(targetEntity="Model\Post", mappedBy="topic", cascade={"persist"})
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function addPost(Post $post)
    {
        $this->posts->add($post);
        $post->internalSetTopic($this);
    }

    public function getPosts()
    {
        return $this->posts;
    }
}
