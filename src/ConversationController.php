<?php

namespace Khall\Chat;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConversationController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    /**
     * @var ConversationRepository
     */
    private $repository;

    /**
     * ConversationController constructor.
     *
     * @param ConversationRepository $repository
     */
    public function __construct(ConversationRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('web');
        $this->middleware('auth');
    }

    /**
     * Get conversation list.
     *
     * @return Factory|View
     */
    public function index()
    {
        $id = Auth::user()->id;

        return view('vendor.chat.index', [
            'users'  => $this->repository->getConversations($id),
            'unread' => $this->repository->unreadCount($id)
            ]);
    }

    /**
     * show conversation.
     *
     * @param  $id
     *
     * @return Factory|View|Response
     */
    public function show($id)
    {
        $currentUser = Auth::user()->id;
        if ((int) $currentUser === (int) $id) {
            return new Response('Forbidden', 403);
        }
        $user = DB::table('users')->where('id', '=', $id)->get()->first();
        $this->repository->readAll($user->id, $currentUser);

        return view('vendor.chat.show', [
            'users'      => $this->repository->getConversations($currentUser),
            'unread'     => $this->repository->unreadCount($currentUser),
            'messages'   => $this->repository->getMessagesFor($user->id, $currentUser)->paginate(3),
            'target'     => $user
            ]);
    }

    /**
     * Store message.
     *
     * @param  $id
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store($id, Request $request)
    {
        if ((int) $request->user()->id === (int) $id) {
            return new Response('Forbidden', 403);
        }
        $this->validate($request, [
            'content' => 'required|min:4'
            ]);

        $this->repository->createMessage(
            $request->get('content'),
            $request->user()->id,
            $id
        );

        return back()->with('success', 'Message envoyé ! ');
    }
}
