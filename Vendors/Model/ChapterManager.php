<?php
namespace Model;

use \MyFram\Manager;
use \Entity\Chapter;

abstract class ChapterManager extends Manager
{
    /**
     * Method to add a chapter.
     * @param $chapter Chapter The chapter to add
     * @return void
     */
    abstract protected function add(Chapter $chapter);

    /**
    * Method to tell the total number of chapter
    * @return int
    */
    abstract public function count();

    /**
    * Method to tell the number of chapter to publish
    * @return int
    */
    abstract public function countPublish();

    /**
    * Method to tell the number of chapter in the trash
    * @return int
    */
    abstract public function countTrash();

    /**
     * Method to delete a chapter
     * @param $id int Identification of the chapter to delete
     * @return void
     */
    abstract public function delete($id);

    /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getListPublish($start ,$limit );

     /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getListToModify($start = -1,$limit = -1);

    /**
     * Method return a list of asked chapters
     * @param $start int The first chapter to select
     * @param $limit int The number of chapter to select
     * @return array The list of the chapters, Each entrance is an instance of Chapter.
     */
    abstract public function getListInTrash($start = -1,$limit = -1);


    /**
     * Metho return a specific chapter
     * @param $id int Identification of the chapter to get
     * @return Chapter the chapter asked
     */
    abstract public function getUnique($id);

    /**
     * Method to save a Chapter
     * @param $chapter Chapter The chapter to save
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    abstract protected function save(Chapter $chapter);
    
    

    /**
     * Method to modify a chapter
     * @param $chapter chapter the chapter to modify
     * @return void
     */
    abstract protected function modify(Chapter $chapter);


}