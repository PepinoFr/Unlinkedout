<?php
class Post
{
    private $id;
    private $title;
    private $body;
    private $created_at;
    private $updated_at;
    private $author;
    private $header;

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
    public function setCreated_at($created_at)
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
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdated_at($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
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
    public function getCreated_at()
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

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header): void
    {
        $this->header = $header;
    }

}
