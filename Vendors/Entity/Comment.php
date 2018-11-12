<?php
namespace Entity;

use \MyFram\Entity;

class Comment extends Entity
{
  protected $chapterId,
            $author,
            $content,
            $trash,
            $dateCreated;

  const INVALID_AUTHOR = 1;
  const INVALID_CONTENT = 2;

  public function isValid()
  {
    return !(empty($this->author) || empty($this->content));
  }


  //SETTERS//

  public function setChapterId($chapterId)
  {
    $this->chapterId = (int) $chapterId;
  }

  public function setAuthor($author)
  {
    if (!is_string($author) || empty($author))
    {
      $this->errors[] = self::INVALID_AUTHOR;
    }

    $this->author = $author;
  }

  public function setContent($content)
  {
    if (!is_string($content) || empty($content))
    {
      $this->errors[] = self::INVALID_CONTENT;
    }

    $this->content = $content;
  }

  public function setTrash($trash)
  {
    return $this->trash = $trash;
  }

  public function setDateCreated(\DateTime $dateCreated)
  {
    $this->dateCreated = $dateCreated;
  }


  //GETTERS//

  public function chapterId()
  {
    return $this->chapterId;
  }

  public function author()
  {
    return $this->author;
  }

  public function content()
  {
    return $this->content;
  }

  public function trash()
  {
    return $this->trash;
  }

  public function dateCreated()
  {
    return $this->dateCreated;
  }
}