<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options)
{
?>
    <li class="d-flex gap-2 p-2">
        <img src="<?= getGravatar($comments->mail); ?>" style="whidth:45px;height:45px;" class="rounded shadow">
        <div id="<?php $comments->theId(); ?>" class="flex-grow-1">
            <div>
                <h5 class="d-flex align-items-center justify-content-between">
                    <?php $comments->author(false); ?>
                    <?php $comments->reply('<button class="btn btn-sm btn-link text-decoration-none text-secondary">' . _t('回复') . '</button>'); ?>
                </h5>
                <div class="bg-light p-2 rounded">
                    <?php $comments->content(); ?>
                </div>
                <div class="text-muted fs-6 text-end"><?php $comments->date('Y-m-d H:i'); ?></div>
            </div>
            <?php if ($comments->children) { ?>
                <?php $comments->threadedComments($options); ?>
            <?php } ?>
        </div>
    </li>
<?php } ?>

<div id="comments" class="mt-3 p-3 bg-light shadow rounded">
    <?php $this->comments()->to($comments); ?>
    <h4 class="d-flex align-items-center"><?php _e('评论'); ?><span class="ms-1 text-secondary fs-6"><?php $this->commentsNum(); ?></span></h4>
    <?php if ($this->allow('comment')) : ?>
        <div id="<?php $this->respondId(); ?>">
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <div class="row">
                    <?php if ($this->user->hasLogin()) : ?>
                        <div class="col mb-2 text-muted text-end">
                            <?php _e('登录身份'); ?>: <a class="link-secondary mx-1" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <a class="link-secondary" href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
                        </div>
                    <?php else : ?>
                        <div class="col-12 col-md-4 mb-2">
                            <input id="author" type="text" name="author" class="form-control" placeholder="<?php _e('称呼(*)'); ?>" value="<?php $this->remember('author'); ?>" required />
                        </div>
                        <div class="col-12 col-md-4 mb-2 px-md-0">
                            <input id="mail" type="email" name="mail" class="form-control" placeholder="<?php _e('邮箱'); ?><?php if ($this->options->commentsRequireMail) : ?>(*)" required <?php else : ?>" <?php endif; ?> value="<?php $this->remember('mail'); ?>" />
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <input id="url" type="url" name="url" class="form-control" placeholder="<?php _e('站点'); ?><?php if ($this->options->commentsRequireUrl) : ?>(*)" required <?php else : ?>" <?php endif; ?> value="<?php $this->remember('url'); ?>" />
                        </div>
                    <?php endif; ?>
                </div>
                <textarea rows="3" name="text" id="textarea" placeholder="<?php _e('我来简单说两句...'); ?>" class="form-control" required><?php $this->remember('text'); ?></textarea>
                <div class="d-flex mt-2 align-items-center">
                    <div id="emoji-box" class="position-relative">
                        <span id="emoji-btn" class="btn btn-light btn-sm border p-1 rounded d-flex align-items-center" style="width: 30px; height: 30px;" aria-label="emoji">
                            <i class="iconfont icon-emoji fs-5 text-secondary"></i>
                        </span>
                        <div id="emoji-list" class="border p-2 m-0 mt-2 rounded row gap-1 row-cols-auto overflow-auto position-absolute top-100 bg-light shadow-sm d-none" style="width: 290px;height: 150px;">
                            <?php $emojis = [
                                '😊', '😃', '😄', '😁', '😆', '😅', '😂', '🤣', '🙂', '🙃',
                                '😉', '😇', '😏', '😌', '😍', '😘', '😗', '😙', '😚', '😋',
                                '😛', '😜', '😝', '😒', '😔', '😖', '😞', '😟', '😠', '😡',
                                '😳', '😨', '😰', '😥', '😢', '😭', '😱', '😲', '😵', '😷',
                                '🤒', '🤕', '🤢', '😴', '🤤', '😪', '😫', '😬', '😮', '🤲',
                                '🤜', '🤛', '🤚', '🤝', '🙏', '🤞', '🤟', '🤘', '🤙', '👌',
                                '👍', '👎', '✊', '👊', '👏', '🙌', '👐', '💪'
                            ];
                            foreach ($emojis as $emoji) : ?>
                                <span class="col p-0 btn btn-light fs-5" data-emoji="<?= $emoji; ?>"><?= $emoji; ?></span>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <?php $comments->cancelReply('<span class="btn btn-light rounded-pill btn-sm">取消</span>'); ?>
                    </div>
                    <input type="submit" value="<?php _e('确定'); ?>" class="btn btn-dark rounded-pill btn-sm ms-1"></input>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <?php if ($comments->have()) : ?>
        <?php $comments->listComments([
            'before'    => '<ol class="list-unstyled bg-white rounded-3 mt-3">',
        ]); ?>
        <?php $comments->pageNav(); ?>
        <script>
            const emojiBox = document.querySelector('#emoji-box');
            const emojiBtn = document.querySelector('#emoji-btn');
            const emojiList = document.querySelector('#emoji-list');
            const textarea = document.querySelector('#textarea');
            window.addEventListener('click', function(e) {
                if (emojiBtn.contains(e.target)) {
                    emojiList.classList.toggle('d-none');
                }

                if (!emojiBox.contains(e.target)) {
                    emojiList.classList.add('d-none');
                }

                if (emojiList.contains(e.target)) {
                    const emoji = e.target.dataset.emoji;
                    if (emoji) {
                        textarea.value += emoji;
                    }
                }
            });
        </script>
    <?php else : ?>
        <p class="mt-3 mb-0 text-muted text-center fs-6"><?php _e('暂时没有评论'); ?></p>
    <?php endif; ?>
</div>