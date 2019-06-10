<?php
namespace Khall\Chat;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ConversationRepository
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var Message
     */
    private $message;

    /**
     * ConversationRepository constructor.
     * @param User $user
     * @param Message $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }


    /**
     * get conversation for a user
     * @param int $userId
     * @return Builder[]|Collection
     */
    public function getConversations(int $userId)
    {
        return $this->user->newQuery()
            ->select('name', 'id')
            ->where('id', '!=', $userId)->get();
    }

    /**
     * create message
     * @param string $content
     * @param int $from
     * @param int $to
     * @return Builder|Model
     */
    public function createMessage(string $content, int $from, int $to)
    {
        return $this->message->newQuery()->create(
            [
            'content' => $content,
            'from_id' => $from,
            'to_id' => $to,
            'created_at' => Carbon::now()
            ]
        );
    }

    /**
     * get messages for two users
     * @param int $from
     * @param int $to
     * @return Builder
     */
    public function getMessagesFor(int $from, int $to): Builder
    {
        return $this->message->newQuery()
            ->whereRaw("(from_id = $from AND to_id =  $to) OR (from_id = $to AND to_id = $from)")
            ->orderBy('created_at', 'DESC')
            ->with([
                'from' => function ($query) {
                    return $query->select('name', 'id');
                }
                ]);
    }

    /**
     * get the number of messages unread
     *
     * @param  int $userId
     * @return Builder[]|Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function unreadCount(int $userId)
    {
        return $this->message->newQuery()
            ->where('to_id', $userId)
            ->groupBy('from_id')
            ->selectRaw('from_id, COUNT(id) AS count')
            ->whereRaw('read_at IS NULL')
            ->get()
            ->pluck('count', 'from_id');
    }

    /**
     * read all messages
     * @param int $from
     * @param int $to
     */
    public function readAll(int $from, int $to)
    {
        $this->message->where('from_id', $from)->where('to_id', $to)->update(['read_at' => Carbon::now()]);
    }
}
