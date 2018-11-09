<?php
namespace Model;

use \Entity\Chapter;

class ChapterManagerPDO extends ChapterManager
{
    /**
     * @see ChapterManager::add()
     */
    public function add(Chapter $chapter)
    {
        $request = $this->dao->prepare('INSERT INTO chapters(title, content, dateCreated, dateModified) 
        VALUES(:title, :content, NOW(), NOW())');

        $request->bindValue(':title', $chapter->title());
        $request->bindValue(':content', $chapter->content());

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
     * @see ChapterManager::delete()
     */
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM chapters WHERE id = '.(int) $id);
    }

    /**
     * @see ChapterManager::getList()
     */
    public function getList($start = -1, $limit = -1)
    {
        $sql = 'SELECT id, title, content, dateCreated, dateModified 
        FROM chapters 
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
        $request = $this->dao->prepare('SELECT id, title, content, dateCreated, dateModified 
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
   * @see ChapterManager::modify()
   */
  protected function modify(Chapter $chapter)
  {
    $request = $this->dao->prepare('UPDATE chapters 
    SET  title = :title, content = :content, dateModified = NOW()
    WHERE id = :id');
   
    $request->bindValue(':title', $chapter->title());
    $request->bindValue(':content', $chapter->content());
    $request->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);

    $request->execute();
  }
}