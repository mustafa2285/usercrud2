<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Article;
use Illuminate\Pagination\Paginator;
use Auth;

class UserArticle extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $title_search;

    public $article_id;
    public $title;
    public $article;
    public $image;



    public $rules = [
        'title' => 'required|min:1',
        'article' => 'required|min:200',
        'image' => 'image|nullable|mimes:jpg,jpeg,png',
        ];

        
    public function render()
    {

        $articles = Article::whereUser_id(Auth::user()->id)->paginate(5);	
        return view('livewire.user.user-article', compact('articles'));
    }
    
     public function newArticle(){
         $this->validate();       

        $new = new Article();
        $new->user_id = Auth::user()->id;
        $new->title = $this->title;
        $new->article = $this->article;

        if (!empty($this->image)){
            $name = $this->image->store('img', 'public');
            $new->image = $name;
        }
        

        $new->save();
        $this->reset();

        $this->emit('add-user');

        session()->flash('message', 'Makale Başarıyla Eklendi');
    }

    public function getArticle(Article $articles){
        $this->title = $articles->title;
        $this->article = $articles->article;
        $this->article_id = $articles->id;
    }

    public function updateArticle(){
        $this->validate();

        $articles = Article::where('id',$this->article_id)->first();
        $articles->title = $this->title;
        $articles->article = $this->article;
        if (!empty($this->image)){
            $name = $this->image->store('img', 'public');
            $articles->image = $name;
        }
        $articles->save();
        $this->reset();
        $this->emit('update-user');

        session()->flash('message', 'Makale Başarıyla Güncellendi');
    }

    public function getArticle2(Article $articles){
        $this->title = $articles->title;
        $this->article_id = $articles->id;
    }

    public function destroy(){
        
        $articles = Article::where('id',$this->article_id)->first();
        $articles->delete();
        $this->emit('delete-user');

        session()->flash('message', 'Makale Silindi');
        
    }
    
}
