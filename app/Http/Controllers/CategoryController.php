<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * カテゴリ検索用
     */
    public function search(Request $request){
        $query = Category::query();
        $keyword = '';

        if ($request->filled('keyword')) {
            $arrayWord = mb_convert_kana($request->input('keyword'), 's');
            $words = explode(' ', $arrayWord);

            foreach($words as $word){
                $query->where('category_name', 'like', '%'.$word.'%');
            }

        }
            $categories = $query->orderby('number')->paginate(20);
        
        return view('category.search', ['categories' => $categories, 'keyword' => $keyword ]);
    }
}
