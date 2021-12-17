<?php

namespace App\Models\QueryBuilders;

use App\Enums\SearchEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserQueryBuilder extends Builder
{
    public function withCountPostsMultiplyAge()
    {
        return $this->select('*')
            ->selectRaw("
                TIMESTAMPDIFF(YEAR, birthday, CURDATE())
                * (SELECT COUNT(*) FROM posts WHERE posts.user_id = users.id)
                AS age_multiply_by_posts_count
            ");
    }
}
