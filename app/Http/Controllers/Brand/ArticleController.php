<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeArticleModel;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{
    public function __construct()
    {
        $hot_articles = HomeArticleModel::orderBy('viewnum', 'desc')->get()->take(5);
        view()->share('hot_articles', $hot_articles);
    }

    public function index(){
        $articles = HomeArticleModel::orderBy('created_at', 'desc')->paginate(5);
        return view('home.article.index', ['articles' => $articles]);
    }

    public function detail(Request $request){
        $article = HomeArticleModel::where('article_id', $request->id)->firstOrFail();
        $prev_id = HomeArticleModel::where('article_id', '<', $article->article_id)->max('article_id');
        $prev_article = HomeArticleModel::find($prev_id);
        $next_id = HomeArticleModel::where('article_id', '>', $article->article_id)->min('article_id');
        $next_article = HomeArticleModel::find($next_id);
        //if($article->city){
            //return redirect()->route('subweb.article.detail',[$article->city['domain'],$article->article_id]);
        //}else{
            $article->increment('viewnum');
            return view('home.article.detail', ['article'=>$article, 'prev_article'=>$prev_article, 'next_article'=>$next_article]);
        //}
    }
}
