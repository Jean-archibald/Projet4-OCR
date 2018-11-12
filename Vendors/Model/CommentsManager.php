<?php
namespace Model;

use \MyFram\Manager;
use \Entity\Comment;

abstract class CommentsManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un commentaire
   * @param $comment Le commentaire à ajouter
   * @return void
   */
  abstract protected function add(Comment $comment);
  
  /**
   * Méthode permettant d'enregistrer un commentaire.
   * @param $comment Le commentaire à enregistrer
   * @return void
   */
  abstract protected function save(Comment $comment);
  
/**
   * Méthode permettant de cibler les commentaires d'un chapitre.
   * @param $comments Les commentaires cibles
   * @return void
   */
  abstract public function getListOf($chapterId);

  /**
   * Méthode permettant de cibler les commentaires qui sont dans la poubelle.
   * @param $comment Le commentaire a verifier
   * @return void
   */
  abstract public function getListTrash($commentId);

  /**
    * Method to tell the number of comments in the trash
    * @return int
    */ 
  abstract public function countTrash();


  /**
   * Méthode permettant de modifier un commentaire.
   * @param $comment Le commentaire à modifier
   * @return void
   */
  abstract protected function modify(Comment $comment);

  /**
   * Méthode permettant d'obtenir un commentaire spécifique.
   * @param $id L'identifiant du commentaire
   * @return Comment
   */
  abstract public function get($id);

  /**
   * Méthode permettant de supprimer un commentaire.
   * @param $id L'identifiant du commentaire à supprimer
   * @return void
   */
  abstract public function delete($id);

  /**

   * Méthode permettant de supprimer tous les commentaires liés à une news
   * @param $news L'identifiant de la news dont les commentaires doivent être supprimés
   * @return void
   */
  abstract public function deleteFromChapter($chapterId);
}