<?php
class Post
{
    private $id;
    private $title;
    private $body;
    private $created_at;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method= 'set'.ucfirst($key);

            if(method_exists($this,$method))
                $this->$method($value);
        }

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $id = (int) $id;
        if($id > 0)
            $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if (is_string($title))
            $this->title = $title;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        if (is_string($body))
            $this->body = $body;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}
