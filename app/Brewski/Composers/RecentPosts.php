<?php  namespace Brewski\Composers;

use Brewski\Repositories\PostInterface;
use Config;

class RecentPosts {

   public function __construct(PostInterface $post)
   {
       $this->post = $post;
   }

    public function compose($view)
    {
        $view->with('recent_posts', $this->post->getPublished(5));
    }
}
