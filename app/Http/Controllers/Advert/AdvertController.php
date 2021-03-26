<?php

namespace App\Http\Controllers\Advert;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image\AdvertImageController;
use App\Http\Controllers\User\UserController;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Advert\AdvertCreateRequest;
use App\Http\Requests\Advert\AdvertUpdateRequest;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $adverts = Advert::where('status', '=', 'active')->orderByDesc('created_at')->paginate(20);
        $adverts = self::prepareAdverts($adverts);

        return view('main', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('advert.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdvertCreateRequest $request
     *
     * @return RedirectResponse
     */
    public function store(AdvertCreateRequest $request)
    {
        $advert = Advert::create([
            'user_id'     => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'city'        => $request->city,
            'contact'     => $request->contact
        ]);

        $images = AdvertImageController::store($request->image, Auth::id() . '/' . $advert->id);

        $advert->update(['image' => $images]);

        return redirect()->route('advert.show', $advert->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $advert = Advert::find($id);

        if ($advert === null) {

            return redirect()->route('main');

        } else {
            $user = Advert::find($id)->user;

            $this->increaseViewsCounter(Auth::id(), $advert->user_id, $id);

            $images               = AdvertImageController::prepareImages($advert['image']);
            $advert['image']      = $images['links'];
            $advert['imageClass'] = $images['class'];

            $user['rating']       = UserController::getRating($advert->user_id);

            if ($advert->status === 'closed') {
                $warning = 'Advert is closed!';

                return view('advert.show', compact('user', 'advert', 'warning'));
            } else {

                return view('advert.show', compact('user', 'advert'));

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit($id)
    {
        $advert = Advert::find($id);

        if (Auth::id() === $advert->user_id && $advert !== null && $advert->status !== 'closed'){

            return view('advert.edit', compact('advert'));

        } else {

            return redirect()->route('main');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdvertUpdateRequest $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(AdvertUpdateRequest $request, int $id)
    {
        $advert   = Advert::find($id);

        $updateInfo = [];
        foreach ($request->input() as $key => $value) {
            if ($value !== $advert[$key] && !in_array($key, ['_token', '_method'])) {
                $updateInfo = array_merge($updateInfo, [$key => $value]);
            }
        }

        if ($request->image !== null) {
            $images     = AdvertImageController::store($request->image, Auth::id() . '/' . $id);
            $updateInfo = array_merge($updateInfo, ['image' => $images]);
        }

        Advert::where('id', $id)->update($updateInfo);

        return redirect()->route('advert.show', $id);
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
     * Get all user adverts.
     *
     * @param int $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function all(int $id)
    {
        $user = User::find($id);

        if ($user === null) {

            return redirect()->route('main');

        } else {

            $adverts = self::getUserAdverts($id);

            return view('advert.all', compact('user', 'adverts'));
        }
    }

    /**
     * Close advert.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function close(int $id)
    {
        $advert = Advert::find($id);
        if (Auth::id() === $advert->user_id && $advert !== null){

            Advert::where('id', '=', $id)->update(['status' => 'closed']);

        }

        return redirect()->route('advert.show', $id);
    }

    /**
     * Get get user adverts by user id.
     *
     * @param int $id
     * @param int $limit
     *
     * @return array
     */
    public static function getUserAdverts(int $id, int $limit = 0): array
    {
        $limit = ($limit !== 0)
            ? $limit
            : Advert::where('user_id', '=', $id)->count();

        $advert['all'] = [
            'active' => self::prepareAdverts(
                Advert::where('user_id', '=', $id)->where('status', '=', 'active')->orderByDesc('created_at')->limit($limit)->get()
            ),
            'closed' => self::prepareAdverts(
                Advert::where('user_id', '=', $id)->where('status', '=', 'closed')->orderByDesc('created_at')->limit($limit)->get()
            )
        ];

        $advert['count'] = [
            'active' => Advert::where('user_id', '=', $id)->where('status', '=', 'active')->count(),
            'closed' => Advert::where('user_id', '=', $id)->where('status', '=', 'closed')->count()
        ];

        return $advert;
    }

    /**
     * Prepare adverts before displayed.
     *
     * @param $advert
     *
     * @return $advert
     */
    public static function prepareAdverts($advert)
    {
        foreach ($advert as $key => $value) {
            if (strlen($value['title']) > 45) {
                $advert[$key]['title'] = substr($value['title'], 0, 45) . '...';
            }
            $arrayImages = explode('*', $value['image']);
            $advert[$key]['image'] = $arrayImages[0];
        }

        return $advert;
    }

    /**
     * Increasing the view countю
     *
     * @param int $authId
     * @param int $userId
     * @param int $advertId
     *
     * @return void
     */
    public function increaseViewsCounter (int $authId, int $userId, int $advertId): void
    {
        if ($authId !== $userId && Auth::check()){

            Advert::where('id', '=', $advertId)->update(['views' => Advert::raw('views+1')]);

        }
    }
}
