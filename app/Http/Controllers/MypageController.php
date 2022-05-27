<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleFormRequest;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Interfaces\Services\ArticleServiceInterface;
use App\Interfaces\Services\CompanyServiceInterface;
use App\Interfaces\Services\DisplayServiceInterface;
use App\Interfaces\Services\EventServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use App\Interfaces\Services\SchoolServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MypageController extends Controller
{
    private $articleService;
    private $companyService;
    private $schoolService;
    private $displayService;
    private $imageService;
    private $eventService;

    public function __construct(
        ArticleServiceInterface $articleService,
        CompanyServiceInterface $companyService,
        SchoolServiceInterface $schoolService,
        DisplayServiceInterface $displayService,
        ImageServiceInterface $imageService,
        EventServiceInterface $eventService
        ) {
        $this->articleService = $articleService;
        $this->companyService = $companyService;
        $this->schoolService = $schoolService;
        $this->displayService = $displayService;
        $this->imageService = $imageService;
        $this->eventService = $eventService;
    }

    public function index(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            return view('mypage.index', compact('user'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのトップでエラーが発生！');
            abort(404);
        }
    }

    public function review(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            //ユーザーに紐づくすべてのreviewを取得
            $allReviews = $this->displayService->getAllReviewsTenEach($user->id);

            return view('mypage.review', compact('allReviews'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのレビュー画面でエラーが発生！');
            abort(404);
        }
    }

    public function event(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            //ユーザーに紐づくすべてのイベントを取得
            $allEvents = $this->eventService->getEvent($user->id, 'user_id', 'updated_at', 20, null);

            return view('mypage.event', compact('user', 'allEvents'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのイベント画面でエラーが発生！');
            abort(404);
        }
    }

    public function editEvent($event){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $event = $this->eventService->getEvent($event);

            return view('mypage.event-edit', compact('user', 'event'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのイベント編集でエラーが発生！');
            abort(404);
        }
    }

    public function confilmEvent(EventFormRequest $request){

        try{
            $image = $request->image;
            $TemporarilyFlg = false;

            if(isset($image) && $image->isValid()){
                $request->validate([
                    'image' => ['image', 'mimes:jpeg,png,jpg'],
                ]);
                //画像の一時保存
                $fileNameToStore = $this->imageService->TemporarilySave($image, 'events');
                $TemporarilyFlg = true;
            }

            $event = $this->eventService->getEvent($request->id);

            //送信されたデータの取得
            $eventInfo = [
                'id' => $request->id,
                'user_id' => $request->user_id,
                'username' => $request->username,
                'gender' => $request->gender,
                'contact_address' => $request->contact_address,
                'contact_email' => $request->contact_email,
                'segment' => $request->segment,
                'online' => $request->online,
                'area' => $request->area,
                'capacity' => $request->capacity,
                'title' => $request->title,
                'contents' => $request->contents,
                'image' => $fileNameToStore ?? $event->image,
                'url' => $request->url,
                'tag' => $request->tag,
            ];

            return view('mypage.event-confilm', compact('eventInfo', 'TemporarilyFlg'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのイベント編集でエラーが発生！');
            abort(404);
        }

    }

    public function registerEvent(EventFormRequest $request){

        try{
            $image = $request->image;
            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                $this->imageService->delete('public/events/tmp/', $image);
                return redirect()->route('mypage.event.edit',['event' => $request->id])->withInput();
            }

            //画像の更新
            $this->imageService->update($image, 'events');

            $event = $this->eventService->getEvent($request->id);
            $event->contact_address = $request->contact_address;
            $event->contact_email = $request->contact_email;
            $event->segment = $request->segment;
            $event->online = $request->online;
            $event->area = $request->area;
            $event->capacity = $request->capacity;
            $event->title = $request->title;
            $event->contents = $request->contents;
            $event->image = $request->image;
            $event->url = $request->url;
            $event->tag = $request->tag;
            $event->save();

            $text = '編集が完了しました！';
            $linkText = 'イベント一覧に戻る';
            $link = 'mypage.event';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのイベント登録でエラーが発生！');
            abort(404);
        }
    }

    public function article(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            //ユーザーに紐づくすべてのイベントを取得
            $allArticles = $this->articleService->getArticle($user->id, 'user_id', 'updated_at', 20, null);

            return view('mypage.article', compact('user', 'allArticles'));
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページの記事画面でエラーが発生！');
            abort(404);
        }
    }

    public function editArticle($article){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            $article = $this->articleService->getArticle($article);

            return view('mypage.article-edit', compact('user', 'article'));
            
        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページの記事編集でエラーが発生！');
            abort(404);
        }
    }

    public function confilmArticle(ArticleFormRequest $request){

        try{
            $image = $request->image;
            $TemporarilyFlg = false;

            if(isset($image) && $image->isValid()){
                $request->validate([
                    'image' => ['image', 'mimes:jpeg,png,jpg'],
                ]);
                //画像の一時保存
                $fileNameToStore = $this->imageService->TemporarilySave($image, 'articles');
                $TemporarilyFlg = true;
            }

            $article = $this->articleService->getArticle($request->id);

            //送信されたデータの取得
            $articleInfo = [
                'id' => $request->id,
                'user_id' => $request->user_id,
                'username' => $request->username,
                'gender' => $request->gender,
                'title' => $request->title,
                'contents' => $request->contents,
                'image' => $fileNameToStore ?? $article->image,
                'url' => $request->url,
                'tag' => $request->tag,
            ];

            return view('mypage.article-confilm', compact('articleInfo', 'TemporarilyFlg'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページの記事確認でエラーが発生！');
            abort(404);
        }

    }

    public function registerArticle(ArticleFormRequest $request){

        try{
            $image = $request->image;
            // 戻るボタンが押された場合に、一時保存画像を消して任意の画面にリダイレクト
            if ($request->back === "true") {
                $this->imageService->delete('public/articles/tmp/', $image);
                return redirect()->route('mypage.article.edit',['article' => $request->id])->withInput();
            }

            //画像の更新
            $this->imageService->update($image, 'articles');

            $article = $this->articleService->getArticle($request->id);
            $article->title = $request->title;
            $article->contents = $request->contents;
            $article->image = $request->image;
            $article->url = $request->url;
            $article->tag = $request->tag;
            $article->save();

            $text = '編集が完了しました！';
            $linkText = '記事一覧に戻る';
            $link = 'mypage.article';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページの記事編集でエラーが発生！');
            abort(404);
        }
    }

    public function profile(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            return view('mypage.profile', compact('user'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのプロフィールでエラーが発生！');
            abort(404);
        }
    }

    public function registProfile(UpdateUserFormRequest $request){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            //同じメールアドレスであるかを確認
            if($user->email !== $request->email){
                abort(404);
            }

            $user->name = $request->name;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
            

            $text = '登録が完了しました！';
            $linkText = 'マイページに戻る';
            $link = 'mypage.index';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのプロフィール編集でエラーが発生！');
            abort(404);
        }
    }

    public function deleteAcount(){

        try{
            $user = $this->displayService->getAuthenticatedUser();

            //アカウントの削除
            $this->displayService->deleteAcount($user->id);

            $text = 'アカウントを削除しました！';
            $linkText = 'TOPに戻る';
            $link = 'top';
            
            return view('redirect', compact('text', 'linkText', 'link'));

        }catch(\Throwable $e){
            \Log::error($e);
            \Slack::channel('error')->send('マイページのアカウント削除でエラーが発生！');
            abort(404);
        }
    }
}
