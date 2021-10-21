<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class UserRepository
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{
    private User $user;
    private UserLink $userLink;

    public function __construct(User $user, UserLink $userLink)
    {
        $this->user = $user;
        $this->userLink = $userLink;
    }

    /**
     * ユーザー名からユーザー情報を取得する
     *
     * @param string $userName
     * @return User|null
     */
    public function getByUserName(string $userName)
    {
        return $this->user->where('name', $userName)->first();
    }

    /**
     * メールアドレスからユーザー情報を取得する
     *
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * Twitterトークンからユーザー情報を取得する
     *
     * @param string $twitterToken
     * @return User|null
     */
    public function getByTwitterToken(string $twitterToken)
    {
        return $this->user->where('twitter_token', $twitterToken)->first();
    }

    /**
     * 登録する
     *
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        try {
            return $this->user->create($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function update(int $id, array $data): User
    {
        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);

            foreach ($data['links'] ?? [] as $index => $linkData) {
                $data['links'][$index]['sort'] = $index + 1;
            }
            $data = $this->_setStaticLinks($data);

            $user->update($data);

            if (!empty($data['deleted_link_ids'])) {
                $this->userLink
                    ->whereIn('id',
                        !is_array($data['deleted_link_ids']) ?
                            explode(',', $data['deleted_link_ids']) :
                            $data['deleted_link_ids']
                    )
                    ->delete();
            }

            foreach ($data['links'] ?? [] as $linkData) {
                $linkData['user_id'] = $id;
                if (empty($linkData['icon_path'])) {
                    $linkData['icon_path'] = '/img/url.png';
                }
                $targetLink = $this->userLink->find($linkData['id'] ?? null);

                if (!empty($targetLink)) {
                    $targetLink->update($linkData);
                } else {
                    $this->userLink->create($linkData);
                }
            }

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    private function _setStaticLinks($data)
    {
        foreach ($data['links'] ?? [] as $index => $link) {
            if ($link['name'] === 'Twitter') {
                $data['twitter_url'] = $link['url'];
                $data['is_public_twitter_url'] = $link['is_public'];
                $data['sort_twitter_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
            if ($link['name'] === 'Instagram') {
                $data['instagram_url'] = $link['url'];
                $data['is_public_instagram_url'] = $link['is_public'];
                $data['sort_instagram_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
            if ($link['name'] === 'Youtube') {
                $data['youtube_url'] = $link['url'];
                $data['is_public_youtube_url'] = $link['is_public'];
                $data['sort_youtube_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
            if ($link['name'] === 'Blog') {
                $data['blog_url'] = $link['url'];
                $data['is_public_blog_url'] = $link['is_public'];
                $data['sort_blog_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
            if ($link['name'] === 'Facebook') {
                $data['facebook_url'] = $link['url'];
                $data['is_public_facebook_url'] = $link['is_public'];
                $data['sort_facebook_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
            if ($link['name'] === 'Clubhouse') {
                $data['clubhouse_url'] = $link['url'];
                $data['is_public_clubhouse_url'] = $link['is_public'];
                $data['sort_clubhouse_url'] = $link['sort'];
                unset($data['links'][$index]);
            }
        }

        return $data;
    }

    /**
     * 削除する
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy(int $id): void
    {
        DB::beginTransaction();
        try {
            $user = $this->user->findOrFail($id);
            $user->campSchedules()->delete();
            $user->bookmarks()->delete();
            $user->links()->delete();
            $user->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
