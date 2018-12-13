<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{

  /**
  * @see CommentManager::add()
  */
  protected function add(Comment $comment)
  {
    $q = $this->dao->prepare('INSERT INTO comments SET chapterId = :chapterId, author = :author, content = :content, trash = :trash, comment_signal = :comment_signal, dateCreated = NOW()');
    
    $q->bindValue(':chapterId', $comment->chapterId(), \PDO::PARAM_INT);
    $q->bindValue(':author', $comment->author());
    $q->bindValue(':content', $comment->content());
    $q->bindValue(':trash', 'non');
    $q->bindValue(':comment_signal', 'non');
    
    $q->execute();
    
    $comment->setId($this->dao->lastInsertId());
  }

  /**
  * @see CommentManager::getCommentsOfUniqueChapter()
  */
  public function getCommentsOfUniqueChapter($chapterId)
  {
    if (!ctype_digit($chapterId))
    {
      throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    }
    $q = $this->dao->prepare('SELECT id, chapterId, author, content, trash, comment_signal, dateCreated 
    FROM comments 
    WHERE trash = \'non\' AND comment_signal = \'non\' AND chapterId = :chapterId');
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
  

  /**
  * @see CommentManager::getListTrash()
  */
  public function getListTrash($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, chapterId, author, content, trash, comment_signal, dateCreated 
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

  /**
  * @see CommentManager::getListSignal()
  */
  public function getListSignal($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, chapterId, author, content, trash, comment_signal, dateCreated 
    FROM comments 
    WHERE comment_signal = \'oui\' AND trash = \'non\'
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


  /**
  * @see CommentManager::getListComments()
  */
  public function getListComments($start = -1, $limit = -1)
  {
    $sql = 'SELECT id, chapterId, author, content, trash, comment_signal, dateCreated 
    FROM comments 
    WHERE comment_signal = \'non\'
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


  /**
  * @see CommentManager::modify()
  */
  protected function modify(Comment $comment)
  {
    $q = $this->dao->prepare('UPDATE comments SET author = :author, content = :content, trash = :trash , comment_signal = :comment_signal WHERE id = :id');

    $q->bindValue(':author', $comment->author());

    $q->bindValue(':content', $comment->content());

    $q->bindValue(':trash', $comment->trash());

    $q->bindValue(':comment_signal', $comment->comment_signal());

    $q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
 
    $q->execute();
  }

  /**
  * @see CommentManager::get()
  */
  public function get($id)
  {
    $q = $this->dao->prepare('SELECT id, chapterId, author, content, trash, comment_signal FROM comments WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->execute();
   
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
   
      return $q->fetch();
  }


  /**
  * @see CommentManager::delete()
  */
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  /**
  * @see CommentManager::deleteFromChapter()
  */
  public function deleteFromChapter($chapterId)
  {
    $this->dao->exec('DELETE FROM comments WHERE chapterId = '.(int) $chapterId);
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

  /**
   * @see CommentManager::countSignalAndUntrash()
   */
  public function countSignalAndUntrash()
  {
      return $this->dao->query('SELECT COUNT(*) FROM comments WHERE comment_signal=\'oui\' AND trash=\'non\'')->fetchColumn();
  }

  public function countCommentChapter($chapterId)
  {
    return $this->dao->query('SELECT COUNT(*) FROM comments WHERE trash =\'non\' AND chapterId = '.(int) $chapterId)->fetchColumn();
  }

    /**
   * @see CommentManager::count()
   */
  public function count()
  {
      return $this->dao->query('SELECT COUNT(*) FROM comments WHERE comment_signal =\'non\'')->fetchColumn();
  }


  /**
  * @see CommentManager::comment_signal()
  */
  public function comment_signal($id)
  {
    $q = $this->dao->prepare('UPDATE comments SET comment_signal = :comment_signal  WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->bindValue(':comment_signal', 'oui');

    $q->execute();

  }

  /**
  * @see CommentManager::comment_unsignal()
  */
  public function comment_unsignal($id)
  {
    $q = $this->dao->prepare('UPDATE comments SET comment_signal = :comment_signal  WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->bindValue(':comment_signal', 'non');

    $q->execute();

  }

  /**
  * @see CommentManager::comment_trash($id)
  */
  public function comment_trash($id)
  {
    $q = $this->dao->prepare('UPDATE comments SET trash = :trash  WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->bindValue(':trash', 'oui');

    $q->execute();

  }

  /**
  * @see CommentManager::comment_untrash($id)
  */
  public function comment_untrash($id)
  {
    $q = $this->dao->prepare('UPDATE comments SET trash = :trash  WHERE id = :id');

    $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);

    $q->bindValue(':trash', 'non');

    $q->execute();
  }
}

