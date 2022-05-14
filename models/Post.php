<?php
class Post
{
    private $_id;
    private $_title;
    private $_body;
    private $_created_at;

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
            $this->_id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if (is_string($title))
            $this->_title = $title;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        if (is_string($body))
            $this->_body = $body;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->_title;
    }
}
