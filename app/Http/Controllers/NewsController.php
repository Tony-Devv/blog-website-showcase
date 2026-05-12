<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.news');
    }

    public function fetchNews(Request $request)
{
    $apiKey = env('NEWS_API_KEY');

    $query = $request->input('query', '');
    $from = $request->input('from');
    $to = $request->input('to');
    $language = $request->input('language');
    $sortBy = $request->input('sortBy', 'publishedAt');

    $allowedSortBy = ["publishedAt", "relevancy", "popularity"];
    if (!in_array($sortBy, $allowedSortBy)) {
        $sortBy = "publishedAt";
    }

    // base params
    $params = [
        'apiKey' => $apiKey,
    ];

    // decide endpoint
    if ($query !== '') {
        $url = "https://newsapi.org/v2/everything";
        $params['q'] = $query;
    } else {
        $url = "https://newsapi.org/v2/top-headlines";
        $params['country'] = 'us';
    }

    // independent optional filters
    if (!empty($from)) {
        $params['from'] = $from;
    }

    if (!empty($to)) {
        $params['to'] = $to;
    }

    if (!empty($language)) {
        $params['language'] = $language;
    }

    if (!empty($query)) {
        $params['sortBy'] = $sortBy;
    }

    $response = Http::get($url, $params);

    return response()->json($response->json());
}
}