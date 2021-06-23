<?php

class Posts extends Controller {

    public function __construct()
    {
        if(!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
    }
    public function index() {
        $data = $this->postModel->getPosts();
        $this->view('posts/index', $data);
    }
    public function show($id) {
        $data = $this->postModel->getPostById($id);
        if($data) {
            $this->view('posts/show', $data);
        }else {
            echo 'database connection errors...';
        }
    }
    public function add() {
        if(isPosted()) {
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => $_POST['title'],
                'comment' => $_POST['comment'],
                'title_err' => '',
                'comment_err' => ''
            ];
            // validatePostData function return the same data with error
            $data = validatePostData($data);
            
            if(empty($data['title_err']) and empty($data['comment_err'])){
                
                // POST DATA INTO THE DATABASE
                $isPosted = $this->postModel->addPost($user_id = $data['user_id'], $title = $data['title'], $comment = $data['comment']);

                if($isPosted) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                }else{
                    echo 'something went wrong insert to the database';
                }
            
            
            }
            else {
                $this->view('posts/add', $data);
            }
        }else {
            $this->view('posts/add');
        }
    }

    public function edit($id) {

        



        if(isPosted()) {
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'comment' => trim($_POST['comment']),
                'title_err' => '',
                'comment_err' => ''
            ];
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = validatePostData($data);
            

            if(empty($data['title_err']) && empty($data['comment_err'])) {
                $updatePost = $this->postModel->updatePost($data['title'], $data['comment'], $id);
                if($updatePost) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                }else {
                    echo "something went wrong into the database";
                }
            }else {
                $this->view('posts/edit', $data);
            }
        }
        else{
            $postData = $this->postModel->getPostById($id);

            if($postData->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $postData->title,
                'comment' => $postData->body,
                'title_err' => '',
                'comment_err' => ''
            ];

            $this->view('posts/edit', $data);
        }
    }


    public function delete($id) {
        if(isPosted()) {
            $postData = $this->postModel->getPostById($id);

            if($postData->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $deletePost = $this->postModel->deletePostById($id);

            if($deletePost) {
                flash('post_message', 'Post removed');
                redirect('posts');
            }else{
                echo 'Something went wrong with the database';
            }
        }
        else {
            echo "You don't have permission to delete this";
        }
    }
}