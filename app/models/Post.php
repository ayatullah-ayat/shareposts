<?php

class Post {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPosts() {
        $this->db->query('SELECT *, posts.id as postId, posts.created_at as postCreated FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');
        return $this->db->resultSet();
    }
    public function getPostById($postId) {
        $this->db->query('SELECT *, posts.id as postId, posts.created_at as postCreated FROM posts INNER JOIN users ON posts.id = :post_id AND posts.user_id = users.id');

        $this->db->bind(':post_id', $postId);
        return $this->db->single();
    }

    public function addPost($user_id, $title, $comment) {
        $this->db->query('INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':title', $title);
        $this->db->bind(':body', $comment);

        if($this->db->execute()) {
            return true;
        }
        return false;
    }
    public function updatePost($title, $comment, $id) {
        $this->db->query('UPDATE posts SET title = :title, body = :comment WHERE id = :id');
        $this->db->bind(':title', $title);
        $this->db->bind(':comment', $comment);
        $this->db->bind(':id', $id);

        if($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function deletePostById($id) {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()) {
            return true;
        }
        return false;
    }
}