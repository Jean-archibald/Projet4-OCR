<?php
namespace Model;

use \MyFram\Manager;
use \Entity\Comment;

abstract class CommentsManager extends Manager
{
  /**
   * Méthod to add a comment
   * @param $comment The comment to add
   * @return void
   */
  abstract protected function add(Comment $comment);

  /**
   * Méthod to target the comments of a Unique Chapter
   * @param $comments The target comments
   * @return void
   */
  abstract public function getCommentsOfUniqueChapter($chapterId);

  /**
   * Méthod to target comments in trash
   * @param $comment The comments in trash
   * @return void
   */
  abstract public function getListTrash($commentId);

  /**
   * Méthod to target signaled comments 
   * @param $comment The signaled comments
   * @return void
   */
  abstract public function getListSignal($commentId);


  /**
   * Méthod to target all comments
   * @param $comment the comments
   * @return void
   */
  abstract public function getListComments($commentId);

  /**
   * Méthod to modify a comment
   * @param $comment the comment to modify
   * @return void
   */
  abstract protected function modify(Comment $comment);


  /**
   * Méthod to get a unique comment
   * @param $id The id of the comment
   * @return Comment
   */
  abstract public function get($id);

   /**
   * Method to delete a comment 
   * @param $id the comment id
   * @return void
   */
  abstract public function delete($id);

   /**
   * Méthod to delete all the comments of a chapter
   * @param $news The id of the chapter
   * @return void
   */
  abstract public function deleteFromChapter($chapterId);
  
  /**
   * Méthod to save a comment
   * @param $comment the comment to save
   * @return void
   */
  abstract protected function save(Comment $comment);
  

  /**
    * Method to tell the number of comments in the trash
    * @return int
    */ 
  abstract public function countTrash();


  /**
    * Method to tell the number of comments Signaled but not in trash
    * @return int
    */ 
    abstract public function countSignalAndUntrash();

  /**
    * Method to tell the number of comments in a chapter
    * @return int
    */ 
    abstract public function countCommentChapter($chapterId);

  /**
    * Method to tell the total number of commentaires
    * @return int
    */
    abstract public function count();

  
  /**
   * Méthod to target one signaled Comment and unsignal it
   * @param $id the comment id
   * @return Comment
   */
  abstract public function comment_signal($id);


  /**
   * Méthod to target one signaled Comment and unsignal it
   * @param $id the comment id
   * @return Comment
   */
  abstract public function comment_unsignal($id);

  /**
   * Method to target a comment and put it in trash
   * @param $id the comment id
   * @return Comment
   */
  abstract public function comment_trash($id);

 
  /**
   * Method to target a comment and take it out of trash
   * @param $id the comment id
   * @return Comment
   */
  abstract public function comment_untrash($id);
   

  
}