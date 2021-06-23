<?php require APPROOT . '/views/inc/header.php'; ?>

<?php debug($data); ?>
<div class="row">
    <div class="col-md-6">
        <form action="<?= URLROOT ?>/posts/edit/<?= $data['id'] ?>" method="post">
            <div class="form-group">
                <label for="userTitle">Title</label>
                <input type="text" class="form-control <?php echo !empty($data['title_err']) ? 'is-invalid' : '' ?>" name="title" id="userTitle" value="<?= $data['title'] ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="comment">Body</label>
                <textarea class="form-control <?php echo !empty($data['comment_err']) ? 'is-invalid' : '' ?>" name="comment" id="comment" cols="30" rows="10"><?= $data['comment'] ?></textarea>
                <span class="invalid-feedback"><?php echo $data['comment_err']; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>