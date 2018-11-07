<?php
namespace Entity;

use \MyFram\Entity;

class Comment extends Entity
{
  protected $chapter,
            $author,
            $content,
            $dateCreated;

  const INVALID_AUTHOR = 1;
  const INVALID_CONTENT = 2;

  public function isValid()
  {
    return !(empty($this->author) || empty($this->content));
  }

  public function setChapter($chapter)
  {
    $this->chapter = (int) $chapter;
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

  public function setDateCreated(\DateTime $dateCreated)
  {
    $this->dateCreated = $dateCreated;
  }

  public function chapter()
  {
    return $this->chapter;
  }

  public function author()
  {
    return $this->author;
  }

  public function content()
  {
    return $this->content;
  }

  public function dateCreated()
  {
    return $this->dateCreated;
  }
}