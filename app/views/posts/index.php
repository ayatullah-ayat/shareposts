<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6">
      <h1>Posts</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add Post
      </a>
    </div>
  </div>
  <p><?= flash('post_message') ?></p>
  <?foreach($data as $post) :?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $post->title; ?></h4>
      <div class="bg-light p-2 mb-3">
        Written by <?php echo $post->name; ?> on <?php echo $post->postCreated; ?>
      </div>
      <p class="card-text"><?php echo $post->body; ?></p>
      <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-dark">More</a>
    </div>
    <? endforeach ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>