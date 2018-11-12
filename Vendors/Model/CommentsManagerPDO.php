<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET chapterId = :chapterId, author = :author, content = :content, trash = :trash, dateCreated = NOW()');
    
    $q->bindValue(':chapterId', $comment->chapterId(), \PDO::PARAM_INT);
    $q->bindValue(':author', $comment->author());
    $q->bindValue(':content', $comment->content());
    $q->bindValue(':trash', 'non');
    
    $q->execute();
    
    $comment->setId($this->dao->lastInsertId());
  }

  public function getListOf($chapterId)
  {
    if (!ctype_digit($chapterId))
    {
      throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    }

    $q = $this->dao->prepare('SELECT id, chapterId, author, content, trash, dateCreated 
    FROM comments 
    WHERE chapterId = :chapterId');

    $q->bindValue(':chapterId', $chapterId, \PDO::PARAM_INT);

    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $comments = $q->fetchAll();

    foreach ($comments as $comment)
    {
      $comment->setDateCreated(new \DateTime($comment->dateCreated()));
    }

    return $comments;
  }

  public function getListTrash($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, chapterId, author, content, trash, dateCreated 
        FROM comments 
        WHERE trash = \'oui\'
        ORDER BY id DESC';
    
        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        
        $commentsList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($commentsList as $comment)
        {
            
            $comment->setDateCreated(new \DateTime($comment->dateCreated()));
        }

        $request->closeCursor();

        return $commentsList;
  } 

  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET author = :author, content = :content, trash = :trash WHERE id = :id');

    $q->bindValue(':author', $comment->author());

    $q->bindValue(':content', $comment->content());

    $q->bindValue(':trash', $comment->trash());

    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }

  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, chapterId, author, content, trash FROM comments WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->execute();
   
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
   
      return $q->fetch();
  }

  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  public function deleteFromChapter($chapterId)
  {
    $this->dao->exec('DELETE FROM comments WHERE chapter = '.(int) $chapterId);
  }

  /**
    * @see CommentManager::save()
    */
    public function save(Comment $comment)
    {
      if ($comment->isValid())
      {
        $comment->isNew() ? $this->add($comment) : $this->modify($comment);
      }
      else
      {
        throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
      }
    }

    /**
     * @see CommentManager::countTrash()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM comments WHERE trash=\'oui\'')->fetchColumn();
    }
}