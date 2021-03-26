<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserReviewRequest;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserReviewController extends Controller
{
    /**
     * Get user reviews.
     *
     * @param int $id
     * @param int $limit
     *
     * @return
     */
    public static function getReview(int $id, int $limit = 0)
    {
        $limit = ($limit !== 0)
            ? $limit
            : UserReview::where('to_user', $id)->count();

        $data = UserReview::where('to_user', '=', $id)->orderByDesc('created_at')->limit($limit)->get();

        foreach ($data as $key => $value){

            $data[$key]['user'] = User::select('id', 'name', 'surname')
                ->where('id', $data[$key]['from_user'])
                ->first();

        }

        return $data;
    }

    /**
     * Store review.
     *
     * @param UserReviewRequest $request
     * @param int $to
     * @param int $from
     *
     * @return RedirectResponse
     */
    public function store(UserReviewRequest $request, int $to, int $from)
    {
        if ($to === $from) {

            $return = ['warning' => 'You can not leave reviews to yourself!'];

        } else {

            if (UserReview::where('from_user', $from)->count() >= 1) {

                $return = ['warning' => 'You can not leave more than one review!'];

            } else {

                $review = UserReview::create([
                    'from_user' => $from,
                    'to_user'   => $to,
                    'rating'    => $request->rating,
                    'message'   => $request->message
                ]);

                $return = ['success' => 'Review successfully added!'];
            }

        }

        return redirect()->back()->with($return);
    }

    /**
     * Get all user reviews.
     *
     * @param int $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function getAllReviews(int $id)
    {
        if (User::find($id) === null) {

            return redirect()->route('main');

        } else {

            $user    = User::select('id', 'name', 'surname')->where('id', '=', $id)->first();
            $reviews = self::getReview($id);

            return view('user.review.all', compact('user', 'reviews'));
        }
    }

}
