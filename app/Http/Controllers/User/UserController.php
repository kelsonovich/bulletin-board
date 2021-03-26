<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Advert\AdvertController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Image\UserImageController;
use App\Models\User;
use App\Models\UserReview;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect()->route('main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        return redirect()->route('main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        return redirect()->route('main');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(int $id)
    {
        $user = User::find($id);

        if ($user === null) {

            return route('main');

        } else {

            $user['rating'] = $this->getRating($user['id']);

            $user['from'] = self::getLocation($user['city'], $user['country']);

            $reviews = UserReviewController::getReview($id, 5);
            $adverts = AdvertController::getUserAdverts($id, 4);

            return view('user.show', compact('user', 'reviews', 'adverts'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(int $id)
    {
        return ($id === Auth::id())
            ? view('user.edit', ['user' => User::find(Auth::id())])
            : redirect()->route('main');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $oldUserInfo = User::find($id);

        $updateInfo = [];
        foreach ($request->input() as $key => $value) {
            if ($value !== $oldUserInfo[$key] && !in_array($key, ['_token', '_method'])) {
                $updateInfo = array_merge($updateInfo, [$key => $value]);
            }
        }

        if ($request->hasFile('photo')) {
            $image      = UserImageController::store($request->photo, $oldUserInfo['photo']);
            $updateInfo = array_merge($updateInfo, ['photo' => $image]);
        }

        User::where('id', Auth::id())->update($updateInfo);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        return redirect()->route('main');
    }

    /**
     * Get user rating.
     *
     * @param  int  $id
     *
     * @return array
     */
    public static function getRating(int $id): array
    {
        $countReviews = UserReview::where('to_user', '=', $id)->count();
        if ($countReviews === 0){
            $result = [
                'index' => 0,
                'count' => 0,
            ];
        } else {
            $result = [
                'index' => round(UserReview::where('to_user', '=', $id)->sum('rating') / $countReviews, 2),
                'count' => $countReviews,
            ];
        }

        return $result;
    }

    /**
     * Get user location.
     *
     * @param  string|null $city
     * @param  string|null $country
     *
     * @return string
     */
    public static function getLocation(string|null $city, string|null $country): string
    {
        if ($city === null && $country === null) {

            $result = 'Country and city not specified';

        } elseif ($city === null || $country === null) {

            $result = ($city === null) ? $country : $city;

        } else {

            $result = $country . ', ' . $city;

        }

        return $result;
    }
}
