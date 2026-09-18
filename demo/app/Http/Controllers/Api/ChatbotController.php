<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;
use OpenAI;
use OpenAI\Exceptions\RateLimitException;

class ChatbotController extends Controller
{
    public function handleChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $products = Product::select('id', 'name', 'price', 'description')->get()->toArray();

        $systemPrompt = "You are a smart assistant for our store. Answer user questions in English based exclusively on the following product data:\n" 
            . json_encode($products, JSON_UNESCAPED_UNICODE) 
            . "\nIf a user asks about a product that is not listed, politely inform them that it is unavailable.";

        $httpClient = new GuzzleClient([
            'verify' => false,
        ]);

        $client = OpenAI::factory()
            ->withApiKey(env('OPENAI_API_KEY'))
            ->withHttpClient($httpClient)
            ->make();

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $request->message],
                ],
            ]);

            $reply = $response['choices'][0]['message']['content'];

            return response()->json([
                'status' => 'success',
                'reply' => $reply
            ]);

        } catch (RateLimitException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'OpenAI rate limit reached or insufficient quota. Please check your account usage/credits.'
            ], 429);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}