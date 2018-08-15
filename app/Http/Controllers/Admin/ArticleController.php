<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommonSubwebModel;
use App\Models\BrandArticleModel;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = BrandArticleModel::where('subject', 'like', '%'.$request->subject.'%')->latest()->paginate(10);
        return view('admin.article.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        return view('admin.article.create', ['subwebs' => $subwebs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'subject' => 'required|max:50',
            'message' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'subject.required' => '文章名称不允许为空！',
            'subject.max' => '文章名称必须小于 :max 个字符。',
            'message.required' => '文章详情不允许为空！',
        );
        $request->validate($rules, $messages);

        $article = new BrandArticleModel;
        $article->subweb_id = $request->subweb_id;
        $article->subject = $request->subject;
        $article->subjectimage = $request->subjectimage;
        $article->desc = $request->desc;
        $article->message = $request->message;
        $article->jumpurl = $request->jumpurl;
        $article->viewnum = $request->viewnum;
        $article->seo_title = $request->seo_title;
        $article->seo_keywords = $request->seo_keywords;
        $article->seo_description = $request->seo_description;
        $article->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.article.addsucceed'), 'url' => route('admin.article.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.article.addsucceed'), 'url' => route('admin.article.index')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = BrandArticleModel::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subwebs = CommonSubwebModel::orderBy('firstletter', 'asc')->get();
        $article = BrandArticleModel::findOrFail($id);
        return view('admin.article.edit', ['article' => $article, 'subwebs' => $subwebs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = BrandArticleModel::findOrFail($id);
        $rules = array(
            'subweb_id' => 'required|numeric|exists:common_subweb',
            'subject' => 'required|max:50',
            'message' => 'required',
        );
        $messages = array(
            'subweb_id.required' => '所属分站不允许为空！',
            'subweb_id.numeric' => '所属分站选择错误！',
            'subweb_id.exists' => '所属分站不存在！',
            'subject.required' => '文章名称不允许为空！',
            'subject.max' => '文章名称必须小于 :max 个字符。',
            'message.required' => '文章详情不允许为空！',
        );
        $request->validate($rules, $messages);

        $article->subweb_id = $request->subweb_id;
        $article->subject = $request->subject;
        $article->subjectimage = $request->subjectimage;
        $article->desc = $request->desc;
        $article->message = $request->message;
        $article->jumpurl = $request->jumpurl;
        $article->viewnum = $request->viewnum;
        $article->seo_title = $request->seo_title;
        $article->seo_keywords = $request->seo_keywords;
        $article->seo_description = $request->seo_description;
        $article->save();

        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.article.editsucceed'), 'url' => route('admin.article.index')]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.article.editsucceed'), 'url' => route('admin.article.index')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $article = BrandArticleModel::findOrFail($id);
        $article->delete();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.article.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.article.deletesucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

    public function batch(Request $request)
    {
        if($request->operate == 'delsubmit') {
            $rules = array(
                'ids' => 'required',
            );
            $messages = array(
                'ids.required' => '请选择要删除的记录！',
            );
            $this->validate($request, $rules, $messages);
            BrandArticleModel::destroy($request->ids);
            if ($request->ajax()) {
                return response()->json(['status' => '1', 'info' => trans('admin.article.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.article.deletesucceed'), 'url' => back()->getTargetUrl()]);
            }
        }else{
            if ($request->ajax()) {
                return response()->json(['status' => 0, 'info' => trans('admin.undefined.operation'), 'url' => back()->getTargetUrl()]);
            }else{
                return view('layouts.admin.message', ['status' => 0, 'info' => trans('admin.undefined.operation'), 'url' => back()->getTargetUrl()]);
            }
        }
    }

    public function recycle(Request $request)
    {
        $articles = BrandArticleModel::onlyTrashed()->where('subject', 'like', '%'.$request->subject.'%')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.article.recycle', ['articles' => $articles]);
    }

    public function restore(Request $request, $id)
    {
        $article = BrandArticleModel::withTrashed()->findOrFail($id);
        $article->restore();
        if ($request->ajax()){
            return response()->json(['status' => '1', 'info' => trans('admin.article.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return view('layouts.admin.message', ['status' => '1', 'info' => trans('admin.article.restoresucceed'), 'url' => back()->getTargetUrl()]);
        }
    }

}
