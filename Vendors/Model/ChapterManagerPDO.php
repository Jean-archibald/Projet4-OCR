<?php
namespace Model;

use \Entity\Chapter;

class ChapterManagerPDO extends ChapterManager
{
    /**
     * @see ChapterManager::add()
     */
    protected function add(Chapter $chapter)
    {
        $request = $this->dao->prepare('INSERT INTO chapters(title, content, publish, trash, dateCreated, dateModified) 
        VALUES(:title, :content, :publish, :trash, NOW(), NOW())');

        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':content', $chapter->content());
        $request->bindValue(':publish', $chapter->publish());
        $request->bindValue(':trash', 'non');
        

        $request->execute();
    }

    /**
     * @see ChapterManager::count()
     */
    public function count()
    {
        return $this->dao->query('SELECT COUNT(*) FROM chapters')->fetchColumn();
    }

     /**
     * @see ChapterManager::countPublish()
     */
    public function countPublish()
    {
        return $this->dao->query('SELECT COUNT(*) FROM chapters WHERE publish=\'oui\'')->fetchColumn();
    }
    

     /**
     * @see ChapterManager::countTrash()
     */
    public function countTrash()
    {
        return $this->dao->query('SELECT COUNT(*) FROM chapters WHERE trash=\'oui\'')->fetchColumn();
    }

    /**
     * @see ChapterManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
    }

    /**
     * @see ChapterManager::getListPublish()
     */
    public function getListPublish($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, content, publish, dateCreated, dateModified 
        FROM chapters
        WHERE publish = \'oui\'
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');
        
        $chaptersList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($chaptersList as $chapter)
        {
            
            $chapter->setDateCreated(new \DateTime($chapter->dateCreated()));
            $chapter->setDateModified(new \DateTime($chapter->dateModified()));
        }

        $request->closeCursor();

        return $chaptersList;
    } 

    /**
     * @see ChapterManager::getLisToModify()
     */
    public function getListToModify($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, content, publish, trash, dateCreated, dateModified 
        FROM chapters
        WHERE trash = \'non\'
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');
        
        $chaptersList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($chaptersList as $chapter)
        {
            
            $chapter->setDateCreated(new \DateTime($chapter->dateCreated()));
            $chapter->setDateModified(new \DateTime($chapter->dateModified()));
        }

        $request->closeCursor();

        return $chaptersList;
    } 

     /**
     * @see ChapterManager::getLisTinTrash()
     */
    public function getListInTrash($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, trash, dateCreated, dateModified 
        FROM chapters
        WHERE trash = \'oui\'
        ORDER BY id DESC';

        //Check if the given param are int
        if ($start != -1 || $limit != -1)
        {
            $sql .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $start;
        }

        $request = $this->dao->query($sql);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');
        
        $chaptersList = $request->fetchAll();
        

        // Use foreach to give instance of DateTime as created date and modified date.
        foreach ($chaptersList as $chapter)
        {
            
            $chapter->setDateCreated(new \DateTime($chapter->dateCreated()));
            $chapter->setDateModified(new \DateTime($chapter->dateModified()));
        }

        $request->closeCursor();

        return $chaptersList;
    } 

    /**
     * @see ChapterManager::getUnique()
     */
    public function getUnique($id)
    {
        $request = $this->dao->prepare('SELECT id, title, content, publish, trash, dateCreated, dateModified 
        FROM chapters WHERE id = :id');
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();

        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

        $chapter = $request->fetch();

        $chapter->setDateCreated(new \DateTime($chapter->dateCreated()));
        $chapter->setDateModified(new \DateTime($chapter->dateModified()));
   
        return $chapter;
    }

    /**
    * @see ChapterManager::save()
    */
    public function save(Chapter $chapter)
    {
        if ($chapter->isValid())
        {
            $chapter->isNew() ? $this->add($chapter) : $this->modify($chapter);
        }
        else
        {
            throw new RuntimeException('Le chapitre doit être valide pour être enregistré');
        }
    }

    /**
    * @see ChapterManager::modify()
    */
    protected function modify(Chapter $chapter)
    {
    $request = $this->dao->prepare('UPDATE chapters 
    SET  title = :title, content = :content, publish = :publish, trash = :trash, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':title', $chapter->title());
    $request->bindValue(':content', $chapter->content());
    $request->bindValue(':publish', $chapter->publish());
    $request->bindValue(':trash', $chapter->trash());
    $request->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);

    $request->execute();
  }
}