<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create(
        [
            'title' => 'Times',
            'discr' => 'What you doing',
            'text' => 'What you doing, when all people died?',
            'contview' => '2',
            'user_id' => 1
        ]);
        
        Article::create(
        [
            'title' => 'Times',
            'discr' => 'What you doing',
            'text' => 'What you doing, when all people died?',
            'contview' => '2',
            'user_id' => 1
        ]);
        
        Article::create(
        [
            'title' => 'Times',
            'discr' => 'What you doing',
            'text' => 'What you doing, when all people died?',
            'contview' => '2',
            'user_id' => 1
        ]);   
        
        Article::create(
        [
            'title' => 'Fast-food receipt leads to supersized fine for Thornlie man',
            'discr' => "A Thornlie man is probably not lovin McDonald's after his fast-food splurge came back to bite him.",
            'text' => "A Thornlie man is probably not lovin McDonald's after his fast-food splurge came back to bite him. Samuel Michael Gossage was fined $10,000 after a fast food receipt was used to trace him and subsequently charge the 27-year-old with illegal dumping in a national park.",
            'contview' => '2',
            'user_id' => 2
        ]); 
    }
}
