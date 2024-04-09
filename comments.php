<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options)
{
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
?>
    <li id="<?php $comments->theId(); ?>">
        <div class="comment-item">
            <img src="<?= getGravatar($comments->mail); ?>" class="gravatar">
            <div class="comment-content">
                <h5>
                    <?php $comments->author(false); ?>
                    <?php $comments->reply(); ?>
                </h5>
                <?php $comments->content(); ?>
                <span class="comment-list-time"><?php $comments->date('Y-m-d H:i'); ?></span>
                <?php if ($comments->children) { ?>
                    <?php $comments->threadedComments($options); ?>
                <?php } ?>
            </div>
        </div>
    </li>
<?php } ?>

<link rel="stylesheet" href="<?php $this->options->themeUrl('static/css/comments.css'); ?>">
<div id="comments" class="mt-3 bg-light shadow rounded">
    <?php $this->comments()->to($comments); ?>
    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <h3 id="response"><?php _e('添加新评论'); ?><?php $comments->cancelReply(); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <textarea rows="8" cols="50" name="text" id="textarea" placeholder="<?php _e('输入评论内容...'); ?>" class="textarea" required><?php $this->remember('text'); ?></textarea>
                <?php if ($this->user->hasLogin()) : ?>
                    <p>
                        <?php _e('登录身份'); ?>: <a class="link-secondary" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a class="link-secondary" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                    </p>
                <?php else : ?>
                    <input type="text" name="author" id="author" class="text" placeholder="<?php _e('称呼(*)'); ?>" value="<?php $this->remember('author'); ?>" required />
                    <input type="email" name="mail" id="mail" class="text" placeholder="<?php _e('邮箱'); ?><?php if ($this->options->commentsRequireMail) : ?>(*)" required <?php else : ?>" <?php endif; ?> value="<?php $this->remember('mail'); ?>" />
                <?php endif; ?>
                <input type="submit" value="<?php _e('发表评论'); ?>" class="btn btn-dark"></input>
            </form>
        </div>
    <?php else : ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
    <?php if ($comments->have()) : ?>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav(); ?>
    <?php endif; ?>
</div>